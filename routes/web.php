<?php

use Illuminate\Support\Facades\Route;

// Auth & Umum Controllers
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\RoleApplicationController;

// Pembeli Controllers
use App\Http\Controllers\Pembeli\EventController as PembeliEventController;
use App\Http\Controllers\Pembeli\MyTicketController;
use App\Http\Controllers\Pembeli\SettingsController as PembeliSettingsController;

// Panitia Controllers (Menggunakan Alias untuk menghindari tabrakan nama)
use App\Http\Controllers\Panitia\EventPanitiaController;
use App\Http\Controllers\Panitia\EventController as PanitiaEventController;
use App\Http\Controllers\Panitia\MyEventController;
use App\Http\Controllers\Panitia\AttendanceController;
use App\Http\Controllers\Panitia\StatisticController;
use App\Http\Controllers\Panitia\SettingsController as PanitiaSettingsController;

// Admin Controllers
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ManageUserController;
use App\Http\Controllers\Admin\EventCategoriesController;
use App\Http\Controllers\Admin\PendingEventController;
use App\Http\Controllers\Admin\PublishedEventController;

// Middleware
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

// Preview Frontend Saja (Sebelum Login)
Route::prefix('registrasi')->group(function () {
    Route::get('/event', function () { return view('Registrasi.Event'); })->name('registrasi.event');
    Route::get('/myticket', function () { return view('Registrasi.MyTicket'); })->name('registrasi.myticket');
    Route::get('/about', function () { return view('Registrasi.About'); })->name('registrasi.about');
    Route::get('/settings', function () { return view('Registrasi.Settings'); })->name('registrasi.settings');
    Route::get('/buatevent', function () { return view('Registrasi.BuatEvent'); })->name('registrasi.buatevent');
    Route::get('/detail', function () { return view('Registrasi.Detail'); })->name('registrasi.detail');
});

/*
|--------------------------------------------------------------------------
| 2. USER SUDAH LOGIN (DIPROTEKSI AUTH + FILTER ROLE MIDDLEWARE)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    /* ================= SISI PEMBELI (CUSTOMER) ================= */
    Route::middleware([RoleMiddleware::class . ':pembeli'])->group(function () {
        Route::get('/pembeli/event', [PembeliEventController::class, 'index'])->name('pembeli.event');
        Route::get('/my-tickets', [MyTicketController::class, 'index'])->name('pembeli.myticket');
        Route::get('/detail-event/{event}', [PembeliEventController::class, 'show'])->name('pembeli.detail');

        // Settings Profil Pembeli
        Route::get('/settings', [PembeliSettingsController::class, 'index'])->name('pembeli.settings');
        Route::put('/settings/update_profile', [PembeliSettingsController::class, 'updateProfile'])->name('pembeli.settings.update_profile');
        Route::put('/settings/update-password', [PembeliSettingsController::class, 'updatePassword'])->name('pembeli.settings.update-password');

        // View Static Pembeli
        Route::get('/about', function () { return view('Pembeli.About'); })->name('pembeli.about');
        Route::get('/ticketdigital', function () { return view('Pembeli.TicketDigital'); })->name('pembeli.ticketdigital');
        Route::get('/buatevent', function () { return view('Pembeli.BuatEvent'); })->name('pembeli.buatevent');
        Route::post('/ajukan-panitia', [RoleApplicationController::class, 'store'])->name('role.apply');
    });

    /* ================= SISI PANITIA (ORGANISER) ================= */
    Route::middleware([RoleMiddleware::class . ':panitia'])->prefix('panitia')->group(function () {
        Route::get('/event', [EventPanitiaController::class, 'index'])->name('panitia.event');

        // Pembuatan Event
        Route::get('/create', function () { return view('Panitia.create'); })->name('panitia.create');
        Route::get('/store', function () { return redirect()->route('panitia.create'); });
        Route::post('/store', [EventPanitiaController::class, 'store'])->name('panitia.store');

        Route::get('/panitia/event', [PanitiaEventController::class, 'index'])->name('panitia.event');

        // Management My Event & Edit (Sudah diarahkan ke PanitiaEventController via Alias)
        Route::get('/myevent', [MyEventController::class, 'index'])->name('panitia.myevent');
        Route::get('/my-events/{id}/edit', [PanitiaEventController::class, 'edit'])->name('events.edit');
        Route::put('/my-events/{id}', [PanitiaEventController::class, 'update'])->name('events.update');

        // Attendance & Customer Data (FIXED: Diarahkan dinamis ke Controller menggunakan Parameter ID)
        Route::get('/attendance', [AttendanceController::class, 'index'])->name('panitia.attendance');
        Route::post('/attendance/verify', [AttendanceController::class, 'verifyTicket'])->name('panitia.verify-ticket');
        Route::get('/attendance/statistics', [AttendanceController::class, 'getStatistics'])->name('panitia.attendance-stats');
        Route::get('/myevent/{id}/attendees', [PanitiaEventController::class, 'attendees'])->name('panitia.customerdata');

        // Statistik Event
        Route::get('/statistic', [StatisticController::class, 'index'])->name('panitia.statistic');
        Route::get('/statistic/{id}', [StatisticController::class, 'show'])->name('panitia.statistic.detail');
        Route::get('/statistic2', function () { return view('Panitia.Statistic2'); })->name('panitia.statistic2');

        // Settings Profil Panitia (Route ganda duplikat lama sudah dibersihkan)
        Route::get('/settings', [PanitiaSettingsController::class, 'index'])->name('panitia.settings');
        Route::put('/settings/profile', [PanitiaSettingsController::class, 'updateProfile'])->name('profile.update');
        Route::put('/settings/password', [PanitiaSettingsController::class, 'updatePassword'])->name('password.update');
    });

    /* ================= SISI ADMIN ================= */
    Route::middleware([RoleMiddleware::class . ':admin'])->prefix('admin')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
        Route::get('/users', [ManageUserController::class, 'index'])->name('admin.users');
        Route::get('/categories', [EventCategoriesController::class, 'index'])->name('admin.categories');
        Route::get('/Settings', function () { return view('Admin.Settings'); })->name('admin.Settings');

        // Approval Event Masuk
        Route::get('/PublishedEvents', [PublishedEventController::class, 'index'])->name('admin.PublishedEvent');
        Route::get('/PendingEvents', [PendingEventController::class, 'index'])->name('admin.PendingEvent');
        Route::post('/events/{event}/approve', [PendingEventController::class, 'approve'])->name('admin.events.approve');
        Route::post('/events/{event}/reject', [PendingEventController::class, 'reject'])->name('admin.events.reject');
        Route::post('/events/{event}/unpublish', [PublishedEventController::class, 'unpublish'])->name('admin.events.unpublish');

        // Request Kenaikan Role Panitia
        Route::get('/role-applications', [RoleApplicationController::class, 'index'])->name('admin.role-applications');
        Route::post('/role-applications/{application}/approve', [RoleApplicationController::class, 'approve'])->name('admin.role-applications.approve');
        Route::post('/role-applications/{application}/reject', [RoleApplicationController::class, 'reject'])->name('admin.role-applications.reject');
    });

});

/* --- 3. LAIN-LAIN / DEVELOPMENT UTILITY --- */
Route::get('/app', function () { return view('app'); });
Route::get('/event-card', function () { return view('components.event-card'); });
Route::get('/event-detail', function () { return view('components.event-detail'); });
Route::prefix('pages')->group(function () {
    Route::get('/product', [ProdukController::class, 'index']);
});
