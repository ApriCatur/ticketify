<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
<<<<<<< HEAD
use App\Http\Controllers\App\Http\Controllers\Pembeli\EventController;
=======

>>>>>>> a4cb2aa71ae2e59b3750a808709278d0e7d37802

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
<<<<<<< HEAD
});

Route::get('/', function () {
    // Gunakan titik untuk menandakan folder.
    // view('NamaFolder.NamaSubFolder.NamaFile')
    return view('Pembeli.Event');
})->name('event.index');

Route::get('/login', function () {
    // Sesuaikan juga untuk halaman Login jika berada di folder Auth
    return view('Auth.Login');
})->name('login');

Route::get('/my-tickets', function () {
    return view('Pembeli.MyTicket');
})->name('tickets.mine');

Route::get('/register', function () {
    return view('Auth.Register');
})->name('register');

Route::get('/settings', function () {
    return view('Pembeli.Settings');
})->name('settings');

Route::get('/about', function () {
    return view('Pembeli.About');
})->name('about');
=======

});
>>>>>>> a4cb2aa71ae2e59b3750a808709278d0e7d37802
