<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class PendingEventController extends Controller
{
    public function index()
    {
        $pendingEvents = Event::with('tickets')->where('status', 'pending')
            ->orderBy('date', 'asc')
            ->get();

        return view('Admin.PendingEvent', compact('pendingEvents'));
    }

    public function approve(Event $event)
    {
        if ($event->status !== 'pending') {
            return redirect()->back()->with('error', 'Hanya event dengan status pending yang bisa disetujui.');
        }

        $event->update(['status' => 'published']);

        return redirect()->back()->with('success', 'Event berhasil disetujui dan dipublikasikan.');
    }

    public function reject(Event $event)
    {
        if ($event->status !== 'pending') {
            return redirect()->back()->with('error', 'Hanya event dengan status pending yang bisa ditolak.');
        }

        $event->update(['status' => 'rejected']);

        return redirect()->back()->with('success', 'Event berhasil ditolak.');
    }
}
