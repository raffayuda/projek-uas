<?php

use App\Http\Controllers\ArmadaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MyBookingController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\ProfileController;
use App\Models\Lokasi;

Route::get('/', function () {
    return view('home');
});
Route::get('/cars', [App\Http\Controllers\CarsController::class, 'index'])->name('cars.index');
Route::get('/booking', [App\Http\Controllers\BookingController::class, 'create'])->name('booking.create');
Route::get('/location', function () {
    return view('location', ['locations' => Lokasi::all()]);
});
Route::get('/about', function () {
    return view('about');
});
Route::get('/contact', function () {
    return view('contact');
});
Route::post('/contact/send', [App\Http\Controllers\ContactController::class, 'send']);
Route::post('/booking/check-availability', [App\Http\Controllers\BookingController::class, 'checkAvailability']);
Route::post('/booking/store', [App\Http\Controllers\BookingController::class, 'store'])->middleware('auth');

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
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

    // Pembayaran Routes
    Route::resource('pembayaran', PembayaranController::class);

    // Location Routes
    Route::resource('lokasi', LocationController::class);

    // Jenis Kendaraan Routes
    Route::resource('jenis-kendaraan', App\Http\Controllers\JenisKendaraanController::class);

    // User Management Routes
    Route::resource('users', App\Http\Controllers\UserController::class);

    // Rating Routes
    Route::post('/rating', [App\Http\Controllers\RatingController::class, 'store'])->name('rating.store');

    // Laporan Routes
    Route::prefix('laporan')->name('laporan.')->group(function () {
        Route::get('/', [App\Http\Controllers\LaporanController::class, 'index'])->name('index');
        Route::get('/detail', [App\Http\Controllers\LaporanController::class, 'detail'])->name('detail');
        Route::get('/export-pdf', [App\Http\Controllers\LaporanController::class, 'exportPdf'])->name('export.pdf');
    });

});

Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->middleware('auth');

// Profile Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [App\Http\Controllers\ProfileController::class, 'updatePassword'])->name('profile.password.update');
    Route::delete('/profile/avatar', [App\Http\Controllers\ProfileController::class, 'deleteAvatar'])->name('profile.avatar.delete');
});

Route::resource('armada', ArmadaController::class);