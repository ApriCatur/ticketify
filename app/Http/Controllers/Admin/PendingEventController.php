<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PendingEventController extends Controller
{
    public function index()
    {
        $today = Carbon::today();

        $pendingEvents = Event::with('tickets')->where('status', 'pending')
            ->orderBy('created_at', 'desc')
            ->get();

        $upcomingEvents = Event::with('tickets')->where('status', 'pending')
            ->whereDate('date', '>=', $today)
            ->orderBy('date', 'asc')
            ->take(3)
            ->get();

        $categories = Category::all();

        return view('Admin.PendingEvent', compact('pendingEvents', 'upcomingEvents', 'categories'));
    }

    public function approve(Event $event)
    {
        if ($event->status !== 'pending') {
            return redirect()->back()->with('error', 'Hanya event dengan status pending yang bisa disetujui.');
        }

        if ($event->date < Carbon::today()->format('Y-m-d')) {
            return redirect()->back()->with('error', 'Tidak bisa menyetujui event yang tanggalnya sudah lewat.');
        }

        $event->update(['status' => 'published']);

        return redirect()->back()->with('success', 'Event berhasil disetujui dan dipublikasikan.');
    }

    public function reject(Request $request, Event $event)
    {
        if ($event->status !== 'pending') {
            return redirect()->back()->with('error', 'Hanya event dengan status pending yang bisa ditolak.');
        }

        $request->validate([
            'reason' => 'required|string|min:10|max:500',
        ]);

        $event->update([
            'status' => 'rejected',
            'unpublish_reason' => $request->reason,
        ]);

        return redirect()->back()->with('success', 'Event berhasil ditolak.');
    }
}
