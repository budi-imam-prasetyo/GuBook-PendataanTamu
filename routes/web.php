<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\UserController;
use App\Models\Pegawai;
use Illuminate\Support\Facades\Auth;

//? ROUTE USER
Route::get('/welcome', function () {
    return view('welcome');
});
Route::get('/', function () {
    return redirect('/welcome'); //* redirect to welcome
});
Route::get('/register', function () {
    return redirect('/login'); //* redirect to login
});
Route::get('/form-tamu', [UserController::class, 'formTamu']);
Route::get('/form-kurir', [UserController::class, 'formKurir']);
//? ROUTE USER

//! ROUTE ADMIN
Route::prefix('admin')->group(function () {
    Route::get('/', [ChartController::class, 'chart']);
    Route::get('/pegawai', [PegawaiController::class, 'index']);
    Route::get('/chart-data', [ChartController::class, 'index']);
});
//! ROUTE ADMIN

//* ROUTE PEGAWAI

//* ROUTE PEGAWAI


Auth::routes();


// Route::get('/welcome', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// view()->share('title', 'Beranda');