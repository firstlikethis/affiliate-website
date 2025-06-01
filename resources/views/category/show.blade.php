@extends('layouts.app')

@section('content')
    <!-- Category Header -->
    <section class="bg-gradient-to-r from-slate-800 to-slate-700 rounded-lg overflow-hidden">
        <div class="container mx-auto px-6 py-12">
            <div class="text-center">
                <h1 class="text-3xl md:text-4xl font-bold text-white mb-4">{{ $category->name }}</h1>
                @if($category->description)
                    <p class="text-lg text-gray-200 max-w-2xl mx-auto">
                        {{ $category->description }}
                    </p>
                @endif
            </div>
        </div>
    </section>

    <!-- Breadcrumbs -->
    <section class="container mx-auto px-4 py-4">
        <div class="flex items-center text-sm text-gray-600">
            <a href="{{ route('home') }}" class="hover:text-slate-800">หน้าแรก</a>
            <span class="mx-2">/</span>
            <span class="text-gray-900 font-medium">{{ $category->name }}</span>
        </div>
    </section>

    <!-- Products Section -->
    <section class="container mx-auto px-4 mt-8">
        <!-- Filter and Sort Options -->
        <div class="bg-white p-4 rounded-lg shadow-sm mb-6 flex flex-col sm:flex-row justify-between items-center">
            <p class="text-gray-600 mb-3 sm:mb-0">
                แสดง <span class="font-medium text-gray-900">{{ count($products) }}</span> รายการ
            </p>
            <div class="flex items-center gap-4">
                <div class="relative">
                    <select class="appearance-none bg-gray-100 border border-gray-300 text-gray-700 py-2 px-4 pr-8 rounded focus:outline-none focus:ring-2 focus:ring-slate-600">
                        <option>เรียงตามราคา: ต่ำ - สูง</option>
                        <option>เรียงตามราคา: สูง - ต่ำ</option>
                        <option>เรียงตามความนิยม</option>
                        <option>เรียงตามล่าสุด</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                        <i class="fas fa-chevron-down text-xs"></i>
                    </div>
                </div>
                <div class="flex gap-2">
                    <button class="bg-gray-100 border border-gray-300 p-2 rounded hover:bg-gray-200">
                        <i class="fas fa-th-large text-gray-600"></i>
                    </button>
                    <button class="bg-gray-100 border border-gray-300 p-2 rounded hover:bg-gray-200">
                        <i class="fas fa-list text-gray-600"></i>
                    </button>
                </div>
            </div>
        </div>

        @if(count($products) > 0)
            <!-- Products Grid -->
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach($products as $product)
                    <x-product-card :product="$product" />
                @endforeach
            </div>
        @else
            <!-- No Products Found -->
            <div class="bg-white rounded-lg shadow-md p-8 text-center">
                <div class="text-gray-400 mb-4">
                    <i class="fas fa-box-open text-5xl"></i>
                </div>
                <h3 class="text-xl font-medium text-gray-700 mb-2">ไม่พบสินค้าในหมวดหมู่นี้</h3>
                <p class="text-gray-500 mb-4">
                    ขออภัย ขณะนี้ยังไม่มีสินค้าในหมวดหมู่ {{ $category->name }} กรุณาเลือกดูหมวดหมู่อื่น หรือกลับมาใหม่ในภายหลัง
                </p>
                <a href="{{ route('home') }}" class="btn-primary inline-block">
                    <i class="fas fa-home mr-2"></i> กลับไปหน้าแรก
                </a>
            </div>
        @endif

        <!-- Pagination -->
        @if(count($products) > 20)
            <div class="mt-10 flex justify-center">
                <nav class="inline-flex rounded-md shadow">
                    <a href="#" class="py-2 px-4 bg-white border border-gray-300 rounded-l-md text-gray-700 hover:bg-gray-100">
                        <i class="fas fa-chevron-left"></i>
                    </a>
                    <a href="#" class="py-2 px-4 bg-slate-700 border border-slate-700 text-white">1</a>
                    <a href="#" class="py-2 px-4 bg-white border border-gray-300 text-gray-700 hover:bg-gray-100">2</a>
                    <a href="#" class="py-2 px-4 bg-white border border-gray-300 text-gray-700 hover:bg-gray-100">3</a>
                    <span class="py-2 px-4 bg-white border border-gray-300 text-gray-700">...</span>
                    <a href="#" class="py-2 px-4 bg-white border border-gray-300 text-gray-700 hover:bg-gray-100">8</a>
                    <a href="#" class="py-2 px-4 bg-white border border-gray-300 rounded-r-md text-gray-700 hover:bg-gray-100">
                        <i class="fas fa-chevron-right"></i>
                    </a>
                </nav>
            </div>
        @endif
    </section>

    <!-- Category Description -->
    @if($category->description)
        <section class="container mx-auto px-4 mt-16">
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">เกี่ยวกับ {{ $category->name }}</h2>
                <div class="prose max-w-none text-gray-600">
                    <p>{{ $category->description }}</p>
                    <p class="mt-4">
                        ที่ {{ config('app.name') }} เรารวบรวมสินค้า{{ $category->name }}คุณภาพดีจากแบรนด์ชั้นนำทั่วโลก
                        ทุกชิ้นผ่านการคัดสรรมาอย่างดีเพื่อให้คุณมั่นใจในคุณภาพ
                        นอกจากนี้ เรายังมีโปรโมชั่นพิเศษเป็นประจำ ติดตามได้ที่เว็บไซต์ของเรา
                    </p>
                </div>
            </div>
        </section>
    @endif

    <!-- Related Categories -->
    <section class="container mx-auto px-4 mt-16">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">หมวดหมู่ที่เกี่ยวข้อง</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
            @foreach($categories->where('id', '!=', $category->id)->take(6) as $relatedCategory)
                <a href="{{ route('category.show', $relatedCategory->slug) }}" class="category-card">
                    <div class="category-icon">
                        <i class="fas fa-{{ $loop->index == 0 ? 'tshirt' : ($loop->index == 1 ? 'mobile-alt' : ($loop->index == 2 ? 'shoe-prints' : ($loop->index == 3 ? 'gem' : 'box'))) }}"></i>
                    </div>
                    <h3 class="text-gray-800 font-medium">{{ $relatedCategory->name }}</h3>
                </a>
            @endforeach
        </div>
    </section>

    <!-- Call to Action -->
    <section class="mt-16">
        <div class="container mx-auto px-4">
            <div class="bg-gray-100 rounded-lg p-8 text-center">
                <h2 class="text-2xl font-bold text-gray-800 mb-2">ไม่พบสิ่งที่คุณกำลังมองหา?</h2>
                <p class="text-gray-600 mb-6 max-w-xl mx-auto">
                    ลองเยี่ยมชมหมวดหมู่อื่น ๆ หรือดูบทความรีวิวสินค้าของเราเพื่อค้นพบสินค้าที่เหมาะกับคุณ
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('home') }}" class="btn-primary">
                        <i class="fas fa-home mr-2"></i> ไปที่หน้าแรก
                    </a>
                    <a href="{{ route('home') }}#latest-articles" class="btn-secondary">
                        <i class="fas fa-newspaper mr-2"></i> อ่านบทความล่าสุด
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection