<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\EarnedController;
use App\Http\Controllers\RidesController;
use App\Http\Controllers\TaxiController;

Route::get('/login', [PageController::class, 'login'])->name('login');
Route::get('/register', [PageController::class, 'register'])->name('register');
Route::get('/', [PageController::class, 'index'])->name('index');
Route::get('/services', [PageController::class, 'services'])->name('services');
Route::get('/drivers', [PageController::class, 'drivers'])->name('drivers');
Route::get('/call', [PageController::class, 'call'])->name('call');

Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::post('/auth/login', [AuthController::class, 'login'])->name('auth.login');
Route::post('/auth/register', [AuthController::class, 'register'])->name('auth.register');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::post('/taksi/cagir', [TaxiController::class, 'call'])->name('taksi.call');

// drivers.blade.php için
Route::get('drivers', [DriverController::class, 'drivers'])->name('drivers');


// driverform.blade.php için
Route::get('/driver-form', [DriverController::class, 'index'])->name('driverForm');
Route::post('/become-driver', [DriverController::class, 'submitForm'])->name('becomeDriver.submit');

// ridehistory.blade.php için
Route::get('/ridehistory', [RidesController::class, 'index'])->name('ridehistory');
Route::post('/rides/{id}/complete', [RidesController::class, 'completeRide'])->name('rides.complete');
Route::get('/rides', [RidesController::class, 'index'])->name('rides.index');



