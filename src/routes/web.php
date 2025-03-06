<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Test1Controller;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;


Route::get('/', [Test1Controller::class, 'index'])->name('index');
Route::post('/confirm', [Test1Controller::class, 'confirm'])->name('confirm');
Route::post('/contacts', [Test1Controller::class, 'store'])->name('store');

// Route::middleware('guest')->group(function () {
//     Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register.index');
//     Route::post('/register', [RegisterController::class, 'register'])->name('register');
//     Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login.index');
//     Route::post('/login', [LoginController::class, 'login'])->name('login');
// });

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register.index');
Route::post('/register', [RegisterController::class, 'register'])->name('register');
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login.index');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// 管理画面のルート（ログイン後にリダイレクトする先）
Route::middleware('auth')->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/admin/{id}', [AdminController::class, 'show'])->name('admin.show');
});
// Auth::routes();
