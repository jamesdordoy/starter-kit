<?php

use App\Http\Controllers\Settings\ActivityLogController;
use App\Http\Controllers\Settings\LogoController;
use App\Http\Controllers\Settings\MediaController;
use App\Http\Controllers\Settings\PasswordController;
use App\Http\Controllers\Settings\PermissionController;
use App\Http\Controllers\Settings\ProfileAvatarController;
use App\Http\Controllers\Settings\ProfileController;
use App\Http\Controllers\Settings\RoleController;
use App\Http\Controllers\Settings\SettingController;
use App\Http\Controllers\Settings\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::prefix('settings')->group(function () {
        Route::name('settings.')->group(function () {
            Route::resource('users', UserController::class);
            Route::put('users/{user}/roles-permissions', [UserController::class, 'update'])->name('users.roles-permissions.update');
            Route::resource('activity', ActivityLogController::class)->only(['index', 'show']);
            Route::resource('media-items', MediaController::class);
            Route::resource('roles', RoleController::class);
            Route::resource('permissions', PermissionController::class);
            Route::post('logo', [LogoController::class, 'update'])->name('logo.update');

            Route::impersonate();
        });

        Route::resource('profile', ProfileController::class)->only(['edit', 'update', 'destroy']);
        Route::post('/profile/avatar', [ProfileAvatarController::class, 'update'])->name('profile.avatar');

        Route::get('/password', [PasswordController::class, 'edit'])->name('password.edit');
        Route::put('/password', [PasswordController::class, 'update'])->name('password.update');
    });

    Route::resource('settings', SettingController::class);
});
