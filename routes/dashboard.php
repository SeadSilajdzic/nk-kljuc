<?php

use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\Post\PostController;
use App\Http\Controllers\Dashboard\User\UserController;

Route::middleware('auth')->group(function() {
    // Dashboard routes
    Route::get('/', [DashboardController::class, 'index'])->name('index');

    // Users routes
    Route::resource('/user', UserController::class);

    // Posts routes
    Route::resource('/post', PostController::class);
});
