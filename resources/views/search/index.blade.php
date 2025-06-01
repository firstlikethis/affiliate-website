@extends('layouts.app')

@section('content')
    <!-- Search Header -->
    <section class="bg-purple-600 py-10">
        <div class="container mx-auto px-4">
            <h1 class="text-2xl md:text-3xl font-bold text-white mb-6 text-center">ผลการค้นหาสำหรับ: "{{ $query }}"</h1>
            
            <!-- Search Form -->
            <div class="max-w-2xl mx-auto">
                <form action="{{ route('search') }}" method="GET" class="flex">
                    <input type="text" name="q" value="{{ $query }}" placeholder="ค้นหาสินค้า บทความ..."
                        class="flex-grow px-4 py-3 rounded-l-lg focus:outline-none focus:ring-2 focus:ring-purple-300 border-0">
                    <button type="submit" class="bg-purple-700 hover:bg-purple-800 text-white font-medium px-6 py-3 rounded-r-lg transition duration-300">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
            </div>
        </div>
    </section>

    <!-- Search Results -->
    <section class="container mx-auto px-4 py-8">
        <div class="bg-white rounded-lg shadow-sm p-4 mb-6">
            <p class="text-gray-600">
                พบ <span class="font-medium text-gray-900">{{ $totalResults }}</span> ผลลัพธ์สำหรับคำค้นหา "<span class="font-medium text-purple-600">{{ $query }}</span>"
            </p>
        </div>

        @if($totalResults > 0)
            <!-- Categories -->
            @if(count($categories) > 0)
                <div class="mb-10">
                    <h2 class="text-xl font-bold text-gray-800 mb-4">หมวดหมู่ที่เกี่ยวข้อง</h2>
                    <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-4">
                        @foreach($categories as $category)
                            <a href="{{ route('category.show', $category->slug) }}" class="bg-white rounded-lg shadow-sm p-4 text-center hover-up">
                                <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center text-purple-600 mx-auto mb-3">
                                    <i class="fas fa-folder"></i>
                                </div>
                                <h3 class="text-gray-800 font-medium">{{ $category->name }}</h3>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Products -->
            @if(count($products) > 0)
                <div class="mb-10">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-xl font-bold text-gray-800">สินค้าที่เกี่ยวข้อง</h2>
                        @if(count($products) > 8)
                            <a href="#" class="text-purple-600 hover:text-purple-800 flex items-center text-sm font-medium">
                                ดูทั้งหมด <i class="fas fa-chevron-right ml-1 text-xs"></i>
                            </a>
                        @endif
                    </div>
                    
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                        @foreach($products as $product)
                            <x-product-card :product="$product" />
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Articles -->
            @if(count($articles) > 0)
                <div>
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-xl font-bold text-gray-800">บทความที่เกี่ยวข้อง</h2>
                        @if(count($articles) > 3)
                            <a href="#" class="text-purple-600 hover:text-purple-800 flex items-center text-sm font-medium">
                                ดูทั้งหมด <i class="fas fa-chevron-right ml-1 text-xs"></i>
                            </a>
                        @endif
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($articles as $article)
                            <x-article-card :article="$article" />
                        @endforeach
                    </div>
                </div>
            @endif
        @else
            <!-- No Results -->
            <div class="bg-white rounded-lg shadow-md p-8 text-center">
                <div class="text-gray-400 mb-4">
                    <i class="fas fa-search text-5xl"></i>
                </div>
                <h3 class="text-xl font-medium text-gray-700 mb-2">ไม่พบผลลัพธ์การค้นหา</h3>
                <p class="text-gray-500 mb-6">
                    ขออภัย เราไม่พบผลลัพธ์สำหรับคำค้นหา "{{ $query }}" กรุณาลองใช้คำค้นหาอื่น หรือตรวจสอบการสะกดอีกครั้ง
                </p>
                <div class="max-w-md mx-auto">
                    <h4 class="font-medium text-gray-700 mb-2">คำแนะนำ:</h4>
                    <ul class="text-gray-500 text-left list-disc list-inside mb-6">
                        <li>ตรวจสอบการสะกดคำ</li>
                        <li>ลองใช้คำค้นหาที่มีความหมายเดียวกัน</li>
                        <li>ลองใช้คำค้นหาที่สั้นและเฉพาะเจาะจง</li>
                        <li>ลองเปลี่ยนเป็นภาษาอังกฤษหรือไทย</li>
                    </ul>
                </div>
                <a href="{{ route('home') }}" class="btn-primary inline-block">
                    <i class="fas fa-home mr-2"></i> กลับไปหน้าแรก
                </a>
            </div>
        @endif
    </section>

    <!-- Popular Searches -->
    <section class="container mx-auto px-4 mt-10 mb-16">
        <h2 class="text-xl font-bold text-gray-800 mb-4">คำค้นหายอดนิยม</h2>
        <div class="flex flex-wrap gap-2">
            <a href="{{ route('search', ['q' => 'สมาร์ทโฟน']) }}" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-full hover:bg-purple-100 hover:text-purple-700">
                สมาร์ทโฟน
            </a>
            <a href="{{ route('search', ['q' => 'รองเท้าวิ่ง']) }}" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-full hover:bg-purple-100 hover:text-purple-700">
                รองเท้าวิ่ง
            </a>
            <a href="{{ route('search', ['q' => 'เสื้อผ้าแฟชั่น']) }}" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-full hover:bg-purple-100 hover:text-purple-700">
                เสื้อผ้าแฟชั่น
            </a>
            <a href="{{ route('search', ['q' => 'กระเป๋า']) }}" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-full hover:bg-purple-100 hover:text-purple-700">
                กระเป๋า
            </a>
            <a href="{{ route('search', ['q' => 'ผลิตภัณฑ์บำรุงผิว']) }}" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-full hover:bg-purple-100 hover:text-purple-700">
                ผลิตภัณฑ์บำรุงผิว
            </a>
            <a href="{{ route('search', ['q' => 'หูฟังไร้สาย']) }}" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-full hover:bg-purple-100 hover:text-purple-700">
                หูฟังไร้สาย
            </a>
        </div>
    </section>
@endsection