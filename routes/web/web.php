<?php

use App\Http\Controllers\AdminsController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/post/{post}', [PostController::class, 'show'])->name('post');

Route::middleware('auth')->group(function () {
    Route::get('/admin', [AdminsController::class, 'index'])->name('admin.index');
});

// Route::get('/admin/posts/{post}/edit', [PostController::class, 'edit'])->middleware('can:view,post')->name('post.edit');
