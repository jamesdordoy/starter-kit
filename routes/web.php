<?php

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Home');
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('kitchen-sink', function () {
    return Inertia::render('KitchenSink', [
        'users' => UserResource::collection(User::paginate()),
    ]);
})->middleware(['auth', 'verified'])->name('sink');

require __DIR__.'/settings.php';
