<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServiceController;
use App\Models\AboutSection;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\Admin\AboutSectionController;


// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', function () {
    return 'Laravel is working!';
});




Route::get('/dashboard', function () {
    return view('pages.home', ['aboutSections' => AboutSection::all()]);
})->name('dashboard');



Route::resource('services', ServiceController::class);
// 45
// Route::resource('services', ServiceController::class)->only(['index']);

// Route::middleware(['auth', 'admin'])->group(function () {
//     Route::get('/services/create', [ServiceController::class, 'create'])->name('services.create');
//     Route::post('/services', [ServiceController::class, 'store'])->name('services.store');
//     Route::get('/services/{service}/edit', [ServiceController::class, 'edit'])->name('services.edit');
//     Route::put('/services/{service}', [ServiceController::class, 'update'])->name('services.update');
//     Route::delete('/services/{service}', [ServiceController::class, 'destroy'])->name('services.destroy');
// });
require __DIR__.'/auth.php';
// 45

// Public booking routes (no auth required)
Route::get('/services/{service}/book', [BookingController::class, 'create'])->name('bookings.create');
Route::post('/services/{service}/book', [BookingController::class, 'store'])->name('bookings.store');
// Route::get('/all-bookings', [BookingController::class, 'myBookings'])->name('bookings.my');

// Only 'my bookings' should require login
Route::middleware(['auth'])->get('/all-bookings', [BookingController::class, 'myBookings'])->name('bookings.my');

// Admin booking management (optional)
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/bookings', [BookingController::class, 'index'])->name('bookings.index');
    Route::post('/admin/bookings/{booking}/status', [BookingController::class, 'updateStatus'])->name('bookings.updateStatus');
});

Route::put('/bookings/{booking}/status', [BookingController::class, 'updateStatus'])->name('bookings.updateStatus');


// editor routes
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('about-sections/{section}/edit', [AboutSectionController::class, 'edit'])->name('about-sections.edit');
    Route::post('about-sections/{section}', [AboutSectionController::class, 'update'])->name('about-sections.update');
});


