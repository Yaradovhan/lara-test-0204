<?php

use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PlanController;

Route::get('/', function () {
    return redirect()->route('dashboard');
});
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/dashboard/domain', [DashboardController::class, 'saveDomain'])->name('dashboard.domain');

    // Маршрути для редагування домену
    Route::get('/dashboard/domain/{id}/edit', [DashboardController::class, 'editDomain'])->name('dashboard.domain.edit');
    Route::put('/dashboard/domain/{id}', [DashboardController::class, 'updateDomain'])->name('dashboard.domain.update');

    Route::get('/plans', [PlanController::class, 'index'])->name('plans');
    Route::post('/plans/buy/{plan}', [PlanController::class, 'buyPlan'])->name('plans.buy');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/users', [UserController::class, 'index'])->name('users')->middleware(AdminMiddleware::class);
});
