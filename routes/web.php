<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\login;
use App\Http\Controllers\databarang;

Route::get('/', function () {
    return view('welcome');
});

Route::get('login', [login::class, 'index']);
Route::get('/databarang', [databarang::class, 'tampilkan']);

