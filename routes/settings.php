<?php

use App\Data\UserData;
use App\Http\Controllers\Settings\PasswordController;
use App\Http\Controllers\Settings\ProfileController;
use App\Http\Controllers\Settings\SettingController;
use App\Http\Controllers\Settings\UserController as SettingsUserController;
use App\Http\Controllers\ActivityLogController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::middleware('auth')->group(function () {
    
    Route::prefix('settings')->group(function () {

        Route::resource('profile', ProfileController::class)->only(['edit', 'update', 'destroy']);
        
        Route::name('settings.')->group(function () {
            Route::resource('users', SettingsUserController::class);
            Route::get('/activity-log', [ActivityLogController::class, 'index'])
                ->name('activity-log');
        });

        Route::get('/password', [PasswordController::class, 'edit'])->name('password.edit');
        Route::put('/password', [PasswordController::class, 'update'])->name('password.update');
    });

    Route::resource('settings', SettingController::class);
});
