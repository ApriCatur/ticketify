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

// ini bagian pembeli, sesuaikan dengan nama folder dan file view yang sudah dibuat
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
