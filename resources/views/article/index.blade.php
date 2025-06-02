@extends('layouts.app')

@section('content')
    <!-- Articles Header -->
    <section class="bg-gradient-to-r from-purple-600 to-purple-800 rounded-lg overflow-hidden">
        <div class="container mx-auto px-6 py-16">
            <div class="text-center">
                <h1 class="text-3xl md:text-4xl font-bold text-white mb-4">
                    @if(isset($tag))
                        บทความเกี่ยวกับ "{{ $tag->name }}"
                    @else
                        บทความทั้งหมด
                    @endif
                </h1>
                <p class="text-lg text-gray-200 max-w-2xl mx-auto">
                    รวบรวมบทความน่าสนใจ รีวิวสินค้า และแนะนำสินค้าคุณภาพ พร้อมรายละเอียดเพื่อช่วยคุณเลือกสิ่งที่ดีที่สุด
                </p>
            </div>
        </div>
    </section>

    <!-- Breadcrumbs -->
    <section class="container mx-auto px-4 py-4">
        <div class="flex items-center text-sm text-gray-600">
            <a href="{{ route('home') }}" class="hover:text-purple-600">หน้าแรก</a>
            <span class="mx-2">/</span>
            @if(isset($tag))
                <a href="{{ route('article.index') }}" class="hover:text-purple-600">บทความ</a>
                <span class="mx-2">/</span>
                <span class="text-gray-900 font-medium">{{ $tag->name }}</span>
            @else
                <span class="text-gray-900 font-medium">บทความ</span>
            @endif
        </div>
    </section>

    <div class="container mx-auto px-4 flex flex-col lg:flex-row gap-8">
        <!-- Main Content -->
        <main class="lg:w-2/3">
            <!-- Search & Filter Form -->
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <form action="{{ route('article.index') }}" method="GET" class="space-y-4">
                    <div class="flex flex-col sm:flex-row gap-4">
                        <div class="flex-grow">
                            <label for="search" class="block text-sm font-medium text-gray-700 mb-1">ค้นหาบทความ</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                                    <i class="fas fa-search text-gray-400"></i>
                                </span>
                                <input type="text" id="search" name="search" value="{{ request('search') }}" 
                                    placeholder="ค้นหาบทความ..."
                                    class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-600">
                            </div>
                        </div>
                        
                        <div class="sm:w-1/3">
                            <label for="tag" class="block text-sm font-medium text-gray-700 mb-1">กรองตามแท็ก</label>
                            <select id="tag" name="tag" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-600">
                                <option value="">ทั้งหมด</option>
                                @foreach($tags as $t)
                                    <option value="{{ $t->slug }}" {{ request('tag') == $t->slug || (isset($tag) && $tag->id == $t->id) ? 'selected' : '' }}>
                                        {{ $t->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                    <div class="flex justify-end">
                        <button type="submit" class="bg-purple-600 hover:bg-purple-700 text-white font-medium px-4 py-2 rounded-md transition duration-300">
                            <i class="fas fa-filter mr-2"></i> กรอง
                        </button>
                    </div>
                </form>
            </div>
            
            <!-- Articles Grid -->
            @if(count($articles) > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    @foreach($articles as $article)
                        <x-article-card :article="$article">
                            @if(count($article->tags) > 0)
                                <x-slot name="actions">
                                    <div class="flex flex-wrap gap-2 mt-2 mb-4">
                                        @foreach($article->tags as $t)
                                            <a href="{{ route('article.tag', ['tag' => $t]) }}" class="px-2 py-1 bg-purple-100 text-purple-700 text-xs rounded-full hover:bg-purple-200">
                                                {{ $t->name }}
                                            </a>
                                        @endforeach
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <span class="text-gray-500 text-sm flex items-center">
                                            <i class="far fa-eye mr-1"></i> {{ number_format($article->views) }} ครั้ง
                                        </span>
                                        <a href="{{ route('article.show', $article) }}" class="text-purple-600 font-medium hover:text-purple-800 inline-flex items-center">
                                            อ่านเพิ่มเติม <i class="fas fa-arrow-right ml-1"></i>
                                        </a>
                                    </div>
                                </x-slot>
                            @endif
                        </x-article-card>
                    @endforeach
                </div>
                
                <!-- Pagination -->
                <div class="mt-8">
                    {{ $articles->withQueryString()->links() }}
                </div>
            @else
                <div class="bg-white rounded-lg shadow-md p-8 text-center">
                    <div class="text-gray-400 mb-4">
                        <i class="fas fa-newspaper text-5xl"></i>
                    </div>
                    <h3 class="text-xl font-medium text-gray-700 mb-2">ไม่พบบทความ</h3>
                    <p class="text-gray-500 mb-4">
                        ขออภัย ยังไม่มีบทความที่ตรงกับเงื่อนไขการค้นหาของคุณ
                    </p>
                    <a href="{{ route('article.index') }}" class="inline-block bg-purple-600 hover:bg-purple-700 text-white font-medium px-4 py-2 rounded-md transition duration-300">
                        <i class="fas fa-undo mr-2"></i> ดูบทความทั้งหมด
                    </a>
                </div>
            @endif
        </main>

        <!-- Sidebar -->
        <aside class="lg:w-1/3">
            <!-- Categories -->
            <div class="bg-white rounded-lg shadow-md p-6 mb-8">
                <h3 class="text-lg font-bold text-gray-800 mb-4">หมวดหมู่</h3>
                <ul class="space-y-2">
                    @foreach($categories as $category)
                        <li>
                            <a href="{{ route('category.show', $category) }}" class="flex items-center justify-between px-4 py-2 text-gray-700 hover:bg-gray-50 hover:text-purple-700 rounded-md">
                                <span>{{ $category->name }}</span>
                                <i class="fas fa-chevron-right text-xs"></i>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
            
            <!-- Popular Tags -->
            <div class="bg-white rounded-lg shadow-md p-6 mb-8">
                <h3 class="text-lg font-bold text-gray-800 mb-4">แท็กยอดนิยม</h3>
                <div class="flex flex-wrap gap-2">
                    @foreach($tags->take(15) as $t)
                        <a href="{{ route('article.tag', $t) }}" class="px-3 py-1 bg-gray-100 text-gray-700 text-sm rounded-full hover:bg-purple-100 hover:text-purple-700 transition duration-300">
                            {{ $t->name }}
                        </a>
                    @endforeach
                </div>
            </div>
            
            <!-- Newsletter Signup -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4">สมัครรับข่าวสาร</h3>
                <p class="text-gray-600 mb-4">
                    สมัครรับข่าวสารเพื่อรับบทความและโปรโมชันล่าสุดส่งตรงถึงอีเมลของคุณ
                </p>
                <form action="#" method="POST" class="newsletter-form space-y-4">
                    <div>
                        <input type="email" name="email" placeholder="อีเมลของคุณ" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-600">
                    </div>
                    <button type="submit" class="w-full bg-purple-600 hover:bg-purple-700 text-white font-medium px-4 py-2 rounded-md transition duration-300">
                        <i class="fas fa-paper-plane mr-2"></i> สมัครรับข่าวสาร
                    </button>
                    <p class="text-xs text-gray-500">
                        เราเคารพความเป็นส่วนตัวของคุณและจะไม่ส่งสแปม
                    </p>
                </form>
            </div>
        </aside>
    </div>
@endsection