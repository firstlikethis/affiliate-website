<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;
use App\Models\Category;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Force HTTPS in production
        if (config('app.env') === 'production') {
            URL::forceScheme('https');
        }
        
        // Share categories with all views
        if (Schema::hasTable('categories')) {
            $categories = Category::all();
            View::share('globalCategories', $categories);
        }
        
        // Handle sub-folder installation (contextPath)
        $this->handleSubfolderInstallation();
    }
    
    /**
     * Handle sub-folder installation (contextPath).
     */
    private function handleSubfolderInstallation(): void
    {
        // Get the base URL from .env
        $appUrl = config('app.url');
        
        // Parse the URL to get the path
        $parsedUrl = parse_url($appUrl);
        
        // If the URL includes a path (subfolder)
        if (isset($parsedUrl['path']) && $parsedUrl['path'] !== '/') {
            // Ensure assets, routes, and other URLs include the subfolder
            URL::forceRootUrl($appUrl);
        }
    }
}