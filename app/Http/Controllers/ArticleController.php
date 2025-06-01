<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;
use App\Services\SeoService;

class ArticleController extends Controller
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
     * Display the specified article.
     */
    public function show(Article $article)
    {
        // Eager load products with their categories
        $products = $article->products()
            ->with('category')
            ->orderBy('article_products.position')
            ->get();
            
        // Get all categories for menu
        $categories = Category::all();
        
        // Get related articles
        $relatedArticles = Article::where('id', '!=', $article->id)
            ->latest()
            ->take(3)
            ->get();
            
        // Set SEO meta tags
        $metaTags = $this->seoService->generateMetaTags($article, 'article');
        
        return view('article.show', compact('article', 'products', 'categories', 'relatedArticles', 'metaTags'));
    }
}