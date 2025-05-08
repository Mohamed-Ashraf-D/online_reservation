<?php


use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\ReservationController;
use App\Http\Controllers\Admin\ServiceController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest:admin')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AuthController::class, 'login']);

});
Route::post('/logout', [AuthController::class, 'logout'])->name('admins.logout');
Route::middleware(['auth:admin', 'role:user_consultation|user_repairs|user_coaching'])->name('admins.')
    ->group(function () {
        Route::get('/my-reservations', [App\Http\Controllers\Admin\ReservationController::class, 'myReservations'])->name('my.reservations');
        Route::patch('/reservation/{id}/status', [App\Http\Controllers\Admin\ReservationController::class, 'markAsDone'])->name('reservation.done');
        Route::patch('/reservations/{id}/reject', [ReservationController::class, 'reject'])->name('reservation.reject');
        Route::get('/admins-dashboard', function () {
            return view('admins.dashboard');
        })->name('admins-dashboard');


    });

Route::middleware(['auth:admin', 'role:super_admin'])->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::resource('services', ServiceController::class);
    Route::get('/manage-admins', [AdminUserController::class, 'index'])->name('admins.index');
    Route::get('/manage-admins/create', [AdminUserController::class, 'create'])->name('admins.create');
    Route::post('/manage-admins', [AdminUserController::class, 'store'])->name('admins.store');


});
