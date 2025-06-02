<?php
// app/Http/Controllers/Admin/ArticleController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Product;
use App\Models\Tag;
use App\Http\Requests\ArticleRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the articles.
     */
    public function index()
    {
        $articles = Article::with('tags')->paginate(10);
        return view('admin.articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new article.
     */
    public function create()
    {
        $tags = Tag::all();
        return view('admin.articles.create', compact('tags'));
    }
    
    /**
     * Search for products while creating/editing articles
     */
    public function searchProducts(Request $request)
    {
        $query = $request->input('query');
        
        $products = Product::where('name', 'LIKE', "%{$query}%")
            ->orWhere('meta_title', 'LIKE', "%{$query}%")
            ->with('category')
            ->take(10)
            ->get();
            
        return response()->json($products);
    }

    /**
     * Store a newly created article in storage.
     */
    public function store(ArticleRequest $request)
    {
        $article = new Article();
        $article->title = $request->title;
        $article->slug = Str::slug($request->title);
        $article->content = $request->content;
        $article->meta_title = $request->meta_title ?? $request->title;
        $article->meta_description = $request->meta_description ?? Str::limit(strip_tags($request->content), 160);
        $article->views = 0;
        
        // Handle Schema.org JSON-LD markup
        $schemaMarkup = [
            '@context' => 'https://schema.org',
            '@type' => 'Article',
            'headline' => $article->title,
            'description' => $article->meta_description,
            'datePublished' => now()->toIso8601String(),
            'dateModified' => now()->toIso8601String(),
            'author' => [
                '@type' => 'Person',
                'name' => auth()->user()->name
            ]
        ];
        
        $article->schema_markup = json_encode($schemaMarkup);
        
        // Handle thumbnail upload
        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('articles', 'public');
            $article->thumbnail = $thumbnailPath;
            
            // Add image to schema markup
            $schemaMarkup['image'] = url('storage/' . $thumbnailPath);
            $article->schema_markup = json_encode($schemaMarkup);
        }
        
        $article->save();
        
        // Handle tags
        if ($request->has('tags')) {
            $this->syncTags($request->tags, $article);
        }
        
        // Attach products to article if selected
        if ($request->has('products')) {
            $position = 0;
            foreach ($request->products as $productId) {
                $article->products()->attach($productId, ['position' => $position]);
                $position++;
            }
        }
        
        return redirect()->route('admin.articles.index')
            ->with('success', 'สร้างบทความสำเร็จ');
    }

    /**
     * Show the form for editing the specified article.
     */
    public function edit(Article $article)
    {
        $tags = Tag::all();
        $selectedTags = $article->tags->pluck('id')->toArray();
        $selectedProducts = $article->products->pluck('id')->toArray();
        $products = $article->products;
        
        return view('admin.articles.edit', compact('article', 'tags', 'selectedTags', 'selectedProducts', 'products'));
    }

    /**
     * Update the specified article in storage.
     */
    public function update(ArticleRequest $request, Article $article)
    {
        $article->title = $request->title;
        $article->slug = Str::slug($request->title);
        $article->content = $request->content;
        $article->meta_title = $request->meta_title ?? $request->title;
        $article->meta_description = $request->meta_description ?? Str::limit(strip_tags($request->content), 160);
        
        // Update Schema.org JSON-LD markup
        $schemaMarkup = [
            '@context' => 'https://schema.org',
            '@type' => 'Article',
            'headline' => $article->title,
            'description' => $article->meta_description,
            'datePublished' => $article->created_at->toIso8601String(),
            'dateModified' => now()->toIso8601String(),
            'author' => [
                '@type' => 'Person',
                'name' => auth()->user()->name
            ]
        ];
        
        // Handle thumbnail upload
        if ($request->hasFile('thumbnail')) {
            // Delete old thumbnail if exists
            if ($article->thumbnail) {
                Storage::disk('public')->delete($article->thumbnail);
            }
            
            $thumbnailPath = $request->file('thumbnail')->store('articles', 'public');
            $article->thumbnail = $thumbnailPath;
            
            // Add image to schema markup
            $schemaMarkup['image'] = url('storage/' . $thumbnailPath);
        } elseif ($article->thumbnail) {
            // Keep existing image in schema
            $schemaMarkup['image'] = url('storage/' . $article->thumbnail);
        }
        
        $article->schema_markup = json_encode($schemaMarkup);
        
        $article->save();
        
        // Handle tags
        if ($request->has('tags')) {
            $this->syncTags($request->tags, $article);
        } else {
            $article->tags()->detach();
        }
        
        // Sync products
        if ($request->has('products')) {
            $syncData = [];
            $position = 0;
            
            foreach ($request->products as $productId) {
                $syncData[$productId] = ['position' => $position];
                $position++;
            }
            
            $article->products()->sync($syncData);
        } else {
            $article->products()->detach();
        }
        
        return redirect()->route('admin.articles.index')
            ->with('success', 'อัปเดตบทความสำเร็จ');
    }

    /**
     * Remove the specified article from storage.
     */
    public function destroy(Article $article)
    {
        // Delete thumbnail if exists
        if ($article->thumbnail) {
            Storage::disk('public')->delete($article->thumbnail);
        }
        
        // Detach all products and tags
        $article->products()->detach();
        $article->tags()->detach();
        
        $article->delete();
        
        return redirect()->route('admin.articles.index')
            ->with('success', 'ลบบทความสำเร็จ');
    }
    
    /**
     * Sync tags with the article
     */
    private function syncTags($tagInput, $article)
    {
        $tagIds = [];
        
        foreach ($tagInput as $tagName) {
            // Skip empty tags
            if (empty(trim($tagName))) {
                continue;
            }
            
            // Create slug
            $slug = Str::slug($tagName);
            
            // Find or create the tag
            $tag = Tag::firstOrCreate(
                ['slug' => $slug],
                ['name' => $tagName]
            );
            
            $tagIds[] = $tag->id;
        }
        
        // Sync tags with the article
        $article->tags()->sync($tagIds);
    }
}