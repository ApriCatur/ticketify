<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\login;

Route::get('/', function () {
    return view('welcome');
});

Route::get('login', [login::class, 'index']);

