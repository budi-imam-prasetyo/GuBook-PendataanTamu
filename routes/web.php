<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\UserController;
use App\Models\Pegawai;
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

Route::get('/pegawai', [PegawaiController::class, 'index']);

Route::get('/dashboard', function () {
    return view('dasboard');
});
Route::get('/form-tamu', [UserController::class, 'formTamu']);
Route::get('/form-kurir', [UserController::class, 'formKurir']);
Auth::routes();


// Route::get('/welcome', [App\Http\Controllers\HomeController::class, 'index'])->name('home');