<?php

use App\Data\UserData;
use App\Http\Controllers\Settings\PasswordController;
use App\Http\Controllers\Settings\ProfileController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::middleware('auth')->group(function () {

    Route::resource('settings', ProfileController::class);

    Route::prefix('settings')->group(function () {

        Route::resource('profile', ProfileController::class)->only(['edit', 'update', 'destroy']);

        Route::get('/password', [PasswordController::class, 'edit'])->name('password.edit');
        Route::put('/password', [PasswordController::class, 'update'])->name('password.update');

        Route::get('/appearance', function () {
            return Inertia::render('settings/Appearance', [
                UserData::DATA_NAME => UserData::from(request()->user()),
            ]);
        })->name('appearance');
    });
});
