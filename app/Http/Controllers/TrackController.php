<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTrackRequest;
use App\Models\Track;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use RuntimeException;
use Throwable;

class TrackController extends Controller
{
    public function create()
    {
        return view('tracks.create');
    }
    public function store(StoreTrackRequest $request)
    {
        $path = $request->file('file')->store('tracks', 'public');
        if ($path === false) {
            throw new RuntimeException('The uploaded track file could not be stored.');
        }

        try {
            $track = DB::transaction(fn() => $request->user()->tracks()->create([
                'title' => $request->validated('title'),
                'genre' => $request->validated('genre'),
                'city' => $request->validated('city'),
                'file_path' => $path,
                'airplay_permission' => true,
                'permission_granted_at' => now(),
                'status' => 'draft',
            ]));
        } catch (Throwable $exception) {
            if (! Storage::disk('public')->delete($path)) {
                report(new RuntimeException('Failed to remove a track file after its database insert failed.', 0, $exception));
            }

            throw $exception;
        }

        return redirect()
            ->route('dashboard.tracks.index')
            ->with('status', 'Track uploaded and submitted for review.');
    }

    public function dashboardIndex(Request $request)
    {
        $tracks = $request->user()->tracks()->latest()->paginate(20);

        return view('tracks.dashboard-index', compact('tracks'));
    }

    public function index()
    {
        $tracks = Track::clearedForAirplay()->with('artist')->latest()->paginate(20);
        return view('tracks.index', compact('tracks'));
    }

    public function show(Track $track)
    {
        abort_unless($track->status === 'live' && $track->airplay_permission, 404);

        return view('tracks.show', compact('track'));
    }
}
