<?php

namespace App\Http\Controllers\Panitia;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;

class EventController extends Controller
{
    /**
     * FUNGSI: Menampilkan daftar event di dashboard panitia
     */
public function index(Request $request)
{
    $today = Carbon::today();

    // Kita mulai query dari Model Event
    $query = Event::query();

    // Jika user mengetik sesuatu di pencarian
    if ($request->filled('search')) {
        $query->where('name', 'like', '%' . $request->search . '%');
    }

    // Jika user memilih kategori
    if ($request->filled('category_id')) {
    $query->where('category_id', $request->category_id);
}

    if ($request->filled('date')) {
        $query->whereDate('date', $request->date);
    }

    // Ambil data yang sudah difilter
    $publicEvents = $query->where('status', 'published')->get();

    // Data untuk carousel (tetap ambil 5 teratas)
    $events = Event::where('status', 'published')->take(5)->get();

    // Upcoming untuk sidebar
    $upcomingEvents = Event::where('status', 'published')
        ->whereDate('date', '>=', $today)
        ->take(3)
        ->get();

    return view('panitia.event', compact('publicEvents', 'events', 'upcomingEvents'));
}

    /**
     * FUNGSI: Mengambil data untuk halaman edit
     */
    public function edit($id)
{
    $event = Event::where('id', $id)
        ->where('user_id', Auth::id())
        ->firstOrFail();

    return view('panitia.EditEvent', compact('event'));
}

public function show($id)
{
    $event = Event::where('id', $id)
        ->where('user_id', Auth::id())
        ->firstOrFail();

    return view('panitia.DetailEvent', compact('event'));
}

    /**
     * FUNGSI: Menyimpan event baru ke database
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'                  => 'required|string|max:255',
           'category_id'            => 'required|exists:categories,id',
            'location'              => 'required|string',
            'social_link'           => 'nullable|url',
            'date'                  => 'required|date',
            'time_start'            => 'required',
            'time_end'              => 'required',
            'description'           => 'required|string',
            'terms'                 => 'required|string',
            'organiser_description' => 'nullable|string',
            'banner'                => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'organiser_photo'       => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'ticket_types'          => 'required|array|min:1',
            'ticket_types.*.name'   => 'required|string|max:255',
            'ticket_types.*.price'  => 'required|numeric|min:0',
            'ticket_types.*.stock'  => 'required|integer|min:0',
        ]);

        $totalStock = array_sum(array_column($request->ticket_types, 'stock'));
        $minPrice = min(array_column($request->ticket_types, 'price'));

        $bannerName = null;
        if ($request->hasFile('banner')) {
            $bannerFile = $request->file('banner');
            $bannerName = 'banner_' . time() . '.' . $bannerFile->getClientOriginalExtension();
            $bannerFile->move(public_path('images/events'), $bannerName);
        }

        $organiserPhotoName = null;
        if ($request->hasFile('organiser_photo')) {
            $orgFile = $request->file('organiser_photo');
            $organiserPhotoName = 'organiser_' . time() . '.' . $orgFile->getClientOriginalExtension();
            $orgFile->move(public_path('images/organizers'), $organiserPhotoName);
        }

        Event::create([
            'user_id'               => Auth::id(),
            'name'                  => $request->name,
            'category_id'           => $request->category_id,
            'location'              => $request->location,
            'social_link'           => $request->social_link,
            'date'                  => $request->date,
            'time_start'            => $request->time_start,
            'time_end'              => $request->time_end,
            'description'           => $request->description,
            'terms'                 => $request->terms,
            'organiser_description' => $request->organiser_description,
            'ticket_type'           => $request->ticket_types[0]['name'] ?? 'Reguler',
            'ticket_types'          => $request->ticket_types,
            'stock'                 => $totalStock,
            'price'                 => $minPrice,
            'banner'                => $bannerName,
            'organiser_photo'       => $organiserPhotoName,
            'status'                => 'pending',
        ]);

        return redirect()->route('panitia.myevent')->with('success', 'Event berhasil diajukan!');
    }

    /**
     * FUNGSI: Menyimpan perubahan data pada event yang sudah ada
     */
   public function update(Request $request, $id)
{
    $event = Event::where('id', $id)
        ->where('user_id', Auth::id())
        ->firstOrFail();

    $request->validate([
        'name'                  => 'required|string|max:255',
        'category_id'           => 'required|exists:categories,id',
        'location'              => 'required|string',
        'social_link'           => 'nullable|url',
        'date'                  => 'required|date',
        'time_start'            => 'required',
        'time_end'              => 'required',
        'description'           => 'required|string',
        'terms'                 => 'required|string',
        'organiser_description' => 'nullable|string',
        'banner'                => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        'organiser_photo'       => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        'ticket_types'          => 'required|array|min:1',
    ]);

    // Logika perubahan status jika ada data krusial yang berubah
    $isCriticalChanged = ($event->name !== $request->name || $event->date !== $request->date || $event->location !== $request->location);

    // Proses Upload Banner
    $bannerName = $event->banner;
    if ($request->hasFile('banner')) {
        if ($event->banner && File::exists(public_path('images/events/' . $event->banner))) {
            File::delete(public_path('images/events/' . $event->banner));
        }
        $bannerFile = $request->file('banner');
        $bannerName = 'banner_' . time() . '.' . $bannerFile->getClientOriginalExtension();
        $bannerFile->move(public_path('images/events'), $bannerName);
    }

    // Proses Upload Organiser Photo
    $organiserPhotoName = $event->organiser_photo;
    if ($request->hasFile('organiser_photo')) {
        if ($event->organiser_photo && File::exists(public_path('images/organizers/' . $event->organiser_photo))) {
            File::delete(public_path('images/organizers/' . $event->organiser_photo));
        }
        $orgFile = $request->file('organiser_photo');
        $organiserPhotoName = 'organiser_' . time() . '.' . $orgFile->getClientOriginalExtension();
        $orgFile->move(public_path('images/organizers'), $organiserPhotoName);
    }

    // Update Database
    $event->update([
        'name'                  => $request->name,
        'category_id'           => $request->category_id,
        'location'              => $request->location,
        'social_link'           => $request->social_link,
        'date'                  => $request->date,
        'time_start'            => $request->time_start,
        'time_end'              => $request->time_end,
        'description'           => $request->description,
        'terms'                 => $request->terms,
        'organiser_description' => $request->organiser_description,
        'ticket_types'          => $request->ticket_types,
        'stock'                 => array_sum(array_column($request->ticket_types, 'stock')),
        'price'                 => min(array_column($request->ticket_types, 'price')),
        'banner'                => $bannerName,
        'organiser_photo'       => $organiserPhotoName,
        'status'                => $isCriticalChanged ? 'pending' : $event->status,
    ]);

    return redirect()->route('panitia.myevent')->with('success', 'Perubahan berhasil disimpan!');
}
 public function destroy($id)
{
    $event = Event::where('id', $id)
        ->where('user_id', Auth::id())
        ->firstOrFail();

    if (
        $event->banner &&
        File::exists(public_path('images/events/' . $event->banner))
    ) {
        File::delete(
            public_path('images/events/' . $event->banner)
        );
    }

    if (
        $event->organiser_photo &&
        File::exists(public_path('images/organizers/' . $event->organiser_photo))
    ) {
        File::delete(
            public_path('images/organizers/' . $event->organiser_photo)
        );
    }

    $event->delete();

    return redirect()
        ->route('panitia.myevent')
        ->with(
            'success',
            'Event berhasil dihapus.'
        );
}



}
