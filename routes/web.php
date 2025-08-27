<?php

use App\Http\Controllers\LayananController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [LoginController::class, 'page'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('login.destroy');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        $layanans = \App\Models\Layanan::all();
        return view('pages.home', compact('layanans'));
    })->name('dashboard');
    Route::resource('user', UserController::class);
    Route::resource('layanan', LayananController::class);
    Route::resource('pesanan', PesananController::class);
    Route::resource('profil', ProfileController::class);
});
