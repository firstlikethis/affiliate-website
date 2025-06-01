<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Article;

class DashboardController extends Controller
{
    /**
     * Display the dashboard.
     */
    public function index()
    {
        // Get counts for dashboard widgets
        $totalProducts = Product::count();
        $totalCategories = Category::count();
        $totalArticles = Article::count();
        
        // Get latest products
        $latestProducts = Product::latest()->take(5)->get();
        
        // Get latest articles
        $latestArticles = Article::latest()->take(5)->get();
        
        return view('admin.dashboard', compact(
            'totalProducts', 
            'totalCategories', 
            'totalArticles', 
            'latestProducts', 
            'latestArticles'
        ));
    }
}