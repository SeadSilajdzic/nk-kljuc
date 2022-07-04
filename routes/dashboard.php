<?php

use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\Post\PostController;
use App\Http\Controllers\Dashboard\User\UserController;

Route::middleware('auth')->group(function() {
    Route::middleware('isAdmin')->group(function() {
        // Dashboard routes
        Route::get('/', [DashboardController::class, 'index'])->name('index');

        // Users routes
        Route::get('/user/archived', [UserController::class, 'archived'])->name('user.archived');
        Route::delete('/user/{id}/forceDelete', [UserController::class, 'forceDelete'])->name('user.forceDelete');
        Route::post('/user/{id}/restore', [UserController::class, 'restore'])->name('user.restore');
        Route::get('/user/members', [UserController::class, 'checkMembers'])->name('user.members');
        Route::resource('/user', UserController::class)->except('show');

        // Posts routes
        Route::get('/post/archived', [PostController::class, 'archived'])->name('post.archived');
        Route::delete('/post/{id}/forceDelete', [PostController::class, 'forceDelete'])->name('post.forceDelete');
        Route::post('/post/{id}/restore', [PostController::class, 'restore'])->name('post.restore');
        Route::resource('/post', PostController::class)->except('show');
    });
});
