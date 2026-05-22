<?php

namespace App\Http\Controllers\Panitia;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventPanitiaController extends Controller
{
    /**
     * Display a listing of published events for panitia
     */
    public function index()
    {
        // Hanya menampilkan event yang sudah disetujui admin dan dipublikasikan.
        $events = Event::where('status', 'published')
            ->orderBy('date', 'asc')
            ->get();

        return view('Panitia.event', compact('events'));
    }

    // Fungsi memproses data form saat tombol "AJUKAN EVENT SEKARANG" ditekan
    public function store(Request $request)
    {
        // Validasi data input form
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string',
            'location' => 'required|string',
            'date' => 'required|date',
            'time_start' => 'required',
            'time_end' => 'required',
            'ticket_types' => 'required|array|min:1',
            'ticket_types.*.name' => 'required|string|max:255',
            'ticket_types.*.price' => 'required|numeric|min:0',
            'ticket_types.*.stock' => 'required|integer|min:0',
            'description' => 'required|string',
            'terms' => 'required|string',
            'banner' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'organiser_photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $ticketTypes = $validated['ticket_types'];

        // Proses Upload Poster Event jika ada
        $bannerPath = null;
        if ($request->hasFile('banner')) {
            $bannerPath = $request->file('banner')->store('banners', 'public');
        }

        // Proses Upload Foto Organisasi jika ada
        $organiserPhotoPath = null;
        if ($request->hasFile('organiser_photo')) {
            $organiserPhotoPath = $request->file('organiser_photo')->store('organisers', 'public');
        }

        // Simpan Data ke Tabel Events
        Event::create([
            'user_id' => Auth::id(), // ID Panitia yang sedang login
            'banner' => $bannerPath,
            'name' => $request->name,
            'category' => $request->category,
            'location' => $request->location,
            'social_link' => $request->social_link,
            'date' => $request->date,
            'time_start' => $request->time_start,
            'time_end' => $request->time_end,
            'ticket_type' => $ticketTypes[0]['name'] ?? 'Reguler',
            'ticket_types' => $ticketTypes,
            'price' => $ticketTypes[0]['price'] ?? 0,
            'stock' => $ticketTypes[0]['stock'] ?? 0,
            'description' => $request->description,
            'maps_link' => $request->maps_link,
            'terms' => $request->terms,
            'organiser_description' => $request->organiser_description,
            'organiser_photo' => $organiserPhotoPath,
            'status' => 'pending' // Default pending agar divalidasi admin dulu sebelum terbit
        ]);

        // Redirect kembali ke list event panitia dengan pesan sukses
        return redirect()->route('panitia.myevent')->with('success', 'Event berhasil diajukan! Menunggu verifikasi Admin.');
    }
}
