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
            ->with('tickets')   // ← load relasi tickets
            ->orderBy('date', 'asc')
            ->get();

        return view('Admin.PublishedEvent', compact('publishedEvents'));
    }

    public function unpublish(Event $event)
    {
        if ($event->status !== 'published') {
            return redirect()->back()->with('error', 'Hanya event yang sudah dipublikasikan yang bisa diunpublish.');
        }

        $event->update(['status' => 'pending']);

        return redirect()->back()->with('success', 'Event "' . $event->name . '" berhasil dipindahkan kembali ke status pending.');
    }
}
