<?php

use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\Post\PostController;
use App\Http\Controllers\Dashboard\User\UserController;

Route::middleware('auth')->group(function() {
    // Dashboard routes
    Route::get('/', [DashboardController::class, 'index'])->name('index');

    // Users routes
    Route::get('/user/archived', [UserController::class, 'archived'])->name('user.archived');
    Route::delete('/user/{id}/forceDelete', [UserController::class, 'forceDelete'])->name('user.forceDelete');
    Route::post('/user/{id}/restore', [UserController::class, 'restore'])->name('user.restore');
    Route::get('/user/members', [UserController::class, 'checkMembers'])->name('user.members');
    Route::resource('/user', UserController::class)->except('show');

    // Posts routes
    Route::resource('/post', PostController::class);
});
