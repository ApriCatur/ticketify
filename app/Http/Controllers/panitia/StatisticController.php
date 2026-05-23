<?php

namespace App\Http\Controllers\Panitia;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB; // Selesai Diperbaiki: Import DB Facade agar query builder berjalan lancar
use Illuminate\Http\Request;

class StatisticController extends Controller
{
    /**
     * Display a listing of the current user's event statistics.
     */
   public function index()
{
    // Mengambil event milik panitia yang login, sama seperti MyEventController
    $events = Event::where('user_id', Auth::id())->orderByDesc('date')->get();

    return view('Panitia.Statistic', compact('events'));
}

    /**
     * Display the specified event statistic details.
     */
    public function show($id)
    {
        // Pastikan event yang diakses adalah benar-size milik panitia yang sedang login
        $event = Event::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $namaTabelTransaksi = 'tickets';

        // Total tiket terjual riil dari tabel tickets
        $tiketTerjual = DB::table($namaTabelTransaksi)
            ->where('event_id', $id)
            ->count();

        // Selesai Diperbaiki: Disinkronkan menggunakan properti '$event->stock' sesuai skema database Ticketify kamu
        $totalKuota = $event->stock ?? 100;

        // Total peserta hadir (Status check-in / QR sudah discan dan diisi date_used)
        $totalHadir = DB::table($namaTabelTransaksi)
            ->where('event_id', $id)
            ->whereNotNull('date_used')
            ->count();

        // Sementara diset 0 sesuai rancangan awalmu karena belum ada data harga di tabel tickets
        $totalPendapatan = 0;

        // Data pengelompokan jenis kategori tiket untuk grafik/chart dashboard
        $kategoriTiket = DB::table($namaTabelTransaksi)
            ->select('ticket_type', DB::raw('COUNT(*) as total'))
            ->where('event_id', $id)
            ->groupBy('ticket_type')
            ->get();

        // Mengarah ke view detail statistik spesifik (Gambar 2)
        return view('Panitia.Statistic2', compact(
            'event',
            'tiketTerjual',
            'totalKuota',
            'totalHadir',
            'totalPendapatan',
            'kategoriTiket'
        ));
    }
} // Selesai Diperbaiki: Kurung kurawal penutup class dipindahkan ke paling bawah file
