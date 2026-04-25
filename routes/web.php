<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdukController;

use App\Http\Controllers\App\Http\Controllers\Pembeli\EventController;
use Termwind\Components\Raw;

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

    Route::get('/Dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::get('/PublishedEvents', function () {
        return view('admin.PublishedEvent');
    })->name('admin.PublishedEvent');

    Route::get('/PendingEvents', function () {
        return view('admin.PendingEvent');
    })->name('admin.PendingEvent');

    Route::get('/ManageUsers', function () {
        return view('admin.ManageUser');
    })->name('admin.ManageUser');

    Route::get('/EventCategories', function () {
        return view('admin.EventCategories');
    })->name('admin.EventCategories');

    Route::get('/Settings', function () {
        return view('admin.Settings');
    })->name('admin.Settings');

});

// ini bagian pembeli, sesuaikan dengan nama folder dan file view yang sudah dibuat
Route::get('/', function () {
    // Gunakan titik untuk menandakan folder.
    // view('NamaFolder.NamaSubFolder.NamaFile')
    return view('Pembeli.Event');
})->name('pembeli.event');

Route::get('/login', function () {
    // Sesuaikan juga untuk halaman Login jika berada di folder Auth
    return view('Auth.Login');
})->name('login');

Route::get('/my-tickets', function () {
    return view('Pembeli.MyTicket');
})->name('pembeli.myticket');

Route::get('/register', function () {
    return view('Auth.Register');
})->name('register');

Route::get('/settings', function () {
    return view('Pembeli.Settings');
})->name('pembeli.settings');

Route::get('/about', function () {
    return view('Pembeli.About');
})->name('pembeli.about');

// Route untuk halaman detail event
Route::get('/detail-event', function () {
    return view('pembeli.detail');
})->name('pembeli.detail');


// ini bagian panitia, sesuaikan dengan nama folder dan file view yang sudah dibuat
Route::get('/panitia/event', function () {
    return view('Panitia.event');
})->name('panitia.event');

Route::get('/panitia/create', function () {
    return view('Panitia.create');
})->name('panitia.create');

Route::get('/panitia/myevent', function () {
    return view('Panitia.MyEvent');
})->name('panitia.myevent');

Route::get('/panitia/attendance', function () {
    return view('Panitia.Attendance');
})->name('panitia.attendance');

Route::get('/panitia/statistic', function () {
    return view('Panitia.Statistic');
})->name('panitia.statistic');

Route::get('/panitia/customerdata', function () {
    return view('Panitia.CustomerData');
})->name('panitia.customerdata');


Route::prefix('pages')->group(function () {
    // Route untuk halaman list produk
    Route::get('/product', [ProdukController::class, 'index']);

    // Kamu bisa menambah route lain di sini nanti (home, about, dll) [cite: 64]
});


// ini untuk tampilan yang belum register atau belum login, sesuaikan dengan nama folder dan file view yang sudah dibuat
Route::get('/registrasi/event', function () {
    return view('Registrasi.Event');
})->name('registrasi.event');

Route::get('/registrasi/myticket', function () {
    return view('Registrasi.MyTicket');
})->name('registrasi.myticket');

Route::get('/registrasi/about', function () {
    return view('Registrasi.About');
})->name('registrasi.about');

Route::get('/registrasi/settings', function () {
    return view('Registrasi.Settings');
})->name('registrasi.settings');


