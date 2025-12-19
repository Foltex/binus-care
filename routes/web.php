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

// Article 
Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/articles/{slug}', [ArticleController::class, 'show'])->name('articles.show');


// section only for logged in users
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
    Route::post('/my-bookings/{appointment}/cancel', [AppointmentController::class, 'cancel'])->name('booking.cancel');

    // Forum System
    Route::get('/forum', [ForumController::class, 'index'])->name('forum.index');
    Route::get('/forum/create', [ForumController::class, 'create'])->name('forum.create');
    Route::post('/forum', [ForumController::class, 'store'])->name('forum.store');
    Route::get('/forum/{id}', [ForumController::class, 'show'])->name('forum.show');
    Route::post('/forum/{id}/reply', [ForumController::class, 'storeReply'])->name('forum.reply.store');

    // doctor routes
    Route::prefix('admin')->group(function () { 
        Route::get('/appointments', [AppointmentController::class, 'adminIndex'])->name('admin.appointments.index');
        Route::post('/appointments/{appointment}/confirm', [AppointmentController::class, 'confirm'])->name('admin.appointments.confirm');
    });

    // articles crud 
    Route::prefix('admin/articles')->group(function () {
        Route::get('/create', [ArticleController::class, 'create'])->name('admin.articles.create');
        Route::post('/', [ArticleController::class, 'store'])->name('admin.articles.store');
        Route::get('/{article}/edit', [ArticleController::class, 'edit'])->name('admin.articles.edit');
        Route::put('/{article}', [ArticleController::class, 'update'])->name('admin.articles.update');
        Route::delete('/{article}', [ArticleController::class, 'destroy'])->name('admin.articles.destroy');
    });
});

// Authentication Routes (Login/Register)
require __DIR__.'/auth.php';