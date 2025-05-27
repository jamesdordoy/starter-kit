<?php

use App\Http\Controllers\Settings\ActivityLogController;
use App\Http\Controllers\Settings\PasswordController;
use App\Http\Controllers\Settings\ProfileController;
use App\Http\Controllers\Settings\SettingController;
use App\Http\Controllers\Settings\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::prefix('settings')->group(function () {
        Route::name('settings.')->group(function () {
            Route::resource('users', UserController::class);
            Route::resource('activity-log', ActivityLogController::class)->only(['index']);
        });

        Route::resource('profile', ProfileController::class)->only(['edit', 'update', 'destroy']);
        Route::get('/password', [PasswordController::class, 'edit'])->name('password.edit');
        Route::put('/password', [PasswordController::class, 'update'])->name('password.update');
    });

    Route::resource('settings', SettingController::class);
});
