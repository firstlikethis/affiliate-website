@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <section class="relative">
        <!-- Hero Banner -->
        <div class="bg-gradient-to-r from-slate-800 to-slate-700 rounded-lg overflow-hidden">
            <div class="container mx-auto px-6 py-16 flex flex-col md:flex-row items-center">
                <div class="md:w-1/2 text-center md:text-left md:pr-10">
                    <h1 class="text-4xl md:text-5xl font-bold text-white leading-tight mb-6">
                        สินค้าคุณภาพ ราคาคุ้มค่า
                    </h1>
                    <p class="text-lg text-gray-200 mb-8">
                        รวบรวมสินค้าที่ดีที่สุดจากร้านค้าออนไลน์ชั้นนำ พร้อมราคาพิเศษและบทความรีวิวที่น่าสนใจ
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center md:justify-start">
                        <a href="#featured-products" class="btn-primary">
                            <i class="fas fa-shopping-cart mr-2"></i> สินค้าแนะนำ
                        </a>
                        <a href="{{ route('article.index') }}" class="btn-secondary">
                            <i class="fas fa-newspaper mr-2"></i> บทความทั้งหมด
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
            <div class="bg-white rounded-lg shadow-md p-6 grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">
                @foreach($categories->take(5) as $category)
                    <a href="{{ route('category.show', $category->slug) }}" class="category-card hover-up">
                        <div class="category-icon">
                            <i class="fas fa-{{ $loop->index == 0 ? 'tshirt' : ($loop->index == 1 ? 'mobile-alt' : ($loop->index == 2 ? 'shoe-prints' : ($loop->index == 3 ? 'gem' : 'box'))) }}"></i>
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
                <a href="#" class="text-slate-600 hover:text-slate-800 flex items-center text-sm font-medium">
                    ดูทั้งหมด <i class="fas fa-chevron-right ml-1 text-xs"></i>
                </a>
            </div>
            
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach($featuredProducts as $product)
                    <x-product-card :product="$product" :featured="true" />
                @endforeach
            </div>
        </div>
    </section>

    <!-- Latest Products Section -->
    <section class="mt-16">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-2xl font-bold text-gray-800">สินค้ามาใหม่</h2>
                <a href="#" class="text-slate-600 hover:text-slate-800 flex items-center text-sm font-medium">
                    ดูทั้งหมด <i class="fas fa-chevron-right ml-1 text-xs"></i>
                </a>
            </div>
            
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach($latestProducts as $product)
                    <x-product-card :product="$product">
                        @if($loop->index < 3)
                            <x-slot name="badge">ใหม่</x-slot>
                        @endif
                    </x-product-card>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Latest Articles Section -->
    <section id="latest-articles" class="mt-16">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-2xl font-bold text-gray-800">บทความล่าสุด</h2>
                <a href="{{ route('article.index') }}" class="text-slate-600 hover:text-slate-800 flex items-center text-sm font-medium">
                    ดูทั้งหมด <i class="fas fa-chevron-right ml-1 text-xs"></i>
                </a>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($latestArticles as $article)
                    <x-article-card :article="$article" />
                @endforeach
            </div>
        </div>
    </section>

    <!-- Popular Tags Section -->
    <section class="mt-16">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-2xl font-bold text-gray-800">แท็กยอดนิยม</h2>
                <a href="{{ route('article.index') }}" class="text-slate-600 hover:text-slate-800 flex items-center text-sm font-medium">
                    ดูบทความทั้งหมด <i class="fas fa-chevron-right ml-1 text-xs"></i>
                </a>
            </div>
            
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex flex-wrap gap-3">
                    @foreach(App\Models\Tag::withCount('articles')->orderBy('articles_count', 'desc')->take(15)->get() as $tag)
                        <a href="{{ route('article.tag', $tag->slug) }}" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-full hover:bg-slate-200 hover:text-slate-800 transition duration-300 flex items-center">
                            {{ $tag->name }}
                            <span class="ml-1 bg-slate-700 text-white text-xs px-1.5 py-0.5 rounded-full">{{ $tag->articles_count }}</span>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- Promotion Banner -->
    <section class="mt-16">
        <div class="container mx-auto px-4">
            <div class="bg-gradient-to-r from-slate-700 to-slate-600 rounded-lg overflow-hidden">
                <div class="container mx-auto px-6 py-12 flex flex-col md:flex-row items-center">
                    <div class="md:w-2/3 text-center md:text-left">
                        <h2 class="text-3xl font-bold text-white mb-4">รับสิทธิพิเศษวันนี้!</h2>
                        <p class="text-gray-200 mb-6">
                            ซื้อสินค้าผ่านเว็บไซต์ของเราวันนี้และรับส่วนลดพิเศษ พร้อมโปรโมชั่นมากมายที่คุณไม่ควรพลาด
                        </p>
                        <a href="#featured-products" class="inline-block bg-white text-slate-700 font-semibold px-6 py-3 rounded-lg hover:bg-gray-100 transition duration-300">
                            ดูสินค้าแนะนำ
                        </a>
                    </div>
                    <div class="md:w-1/3 mt-8 md:mt-0 text-center">
                        <span class="inline-block bg-white text-slate-700 text-5xl font-bold p-6 rounded-full">
                            50% OFF
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action Section -->
    <section class="mt-16">
        <div class="container mx-auto px-4">
            <div class="bg-gradient-to-r from-purple-600 to-purple-800 rounded-lg overflow-hidden">
                <div class="container mx-auto px-6 py-12 flex flex-col md:flex-row items-center">
                    <div class="md:w-2/3 text-center md:text-left">
                        <h2 class="text-3xl font-bold text-white mb-4">ต้องการความช่วยเหลือ?</h2>
                        <p class="text-gray-200 mb-6">
                            หากคุณมีข้อสงสัยเกี่ยวกับสินค้าหรือบทความใดๆ บนเว็บไซต์ของเรา อย่าลังเลที่จะติดต่อเรา เรายินดีให้คำแนะนำและช่วยเหลือคุณตลอดเวลา
                        </p>
                        <a href="{{ route('contact.index') }}" class="inline-block bg-white text-purple-700 font-semibold px-6 py-3 rounded-lg hover:bg-gray-100 transition duration-300">
                            <i class="fas fa-envelope mr-2"></i> ติดต่อเรา
                        </a>
                    </div>
                    <div class="md:w-1/3 mt-8 md:mt-0 text-center">
                        <div class="bg-white/10 p-6 rounded-full inline-block">
                            <i class="fas fa-headset text-white text-6xl"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection