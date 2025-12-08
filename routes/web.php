<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\DashboardController;

// Home Page
Route::get('/', function () {
    return view('home'); 
})->name('home');

// Article / Blog Routes 
Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/articles/{slug}', [ArticleController::class, 'show'])->name('articles.show');


// AUTHENTICATED ROUTES (Must be logged in)

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Booking System
    Route::get('/booking', [AppointmentController::class, 'index'])->name('booking.index');
    Route::post('/booking', [AppointmentController::class, 'store'])->name('booking.store');
    Route::get('/my-bookings', [AppointmentController::class, 'history'])->name('booking.history');

    // Forum System
    Route::get('/forum', [ForumController::class, 'index'])->name('forum.index');
    Route::get('/forum/create', [ForumController::class, 'create'])->name('forum.create');
    Route::post('/forum', [ForumController::class, 'store'])->name('forum.store');
    Route::get('/forum/{id}', [ForumController::class, 'show'])->name('forum.show');
    Route::post('/forum/{id}/reply', [ForumController::class, 'storeReply'])->name('forum.reply.store');
});

// Authentication Routes (Login/Register)
require __DIR__.'/auth.php';