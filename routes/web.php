<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\ReservationController;
use App\Http\Controllers\User\ServiceController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});



Route::middleware(['auth','role:normal_user'])->group(function () {
    Route::get('/dashboard', function () {
        return view('user.dashboard');
    })->name('user.dashboard');
    Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
    Route::get('/reservations/create', [ReservationController::class, 'create'])->name('reservations.create');
    Route::post('/reservations/store', [ReservationController::class, 'store'])->name('reservations.store');
    Route::post('/reservations/{id}/cancel', [ReservationController::class, 'cancel'])->name('reservations.cancel');
    Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations.index');
    Route::get('/services/{service}/reserve', [ReservationController::class, 'create'])->name('services.reserve');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::delete('/edit/{id}', [ProfileController::class, 'edit'])->name('profile.edit');
});

require __DIR__.'/auth.php';
