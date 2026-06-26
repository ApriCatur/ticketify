<?php

namespace App\Http\Controllers\Pembeli;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Category;
use Illuminate\Http\Request;
use Carbon\Carbon;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $today = Carbon::today();

        // 1. Query untuk event utama dengan filter
        $query = Event::with(['tickets', 'category'])->where('status', 'published')->whereDate('date', '>=', $today);

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Ubah bagian ini agar sesuai dengan name="category_id" di komponen Anda
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('date')) {
            $query->whereDate('date', $request->date);
        }

        $publicEvents = $query->latest()->get();

        // 2. Query untuk carousel & sidebar
        $events = Event::where('status', 'published')->whereDate('date', '>=', $today)->latest()->take(5)->get();
        $upcomingEvents = Event::where('status', 'published')
            ->whereDate('date', '>=', $today)
            ->orderBy('date', 'asc')
            ->take(4)
            ->get();

        $categories = Category::all();

        return view('pembeli.event', compact('publicEvents', 'events', 'upcomingEvents', 'categories'));
    }

        public function show(Event $event)
        {
            $event->load(['tickets', 'category']);

            return view('Pembeli.detail', compact('event'));
        }
}
