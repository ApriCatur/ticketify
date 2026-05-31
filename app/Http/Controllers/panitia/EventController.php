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
    public function index()
{
    $today = Carbon::today();

    $events = Event::where('user_id', Auth::id())
        ->orderByRaw("
            FIELD(
                LOWER(status),
                'published',
                'pending',
                'rejected'
            )
        ")
        ->orderBy('date', 'desc')
        ->get();

    $upcomingEvents = Event::where('user_id', Auth::id())
        ->where('status', 'published')
        ->whereDate('date', '>=', $today)
        ->orderBy('date', 'asc')
        ->take(3)
        ->get();

    return view('panitia.event', compact(
        'events',
        'upcomingEvents'
    ));
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
            'category'              => 'required|string',
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
            'category'              => $request->category,
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
            'nama_event'       => 'required|string|max:255',
            'kategori'         => 'required|string',
            'lokasi'           => 'required|string',
            'sosmed_link'      => 'nullable|url',
            'tanggal'          => 'required|date',
            'waktu_mulai'      => 'required',
            'waktu_selesai'    => 'required',
            'deskripsi'        => 'required|string',
            'syarat_ketentuan' => 'required|string',
            'deskripsi_org'    => 'nullable|string',
            'banner'           => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'org_photo'        => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'tickets'          => 'required|array|min:1',
        ]);

        $isCriticalChanged = ($event->name !== $request->nama_event || $event->date !== $request->tanggal || $event->location !== $request->lokasi || json_encode($event->ticket_types) !== json_encode($request->tickets));

        $bannerName = $event->banner;
        if ($request->hasFile('banner')) {
            if ($event->banner && File::exists(public_path('images/events/' . $event->banner))) {
                File::delete(public_path('images/events/' . $event->banner));
            }
            $bannerFile = $request->file('banner');
            $bannerName = 'banner_' . time() . '.' . $bannerFile->getClientOriginalExtension();
            $bannerFile->move(public_path('images/events'), $bannerName);
        }

        $organiserPhotoName = $event->organiser_photo;
        if ($request->hasFile('org_photo')) {
            if ($event->organiser_photo && File::exists(public_path('images/organizers/' . $event->organiser_photo))) {
                File::delete(public_path('images/organizers/' . $event->organiser_photo));
            }
            $orgFile = $request->file('org_photo');
            $organiserPhotoName = 'organiser_' . time() . '.' . $orgFile->getClientOriginalExtension();
            $orgFile->move(public_path('images/organizers'), $organiserPhotoName);
        }

        $event->update([
            'name'                  => $request->nama_event,
            'category'              => $request->kategori,
            'location'              => $request->lokasi,
            'social_link'           => $request->sosmed_link,
            'date'                  => $request->tanggal,
            'time_start'            => $request->waktu_mulai,
            'time_end'              => $request->waktu_selesai,
            'description'           => $request->deskripsi,
            'terms'                 => $request->syarat_ketentuan,
            'organiser_description' => $request->deskripsi_org,
            'ticket_types'          => $request->tickets,
            'stock'                 => array_sum(array_column($request->tickets, 'stock')),
            'price'                 => min(array_column($request->tickets, 'price')),
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
