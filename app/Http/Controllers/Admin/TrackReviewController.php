<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Track;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class TrackReviewController extends Controller
{
    public function index(): View
    {
        $tracks = Track::query()
            ->where('status', 'draft')
            ->where('airplay_permission', true)
            ->with('artist')
            ->latest()
            ->paginate(20);

        return view('admin.tracks.review', compact('tracks'));
    }

    public function publish(Track $track): RedirectResponse
    {
        abort_unless($track->status === 'draft' && $track->airplay_permission, 404);

        $track->update(['status' => 'live']);

        return redirect()
            ->route('admin.tracks.review.index')
            ->with('status', 'Track published.');
    }
}
