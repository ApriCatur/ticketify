<?php

namespace App\Http\Controllers\Pembeli;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        // Hanya menampilkan event yang sudah disetujui admin dan dipublikasikan.
        $events = Event::where('status', 'published')
            ->orderBy('date', 'asc')
            ->get();

        return view('Pembeli.event', compact('events'));
    }

    /**
     * Show the event detail.
     */
    public function show(Event $event)
    {
        return view('Pembeli.detail', compact('event'));
    }
}
