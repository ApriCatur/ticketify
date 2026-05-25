<?php

namespace App\Http\Controllers\Panitia;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class EventController extends Controller
{
    // =========================================================================
    // 1. MENAMPILKAN HALAMAN UTAMA PANITIA (DENGAN URUTAN STATUS & UPCOMING)
    // =========================================================================
    public function index()
    {
        // Ambil data hari ini
        $today = Carbon::today();

        // Query Utama: Fokus urutkan berdasarkan status published terlebih dahulu secara mutlak
        $events = Event::orderByRaw("FIELD(LOWER(status), 'published', 'pending', 'rejected') ASC")
            ->orderBy('date', 'desc') // Tanggal terbaru hanya berlaku untuk sesama status yang sama
            ->get();

        // FIX: Mengubah status 'active' menjadi 'published' sesuai isi database asli
        $upcomingEvents = Event::where('status', 'published')
            ->whereDate('date', '>=', $today)
            ->orderBy('date', 'asc')
            ->take(3)
            ->get();

        // FIX: Kirimkan juga variabel $events ke view agar bagian banner & popular event tetap tampil
        return view('panitia.event', compact('events', 'upcomingEvents'));
    }

    // =========================================================================
    // 2. MENAMPILKAN HALAMAN EDIT EVENT (PROTEKSI REJECTED)
    // =========================================================================
    public function edit($id)
    {
        $event = Event::findOrFail($id);

        // Proteksi Backend: Jika statusnya rejected, blokir akses edit
        if ($event->status === 'rejected') {
            abort(403, 'Event yang ditolak oleh Admin tidak dapat diubah kembali.');
        }

        return view('Panitia.EditEvent', compact('event'));
    }

    // =========================================================================
    // 3. MEMPROSES UPDATE DATA EVENT KE DATABASE (PROTEKSI REJECTED)
    // =========================================================================
    public function update(Request $request, $id)
    {
        $event = Event::findOrFail($id);

        // Proteksi Backend: Memastikan user nakal tidak bisa nembak request lewat Postman/API
        if ($event->status === 'rejected') {
            abort(403, 'Event yang ditolak oleh Admin tidak dapat diubah kembali.');
        }

        // Validasi Input Form (Termasuk array tickets dinamis dari Alpine.js)
        $request->validate([
            'nama_event'       => 'required|string|max:255',
            'kategori'         => 'required|string',
            'lokasi'           => 'required|string',
            'sosmed_link'      => 'nullable|url',
            'tanggal'          => 'required|date',
            'waktu_mulai'      => 'required',
            'waktu_selesai'    => 'required',
            'deskripsi'        => 'required|string',
            'maps_link'        => 'nullable|string',
            'syarat_ketentuan' => 'required|string',
            'deskripsi_org'    => 'nullable|string',
            'banner'           => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'org_photo'        => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',

            // Validasi skema tiket dinamis Alpine.js
            'tickets'          => 'required|array|min:1',
            'tickets.*.name'   => 'required|string|max:255',
            'tickets.*.price'  => 'required|numeric|min:0',
            'tickets.*.stock'  => 'required|integer|min:0',
        ]);

        // Logika Deteksi Perubahan Field Krusial
        $isCriticalChanged = false;

        if (
            $event->name !== $request->nama_event ||
            $event->date !== $request->tanggal ||
            $event->location !== $request->lokasi
        ) {
            $isCriticalChanged = true;
        }

        if (json_encode($event->ticket_types) !== json_encode($request->tickets)) {
            $isCriticalChanged = true;
        }

        // Proses Pemetaan Data ke Model Event
        $event->name                 = $request->nama_event;
        $event->category              = $request->kategori;
        $event->location              = $request->lokasi;
        $event->social_link           = $request->sosmed_link;
        $event->date                  = $request->tanggal;
        $event->time_start            = $request->waktu_mulai;
        $event->time_end              = $request->waktu_selesai;
        $event->description           = $request->deskripsi;
        $event->maps_link             = $request->maps_link;
        $event->terms                 = $request->syarat_ketentuan;
        $event->organiser_description = $request->deskripsi_org;
        $event->ticket_types          = $request->tickets;

        // Hitung total stok dan harga terendah dari array tiket
        $totalStock = array_sum(array_column($request->tickets, 'stock'));
        $minPrice = min(array_column($request->tickets, 'price'));

        $event->stock = $totalStock;
        $event->price = $minPrice;

        // Logika update file Banner/Poster
        if ($request->hasFile('banner')) {
            if ($event->banner && File::exists(public_path('images/events/' . $event->banner))) {
                File::delete(public_path('images/events/' . $event->banner));
            }

            $bannerName = 'banner_'.time().'.'.$request->banner->extension();
            $request->banner->move(public_path('images/events'), $bannerName);
            $event->banner = $bannerName;
            $isCriticalChanged = true;
        }

        // Logika update foto Organisasi
        if ($request->hasFile('org_photo')) {
            if ($event->organiser_photo && File::exists(public_path('images/organizers/' . $event->organiser_photo))) {
                File::delete(public_path('images/organizers/' . $event->organiser_photo));
            }

            $orgPhotoName = 'org_'.time().'.'.$request->org_photo->extension();
            $request->org_photo->move(public_path('images/organizers'), $orgPhotoName);
            $event->organiser_photo = $orgPhotoName;
        }

        // Penentuan Status Akhir
        if ($isCriticalChanged) {
            $event->status = 'pending';
            $message = 'Perubahan event berhasil disimpan! Karena mengubah info krusial, status kembali menjadi Pending untuk diperiksa Admin.';
        } else {
            $message = 'Perubahan minor berhasil disimpan langsung!';
        }

        $event->save();

        return redirect()->route('panitia.myevent')->with('success', $message);
    }

    // =========================================================================
    // 4. MENAMPILKAN DATA PESERTA / ATTENDEE LIST (DINAMIS)
    // =========================================================================
    public function attendees($id)
    {
        // Ambil data event atau berikan error 404 jika id salah
        $event = Event::findOrFail($id);

        // Ambil data peserta yang membeli tiket event ini melalui Query Builder (Join ke tabel users)
        $attendees = DB::table('tickets')
            ->join('users', 'tickets.user_id', '=', 'users.id')
            ->where('tickets.event_id', $id)
            ->select(
                'tickets.*',
                'users.name as user_name',
                'users.email as user_email',
                'users.no_telp as user_phone'
            )
            ->paginate(10);

        // Mengarahkan ke view folder Panitia dengan membawa data event dan peserta
        return view('Panitia.CustomerData', compact('event', 'attendees'));
    }
}
