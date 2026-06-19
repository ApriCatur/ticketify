<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Category;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PublishedEventController extends Controller
{
    public function index(Request $request)
    {
        $today = Carbon::today();

        $query = Event::with('tickets')->where('status', 'published');

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('date')) {
            $query->whereDate('date', $request->date);
        }

        $publishedEvents = $query->orderBy('updated_at', 'desc')->get();
        $events          = Event::with('tickets')->where('status', 'published')
            ->orderBy('updated_at', 'desc')
            ->take(5)->get();
        $upcomingEvents  = Event::with('tickets')->where('status', 'published')
            ->whereDate('date', '>=', $today)
            ->orderBy('date', 'asc')
            ->take(3)
            ->get();

        $categories = Category::all();

        return view('Admin.PublishedEvent', compact('publishedEvents', 'events', 'upcomingEvents', 'categories'));
    }

    public function unpublish(Request $request, Event $event)
    {
        $request->validate([
            'reason' => 'required|string|min:10|max:500',
            'refund_date' => 'nullable|date',
            'refund_location' => 'nullable|string|max:255',
            'refund_info' => 'nullable|string|max:1000',
        ]);

        $event->update([
            'status'           => 'unpublished',
            'unpublish_reason' => $request->reason,
            'unpublished_at'   => now(),
            'refund_date'      => $request->refund_date,
            'refund_location'  => $request->refund_location,
            'refund_info'      => $request->refund_info,
        ]);

        $event->tickets()->whereNotNull('order_id')->update(['status' => 'Canceled']);

        return redirect()->route('admin.PublishedEvent')->with('success', 'Event berhasil di-unpublish dan tiket pembeli telah di-cancel.');
    }
}
