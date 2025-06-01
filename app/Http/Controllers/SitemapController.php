<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Article;
use App\Models\Category;

class SitemapController extends Controller
{
    /**
     * Generate the sitemap.xml file
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        $articles = Article::all();
        
        // We don't include products in sitemap because they link directly to affiliate sites
        
        return response()->view('sitemap.index', [
            'categories' => $categories,
            'articles' => $articles,
        ])->header('Content-Type', 'text/xml');
    }
}