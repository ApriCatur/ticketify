<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EventCategoriesController extends Controller
{
    public function index()
    {
        // Catatan: Jika nanti kamu bikin model Category tersendiri, silakan ubah query ini.
        // Untuk sekarang, kita kelompokkan kategori yang ada dari tabel events secara dinamis.

        $totalEvents = Event::count();

        // Mengambil kategori unik dan menghitung jumlah event di dalamnya
        $categoriesData = Event::select('category', DB::raw('count(*) as total'))
            ->groupBy('category')
            ->get();

        $totalCategories = $categoriesData->count();

        // Kategori aktif (punya event > 0) dan kosong
        $activeCategories = $categoriesData->where('total', '>', 0)->count();
        $emptyCategories = 0; // Bisa disesuaikan jika sudah memakai tabel master categories

        return view('Admin.EventCategories', compact(
            'totalCategories',
            'activeCategories',
            'emptyCategories',
            'totalEvents',
            'categoriesData'
        ));
    }
}
