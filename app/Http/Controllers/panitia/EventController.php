<?php

namespace App\Http\Controllers\Panitia;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $today = Carbon::today();
        $query = Event::with('tickets');

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('date')) {
            $query->whereDate('date', $request->date);
        }

        $publicEvents = $query->where('status', 'published')->get();
        $events = Event::with('tickets')->where('status', 'published')->take(5)->get();
        $upcomingEvents = Event::with('tickets')->where('status', 'published')->whereDate('date', '>=', $today)->take(3)->get();
        $categories = Category::all();

        return view('panitia.event', compact('publicEvents', 'events', 'upcomingEvents', 'categories'));
    }

    public function edit($id)
    {
        $event = Event::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        return view('panitia.EditEvent', compact('event'));
    }

    public function show($id)
    {
        $event = Event::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        return view('panitia.DetailEvent', compact('event'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'location' => 'required|string',
            'date' => 'required|date',
            'time_start' => 'required',
            'time_end' => 'required',
            'description' => 'required|string',
            'terms' => 'required|string',
            'banner' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'organiser_photo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'ticket_types' => 'required|array|min:1',
            'ticket_types.*.ticket_type' => 'required|string|max:255',
            'ticket_types.*.price' => 'required|numeric|min:0',
            'ticket_types.*.stock' => 'required|integer|min:0',
        ]);

        return DB::transaction(function () use ($request) {
            $bannerName = $this->handleFileUpload($request, 'banner', 'images/events', 'banner_');
            $orgPhotoName = $this->handleFileUpload($request, 'organiser_photo', 'images/organizers', 'organiser_');

            $event = Event::create([
                'user_id' => Auth::id(),
                'name' => $request->name,
                'category_id' => $request->category_id,
                'location' => $request->location,
                'date' => $request->date,
                'time_start' => $request->time_start,
                'time_end' => $request->time_end,
                'description' => $request->description,
                'terms' => $request->terms,
                'organiser_description' => $request->organiser_description,
                'banner' => $bannerName,
                'organiser_photo' => $orgPhotoName,
                'status' => 'pending',
            ]);

            foreach ($request->ticket_types as $t) {
    $event->tickets()->create([
        'user_id' => Auth::id(),
        'ticket_type' => $t['ticket_type'],
        'price' => $t['price'],
        'stock' => $t['stock'],
        'status' => 'Active',
        'purchase_date' => now(),
    ]);
}

            return redirect()->route('panitia.myevent')->with('success', 'Event berhasil diajukan!');
        });
    }

    public function update(Request $request, $id)
    {
        $event = Event::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'ticket_types' => 'required|array|min:1',
        ]);

        DB::transaction(function () use ($request, $event) {
            $isCriticalChanged = ($event->name !== $request->name || $event->date !== $request->date);

            $bannerName = $request->hasFile('banner') ? $this->handleFileUpload($request, 'banner', 'images/events', 'banner_', $event->banner) : $event->banner;
            $orgPhotoName = $request->hasFile('organiser_photo') ? $this->handleFileUpload($request, 'organiser_photo', 'images/organizers', 'organiser_', $event->organiser_photo) : $event->organiser_photo;

            $event->update([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'location' => $request->location,
            'date' => $request->date,
            'time_start' => $request->time_start,
            'time_end' => $request->time_end,
            'description' => $request->description,
            'terms' => $request->terms,
            'organiser_description' => $request->organiser_description,
            'banner' => $bannerName,
            'organiser_photo' => $orgPhotoName,
            'status' => $isCriticalChanged ? 'pending' : $event->status,
        ]);

            // Sync: Hapus lama, ganti baru
            $event->tickets()->delete();
            foreach ($request->ticket_types as $t) {
                $event->tickets()->create([
                    'user_id' => Auth::id(),
                    'ticket_type' => $t['ticket_type'],
                    'price' => $t['price'],
                    'stock' => $t['stock'],
                    'status' => 'Active',
                ]);
            }
        });

        return redirect()->route('panitia.myevent')->with('success', 'Perubahan berhasil disimpan!');
    }

    // Helper untuk upload agar kode lebih rapi
    private function handleFileUpload(Request $request, $fieldName, $path, $prefix, $oldFile = null)
    {
        if ($oldFile && File::exists(public_path($path . '/' . $oldFile))) {
            File::delete(public_path($path . '/' . $oldFile));
        }
        $file = $request->file($fieldName);
        $fileName = $prefix . time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path($path), $fileName);
        return $fileName;
    }

    public function destroy($id)
    {
        $event = Event::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        if ($event->banner) File::delete(public_path('images/events/' . $event->banner));
        if ($event->organiser_photo) File::delete(public_path('images/organizers/' . $event->organiser_photo));
        $event->delete();
        return redirect()->route('panitia.myevent')->with('success', 'Event berhasil dihapus.');
    }
}
