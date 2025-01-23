<?php

use Illuminate\Http\Request;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OefeningController;
use App\Models\Oefening;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AutoLoginAsAdmin;

Route::middleware([AutoLoginAsAdmin::class])->group(function () {
    Route::apiResource('oefeningen', OefeningController::class);
});