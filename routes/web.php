<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminEventController;
use App\Http\Controllers\Admin\AdminReportController;
use App\Http\Controllers\Admin\AdminSportController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ExploreController;
use App\Http\Controllers\FriendController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SportController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return auth()->check() ? redirect()->route('dashboard') : redirect()->route('login');
})->name('home');

// Guest / Auth routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

// Authenticated user routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/sports/pick', [SportController::class, 'pick'])->name('sports.pick');
    Route::post('/sports/pick', [SportController::class, 'save'])->name('sports.save');

    Route::get('/explore', [ExploreController::class, 'index'])->name('explore.index');
    Route::get('/explore/{user}', [ExploreController::class, 'show'])->name('explore.show');

    Route::get('/events', [EventController::class, 'index'])->name('events.index');
    Route::get('/events/create', [EventController::class, 'create'])->name('events.create');
    Route::post('/events', [EventController::class, 'store'])->name('events.store');
    Route::get('/events/{event}', [EventController::class, 'show'])->name('events.show');
    Route::post('/events/{event}/join', [EventController::class, 'join'])->name('events.join');
    Route::post('/events/{event}/leave', [EventController::class, 'leave'])->name('events.leave');
    Route::post('/events/{event}/cancel', [EventController::class, 'cancel'])->name('events.cancel');

    Route::get('/friends', [FriendController::class, 'index'])->name('friends.index');
    Route::post('/friends/{user}/request', [FriendController::class, 'request'])->name('friends.request');
    Route::post('/friends/{friend}/accept', [FriendController::class, 'accept'])->name('friends.accept');
    Route::post('/friends/{friend}/reject', [FriendController::class, 'reject'])->name('friends.reject');
    Route::delete('/friends/{friend}/cancel', [FriendController::class, 'cancel'])->name('friends.cancel');
    Route::delete('/friends/{user}', [FriendController::class, 'destroy'])->name('friends.destroy');

    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/riwayat', [ProfileController::class, 'riwayat'])->name('profile.riwayat');
});

// Admin routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');

    Route::get('/users/{user}', [AdminUserController::class, 'show'])
    ->name('users.show');

    Route::delete('/users/{user}', [AdminUserController::class, 'destroy'])->name('users.destroy');

    Route::get('/sports', [AdminSportController::class, 'index'])->name('sports.index');
    Route::post('/sports', [AdminSportController::class, 'store'])->name('sports.store');
    Route::put('/sports/{sport}', [AdminSportController::class, 'update'])->name('sports.update');
    Route::delete('/sports/{sport}', [AdminSportController::class, 'destroy'])->name('sports.destroy');

    Route::get('/events', [AdminEventController::class, 'index'])->name('events.index');
    Route::put('/events/{event}/status', [AdminEventController::class, 'updateStatus'])->name('events.status');
    Route::delete('/events/{event}', [AdminEventController::class, 'destroy'])->name('events.destroy');

    Route::get('/reports', [AdminReportController::class, 'index'])->name('reports.index');
});
