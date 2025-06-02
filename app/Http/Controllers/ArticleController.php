<?php
// app/Http/Controllers/ArticleController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
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
     * Display a listing of all articles.
     */
    public function index(Request $request)
    {
        // Get all categories and tags for filters
        $categories = Category::all();
        $tags = Tag::all();
        
        // Build query
        $query = Article::with('tags')->latest();
        
        // Apply tag filter if provided
        if ($request->has('tag') && $request->tag != '') {
            $tag = Tag::where('slug', $request->tag)->firstOrFail();
            $query->whereHas('tags', function($q) use ($tag) {
                $q->where('tags.id', $tag->id);
            });
        }
        
        // Apply search filter if provided
        if ($request->has('search') && $request->search != '') {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('title', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('content', 'LIKE', "%{$searchTerm}%");
            });
        }
        
        // Get paginated results
        $articles = $query->paginate(9);
        
        // Set SEO meta tags
        $seoData = (object) [
            'title' => 'บทความทั้งหมด - ' . config('app.name'),
            'description' => 'รวบรวมบทความน่าสนใจ รีวิวสินค้า และแนะนำสินค้าคุณภาพ พร้อมรายละเอียดเพื่อช่วยคุณเลือกสิ่งที่ดีที่สุด',
        ];
        
        $metaTags = $this->seoService->generateMetaTags($seoData);
        
        return view('article.index', compact('articles', 'categories', 'tags', 'metaTags'));
    }
    
    /**
     * Display the specified article.
     */
    public function show(Article $article)
    {
        // Increment view count
        $article->incrementViewCount();
        
        // Eager load products with their categories
        $products = $article->products()
            ->with('category')
            ->orderBy('article_products.position')
            ->get();
            
        // Get all categories for menu
        $categories = Category::all();
        
        // Get related articles based on tags
        $relatedArticles = collect();
        
        if ($article->tags->count() > 0) {
            $tagIds = $article->tags->pluck('id');
            
            $relatedArticles = Article::where('id', '!=', $article->id)
                ->whereHas('tags', function($q) use ($tagIds) {
                    $q->whereIn('tags.id', $tagIds);
                })
                ->latest()
                ->take(3)
                ->get();
        }
        
        // If we don't have enough related articles by tags, add some recent ones
        if ($relatedArticles->count() < 3) {
            $moreArticles = Article::where('id', '!=', $article->id)
                ->whereNotIn('id', $relatedArticles->pluck('id'))
                ->latest()
                ->take(3 - $relatedArticles->count())
                ->get();
                
            $relatedArticles = $relatedArticles->concat($moreArticles);
        }
        
        // Get all tags for the article
        $tags = $article->tags;
        
        // Set SEO meta tags
        $metaTags = $this->seoService->generateMetaTags($article, 'article');
        
        return view('article.show', compact('article', 'products', 'categories', 'relatedArticles', 'tags', 'metaTags'));
    }
    
    /**
     * Display articles by tag.
     */
    public function tag(Tag $tag)
    {
        // Get articles with this tag
        $articles = $tag->articles()->latest()->paginate(9);
        
        // Get all categories for menu
        $categories = Category::all();
        
        // Get all tags for filter
        $tags = Tag::all();
        
        // Set SEO meta tags
        $seoData = (object) [
            'title' => 'บทความเกี่ยวกับ ' . $tag->name . ' - ' . config('app.name'),
            'description' => 'รวบรวมบทความเกี่ยวกับ ' . $tag->name . ' สาระน่ารู้ รีวิวสินค้า และข้อมูลที่เป็นประโยชน์',
        ];
        
        $metaTags = $this->seoService->generateMetaTags($seoData);
        
        return view('article.index', compact('articles', 'categories', 'tags', 'tag', 'metaTags'));
    }
}