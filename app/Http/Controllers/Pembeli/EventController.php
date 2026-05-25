<?php

namespace App\Http\Controllers\Pembeli;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Carbon\Carbon;

class EventController extends Controller
{
    public function index(Request $request)
    {
        // Ambil data hari ini
        $today = Carbon::today();

        // Query dasar: Hanya event yang sudah disetujui admin dan dipublikasikan
        $query = Event::where('status', 'published');

        // Filter berdasarkan Search (Nama Event)
        if ($request->filled('search')) {
            $searchTerm = $request->input('search');
            $query->where('name', 'like', '%' . $searchTerm . '%');
        }

        // Filter berdasarkan Kategori
        if ($request->filled('category')) {
            $query->where('category', $request->input('category'));
        }

        // Filter berdasarkan Tanggal
        if ($request->filled('date')) {
            $selectedDate = $request->input('date');
            $query->whereDate('date', '=', $selectedDate);
        }

        // Ambil hasil dengan pengurutan
        $events = $query->orderBy('date', 'asc')->get();

        // Ambil 3 event terdekat dari tanggal sekarang (Upcoming Events)
        $upcomingEvents = Event::where('status', 'published')
            ->whereDate('date', '>=', $today)
            ->orderBy('date', 'asc')
            ->take(3)
            ->get();

        return view('Pembeli.event', compact('events', 'upcomingEvents'));
    }

    /**
     * Show the event detail.
     */
    public function show(Event $event)
    {
        return view('Pembeli.detail', compact('event'));
    }
}
