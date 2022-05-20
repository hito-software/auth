<?php

use Hito\Auth\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['auth'])->group(static function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::middleware(['guest'])->group(static function () {
    Route::get('login', [AuthController::class, 'show'])->name('login');
    Route::post('login', [AuthController::class, 'check'])->name('login-check');

    Route::prefix('/reset-password')->group(function () {
        Route::get('/', [AuthController::class, 'showResetPasswordViaEmail'])->name('reset-password-via-email');
        Route::post('/', [AuthController::class, 'triggerResetPassword']);
    });

    Route::prefix('/reset-password/{token}')->group(function () {
        Route::get('/', [AuthController::class, 'showResetPassword'])->name('reset-password');
        Route::post('/', [AuthController::class, 'resetPassword']);
    });
});
