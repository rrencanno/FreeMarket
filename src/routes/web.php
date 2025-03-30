<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\WeightLogController;
use Laravel\Fortify\Fortify;


Route::get('/register/step1', [RegisterController::class, 'showRegistrationForm'])->name('register.step1');
Route::post('/register/step1', [RegisterController::class, 'register']);
Route::get('/register/step2', [RegisterController::class, 'create'])->name('register.step2');
Route::post('/register/step2', [RegisterController::class, 'store'])->name('register.step2.store');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.attempt');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/weight_logs', [WeightLogController::class, 'index'])->name('weight_logs.index');
Route::post('/weight_logs', [WeightLogController::class, 'store'])->name('weight_logs.store');
Route::get('/weight_logs/{weightLogId}/edit', [WeightLogController::class, 'edit'])->name('weight_logs.edit');
Route::put('/weight_logs/{weightLogId}', [WeightLogController::class, 'update'])->name('weight_logs.update');
Route::delete('/weight_logs/{weightLogId}', [WeightLogController::class, 'destroy'])->name('weight_logs.destroy');
Route::get('/weight_logs/target_setting', [WeightLogController::class, 'editTargetWeight'])
    ->name('weight_logs.target_setting');
Route::post('/weight_logs/target_setting', [WeightLogController::class, 'updateTargetWeight'])
    ->name('weight_logs.target_setting.update');