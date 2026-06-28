<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserSkillController;
use App\Http\Controllers\SwapController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::post('/profile/skills', [UserSkillController::class, 'store'])->name('profile.skills.store');
    Route::delete('/profile/skills/{id}', [UserSkillController::class, 'destroy'])->name('profile.skills.destroy');
    
    // Swap routes
    Route::get('/swaps', [SwapController::class, 'index'])->name('swaps.index');
    Route::get('/swaps/create/{userId}', [SwapController::class, 'create'])->name('swaps.create');
    Route::post('/swaps', [SwapController::class, 'store'])->name('swaps.store');
    Route::post('/swaps/{id}/accept', [SwapController::class, 'accept'])->name('swaps.accept');
    Route::post('/swaps/{id}/reject', [SwapController::class, 'reject'])->name('swaps.reject');
    
    // Review routes
    Route::get('/swaps/{swapId}/review', [ReviewController::class, 'create'])->name('reviews.create');
    Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
});

require __DIR__.'/auth.php';
