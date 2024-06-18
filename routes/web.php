<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChartController;

Route::get('/chart-data', [ChartController::class, 'index']);

Route::get('/', function () {
    return view('welcome');
});
Route::get('/dashboard', function () {
    return view('dashboard');
});
Route::get('/pegawai', function () {
    return view('pegawai');
});