<?php

namespace App\Http\Controllers\Panitia;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;

class EventController extends Controller
{
    // =========================================================================
    // 1. MENAMPILKAN HALAMAN MY EVENT PANITIA
    // =========================================================================
    public function index()
    {
        $today = Carbon::today();

        /*
        |--------------------------------------------------------------------------
        | Menampilkan seluruh event
        |--------------------------------------------------------------------------
        | Diurutkan berdasarkan status:
        | Published -> Pending -> Rejected
        | Kemudian berdasarkan tanggal terbaru.
        */
        $events = Event::orderByRaw("
                FIELD(
                    LOWER(status),
                    'published',
                    'pending',
                    'rejected'
                )
            ")
            ->orderBy('date', 'desc')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Menampilkan 3 event terdekat yang sudah dipublish
        |--------------------------------------------------------------------------
        */
        $upcomingEvents = Event::where('status', 'published')
            ->whereDate('date', '>=', $today)
            ->orderBy('date', 'asc')
            ->take(3)
            ->get();

        return view('panitia.event', compact('events', 'upcomingEvents'));
    }

    // =========================================================================
    // 2. MENYIMPAN EVENT BARU
    // =========================================================================
    public function store(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | Validasi Input Form
        |--------------------------------------------------------------------------
        */
        $request->validate([
            'name'                    => 'required|string|max:255',
            'category'                => 'required|string',
            'location'                => 'required|string',
            'social_link'             => 'nullable|url',
            'date'                    => 'required|date',
            'time_start'              => 'required',
            'time_end'                => 'required',
            'description'             => 'required|string',
            'maps_link'               => 'nullable|string',
            'terms'                   => 'required|string',
            'organiser_description'   => 'nullable|string',

            'banner'                  => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'organiser_photo'         => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',

            // Validasi tiket dinamis
            'ticket_types'            => 'required|array|min:1',
            'ticket_types.*.name'     => 'required|string|max:255',
            'ticket_types.*.price'    => 'required|numeric|min:0',
            'ticket_types.*.stock'    => 'required|integer|min:0',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Menghitung total stok dan harga termurah
        |--------------------------------------------------------------------------
        | Total stok = jumlah seluruh stok tiket
        | Harga event = harga tiket termurah
        */
        $totalStock = array_sum(array_column($request->ticket_types, 'stock'));
        $minPrice   = min(array_column($request->ticket_types, 'price'));

        /*
        |--------------------------------------------------------------------------
        | Upload Banner Event
        |--------------------------------------------------------------------------
        */
        $bannerName = null;

        if ($request->hasFile('banner')) {

            $bannerName = 'banner_' . time() . '.' .
                $request->banner->extension();

            $request->banner->move(
                public_path('images/events'),
                $bannerName
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Upload Foto Organiser
        |--------------------------------------------------------------------------
        */
        $organiserPhotoName = null;

        if ($request->hasFile('organiser_photo')) {

            $organiserPhotoName = 'org_' . time() . '.' .
                $request->organiser_photo->extension();

            $request->organiser_photo->move(
                public_path('images/organizers'),
                $organiserPhotoName
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Simpan Event ke Database
        |--------------------------------------------------------------------------
        */
        Event::create([
            'user_id'                 => Auth::id(),
            'name'                    => $request->name,
            'category'                => $request->category,
            'location'                => $request->location,
            'social_link'             => $request->social_link,
            'date'                    => $request->date,
            'time_start'              => $request->time_start,
            'time_end'                => $request->time_end,
            'description'             => $request->description,
            'maps_link'               => $request->maps_link,
            'terms'                   => $request->terms,
            'organiser_description'   => $request->organiser_description,

            // Tiket utama yang ditampilkan
            'ticket_type'             => $request->ticket_types[0]['name'] ?? 'Reguler',

            // Semua tipe tiket disimpan dalam format JSON
            'ticket_types'            => $request->ticket_types,

            'stock'                   => $totalStock,
            'price'                   => $minPrice,

            'banner'                  => $bannerName,
            'organiser_photo'         => $organiserPhotoName,

            // Event baru otomatis berstatus pending
            'status'                  => 'pending',
        ]);

        return redirect()
            ->route('panitia.myevent')
            ->with(
                'success',
                'Event berhasil diajukan! Menunggu verifikasi Admin.'
            );
    }

    // =========================================================================
    // 3. MENAMPILKAN HALAMAN EDIT EVENT
    // =========================================================================
    public function edit($id)
    {
        $event = Event::findOrFail($id);

        /*
        |--------------------------------------------------------------------------
        | Event yang ditolak tidak boleh diedit lagi
        |--------------------------------------------------------------------------
        */
        if ($event->status === 'rejected') {
            abort(
                403,
                'Event yang ditolak oleh Admin tidak dapat diubah kembali.'
            );
        }

        return view('Panitia.EditEvent', compact('event'));
    }

    // =========================================================================
    // 4. UPDATE DATA EVENT
    // =========================================================================
    public function update(Request $request, $id)
    {
        $event = Event::findOrFail($id);

        if ($event->status === 'rejected') {
            abort(
                403,
                'Event yang ditolak oleh Admin tidak dapat diubah kembali.'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Validasi Input
        |--------------------------------------------------------------------------
        */
        $request->validate([
            'nama_event'        => 'required|string|max:255',
            'kategori'          => 'required|string',
            'lokasi'            => 'required|string',
            'sosmed_link'       => 'nullable|url',
            'tanggal'           => 'required|date',
            'waktu_mulai'       => 'required',
            'waktu_selesai'     => 'required',
            'deskripsi'         => 'required|string',
            'maps_link'         => 'nullable|string',
            'syarat_ketentuan'  => 'required|string',
            'deskripsi_org'     => 'nullable|string',

            'banner'            => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'org_photo'         => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',

            'tickets'           => 'required|array|min:1',
            'tickets.*.name'    => 'required|string|max:255',
            'tickets.*.price'   => 'required|numeric|min:0',
            'tickets.*.stock'   => 'required|integer|min:0',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Mengecek apakah ada perubahan krusial
        |--------------------------------------------------------------------------
        | Jika ada perubahan penting maka status kembali ke pending
        | agar diverifikasi ulang oleh Admin.
        */
        $isCriticalChanged = false;

        if (
            $event->name !== $request->nama_event ||
            $event->date !== $request->tanggal ||
            $event->location !== $request->lokasi
        ) {
            $isCriticalChanged = true;
        }

        if (
            json_encode($event->ticket_types) !==
            json_encode($request->tickets)
        ) {
            $isCriticalChanged = true;
        }

        /*
        |--------------------------------------------------------------------------
        | Update Data Event
        |--------------------------------------------------------------------------
        */
        $event->name                   = $request->nama_event;
        $event->category               = $request->kategori;
        $event->location               = $request->lokasi;
        $event->social_link            = $request->sosmed_link;
        $event->date                   = $request->tanggal;
        $event->time_start             = $request->waktu_mulai;
        $event->time_end               = $request->waktu_selesai;
        $event->description            = $request->deskripsi;
        $event->maps_link              = $request->maps_link;
        $event->terms                  = $request->syarat_ketentuan;
        $event->organiser_description  = $request->deskripsi_org;
        $event->ticket_types           = $request->tickets;

        /*
        |--------------------------------------------------------------------------
        | Hitung ulang stok dan harga termurah
        |--------------------------------------------------------------------------
        */
        $event->stock = array_sum(
            array_column($request->tickets, 'stock')
        );

        $event->price = min(
            array_column($request->tickets, 'price')
        );

        /*
        |--------------------------------------------------------------------------
        | Update Banner Event
        |--------------------------------------------------------------------------
        */
        if ($request->hasFile('banner')) {

            // Hapus file lama
            if (
                $event->banner &&
                File::exists(public_path('images/events/' . $event->banner))
            ) {
                File::delete(
                    public_path('images/events/' . $event->banner)
                );
            }

            $bannerName = 'banner_' . time() . '.' .
                $request->banner->extension();

            $request->banner->move(
                public_path('images/events'),
                $bannerName
            );

            $event->banner = $bannerName;

            // Banner termasuk perubahan penting
            $isCriticalChanged = true;
        }

        /*
        |--------------------------------------------------------------------------
        | Update Foto Organiser
        |--------------------------------------------------------------------------
        */
        if ($request->hasFile('org_photo')) {

            if (
                $event->organiser_photo &&
                File::exists(
                    public_path(
                        'images/organizers/' .
                        $event->organiser_photo
                    )
                )
            ) {
                File::delete(
                    public_path(
                        'images/organizers/' .
                        $event->organiser_photo
                    )
                );
            }

            $orgPhotoName = 'org_' . time() . '.' .
                $request->org_photo->extension();

            $request->org_photo->move(
                public_path('images/organizers'),
                $orgPhotoName
            );

            $event->organiser_photo = $orgPhotoName;
        }

        /*
        |--------------------------------------------------------------------------
        | Jika ada perubahan penting
        |--------------------------------------------------------------------------
        */
        if ($isCriticalChanged) {

            $event->status = 'pending';

            $message =
                'Perubahan event berhasil disimpan! ' .
                'Karena mengubah informasi penting, status kembali menjadi Pending.';
        } else {

            $message =
                'Perubahan minor berhasil disimpan langsung!';
        }

        $event->save();

        return redirect()
            ->route('panitia.myevent')
            ->with('success', $message);
    }

    // =========================================================================
    // 5. MENAMPILKAN DATA PESERTA EVENT
    // =========================================================================
    public function attendees($id)
    {
        $event = Event::findOrFail($id);

        /*
        |--------------------------------------------------------------------------
        | Mengambil data peserta dari tabel tickets
        | kemudian digabung dengan data users
        |--------------------------------------------------------------------------
        */
        $attendees = DB::table('tickets')
            ->join(
                'users',
                'tickets.user_id',
                '=',
                'users.id'
            )
            ->where('tickets.event_id', $id)
            ->select(
                'tickets.*',
                'users.name as user_name',
                'users.email as user_email',
                'users.no_telp as user_phone'
            )
            ->paginate(10);

        return view(
            'Panitia.CustomerData',
            compact('event', 'attendees')
        );
    }
}
