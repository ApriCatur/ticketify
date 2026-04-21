<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('login', function () {
    return view('login');
});
Route::get('/app', function () {
    return view('app');
});

Route::prefix('admin')->group(function () {

    Route::get('/dashboard', function () {
        return view('Admin.Dashboard');
    })->name('admin.dashboard');

    Route::get('/published-events', function () {
        return view('Admin.PublishedEvent');
    })->name('admin.published');

    Route::get('/pending-events', function () {
        return view('Admin.PendingEvent');
    })->name('admin.pending');

    Route::get('/manage-users', function () {
        return view('Admin.ManageUser');
    })->name('admin.users');

    Route::get('/categories', function () {
        return view('Admin.EventCategories');
    })->name('admin.categories');

    Route::get('/settings', function () {
        return view('Admin.Settings');
    })->name('admin.settings');

});
