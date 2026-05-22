<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ManageUserController extends Controller
{
    public function index()
    {
        // Mengambil statistik user berdasarkan role (asumsi role disimpan di kolom 'role')
        $totalUsers = User::count();
        $totalAdmins = User::where('role', 'admin')->count();
        $totalOrganizers = User::where('role', 'panitia')->count();
        $totalCustomers = User::where('role', 'pembeli')->count();

        // Mengambil semua data user untuk tabel
        $users = User::select('id', 'name', 'email', 'role')->get();

        return view('Admin.ManageUser', compact(
            'totalUsers',
            'totalAdmins',
            'totalOrganizers',
            'totalCustomers',
            'users'
        ));
    }
}
