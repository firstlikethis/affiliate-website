@extends('layouts.admin')

@section('title', 'แผงควบคุม')

@section('page-title', 'แผงควบคุม')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <!-- Categories Stats -->
    <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-blue-100 text-blue-500">
                <i class="fas fa-folder text-xl"></i>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-500">หมวดหมู่ทั้งหมด</p>
                <p class="text-2xl font-semibold text-gray-800">{{ $totalCategories }}</p>
            </div>
        </div>
        <div class="mt-4">
            <a href="{{ route('admin.categories.index') }}" class="text-sm text-blue-500 hover:text-blue-700">
                ดูทั้งหมด <i class="fas fa-arrow-right ml-1"></i>
            </a>
        </div>
    </div>
    
    <!-- Products Stats -->
    <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-green-100 text-green-500">
                <i class="fas fa-box text-xl"></i>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-500">สินค้าทั้งหมด</p>
                <p class="text-2xl font-semibold text-gray-800">{{ $totalProducts }}</p>
            </div>
        </div>
        <div class="mt-4">
            <a href="{{ route('admin.products.index') }}" class="text-sm text-green-500 hover:text-green-700">
                ดูทั้งหมด <i class="fas fa-arrow-right ml-1"></i>
            </a>
        </div>
    </div>
    
    <!-- Articles Stats -->
    <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-purple-100 text-purple-500">
                <i class="fas fa-newspaper text-xl"></i>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-500">บทความทั้งหมด</p>
                <p class="text-2xl font-semibold text-gray-800">{{ $totalArticles }}</p>
            </div>
        </div>
        <div class="mt-4">
            <a href="{{ route('admin.articles.index') }}" class="text-sm text-purple-500 hover:text-purple-700">
                ดูทั้งหมด <i class="fas fa-arrow-right ml-1"></i>
            </a>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
    <!-- Latest Products -->
    <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-semibold text-gray-800">สินค้าล่าสุด</h2>
            <a href="{{ route('admin.products.create') }}" class="text-sm text-green-500 hover:text-green-700">
                <i class="fas fa-plus mr-1"></i> เพิ่มสินค้า
            </a>
        </div>
        
        @if(count($latestProducts) > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">รูปภาพ</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ชื่อสินค้า</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ราคา</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">จัดการ</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($latestProducts as $product)
                            <tr>
                                <td class="px-4 py-2 whitespace-nowrap">
                                    <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}" class="h-10 w-10 rounded object-cover">
                                </td>
                                <td class="px-4 py-2 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $product->name }}</div>
                                    <div class="text-xs text-gray-500">{{ $product->category->name }}</div>
                                </td>
                                <td class="px-4 py-2 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ number_format($product->price, 2) }} บาท</div>
                                </td>
                                <td class="px-4 py-2 whitespace-nowrap text-sm">
                                    <a href="{{ route('admin.products.edit', $product) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="bg-gray-50 p-4 rounded text-center">
                <p class="text-gray-500">ยังไม่มีสินค้า</p>
            </div>
        @endif
    </div>
    
    <!-- Latest Articles -->
    <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-semibold text-gray-800">บทความล่าสุด</h2>
            <a href="{{ route('admin.articles.create') }}" class="text-sm text-purple-500 hover:text-purple-700">
                <i class="fas fa-plus mr-1"></i> เพิ่มบทความ
            </a>
        </div>
        
        @if(count($latestArticles) > 0)
            <div class="space-y-4">
                @foreach($latestArticles as $article)
                    <div class="flex items-start">
                        @if($article->thumbnail)
                            <img src="{{ asset('storage/' . $article->thumbnail) }}" alt="{{ $article->title }}" class="h-12 w-12 rounded object-cover">
                        @else
                            <div class="h-12 w-12 rounded bg-gray-200 flex items-center justify-center">
                                <i class="fas fa-newspaper text-gray-400"></i>
                            </div>
                        @endif
                        <div class="ml-4">
                            <h3 class="text-sm font-medium text-gray-900">{{ $article->title }}</h3>
                            <p class="text-xs text-gray-500">{{ $article->created_at->format('d M Y') }}</p>
                            <div class="mt-1">
                                <a href="{{ route('admin.articles.edit', $article) }}" class="text-xs text-indigo-600 hover:text-indigo-900">
                                    <i class="fas fa-edit mr-1"></i> แก้ไข
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="bg-gray-50 p-4 rounded text-center">
                <p class="text-gray-500">ยังไม่มีบทความ</p>
            </div>
        @endif
    </div>
</div>

<div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200 mt-6">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-lg font-semibold text-gray-800">ลิงค์ที่เป็นประโยชน์</h2>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <a href="{{ route('home') }}" target="_blank" class="block p-4 bg-blue-50 rounded-lg hover:bg-blue-100 transition-300">
            <div class="flex items-center">
                <div class="p-2 rounded-full bg-blue-100">
                    <i class="fas fa-home text-blue-500"></i>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-gray-900">หน้าแรกเว็บไซต์</p>
                    <p class="text-xs text-gray-500">เยี่ยมชมหน้าแรกของเว็บไซต์</p>
                </div>
            </div>
        </a>
        
        <a href="{{ route('admin.products.create') }}" class="block p-4 bg-green-50 rounded-lg hover:bg-green-100 transition-300">
            <div class="flex items-center">
                <div class="p-2 rounded-full bg-green-100">
                    <i class="fas fa-plus text-green-500"></i>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-gray-900">เพิ่มสินค้า</p>
                    <p class="text-xs text-gray-500">เพิ่มสินค้าใหม่เข้าสู่ระบบ</p>
                </div>
            </div>
        </a>
        
        <a href="{{ route('admin.articles.create') }}" class="block p-4 bg-purple-50 rounded-lg hover:bg-purple-100 transition-300">
            <div class="flex items-center">
                <div class="p-2 rounded-full bg-purple-100">
                    <i class="fas fa-edit text-purple-500"></i>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-gray-900">เขียนบทความ</p>
                    <p class="text-xs text-gray-500">เขียนบทความ SEO ใหม่</p>
                </div>
            </div>
        </a>
    </div>
</div>
@endsection