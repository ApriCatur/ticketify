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

// Panitia Controllers
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

// Guest Controllers
use App\Http\Controllers\Guest\EventController as GuestEventController;

// Middleware
use App\Http\Middleware\RoleMiddleware;
// midtrans
use App\Http\Controllers\PaymentController;


/*
|--------------------------------------------------------------------------
| 1. GUEST / BELUM LOGIN
|--------------------------------------------------------------------------
*/
Route::get('/login', function () { return view('Auth.Login'); })->name('login');
Route::get('/register', function () { return view('Auth.Register'); })->name('register');

Route::post('/login', [AuthController::class, 'login'])->name('login.proses');
Route::post('/register', [AuthController::class, 'register'])->name('register.store');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Preview Frontend Saja (Sebelum Login)
Route::prefix('guest')->group(function () {
    Route::get('/event', [GuestEventController::class, 'index'])->name('guest.event');
    Route::get('/event/{id}', [GuestEventController::class, 'show'])->name('guest.event.detail');
    Route::get('/myticket', function () { return view('Guest.MyTicket'); })->name('guest.myticket');
    Route::get('/about', function () { return view('Guest.About'); })->name('guest.about');
    Route::get('/settings', function () { return view('Guest.Settings'); })->name('guest.settings');
    Route::get('/buatevent', function () { return view('Guest.BuatEvent'); })->name('guest.buatevent');
    Route::get('/detail', function () { return view('Guest.Detail'); })->name('guest.detail');


});

/*
|--------------------------------------------------------------------------
| 2. USER SUDAH LOGIN
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    /* ================= PEMBELI ================= */
    Route::middleware([RoleMiddleware::class . ':pembeli'])->group(function () {
        Route::get('/pembeli/event', [PembeliEventController::class, 'index'])->name('pembeli.event');
        Route::get('/my-tickets', [MyTicketController::class, 'index'])->name('pembeli.myticket');
        Route::get('/detail-event/{event}', [PembeliEventController::class, 'show'])->name('pembeli.detail');
        Route::get('/settings', [PembeliSettingsController::class, 'index'])->name('pembeli.settings');
        Route::put('/settings/update_profile', [PembeliSettingsController::class, 'updateProfile'])->name('pembeli.settings.update_profile');
        Route::put('/settings/update-password', [PembeliSettingsController::class, 'updatePassword'])->name('pembeli.settings.update-password');
        Route::get('/about', function () { return view('Pembeli.About'); })->name('pembeli.about');
        Route::get('/ticketdigital', function () { return view('Pembeli.TicketDigital'); })->name('pembeli.ticketdigital');
        Route::get('/buatevent', [RoleApplicationController::class, 'create'])->name('pembeli.buatevent');
        Route::post('/ajukan-panitia', [RoleApplicationController::class, 'store'])->name('role.apply');
    });

  /* ================= PANITIA ================= */
Route::middleware([RoleMiddleware::class . ':panitia'])->prefix('panitia')->group(function () {
    Route::get('/event', [PanitiaEventController::class, 'index'])->name('panitia.event');
    // FORM CREATE EVENT
    Route::get('/create', function () {
        return view('panitia.create');
    })->name('panitia.create');
    // SIMPAN EVENT
    Route::post('/store', [PanitiaEventController::class, 'store'])->name('panitia.store');
    // MY EVENT
    Route::get('/myevent', [MyEventController::class, 'index'])->name('panitia.myevent');
    Route::get('/my-events/{id}', [PanitiaEventController::class, 'show'])->name('panitia.events.show');
    Route::get('/my-events/{id}/edit', [PanitiaEventController::class, 'edit'])->name('panitia.events.edit');
    Route::put('/my-events/{id}', [PanitiaEventController::class, 'update'])->name('panitia.events.update');
    Route::delete('/my-events/{id}', [PanitiaEventController::class, 'destroy'])->name('panitia.events.destroy');
    // ATTENDANCE
    Route::get('/attendance', [AttendanceController::class, 'index'])->name('panitia.attendance');
    Route::post('/attendance/verify', [AttendanceController::class, 'verifyTicket'])->name('panitia.verify-ticket');
    Route::get('/attendance/statistics', [AttendanceController::class, 'getStatistics'])->name('panitia.attendance-stats');
    Route::get('/myevent/{id}/attendees', [AttendanceController::class, 'showAttendees'])->name('panitia.customerdata');
    // STATISTIC
    Route::get('/statistic', [StatisticController::class, 'index'])->name('panitia.statistic');
    Route::get('/statistic/{id}', [StatisticController::class, 'show'])->name('panitia.statistic.detail');
    Route::get('/statistic2', function () {
        return view('Panitia.Statistic2');
    })->name('panitia.statistic2');
    // SETTINGS
    Route::get('/settings', [PanitiaSettingsController::class, 'index'])->name('panitia.settings');
    Route::put('/settings/profile', [PanitiaSettingsController::class, 'updateProfile'])->name('profile.update');
    Route::put('/settings/password', [PanitiaSettingsController::class, 'updatePassword'])->name('password.update');
});

    /* ================= ADMIN ================= */
    Route::middleware([RoleMiddleware::class . ':admin'])->prefix('admin')->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
        Route::get('/Settings', function () { return view('Admin.Settings'); })->name('admin.Settings');

        // Approval Event
        Route::get('/PublishedEvents', [PublishedEventController::class, 'index'])->name('admin.PublishedEvent');
        Route::get('/PendingEvents', [PendingEventController::class, 'index'])->name('admin.PendingEvent');
        Route::post('/events/{event}/approve', [PendingEventController::class, 'approve'])->name('admin.events.approve');
        Route::post('/events/{event}/reject', [PendingEventController::class, 'reject'])->name('admin.events.reject');
        Route::post('/events/{event}/unpublish', [PublishedEventController::class, 'unpublish'])->name('admin.events.unpublish');

        // Role Applications
        Route::get('/role-applications', [RoleApplicationController::class, 'index'])->name('admin.role-applications');
        Route::post('/role-applications/{application}/approve', [RoleApplicationController::class, 'approve'])->name('admin.role-applications.approve');
        Route::post('/role-applications/{application}/reject', [RoleApplicationController::class, 'reject'])->name('admin.role-applications.reject');

        // ── Manage Users CRUD & Soft Delete ─────────────────────────
        Route::get('/users',                      [ManageUserController::class, 'index'])->name('admin.users');
        Route::post('/users',                     [ManageUserController::class, 'store'])->name('admin.users.store');
        Route::put('/users/{user}',               [ManageUserController::class, 'update'])->name('admin.users.update');
        Route::delete('/users/{user}',            [ManageUserController::class, 'destroy'])->name('admin.users.destroy');
        Route::post('/users/{id}/restore',        [ManageUserController::class, 'restore'])->name('admin.users.restore');
        Route::delete('/users/{id}/force-delete', [ManageUserController::class, 'forceDelete'])->name('admin.users.force-delete');

        // ── Event Categories CRUD & Soft Delete ──────────────────────
        Route::get('/categories',                      [EventCategoriesController::class, 'index'])->name('admin.categories');
        Route::post('/categories',                     [EventCategoriesController::class, 'store'])->name('admin.categories.store');
        Route::put('/categories/{category}',           [EventCategoriesController::class, 'update'])->name('admin.categories.update');
        Route::delete('/categories/{category}',        [EventCategoriesController::class, 'destroy'])->name('admin.categories.destroy');
        Route::patch('/categories/{id}/restore',       [EventCategoriesController::class, 'restore'])->name('admin.categories.restore');
        Route::delete('/categories/{id}/force-delete', [EventCategoriesController::class, 'forceDelete'])->name('admin.categories.forceDelete');
    });

});

/* --- 3. LAIN-LAIN --- */
Route::get('/app', function () { return view('app'); });
Route::get('/event-card', function () { return view('components.event-card'); });
Route::get('/event-detail', function () { return view('components.event-detail'); });
Route::prefix('pages')->group(function () {
    Route::get('/product', [ProdukController::class, 'index']);
});


// ─── Payment Routes (butuh login) ────────────────────────────────────────────
Route::middleware(['auth'])->group(function () {

    // Halaman checkout (pilih jumlah tiket)
    Route::get('/events/{event}/checkout', [PaymentController::class, 'checkout'])
         ->name('payment.checkout');

    // Proses checkout → buat order → tampilkan tombol bayar
    Route::post('/events/{event}/checkout', [PaymentController::class, 'process'])
         ->name('payment.process');

    // Redirect dari Midtrans setelah bayar sukses
    Route::get('/payment/success', [PaymentController::class, 'success'])
         ->name('payment.success');

    // Redirect dari Midtrans jika gagal/cancel
    Route::get('/payment/failed', [PaymentController::class, 'failed'])
         ->name('payment.failed');
});

// ─── Webhook Midtrans (TANPA auth, dari server Midtrans) ─────────────────────
// PENTING: Tambahkan URL ini ke pengecualian CSRF di App\Http\Middleware\VerifyCsrfToken.php
Route::post('/payment/notification', [PaymentController::class, 'notification'])
     ->name('payment.notification');
