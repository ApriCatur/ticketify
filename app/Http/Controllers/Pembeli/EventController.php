<?php

namespace App\Http\Controllers\Pembeli;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Carbon\Carbon;

class EventController extends Controller // Pastikan class dibuka di sini
{
    public function index(Request $request)
    {
        $today = Carbon::today();

        // 1. Query untuk event utama (dengan filter)
        $query = Event::where('status', 'published');

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        if ($request->filled('date')) {
            $query->whereDate('date', $request->date);
        }

        $publicEvents = $query->orderBy('date', 'asc')->get();

        // 2. Query untuk carousel
        $events = Event::where('status', 'published')->take(5)->get();

        // 3. Query untuk sidebar
        $upcomingEvents = Event::where('status', 'published')
            ->whereDate('date', '>=', $today)
            ->orderBy('date', 'asc')
            ->take(3)
            ->get();

        // KIRIM SEMUA VARIABEL KE VIEW
        return view('pembeli.event', compact('publicEvents', 'events', 'upcomingEvents'));
    }

    public function show(Event $event)
    {
        return view('pembeli.detail', compact('event'));
    }
} // Pastikan class ditutup di sini
