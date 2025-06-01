<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- SEO Meta Tags -->
    @include('partials.seo', ['metaTags' => $metaTags ?? null])
    
    <title>{{ isset($metaTags['title']) ? $metaTags['title'] : config('app.name') }}</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Kanit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Enterprise CSS -->
    <link rel="stylesheet" href="{{ asset('css/enterprise.css') }}">
    
    <style>
        body {
            font-family: 'Inter', 'Kanit', sans-serif;
        }
        
        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        ::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #555;
        }
        
        /* Hover effects */
        .hover-up {
            transition: transform 0.3s ease;
        }
        .hover-up:hover {
            transform: translateY(-5px);
        }
    </style>
    
    <!-- Custom Scripts -->
    <script>
        // Initialize Tailwind Configuration
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            light: '#3B82F6',
                            DEFAULT: '#2563EB',
                            dark: '#1D4ED8',
                        },
                        secondary: {
                            light: '#475569',
                            DEFAULT: '#334155',
                            dark: '#1E293B',
                        }
                    }
                }
            }
        }
    </script>
    
    @yield('head')
</head>
<body class="bg-gray-50 text-gray-800 flex flex-col min-h-screen">
    <!-- Header -->
    @include('partials.header')
    
    <!-- Main Content -->
    <main class="flex-grow container mx-auto px-4 py-6 sm:px-6 lg:px-8">
        @yield('content')
    </main>
    
    <!-- Footer -->
    @include('partials.footer')
    
    <!-- Scripts -->
    <script>
        // Lazyload images
        document.addEventListener("DOMContentLoaded", function() {
            let lazyImages = [].slice.call(document.querySelectorAll("img.lazy"));
            
            if ("IntersectionObserver" in window) {
                let lazyImageObserver = new IntersectionObserver(function(entries, observer) {
                    entries.forEach(function(entry) {
                        if (entry.isIntersecting) {
                            let lazyImage = entry.target;
                            lazyImage.src = lazyImage.dataset.src;
                            lazyImage.classList.remove("lazy");
                            lazyImageObserver.unobserve(lazyImage);
                        }
                    });
                });
                
                lazyImages.forEach(function(lazyImage) {
                    lazyImageObserver.observe(lazyImage);
                });
            }
        });
        
        // Mobile menu toggle
        function toggleMobileMenu() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        }
    </script>
    
    @yield('scripts')
</body>
</html>