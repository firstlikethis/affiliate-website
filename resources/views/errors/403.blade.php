@extends('layouts.app')

@section('head')
    <title>403 ไม่ได้รับอนุญาต - {{ config('app.name') }}</title>
    <meta name="robots" content="noindex, follow">
@endsection

@section('content')
<div class="flex items-center justify-center min-h-[60vh] py-16">
    <div class="text-center px-6">
        <div class="mb-8">
            <img src="{{ asset('images/403-illustration.svg') }}" alt="Access denied" class="h-64 mx-auto">
        </div>
        <h1 class="text-5xl font-bold text-gray-800 mb-4">403</h1>
        <h2 class="text-2xl font-medium text-gray-700 mb-6">ขออภัย คุณไม่มีสิทธิ์เข้าถึงหน้านี้</h2>
        <p class="text-gray-600 max-w-md mx-auto mb-8">
            คุณไม่ได้รับอนุญาตให้เข้าถึงหน้านี้ หากคุณเชื่อว่านี่เป็นข้อผิดพลาด โปรดติดต่อเรา
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('home') }}" class="btn-primary">
                <i class="fas fa-home mr-2"></i> กลับไปหน้าแรก
            </a>
            <a href="#" onclick="history.back(); return false;" class="btn-secondary">
                <i class="fas fa-arrow-left mr-2"></i> กลับไปหน้าก่อนหน้า
            </a>
        </div>
    </div>
</div>

<!-- Suggested Products -->
<section class="container mx-auto px-4 mt-12 mb-16">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">สินค้าที่อาจสนใจ</h2>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
        @foreach(\App\Models\Product::where('is_featured', true)->take(4)->get() as $product)
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover-up">
                <div class="relative">
                    <a href="{{ $product->affiliate_link }}" target="_blank" rel="nofollow noopener">
                        <img class="w-full h-48 object-cover" src="{{ $product->image_url }}" alt="{{ $product->name }}">
                    </a>
                </div>
                <div class="p-4">
                    <a href="{{ $product->affiliate_link }}" target="_blank" rel="nofollow noopener" class="block">
                        <h3 class="text-lg font-medium text-gray-800 mb-2 line-clamp-2 h-14">{{ $product->name }}</h3>
                        <div class="flex justify-between items-center">
                            <span class="text-purple-600 font-bold">{{ number_format($product->price, 2) }} บาท</span>
                        </div>
                    </a>
                    <a href="{{ $product->affiliate_link }}" target="_blank" rel="nofollow noopener" class="btn-buy w-full mt-4">
                        <i class="fas fa-shopping-cart"></i> ซื้อเลย
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</section>
@endsection