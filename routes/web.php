<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ThemeController;

// Public Routes
Route::get('/', function () {
    return view('theme.index'); // Homepage view for users
})->name('home');

// Public pages handled by ThemeController
Route::controller(ThemeController::class)->name('theme.')->group(function () {
    Route::get('/about', 'about')->name('about');
    Route::get('/booking', 'booking')->name('booking');
    Route::get('/contact', 'contact')->name('contact');
    Route::get('/service', 'service')->name('service');
    Route::get('/team', 'team')->name('team');
    Route::get('/testimonial', 'testimonial')->name('testimonial');
});

// Guest-specific routes (for login view)
Route::middleware('guest')->group(function () {
    Route::get('/login', function () {
        return view('dashboard.login'); // Your login view
    })->name('login');
});

// Authenticated and role-based routes
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard.main'); // Admin dashboard view
    })->name('dashboard');

    Route::get('/rental', function () {
        return view('dashboard.rental'); // Admin rental management view
    })->name('rental');
    Route::get('/news', function () {
        return view('dashboard.news'); // Admin newsletter view
    })->name('news');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('users');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::put('/users/{id}/update', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

    Route::get('/events', [EventController::class, 'index'])->name('event');
    Route::post('/events', [EventController::class, 'store'])->name('events.store');
    Route::put('/events/{id}', [EventController::class, 'update'])->name('events.update');
    Route::delete('/events/{id}', [EventController::class, 'destroy'])->name('events.destroy');
});


Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// Authenticated users' logout route
Route::middleware('auth')->group(function () {
    Route::post('/logout', function () {
        auth()->logout();
        request()->session()->invalidate(); // Invalidate the session
        request()->session()->regenerateToken(); // Regenerate the CSRF token
        return redirect()->route('login'); // Redirect to the login page
    })->name('logout');

});

// Include Breeze auth routes
require __DIR__.'/auth.php';
