<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Article;
use App\Models\Category;
use App\Services\SeoService;

class HomeController extends Controller
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
     * Show the application home page.
     */
    public function index()
    {
        // Get featured products
        $featuredProducts = Product::where('is_featured', true)
            ->with('category')
            ->latest()
            ->take(8)
            ->get();
            
        // Get latest products
        $latestProducts = Product::with('category')
            ->latest()
            ->take(12)
            ->get();
            
        // Get latest articles
        $latestArticles = Article::latest()
            ->take(3)
            ->get();
            
        // Get all categories for menu
        $categories = Category::all();
        
        // Set SEO meta tags
        $seoData = (object) [
            'title' => config('app.name') . ' - Affiliate เว็บไซต์สินค้าคุณภาพ',
            'description' => 'เว็บไซต์รวบรวมสินค้าคุณภาพและบทความสาระน่ารู้ พร้อมลิงก์ไปยังร้านค้าออนไลน์ที่เชื่อถือได้',
        ];
        
        $metaTags = $this->seoService->generateMetaTags($seoData);
        
        return view('home.index', compact('featuredProducts', 'latestProducts', 'latestArticles', 'categories', 'metaTags'));
    }
}