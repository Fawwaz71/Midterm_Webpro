<?php

use App\Http\Controllers\RegistControl;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\logincontrol;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CategoryController;


Route::get('/', function () {
    return view('home');
});

Route::get('/register', [RegistControl::class, 'showForm'])->name('register');
Route::post('/register', [RegistControl::class, 'processForm'])->name('register.process');
Route::get('/login', [logincontrol::class, 'showLoginForm'])->name('login');
Route::post('/login', [logincontrol::class, 'login'])->name('login.process');
Route::post('/logout', [logincontrol::class, 'logout'])->name('logout');
Route::delete('/account/delete', [logincontrol::class, 'destroy'])->name('account.delete');
Route::middleware('auth')->group(function() {
Route::resource('posts', PostController::class);
Route::resource('comments', CommentController::class)->only(['store','edit','update','destroy']);
});

Route::resource('categories', CategoryController::class)->only(['index','show']);
Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
