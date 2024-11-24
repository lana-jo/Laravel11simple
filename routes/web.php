<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ItemsController;
use App\Http\Controllers\BorrowingItemController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ReturningItemController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\WelcomeController;


// Public routes
Route::get('/', [WelcomeController::class, 'index']);

// Authentication routes
Route::middleware('guest')->group(function () {
     Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
     Route::post('/login', [AuthController::class, 'login']);
     Route::get('register', [AuthController::class, 'showRegisterForm'])->name('register');
     Route::post('register', [AuthController::class, 'register']);
});

// Protected routes
Route::middleware('auth')->group(function () {
     // Dashboard
     Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
     // Resource routes
     Route::resource('users', UsersController::class);
     Route::resource('items', ItemsController::class);
     Route::resource('borrowings', BorrowingItemController::class);
     Route::resource('categories', CategoriesController::class);
     Route::resource('returnings', ReturningItemController::class);
    
     // Custom returning route
     Route::post('returnings/{borrowing}/return', [ReturningItemController::class, 'returnItem'])
         ->name('returnings.return');
    
     // Logout route
     Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});
