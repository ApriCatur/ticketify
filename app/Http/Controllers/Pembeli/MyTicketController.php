<?php

namespace App\Http\Controllers\Pembeli;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;

class MyTicketController extends Controller
{
    // Menampilkan halaman my tickets pembeli
   public function index()
{
    // 1. Cek keamanan: Jika user belum login, arahkan ke halaman login
    if (!Auth::check()) {
        return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
    }

    /** @var \App\Models\User $user */
    $user = Auth::user();

    // 2. Ambil semua tickets milik user yang sedang login
    $tickets = Ticket::where('user_id', Auth::id())
    ->with('event') // Load relasi event untuk mendapatkan info event
    ->orderBy('purchase_date', 'desc') // Urutkan dari yang terbaru
    ->get();

    // 3. Hitung statistik
    $totalTickets = $tickets->count();
    $activeTickets = $tickets->where('status', 'Active')->count();
    $usedTickets = $tickets->where('status', 'Used')->count();

    return view('Pembeli.MyTicket', [
        'tickets' => $tickets,
        'totalTickets' => $totalTickets,
        'activeTickets' => $activeTickets,
        'usedTickets' => $usedTickets,
    ]);
}
}
