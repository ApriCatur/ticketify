<?php

namespace App\Http\Controllers\Guest;

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

        return view('Guest.event', compact('events', 'upcomingEvents'));
    }

    /**
     * Display detail of a specific event
     */
    public function show($id)
    {
        $event = Event::findOrFail($id);

        // Jika event belum published, jangan tampilkan
        if ($event->status !== 'published') {
            abort(404);
        }

        return view('Guest.EventDetail', compact('event'));
    }

    /**
     * Filter events berdasarkan kategori dan tanggal
     */
    public function filter($category = null, $date = null)
    {
        $query = Event::where('status', 'published');

        if ($category && $category !== 'semua') {
            $query->where('category', $category);
        }

        if ($date) {
            $query->whereDate('date', $date);
        }

        $events = $query->orderBy('date', 'desc')->get();

        return response()->json($events);
    }
}
