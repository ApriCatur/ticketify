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

Route::get('/admin/dashboard', function () {
    return view('/admin/dashboard');
});

Route::get('/admin/PendingEvent', function () {
    return view('/admin/PendingEvent');
});

Route::get('/admin/PublishedEvent', function () {
    return view('admin.PublishedEvent');
});

Route::get('/admin/EventCategories', function () {
    return view('admin.EventCategories');
});

Route::get('/admin/ManageUser', function () {
    return view('admin.ManageUser');
});
