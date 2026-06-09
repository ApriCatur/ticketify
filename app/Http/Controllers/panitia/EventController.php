<?php

namespace App\Http\Controllers\Panitia;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEventRequest;
use App\Models\Event;
use App\Models\Category;
use App\Services\EventService;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function __construct(
        protected EventService $eventService
    ) {}

    public function index()
    {
        $events = Event::where('user_id', Auth::id())
            ->orderByDesc('created_at')
            ->get();

        return view('panitia.Event', compact('events'));
    }

    public function show($id)
    {
        $event = Event::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        return view('panitia.DetailEvent', compact('event'));
    }

    public function store(StoreEventRequest $request)
    {
        $this->eventService->createEvent($request);

        return redirect()->route('panitia.myevent')
            ->with('success', 'Event berhasil diajukan!');
    }

    public function edit($id)
    {
        $event = Event::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $categories = Category::all();
        $ticketTypes = $event->tickets()
            ->whereNull('order_id')
            ->get(['ticket_type', 'price', 'stock']);

        return view('panitia.EditEvent', compact('event', 'categories', 'ticketTypes'));
    }

    public function update(StoreEventRequest $request, $id)
    {
        $event = Event::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $this->eventService->updateEvent($request, $event);

        return redirect()->route('panitia.myevent')
            ->with('success', 'Perubahan berhasil disimpan!');
    }

    public function destroy($id)
    {
        $event = Event::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $this->eventService->deleteEvent($event);

        return redirect()->route('panitia.myevent')
            ->with('success', 'Event berhasil dihapus!');
    }
}
