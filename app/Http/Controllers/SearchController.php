<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Article;
use App\Models\Category;

class SearchController extends Controller
{
    /**
     * Handle the search request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $query = $request->input('q');
        
        // Validate search query
        if (empty($query) || strlen($query) < 2) {
            return redirect()->back()->with('error', 'กรุณาระบุคำค้นหาที่มีความยาวอย่างน้อย 2 ตัวอักษร');
        }
        
        // Get search results
        $products = Product::where('name', 'LIKE', "%{$query}%")
            ->orWhere('meta_title', 'LIKE', "%{$query}%")
            ->orWhere('meta_description', 'LIKE', "%{$query}%")
            ->with('category')
            ->take(20)
            ->get();
            
        $articles = Article::where('title', 'LIKE', "%{$query}%")
            ->orWhere('content', 'LIKE', "%{$query}%")
            ->orWhere('meta_title', 'LIKE', "%{$query}%")
            ->orWhere('meta_description', 'LIKE', "%{$query}%")
            ->take(10)
            ->get();
            
        $categories = Category::where('name', 'LIKE', "%{$query}%")
            ->orWhere('description', 'LIKE', "%{$query}%")
            ->take(5)
            ->get();
        
        // Count total results
        $totalResults = $products->count() + $articles->count() + $categories->count();
        
        // Get all categories for menu
        $allCategories = Category::all();
        
        // Set SEO meta tags
        $metaTags = [
            'title' => 'ผลการค้นหาสำหรับ: ' . $query . ' - ' . config('app.name'),
            'description' => 'ค้นพบสินค้าและบทความที่เกี่ยวข้องกับ ' . $query . ' ที่ ' . config('app.name'),
            'canonical' => url()->current(),
            'robots' => 'noindex, follow',
        ];
        
        return view('search.index', compact(
            'query', 
            'products', 
            'articles', 
            'categories', 
            'totalResults', 
            'allCategories', 
            'metaTags'
        ));
    }
}