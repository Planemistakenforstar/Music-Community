<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NavigationTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_navigation_links_to_listen_lessons_forum_and_dashboard(): void
    {
        $this->get(route('home'))
            ->assertOk()
            ->assertSee('href="#tracks"', false)
            ->assertSee('href="#lessons"', false)
            ->assertSee('href="' . route('forum') . '"', false)
            ->assertSee('href="' . route('dashboard') . '"', false);
    }

    public function test_dashboard_navigation_links_to_the_same_sections(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get(route('dashboard'))
            ->assertOk()
            ->assertSee('href="' . route('tracks.index') . '"', false)
            ->assertSee('href="' . route('lessons') . '"', false)
            ->assertSee('href="' . route('forum') . '"', false)
            ->assertSee('href="' . route('dashboard') . '"', false);
    }
}
