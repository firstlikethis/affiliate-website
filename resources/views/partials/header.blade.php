<header class="bg-white shadow-sm sticky top-0 z-50 site-header">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Logo -->
            <div class="flex-shrink-0 flex items-center">
                <a href="{{ route('home') }}" class="text-2xl font-bold text-slate-800 flex items-center header-logo">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mr-2 text-slate-700" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 00.994-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zm2 5V6a2 2 0 10-4 0v1h4zm-6 3a1 1 0 112 0 1 1 0 01-2 0zm7-1a1 1 0 100 2 1 1 0 000-2z" clip-rule="evenodd" />
                    </svg>
                    <span>{{ config('app.name', 'ShopDeals') }}</span>
                </a>
            </div>
            
            <!-- Desktop Navigation -->
            <nav class="hidden md:ml-6 md:flex md:items-center md:space-x-4">
                <a href="{{ route('home') }}" class="px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('home') ? 'text-slate-800 bg-gray-100' : 'text-gray-700 hover:text-slate-800 hover:bg-gray-50' }}">
                    หน้าแรก
                </a>
                
                <!-- Categories Dropdown -->
                <div class="relative group">
                    <button class="px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:text-slate-800 hover:bg-gray-50 flex items-center">
                        หมวดหมู่
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    
                    <div class="absolute left-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 hidden group-hover:block">
                        <div class="py-1">
                            @foreach($globalCategories as $category)
                                <a href="{{ route('category.show', $category->slug) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    {{ $category->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
                
                <!-- Latest Articles -->
                <a href="{{ route('home') }}#latest-articles" class="px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:text-slate-800 hover:bg-gray-50">
                    บทความล่าสุด
                </a>
            </nav>
            
            <!-- Mobile menu button -->
            <div class="flex items-center md:hidden">
                <button type="button" class="inline-flex items-center justify-center p-2 rounded-md text-gray-700 hover:text-slate-800 hover:bg-gray-100" onclick="toggleMobileMenu()">
                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
    
    <!-- Mobile menu -->
    <div class="md:hidden hidden" id="mobile-menu">
        <div class="pt-2 pb-3 space-y-1 px-4 sm:px-6 lg:px-8">
            <a href="{{ route('home') }}" class="block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('home') ? 'text-slate-800 bg-gray-100' : 'text-gray-700 hover:bg-gray-100' }}">
                หน้าแรก
            </a>
            
            <!-- Categories -->
            <div>
                <button class="w-full flex justify-between items-center px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:bg-gray-100" onclick="this.nextElementSibling.classList.toggle('hidden')">
                    <span>หมวดหมู่</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                
                <div class="hidden pl-4 mt-1 space-y-1">
                    @foreach($globalCategories as $category)
                        <a href="{{ route('category.show', $category->slug) }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:bg-gray-100">
                            {{ $category->name }}
                        </a>
                    @endforeach
                </div>
            </div>
            
            <!-- Latest Articles -->
            <a href="{{ route('home') }}#latest-articles" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:bg-gray-100">
                บทความล่าสุด
            </a>
        </div>
    </div>
</header>