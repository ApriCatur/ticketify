<?php

namespace App\Http\Controllers;

use App\Models\PanitiaProfile;
use App\Models\Ukm;
use App\Models\RoleApplication;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleApplicationController extends Controller
{
    /**
     * =========================================================
     * PEMBELI - HALAMAN AJUKAN PANITIA
     * =========================================================
     */

    // Menampilkan halaman pengajuan
    public function create()
    {
        // Ambil semua data UKM
        $ukms = Ukm::all();

        // Cek apakah user sudah pernah mengajukan (pending)
        $application = RoleApplication::where('user_id', Auth::id())
            ->where('status', 'pending')
            ->first();

        // Ambil pengajuan terakhir yang ditolak (untuk lihat alasan)
        $rejectedApplication = RoleApplication::where('user_id', Auth::id())
            ->where('status', 'rejected')
            ->latest()
            ->first();

        // Tampilkan halaman Blade
        return view('Pembeli.BuatEvent', compact('ukms', 'application', 'rejectedApplication'));
    }

    // Menyimpan pengajuan panitia
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'ukm_id' => 'required|exists:ukms,id',
            'nomor_rekening' => 'required|string|max:50',
        ]);

        // Cek apakah sudah pernah mengajukan
        $check = RoleApplication::where('user_id', Auth::id())
            ->where('status', 'pending')
            ->first();

        if ($check) {
            return redirect()->back()->with(
                'error',
                'Kamu sudah pernah mengajukan.'
            );
        }

        // Simpan pengajuan
        RoleApplication::create([
            'user_id' => Auth::id(),
            'ukm_id' => $request->ukm_id,
            'nomor_rekening' => $request->nomor_rekening,
            'status' => 'pending',
        ]);

        return redirect()->back()->with(
            'success',
            'Pengajuan berhasil dikirim!'
        );
    }

    /**
     * =========================================================
     * ADMIN - MELIHAT PENGAJUAN
     * =========================================================
     */

    // Menampilkan semua pengajuan pending
    public function index()
    {
        $applications = RoleApplication::with(['user', 'ukm'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('Admin.RoleApplication', compact('applications'));
    }

    /**
     * =========================================================
     * ADMIN - APPROVE PENGAJUAN
     * =========================================================
     */

    public function approve($application)
    {
        // Cari data pengajuan
        $roleApp = RoleApplication::findOrFail($application);

        // Update status
        $roleApp->update([
            'status' => 'approved'
        ]);

        // Cari user
        $user = User::findOrFail($roleApp->user_id);

        // Ubah role jadi organiser
        $user->update([
            'role' => 'panitia'
        ]);

        // Buat profil panitia
        PanitiaProfile::create([
            'user_id' => $roleApp->user_id,
            'ukm_id' => $roleApp->ukm_id,
            'no_rekening' => $roleApp->nomor_rekening,
        ]);

        return redirect()->back()->with(
            'success',
            'Pengajuan berhasil disetujui!'
        );
    }

    /**
     * =========================================================
     * ADMIN - REJECT PENGAJUAN
     * =========================================================
     */

    public function reject(Request $request, $application)
    {
        // Validasi input
        $request->validate([
            'alasan_ditolak' => 'required|string|min:10|max:500',
        ]);

        // Cari data pengajuan
        $roleApp = RoleApplication::findOrFail($application);

        // Update status dan simpan alasan
        $roleApp->update([
            'status' => 'rejected',
            'alasan_ditolak' => $request->alasan_ditolak,
        ]);

        return redirect()->back()->with(
            'error',
            'Pengajuan panitia ditolak.'
        );
    }
}
