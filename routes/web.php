<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Page\DashboardController;
use App\Http\Controllers\Page\LicturersController;
use App\Http\Controllers\Page\SchedulesController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',

])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');


    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/licturers', [LicturersController::class, 'index'])->name('licturers');
    Route::get('/schedules', [SchedulesController::class, 'index'])->name('schedules');

});

