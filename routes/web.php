<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\GuideController;
use App\Http\Controllers\ContactController;

// Public pages
Route::get('/', [PageController::class, 'home']);
Route::get('/home', [PageController::class, 'home'])->name('home');

// Contact form (everyone)
Route::get('/contact', [ContactController::class, 'create'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.send');

// Guests only: login and register
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// Logged-in users: bookings (customers see only their own)
Route::middleware('auth')->group(function () {
    Route::resource('bookings', BookingController::class)->except(['show']);
});

// Admin only: activities, guides, and contact messages
Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('activities', ActivityController::class)->except(['index', 'show']);
    Route::resource('guides', GuideController::class)->except(['show']);
    Route::get('/messages', [ContactController::class, 'index'])->name('messages.index');
});

// Everyone: browse, search, view activities
Route::resource('activities', ActivityController::class)->only(['index', 'show']);
