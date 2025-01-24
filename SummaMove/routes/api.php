<?php

use Illuminate\Http\Request;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Api\OefeningController;
use App\Http\Controllers\Api\UserController;
use App\Models\Oefening;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AutoLoginAsAdmin;


Route::middleware([AutoLoginAsAdmin::class])->group(function () {
    Route::apiResource('oefeningen', OefeningController::class);
    Route::apiResource('users', UserController::class);
    Route::post('login', [UserController::class, 'login']);
});