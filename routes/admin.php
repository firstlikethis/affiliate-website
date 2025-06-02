<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\AuthController;

// Admin routes with prefix 'dashboard-x1z3a9' for security (instead of 'admin')
Route::prefix('dashboard-x1z3a9')->name('admin.')->group(function () {
    // Authentication routes
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // Protected admin routes
    Route::middleware(['web', 'auth', \App\Http\Middleware\AdminMiddleware::class])->group(function () {
        // Dashboard
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        
        // Categories management
        Route::resource('categories', CategoryController::class);
        
        // Products management
        Route::resource('products', ProductController::class);
        
        // Articles management
        Route::resource('articles', ArticleController::class);
        
        // เพิ่ม route สำหรับ search products ในบทความ
        Route::post('articles/search-products', [ArticleController::class, 'searchProducts'])
            ->name('articles.search-products');
    });
});