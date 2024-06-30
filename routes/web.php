<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;

Route::get('/chart-data', [ChartController::class, 'index']);


Route::get('/register', function () {
    return redirect('/login');
});
//redirect to welcome
Route::get('/', function () {
    return redirect('/welcome');
});
Route::get('/welcome', function () {
    // view()->share('title', 'Beranda');
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
});
Route::get('/pegawai', function () {
    return view('pegawai');
});
Route::get('/form-tamu', [UserController::class, 'formTamu']);
Route::get('/form-kurir', [UserController::class, 'formKurir']);
Auth::routes();


// Route::get('/welcome', [App\Http\Controllers\HomeController::class, 'index'])->name('home');