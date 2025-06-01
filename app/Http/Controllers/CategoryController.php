<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Services\SeoService;

class CategoryController extends Controller
{
    protected $seoService;
    
    /**
     * Create a new controller instance.
     */
    public function __construct(SeoService $seoService)
    {
        $this->seoService = $seoService;
    }
    
    /**
     * Display the specified category.
     */
    public function show(Category $category)
    {
        // Eager load products with their categories
        $products = $category->products()
            ->latest()
            ->get();
            
        // Get all categories for menu
        $categories = Category::all();
        
        // Set SEO meta tags
        $metaTags = $this->seoService->generateMetaTags($category, 'category');
        
        return view('category.show', compact('category', 'products', 'categories', 'metaTags'));
    }
}