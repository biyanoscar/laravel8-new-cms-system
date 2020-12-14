<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    // Route::get('/users/{user}/profile', [UserController::class, 'show'])->name('user.profile.show');
    Route::put('/users/{user}/update', [UserController::class, 'update'])->name('user.profile.update');

    // Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::delete('/users/{user}/destroy', [UserController::class, 'destroy'])->name('user.destroy');
});

Route::middleware(['role:admin', 'auth'])->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
});

Route::middleware(['can:view,user'])->group(function () {
    Route::get('/users/{user}/profile', [UserController::class, 'show'])->name('user.profile.show');
});
