@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <section class="relative">
        <!-- Hero Banner -->
        <div class="bg-gradient-to-r from-purple-600 to-purple-800 rounded-xl overflow-hidden">
            <div class="container mx-auto px-6 py-16 flex flex-col md:flex-row items-center">
                <div class="md:w-1/2 text-center md:text-left md:pr-10">
                    <h1 class="text-4xl md:text-5xl font-bold text-white leading-tight mb-6">
                        ค้นพบสินค้าคุณภาพในราคาที่คุ้มค่า
                    </h1>
                    <p class="text-lg text-purple-100 mb-8">
                        เรารวบรวมสินค้าที่ดีที่สุดจากร้านค้าออนไลน์ชั้นนำ พร้อมโปรโมชั่นและส่วนลดพิเศษเพื่อคุณ
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center md:justify-start">
                        <a href="#featured-products" class="btn-primary">
                            <i class="fas fa-shopping-cart mr-2"></i> สินค้าแนะนำ
                        </a>
                        <a href="#latest-articles" class="btn-secondary">
                            <i class="fas fa-newspaper mr-2"></i> บทความล่าสุด
                        </a>
                    </div>
                </div>
                <div class="md:w-1/2 mt-10 md:mt-0">
                    <img src="{{ asset('images/hero-image.jpg') }}" alt="Shopping Online" class="rounded-lg shadow-xl">
                </div>
            </div>
        </div>
        
        <!-- Category Shortcuts -->
        <div class="container mx-auto px-4 relative -mt-10 z-10">
            <div class="bg-white rounded-xl shadow-lg p-6 grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">
                @foreach($categories->take(5) as $category)
                    <a href="{{ route('category.show', $category->slug) }}" class="flex flex-col items-center hover-up">
                        <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center text-purple-600 mb-2">
                            <i class="fas fa-{{ $loop->index == 0 ? 'tshirt' : ($loop->index == 1 ? 'mobile-alt' : ($loop->index == 2 ? 'shoe-prints' : ($loop->index == 3 ? 'gem' : 'heart'))) }} text-2xl"></i>
                        </div>
                        <span class="text-sm font-medium text-gray-700">{{ $category->name }}</span>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Featured Products Section -->
    <section id="featured-products" class="mt-16">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-2xl font-bold text-gray-800">สินค้าแนะนำ</h2>
                <a href="#" class="text-purple-600 hover:text-purple-800 flex items-center text-sm font-medium">
                    ดูทั้งหมด <i class="fas fa-chevron-right ml-1 text-xs"></i>
                </a>
            </div>
            
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach($featuredProducts as $product)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden hover-up">
                        <div class="relative">
                            <a href="{{ $product->affiliate_link }}" target="_blank" rel="nofollow noopener">
                                <img class="w-full h-48 object-cover lazy" data-src="{{ $product->image_url }}" alt="{{ $product->name }}" src="{{ asset('images/placeholder.jpg') }}">
                                <div class="absolute top-0 right-0 bg-orange-500 text-white text-xs font-bold px-2 py-1 m-2 rounded">แนะนำ</div>
                            </a>
                        </div>
                        <div class="p-4">
                            <a href="{{ $product->affiliate_link }}" target="_blank" rel="nofollow noopener" class="block">
                                <h3 class="text-lg font-medium text-gray-800 mb-2 line-clamp-2 h-14">{{ $product->name }}</h3>
                                <p class="text-gray-500 text-sm mb-2">{{ $product->category->name }}</p>
                                <div class="flex justify-between items-center">
                                    <span class="text-purple-600 font-bold">{{ number_format($product->price, 2) }} บาท</span>
                                    <div class="text-yellow-400">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-alt"></i>
                                    </div>
                                </div>
                            </a>
                            <a href="{{ $product->affiliate_link }}" target="_blank" rel="nofollow noopener" class="btn-buy w-full mt-4">
                                <i class="fas fa-shopping-cart"></i> ซื้อเลย
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Latest Products Section -->
    <section class="mt-16">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-2xl font-bold text-gray-800">สินค้ามาใหม่</h2>
                <a href="#" class="text-purple-600 hover:text-purple-800 flex items-center text-sm font-medium">
                    ดูทั้งหมด <i class="fas fa-chevron-right ml-1 text-xs"></i>
                </a>
            </div>
            
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach($latestProducts as $product)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden hover-up">
                        <div class="relative">
                            <a href="{{ $product->affiliate_link }}" target="_blank" rel="nofollow noopener">
                                <img class="w-full h-48 object-cover lazy" data-src="{{ $product->image_url }}" alt="{{ $product->name }}" src="{{ asset('images/placeholder.jpg') }}">
                                @if($loop->index < 3)
                                    <div class="absolute top-0 left-0 bg-purple-500 text-white text-xs font-bold px-2 py-1 m-2 rounded">ใหม่</div>
                                @endif
                            </a>
                        </div>
                        <div class="p-4">
                            <a href="{{ $product->affiliate_link }}" target="_blank" rel="nofollow noopener" class="block">
                                <h3 class="text-lg font-medium text-gray-800 mb-2 line-clamp-2 h-14">{{ $product->name }}</h3>
                                <p class="text-gray-500 text-sm mb-2">{{ $product->category->name }}</p>
                                <div class="flex justify-between items-center">
                                    <span class="text-purple-600 font-bold">{{ number_format($product->price, 2) }} บาท</span>
                                    <div class="text-yellow-400">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-alt"></i>
                                    </div>
                                </div>
                            </a>
                            <a href="{{ $product->affiliate_link }}" target="_blank" rel="nofollow noopener" class="btn-buy w-full mt-4">
                                <i class="fas fa-shopping-cart"></i> ซื้อเลย
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Latest Articles Section -->
    <section id="latest-articles" class="mt-16">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-2xl font-bold text-gray-800">บทความล่าสุด</h2>
                <a href="#" class="text-purple-600 hover:text-purple-800 flex items-center text-sm font-medium">
                    ดูทั้งหมด <i class="fas fa-chevron-right ml-1 text-xs"></i>
                </a>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($latestArticles as $article)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden hover-up">
                        <a href="{{ route('article.show', $article->slug) }}" class="block relative">
                            <img class="w-full h-56 object-cover lazy" data-src="{{ $article->thumbnail_url }}" alt="{{ $article->title }}" src="{{ asset('images/placeholder.jpg') }}">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent"></div>
                            <div class="absolute bottom-0 left-0 p-4">
                                <span class="bg-purple-600 text-white text-xs font-medium px-2 py-1 rounded">บทความ</span>
                                <h3 class="text-xl font-semibold text-white mt-2">{{ $article->title }}</h3>
                            </div>
                        </a>
                        <div class="p-4">
                            <div class="flex items-center text-gray-500 text-sm mb-3">
                                <span class="flex items-center">
                                    <i class="far fa-calendar-alt mr-1"></i>
                                    {{ $article->formatted_created_at }}
                                </span>
                            </div>
                            <p class="text-gray-600 mb-4 line-clamp-3">
                                {{ \Illuminate\Support\Str::limit(strip_tags($article->content), 150) }}
                            </p>
                            <a href="{{ route('article.show', $article->slug) }}" class="text-purple-600 font-medium hover:text-purple-800 inline-flex items-center">
                                อ่านเพิ่มเติม <i class="fas fa-arrow-right ml-1"></i>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Promotion Banner -->
    <section class="mt-16">
        <div class="container mx-auto px-4">
            <div class="bg-gradient-to-r from-purple-500 to-pink-500 rounded-xl overflow-hidden">
                <div class="container mx-auto px-6 py-12 flex flex-col md:flex-row items-center">
                    <div class="md:w-2/3 text-center md:text-left">
                        <h2 class="text-3xl font-bold text-white mb-4">รับส่วนลดพิเศษวันนี้!</h2>
                        <p class="text-purple-100 mb-6">
                            ซื้อสินค้าผ่านเว็บไซต์ของเราวันนี้และรับส่วนลดพิเศษ พร้อมโปรโมชั่นมากมายที่คุณไม่ควรพลาด
                        </p>
                        <a href="#featured-products" class="inline-block bg-white text-purple-600 font-semibold px-6 py-3 rounded-lg hover:bg-gray-100 transition duration-300">
                            ช้อปเลย
                        </a>
                    </div>
                    <div class="md:w-1/3 mt-8 md:mt-0 text-center">
                        <span class="inline-block bg-white text-purple-600 text-5xl font-bold p-6 rounded-full">
                            50% OFF
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Newsletter Section -->
    <section class="mt-16">
        <div class="container mx-auto px-4">
            <div class="bg-gray-100 rounded-xl p-8 text-center">
                <h2 class="text-2xl font-bold text-gray-800 mb-2">สมัครรับข่าวสารและโปรโมชั่น</h2>
                <p class="text-gray-600 mb-6 max-w-xl mx-auto">
                    ลงทะเบียนเพื่อรับข่าวสารเกี่ยวกับสินค้าใหม่ โปรโมชั่นพิเศษ และบทความที่น่าสนใจก่อนใคร
                </p>
                <form class="max-w-md mx-auto flex">
                    <input type="email" placeholder="อีเมลของคุณ" class="flex-grow px-4 py-3 rounded-l-lg focus:outline-none focus:ring-2 focus:ring-purple-600 border border-gray-300">
                    <button type="submit" class="bg-purple-600 hover:bg-purple-700 text-white font-medium px-6 py-3 rounded-r-lg transition duration-300">
                        สมัครรับข่าวสาร
                    </button>
                </form>
            </div>
        </div>
    </section>
@endsection