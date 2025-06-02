<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\SitemapController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Front-end routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/category/{category:slug}', [CategoryController::class, 'show'])->name('category.show');
Route::get('/article/{article:slug}', [ArticleController::class, 'show'])->name('article.show');

// Search
Route::get('/search', [SearchController::class, 'search'])->name('search');

// Contact
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Articles routes
Route::get('/articles', [ArticleController::class, 'index'])->name('article.index');
Route::get('/article/{article:slug}', [ArticleController::class, 'show'])->name('article.show');
Route::get('/tag/{tag:slug}', [ArticleController::class, 'tag'])->name('article.tag');

// Product search for articles
Route::post('/articles/search-products', [ArticleController::class, 'searchProducts'])->name('articles.search-products');

// Sitemap
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap.index');

// Include admin routes
require __DIR__.'/admin.php';