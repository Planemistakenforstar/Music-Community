<?php

namespace Tests\Feature;

use App\Models\Track;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use RuntimeException;
use Tests\TestCase;

class TrackPersistenceTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_access_is_granted_and_revoked_from_the_command_line(): void
    {
        $user = User::factory()->create();
        $this->assertFalse($user->isAdmin());

        $this->artisan('users:set-admin', ['email' => $user->email, 'status' => 'grant'])
            ->assertSuccessful();
        $this->assertTrue($user->fresh()->isAdmin());

        $this->artisan('users:set-admin', ['email' => $user->email, 'status' => 'revoke'])
            ->assertSuccessful();
        $this->assertFalse($user->fresh()->isAdmin());
    }

    public function test_artist_upload_is_persisted_as_a_private_draft_until_admin_publishes_it(): void
    {
        Storage::fake('public');
        $artist = User::factory()->create(['role' => 'artist']);

        $this->actingAs($artist)
            ->post(route('dashboard.tracks.store'), [
                'title' => 'Community Song',
                'airplay_permission' => '1',
                'file' => UploadedFile::fake()->create('community-song.mp3', 10, 'audio/mpeg'),
            ])
            ->assertRedirect(route('dashboard.tracks.index'));

        $track = Track::query()->where('title', 'Community Song')->firstOrFail();

        $this->assertDatabaseHas('tracks', [
            'id' => $track->id,
            'user_id' => $artist->id,
            'status' => 'draft',
            'airplay_permission' => true,
        ]);
        Storage::disk('public')->assertExists($track->file_path);
        $this->get(route('tracks.show', $track))->assertNotFound();

        $this->actingAs($artist)
            ->get(route('admin.tracks.review.index'))
            ->assertForbidden();

        $admin = User::factory()->create();
        $admin->is_admin = true;
        $admin->save();

        $this->actingAs($admin)
            ->get(route('admin.tracks.review.index'))
            ->assertOk()
            ->assertSee('Community Song');

        $this->actingAs($admin)
            ->post(route('admin.tracks.publish', $track))
            ->assertRedirect(route('admin.tracks.review.index'));

        $this->assertDatabaseHas('tracks', [
            'id' => $track->id,
            'status' => 'live',
        ]);
        $this->get(route('tracks.show', $track))->assertOk();
    }

    public function test_upload_removes_the_file_if_database_persistence_fails(): void
    {
        Storage::fake('public');
        $artist = User::factory()->create(['role' => 'artist']);
        Track::creating(function () {
            throw new RuntimeException('Simulated database insert failure.');
        });

        try {
            $this->withoutExceptionHandling()
                ->actingAs($artist)
                ->post(route('dashboard.tracks.store'), [
                    'title' => 'Failed Song',
                    'airplay_permission' => '1',
                    'file' => UploadedFile::fake()->create('failed-song.mp3', 10, 'audio/mpeg'),
                ]);
            $this->fail('The database failure should be rethrown.');
        } catch (RuntimeException $exception) {
            $this->assertSame('Simulated database insert failure.', $exception->getMessage());
        }

        $this->assertDatabaseCount('tracks', 0);
        $this->assertSame([], Storage::disk('public')->allFiles('tracks'));
    }
}
