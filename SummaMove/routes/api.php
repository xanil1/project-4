<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OefeningController;
use App\Models\Oefening;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
})->name('index');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // User routes
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::get('/users/add', [UserController::class, 'add'])->name('users.add');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::put('/users/{user}/promote', [UserController::class, 'promote'])->name('users.promote');

    // Oefening routes
    Route::get('/oefeningen', [OefeningController::class, 'index'])->name('oefeningen.index');
    Route::get('/oefeningen/{oefening}/edit', [OefeningController::class, 'edit'])->name('oefeningen.edit');
    Route::delete('/oefeningen/{oefening}', [OefeningController::class, 'destroy'])->name('oefeningen.destroy');
    Route::put('/oefeningen/{oefening}', [OefeningController::class, 'update'])->name('oefeningen.update');
    Route::get('/oefeningen/create', [OefeningController::class, 'create'])->name('oefeningen.create');
    Route::post('/oefeningen', [OefeningController::class, 'store'])->name('oefeningen.store');
});