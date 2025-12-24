<?php

use App\Http\Controllers\AdminBookingController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
//Route::get('/', [BookingController::class, 'index'])->name('home');

// Route::middleware('guest')->group(function () {
//     Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
//     Route::post('/register', [AuthController::class, 'register']);

//     Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
//     Route::post('/login', [AuthController::class, 'login']);
// });

// Route::middleware('auth')->group(function () {
//     Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
//     Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
//     Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
// });

// Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
//     Route::get('/bookings', [AdminBookingController::class, 'index'])->name('admin.bookings.index');
//     Route::patch('/bookings/{booking}/status', [AdminBookingController::class, 'updateStatus'])->name('admin.bookings.updateStatus');
// });
