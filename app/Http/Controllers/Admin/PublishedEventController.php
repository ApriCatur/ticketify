<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class PublishedEventController extends Controller
{
    public function index()
    {
        $publishedEvents = Event::where('status', 'published')
            ->orderBy('date', 'asc')
            ->get();

        return view('Admin.PublishedEvent', compact('publishedEvents'));
    }

    public function unpublish(Request $request, Event $event)
    {
        $request->validate([
            'reason' => 'required|string|min:10|max:500',
        ]);

        $event->update([
            'status'           => 'rejected',
            'unpublish_reason' => $request->reason,
            'unpublished_at'   => now(),
        ]);

        return back()->with('success', 'Event berhasil di-unpublish.');
    }
}
