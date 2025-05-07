<?php


use App\Http\Controllers\Consultation\ConsultationController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'role:user_consultation'])
    ->prefix('consultation')
    ->name('consultation.')
    ->group(function () {
        Route::get('/consultation/profile', [ConsultationController::class, 'profile'])->name('consultation.profile');
        Route::get('/', [ConsultationController::class, 'index'])->name('index');
        Route::get('/services', [ConsultationController::class, 'services'])->name('services');
        Route::post('/reserve', [ConsultationController::class, 'reserve'])->name('reserve');

    });
