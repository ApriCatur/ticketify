<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RoleApplication;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class RoleApplicationController extends Controller
{
    /**
     * Tampilkan daftar semua pengajuan role
     */
    public function index()
    {
        $applications = RoleApplication::with('user')->get();

        return view('Admin.ManageRoleApplications', compact('applications'));
    }

    /**
     * User mengajukan permohonan untuk menjadi panitia
     */
    public function store(Request $request)
    {
        $userId = Auth::id();

        // 1. Cek apakah user ini sudah pernah mengajukan dan statusnya masih pending
        $existingApp = RoleApplication::where('user_id', $userId)
                                      ->where('status', 'pending')
                                      ->first();

        if ($existingApp) {
            return redirect()->back()->with('error', 'Kamu sudah memiliki pengajuan yang sedang diproses!');
        }

        // 2. Simpan pengajuan baru ke database
        RoleApplication::create([
            'user_id' => $userId,
            'organization_name' => Auth::user()->name, // Sementara disamakan dengan nama user
            'reason' => 'Menyetujui syarat dan ketentuan menjadi organiser.', // Sesuai centang di UI
            'status' => 'pending'
        ]);

        // 3. Redirect balik dengan membawa session success untuk memicu alert
        return redirect()->back()->with('success', 'Pengajuan berhasil dikirim!');
    }

    /**
     * Admin menyetujui pengajuan role application
     */
    public function approve(RoleApplication $application)
    {
        // Update status pengajuan menjadi 'approved'
        $application->update(['status' => 'approved']);

        // Update role user menjadi 'panitia'
        $application->user->update(['role' => 'panitia']);

        return redirect()->back()->with('success', 'Pengajuan berhasil disetujui! User sekarang menjadi Panitia.');
    }

    /**
     * Admin menolak pengajuan role application
     */
    public function reject(RoleApplication $application)
    {
        // Update status pengajuan menjadi 'rejected'
        $application->update(['status' => 'rejected']);

        return redirect()->back()->with('success', 'Pengajuan ditolak.');
    }
}
