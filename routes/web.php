<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\RoleApplicationController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Pembeli\EventController;
use App\Http\Controllers\Panitia\EventPanitiaController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ManageUserController;
use App\Http\Controllers\Admin\EventCategoriesController;
use App\Http\Controllers\Admin\PendingEventController;
use App\Http\Controllers\Admin\PublishedEventController;
use App\Http\Controllers\Pembeli\SettingsController;
use App\Http\Controllers\Pembeli\MyTicketController;

// Panggil Middleware Filter Role buatan kita
use App\Http\Middleware\RoleMiddleware;

/*
|--------------------------------------------------------------------------
| 1. GUEST / BELUM LOGIN (Halaman Registrasi & Auth)
|--------------------------------------------------------------------------
*/
Route::get('/login', function () { return view('Auth.Login'); })->name('login');
Route::get('/register', function () { return view('Auth.Register'); })->name('register');

Route::post('/login', [AuthController::class, 'login'])->name('login.proses');
Route::post('/register', [AuthController::class, 'register'])->name('register.store');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/registrasi/event', function () { return view('Registrasi.Event'); })->name('registrasi.event');
Route::get('/registrasi/myticket', function () { return view('Registrasi.MyTicket'); })->name('registrasi.myticket');
Route::get('/registrasi/about', function () { return view('Registrasi.About'); })->name('registrasi.about');
Route::get('/registrasi/settings', function () { return view('Registrasi.Settings'); })->name('registrasi.settings');
Route::get('/registrasi/buatevent', function () { return view('Registrasi.BuatEvent'); })->name('registrasi.buatevent');
Route::get('/registrasi/detail', function () { return view('Registrasi.Detail'); })->name('registrasi.detail');

/*
|--------------------------------------------------------------------------
| 2. USER SUDAH LOGIN (DIPROTEKSI AUTH + FILTER ROLE MIDDLEWARE)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

  /* ================= SISI PEMBELI (CUSTOMER) ================= */
    Route::middleware([RoleMiddleware::class . ':pembeli'])->group(function () {
        Route::get('/pembeli/event', [EventController::class, 'index'])->name('pembeli.event');
        Route::get('/my-tickets', [MyTicketController::class, 'index'])->name('pembeli.myticket');

        // 1. TAMPILKAN HALAMAN SETTINGS (Sekarang lewat Controller agar bisa ambil data DB)
        Route::get('/settings', [SettingsController::class, 'index'])->name('pembeli.settings');

        // 2. PROSES UPDATE DATA KE DATABASE (Tambahkan 2 baris ini)
        Route::put('/settings/update-profile', [SettingsController::class, 'updateProfile'])->name('pembeli.settings.update-profile');
        Route::put('/settings/update-password', [SettingsController::class, 'updatePassword'])->name('pembeli.settings.update-password');

        Route::get('/about', function () { return view('Pembeli.About'); })->name('pembeli.about');
        Route::get('/ticketdigital', function () { return view('Pembeli.TicketDigital'); })->name('pembeli.ticketdigital');
        Route::get('/detail-event/{event}', [EventController::class, 'show'])->name('pembeli.detail');
        Route::get('/buatevent', function () { return view('Pembeli.BuatEvent'); })->name('pembeli.buatevent');
        Route::post('/ajukan-panitia', [RoleApplicationController::class, 'store'])->name('role.apply');
    });

    /* ================= SISI PANITIA (ORGANISER) ================= */
    Route::middleware([RoleMiddleware::class . ':panitia'])->prefix('panitia')->group(function () {
        Route::get('/event', [EventPanitiaController::class, 'index'])->name('panitia.event');
        Route::get('/create', function () { return view('Panitia.create'); })->name('panitia.create');

        Route::get('/store', function () { return redirect()->route('panitia.create'); });
        Route::post('/store', [EventPanitiaController::class, 'store'])->name('panitia.store');

        Route::get('/myevent', [\App\Http\Controllers\Panitia\MyEventController::class, 'index'])->name('panitia.myevent');
        Route::get('/attendance', function () { return view('Panitia.Attendance'); })->name('panitia.attendance');

        // Halaman utama daftar statistik event (Gambar 1)
        Route::get('/statistic', [\App\Http\Controllers\Panitia\StatisticController::class, 'index'])->name('panitia.statistic');

        // Halaman detail statistik spesifik berdasarkan ID Event (Gambar 2)
        Route::get('/statistic/{id}', [\App\Http\Controllers\Panitia\StatisticController::class, 'show'])->name('panitia.statistic.detail');

        Route::get('/statistic2', function () { return view('Panitia.Statistic2'); })->name('panitia.statistic2');
        Route::get('/customerdata', function () { return view('Panitia.CustomerData'); })->name('panitia.customerdata');
        Route::get('/settings', function () { return view('Panitia.settings'); })->name('panitia.settings');

        Route::get('/settings', [\App\Http\Controllers\Panitia\SettingsController::class, 'index'])->name('panitia.settings');
        Route::put('/settings/profile', [\App\Http\Controllers\Panitia\SettingsController::class, 'updateProfile'])->name('profile.update');
        Route::put('/settings/password', [\App\Http\Controllers\Panitia\SettingsController::class, 'updatePassword'])->name('password.update');
    });

    /* ================= SISI ADMIN ================= */
    Route::middleware([RoleMiddleware::class . ':admin'])->prefix('admin')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
        Route::get('/PublishedEvents', [PublishedEventController::class, 'index'])->name('admin.PublishedEvent');
        Route::get('/PendingEvents', [PendingEventController::class, 'index'])->name('admin.PendingEvent');
        Route::post('/events/{event}/approve', [PendingEventController::class, 'approve'])->name('admin.events.approve');
        Route::post('/events/{event}/reject', [PendingEventController::class, 'reject'])->name('admin.events.reject');
        Route::post('/events/{event}/unpublish', [PublishedEventController::class, 'unpublish'])->name('admin.events.unpublish');
        Route::get('/users', [ManageUserController::class, 'index'])->name('admin.users');
        Route::get('/categories', [EventCategoriesController::class, 'index'])->name('admin.categories');
        Route::get('/Settings', function () { return view('Admin.Settings'); })->name('admin.Settings');
        Route::get('/role-applications', [\App\Http\Controllers\RoleApplicationController::class, 'index'])->name('admin.role-applications');
        Route::post('/role-applications/{application}/approve', [\App\Http\Controllers\RoleApplicationController::class, 'approve'])->name('admin.role-applications.approve');
        Route::post('/role-applications/{application}/reject', [\App\Http\Controllers\RoleApplicationController::class, 'reject'])->name('admin.role-applications.reject');
    });

});

/* --- 3. LAIN-LAIN --- */
Route::get('/app', function () { return view('app'); });
Route::get('/event-card', function () { return view('components.event-card'); });
Route::get('/event-detail', function () { return view('components.event-detail'); });
Route::prefix('pages')->group(function () { Route::get('/product', [ProdukController::class, 'index']); });
