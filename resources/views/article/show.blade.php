@extends('layouts.app')

@section('content')
    <!-- Article Header -->
    <section class="relative">
        <div class="relative h-80 w-full overflow-hidden rounded-xl">
            <img class="w-full h-full object-cover" src="{{ $article->thumbnail_url }}" alt="{{ $article->title }}">
            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent"></div>
            <div class="absolute bottom-0 left-0 p-6 md:p-10 w-full">
                <div class="max-w-3xl">
                    <h1 class="text-3xl md:text-4xl font-bold text-white mb-4">{{ $article->title }}</h1>
                    <div class="flex items-center text-white/80 text-sm">
                        <span class="flex items-center">
                            <i class="far fa-calendar-alt mr-1"></i>
                            {{ $article->formatted_created_at }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Breadcrumbs -->
    <section class="container mx-auto px-4 py-4">
        <div class="flex items-center text-sm text-gray-600">
            <a href="{{ route('home') }}" class="hover:text-purple-600">หน้าแรก</a>
            <span class="mx-2">/</span>
            <a href="{{ route('home') }}#latest-articles" class="hover:text-purple-600">บทความ</a>
            <span class="mx-2">/</span>
            <span class="text-gray-900 font-medium">{{ $article->title }}</span>
        </div>
    </section>

    <div class="container mx-auto px-4 flex flex-col lg:flex-row gap-8">
        <!-- Main Content -->
        <main class="lg:w-2/3">
            <!-- Article Content -->
            <article class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="p-6 md:p-8">
                    <!-- Article Body -->
                    <div class="prose max-w-none">
                        {!! $article->content !!}
                    </div>

                    <!-- Social Share -->
                    <div class="mt-10 pt-6 border-t border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">แชร์บทความนี้</h3>
                        <div class="flex space-x-4">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank" class="bg-blue-600 text-white w-10 h-10 rounded-full flex items-center justify-center hover:bg-blue-700">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($article->title) }}" target="_blank" class="bg-blue-400 text-white w-10 h-10 rounded-full flex items-center justify-center hover:bg-blue-500">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="https://line.me/R/msg/text/?{{ urlencode($article->title . ' ' . url()->current()) }}" target="_blank" class="bg-green-500 text-white w-10 h-10 rounded-full flex items-center justify-center hover:bg-green-600">
                                <i class="fab fa-line"></i>
                            </a>
                            <a href="mailto:?subject={{ urlencode($article->title) }}&body={{ urlencode(url()->current()) }}" class="bg-gray-600 text-white w-10 h-10 rounded-full flex items-center justify-center hover:bg-gray-700">
                                <i class="fas fa-envelope"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </article>

            <!-- Featured Products in Article -->
            @if(count($products) > 0)
                <section class="mt-8">
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <div class="p-6 md:p-8">
                            <h2 class="text-2xl font-bold text-gray-800 mb-6">สินค้าแนะนำในบทความ</h2>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                @foreach($products as $product)
                                    <div class="flex bg-gray-50 rounded-lg overflow-hidden hover-up">
                                        <div class="w-1/3">
                                            <a href="{{ $product->affiliate_link }}" target="_blank" rel="nofollow noopener">
                                                <img class="w-full h-32 object-cover lazy" data-src="{{ $product->image_url }}" alt="{{ $product->name }}" src="{{ asset('images/placeholder.jpg') }}">
                                            </a>
                                        </div>
                                        <div class="w-2/3 p-4">
                                            <a href="{{ $product->affiliate_link }}" target="_blank" rel="nofollow noopener" class="block">
                                                <h3 class="text-md font-medium text-gray-800 mb-1 line-clamp-2">{{ $product->name }}</h3>
                                                <div class="text-yellow-400 text-xs mb-1">
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star-half-alt"></i>
                                                </div>
                                                <div class="flex justify-between items-center">
                                                    <span class="text-purple-600 font-bold text-sm">{{ number_format($product->price, 2) }} บาท</span>
                                                </div>
                                            </a>
                                            <a href="{{ $product->affiliate_link }}" target="_blank" rel="nofollow noopener" class="btn-buy w-full mt-2 py-1 text-sm">
                                                <i class="fas fa-shopping-cart"></i> ซื้อเลย
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </section>
            @endif

            <!-- Related Articles -->
            @if(count($relatedArticles) > 0)
                <section class="mt-8">
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <div class="p-6 md:p-8">
                            <h2 class="text-2xl font-bold text-gray-800 mb-6">บทความที่เกี่ยวข้อง</h2>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                @foreach($relatedArticles as $relatedArticle)
                                    <a href="{{ route('article.show', $relatedArticle->slug) }}" class="flex items-center group">
                                        <div class="w-20 h-20 flex-shrink-0">
                                            <img class="w-full h-full object-cover rounded lazy" data-src="{{ $relatedArticle->thumbnail_url }}" alt="{{ $relatedArticle->title }}" src="{{ asset('images/placeholder.jpg') }}">
                                        </div>
                                        <div class="ml-4">
                                            <h3 class="text-gray-800 font-medium group-hover:text-purple-600 transition duration-300 line-clamp-2">{{ $relatedArticle->title }}</h3>
                                            <span class="text-gray-500 text-sm">{{ $relatedArticle->formatted_created_at }}</span>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </section>
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
                            <a href="{{ route('category.show', $category->slug) }}" class="flex items-center justify-between px-4 py-2 text-gray-700 hover:bg-purple-50 hover:text-purple-600 rounded-md">
                                <span>{{ $category->name }}</span>
                                <i class="fas fa-chevron-right text-xs"></i>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
            
            <!-- Popular Products -->
            <div class="bg-white rounded-lg shadow-md p-6 mb-8">
                <h3 class="text-lg font-bold text-gray-800 mb-4">สินค้ายอดนิยม</h3>
                <div class="space-y-4">
                    @foreach($products->take(4) as $popularProduct)
                        <a href="{{ $popularProduct->affiliate_link }}" target="_blank" rel="nofollow noopener" class="flex items-start group">
                            <div class="w-16 h-16 flex-shrink-0">
                                <img class="w-full h-full object-cover rounded lazy" data-src="{{ $popularProduct->image_url }}" alt="{{ $popularProduct->name }}" src="{{ asset('images/placeholder.jpg') }}">
                            </div>
                            <div class="ml-3">
                                <h4 class="text-sm font-medium text-gray-800 group-hover:text-purple-600 transition duration-300 line-clamp-2">{{ $popularProduct->name }}</h4>
                                <span class="text-purple-600 text-sm font-bold">{{ number_format($popularProduct->price, 2) }} บาท</span>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
            
            <!-- Newsletter -->
            <div class="bg-purple-600 rounded-lg shadow-md p-6 text-white">
                <h3 class="text-lg font-bold mb-2">รับข่าวสารจากเรา</h3>
                <p class="text-purple-100 text-sm mb-4">
                    ลงทะเบียนเพื่อรับข่าวสารและโปรโมชั่นพิเศษก่อนใคร
                </p>
                <form>
                    <input type="email" placeholder="อีเมลของคุณ" class="w-full px-4 py-2 mb-2 rounded text-gray-800 focus:outline-none focus:ring-2 focus:ring-purple-300">
                    <button type="submit" class="w-full bg-white text-purple-600 font-medium py-2 rounded hover:bg-gray-100 transition duration-300">
                        สมัครรับข่าวสาร
                    </button>
                </form>
            </div>
            
            <!-- Tags -->
            <div class="bg-white rounded-lg shadow-md p-6 mt-8">
                <h3 class="text-lg font-bold text-gray-800 mb-4">แท็ก</h3>
                <div class="flex flex-wrap gap-2">
                    <a href="#" class="px-3 py-1 bg-gray-100 text-gray-700 text-sm rounded-full hover:bg-purple-100 hover:text-purple-700">
                        รีวิวสินค้า
                    </a>
                    <a href="#" class="px-3 py-1 bg-gray-100 text-gray-700 text-sm rounded-full hover:bg-purple-100 hover:text-purple-700">
                        แฟชั่น
                    </a>
                    <a href="#" class="px-3 py-1 bg-gray-100 text-gray-700 text-sm rounded-full hover:bg-purple-100 hover:text-purple-700">
                        เทคโนโลยี
                    </a>
                    <a href="#" class="px-3 py-1 bg-gray-100 text-gray-700 text-sm rounded-full hover:bg-purple-100 hover:text-purple-700">
                        สมาร์ทโฟน
                    </a>
                    <a href="#" class="px-3 py-1 bg-gray-100 text-gray-700 text-sm rounded-full hover:bg-purple-100 hover:text-purple-700">
                        ไลฟ์สไตล์
                    </a>
                    <a href="#" class="px-3 py-1 bg-gray-100 text-gray-700 text-sm rounded-full hover:bg-purple-100 hover:text-purple-700">
                        ความงาม
                    </a>
                </div>
            </div>
        </aside>
    </div>
@endsection