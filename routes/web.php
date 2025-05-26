<?php

use App\Http\Controllers\ArmadaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MyBookingController;
use App\Http\Controllers\PeminjamanController;

Route::get('/', function () {
    return view('home');
});
Route::get('/cars', function () {
    return view('cars');
});
Route::get('/booking', [App\Http\Controllers\BookingController::class, 'create']);
Route::get('/location', function () {
    return view('location');
});
Route::get('/about', function () {
    return view('about');
});
Route::get('/contact', function () {
    return view('contact');
});
Route::post('/contact/send', [App\Http\Controllers\ContactController::class, 'send']);
Route::post('/booking/store', [App\Http\Controllers\BookingController::class, 'store'])->middleware('auth');

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/password/reset', [AuthController::class, 'showResetForm'])->name('password.request');
Route::post('/password/reset', [AuthController::class, 'reset'])->name('password.update');

Route::middleware(['auth'])->group(function () {
    // My Booking Routes
    Route::get('/mybooking', [MyBookingController::class, 'index'])->name('mybooking');
    Route::delete('/bookings/{id}/cancel', [MyBookingController::class, 'cancel'])->name('bookings.cancel');
    
    // Rental Management Routes
    Route::resource('peminjaman', PeminjamanController::class);
    Route::get('/armada/{armada}/check-availability', [PeminjamanController::class, 'checkAvailability'])
        ->name('armada.check-availability');
});

Route::get('/dashboard', function () {
    return view('dashboard.home');
})->middleware('auth');

Route::resource('armada', ArmadaController::class);