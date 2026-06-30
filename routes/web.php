<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FriendController;

// Route untuk halaman manajemen pertemanan
Route::get('/friends', [FriendController::class, 'index'])->name('friends.index');

// Route untuk aksi (Terima/Batalkan)
Route::post('/friends/store', [FriendController::class, 'store'])->name('friends.store');
Route::put('/friends/{id}', [FriendController::class, 'update'])->name('friends.update');
Route::delete('/friends/{id}', [FriendController::class, 'destroy'])->name('friends.destroy');