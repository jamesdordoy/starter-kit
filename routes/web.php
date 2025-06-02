<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('kitchen-sink', function () {
    return Inertia::render('KitchenSink', [
        'users' => User::paginate(),
    ]);
})->middleware(['auth', 'verified'])->name('sink');

require __DIR__.'/settings.php';
