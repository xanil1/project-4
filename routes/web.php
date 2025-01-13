<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;

Route::get('/', [IndexController::class, 'index'])->name('index');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Gebruikersbeheer (alleen toegankelijk voor ingelogde gebruikers)
Route::middleware('auth')->group(function () {
    // Route naar de gebruikerspagina
    Route::get('/users', [UserController::class, 'index'])->name('users.index');

    // Route om een gebruiker te bewerken
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');

    // Route om een gebruiker te verwijderen
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

    // Route om klanten te beheren (add.blade.php)
    Route::get('/users/add', [UserController::class, 'add'])->name('users.add');

    // Route om een gebruiker te promoten (klant naar medewerker)
    Route::post('/users/{user}/promote', [UserController::class, 'promote'])->name('users.promote');
});

// Profielpagina (voor het bewerken van het profiel van de ingelogde gebruiker)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Authenticatie routes
require __DIR__.'/auth.php';