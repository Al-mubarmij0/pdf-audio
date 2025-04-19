<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AudioController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

// Show login form and handle login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');

// Show registration form and handle registration
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');

// Handle logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| PDF to Audio Routes
|--------------------------------------------------------------------------
*/

// Homepage with upload form (PDF upload page)
Route::get('/', [AudioController::class, 'index'])->name('home');

// Handle form submission to convert PDF to audio
Route::post('/convert', [AudioController::class, 'convert'])->name('convert.submit');

/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/

// Routes that require authentication (using 'auth' middleware)
Route::middleware(['auth'])->group(function () {
    // View conversion history
    Route::get('history', [AudioController::class, 'history'])->name('convert.history');

    // Delete a specific conversion record (must be logged in to perform)
    Route::delete('/conversion/{id}', [AudioController::class, 'destroy'])->name('convert.destroy');
});
