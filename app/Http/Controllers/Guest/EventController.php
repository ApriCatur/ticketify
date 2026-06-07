<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Category;

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

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
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

        // 4. Query untuk kategori
        $categories = Category::all();

        // KIRIM SEMUA VARIABEL KE VIEW
        return view('guest.event', compact('publicEvents', 'events', 'upcomingEvents', 'categories'));
    }

 public function show($id)
{
    // Mengambil data berdasarkan ID secara manual agar lebih fleksibel
    $event = \App\Models\Event::findOrFail($id);

    return view('guest.detail', compact('event'));
}
} // Pastikan class ditutup di sini
