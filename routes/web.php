<?php

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Home');
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::get('kitchen-sink', function () {
        return Inertia::render('KitchenSink', [
            'users' => UserResource::collection(User::paginate()),
        ]);
    })->name('sink');
});

require __DIR__.'/settings.php';
