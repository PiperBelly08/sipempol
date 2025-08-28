<?php

use App\Http\Controllers\LayananController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
use App\Models\Pesanan;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [LoginController::class, 'page'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('login.destroy');

Route::get('/register', [RegisterController::class, 'page'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.post');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        // Admin
        $customers = User::whereHas('roles', function ($query) {
            $query->where('name', 'customer');
        })->count();
        $orders = Pesanan::all();
        $pendingOrders = $orders->where('status', 'Pending')->count();
        $processedOrders = $orders->where('status', 'Diproses')->count();
        $doneOrders = $orders->where('status', 'Selesai')->count();
        $cancelledOrders = $orders->where('status', 'Dibatalkan')->count();

        // Customer
        $layanans = \App\Models\Layanan::all();
        return view('pages.home', compact('layanans', 'customers', 'orders', 'pendingOrders', 'processedOrders', 'doneOrders', 'cancelledOrders'));
    })->name('dashboard');
    Route::resource('user', UserController::class);
    Route::resource('layanan', LayananController::class);
    Route::resource('pesanan', PesananController::class);
    Route::resource('profil', ProfileController::class);
});
