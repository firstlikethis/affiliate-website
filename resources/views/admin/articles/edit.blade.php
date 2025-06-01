@extends('layouts.admin')

@section('title', 'แก้ไขบทความ')

@section('page-title', 'แก้ไขบทความ')

@section('content')
<div class="bg-white rounded-lg shadow-sm overflow-hidden">
    <form action="{{ route('admin.articles.update', $article) }}" method="POST" enctype="multipart/form-data" class="p-6">
        @csrf
        @method('PUT')
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- คอลัมน์ซ้าย (2/3) -->
            <div class="md:col-span-2">
                <div class="mb-6">
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">หัวข้อบทความ <span class="text-red-500">*</span></label>
                    <input type="text" name="title" id="title" value="{{ old('title', $article->title) }}" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-200">
                    @error('title')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="mb-6">
                    <label for="content" class="block text-sm font-medium text-gray-700 mb-2">เนื้อหาบทความ <span class="text-red-500">*</span></label>
                    <textarea name="content" id="content" class="tinymce-editor">{{ old('content', $article->content) }}</textarea>
                    @error('content')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="mb-6 border-t border-gray-200 pt-4">
                    <h3 class="text-lg font-medium text-gray-700 mb-4">สินค้าที่เกี่ยวข้อง</h3>
                    <p class="text-sm text-gray-500 mb-3">เลือกสินค้าที่ต้องการแสดงในบทความนี้</p>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 mt-3">
                        @foreach($products as $product)
                            <div class="flex items-start space-x-3">
                                <input type="checkbox" name="products[]" id="product_{{ $product->id }}" value="{{ $product->id }}"
                                    {{ in_array($product->id, old('products', $selectedProducts)) ? 'checked' : '' }}
                                    class="mt-1 h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                                <div>
                                    <label for="product_{{ $product->id }}" class="text-sm font-medium text-gray-700">{{ $product->name }}</label>
                                    <p class="text-xs text-gray-500">{{ number_format($product->price, 2) }} บาท</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    
                    @error('products')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            
            <!-- คอลัมน์ขวา (1/3) -->
            <div>
                <div class="mb-6">
                    <label for="thumbnail" class="block text-sm font-medium text-gray-700 mb-2">รูปภาพปก</label>
                    <input type="file" name="thumbnail" id="thumbnail" accept="image/*"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-200"
                        onchange="previewImage(this, 'thumbnailPreview')">
                    <p class="mt-1 text-xs text-gray-500">รูปภาพควรมีขนาดไม่เกิน 2MB และเป็นไฟล์ประเภท JPEG, PNG, GIF, หรือ WEBP (เว้นว่างไว้หากไม่ต้องการเปลี่ยนรูปภาพ)</p>
                    @error('thumbnail')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                    
                    <div class="mt-2">
                        <img id="thumbnailPreview" src="{{ $article->thumbnail ? asset('storage/' . $article->thumbnail) : '#' }}" 
                            alt="{{ $article->title }}" class="{{ $article->thumbnail ? '' : 'hidden' }} mt-2 max-h-48 rounded">
                    </div>
                </div>
                
                <div class="mb-6 border-t border-gray-200 pt-4">
                    <h3 class="text-lg font-medium text-gray-700 mb-4">ข้อมูล SEO</h3>
                    
                    <div class="mb-4">
                        <label for="meta_title" class="block text-sm font-medium text-gray-700 mb-2">Meta Title</label>
                        <input type="text" name="meta_title" id="meta_title" value="{{ old('meta_title', $article->meta_title) }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-200">
                        <p class="mt-1 text-xs text-gray-500">ถ้าเว้นว่าง ระบบจะใช้หัวข้อบทความแทน (แนะนำไม่เกิน 70 ตัวอักษร)</p>
                        @error('meta_title')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="mb-4">
                        <label for="meta_description" class="block text-sm font-medium text-gray-700 mb-2">Meta Description</label>
                        <textarea name="meta_description" id="meta_description" rows="3"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-200">{{ old('meta_description', $article->meta_description) }}</textarea>
                        <p class="mt-1 text-xs text-gray-500">ถ้าเว้นว่าง ระบบจะใช้เนื้อหาส่วนต้นของบทความแทน (แนะนำไม่เกิน 160 ตัวอักษร)</p>
                        @error('meta_description')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                
                <div class="mb-6 border-t border-gray-200 pt-4">
                    <h3 class="text-lg font-medium text-gray-700 mb-4">ข้อมูลอื่นๆ</h3>
                    
                    <div class="mb-4">
                        <p class="text-sm text-gray-700 mb-2">Slug: <span class="text-blue-500">{{ $article->slug }}</span></p>
                        <p class="text-sm text-gray-700 mb-2">สร้างเมื่อ: {{ $article->created_at->format('d/m/Y H:i') }}</p>
                        <p class="text-sm text-gray-700 mb-2">แก้ไขล่าสุด: {{ $article->updated_at->format('d/m/Y H:i') }}</p>
                        <p class="text-sm text-gray-700 mb-2">URL: <a href="{{ route('article.show', $article->slug) }}" target="_blank" class="text-blue-500 hover:underline">{{ route('article.show', $article->slug) }}</a></p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="flex justify-end space-x-3 mt-6 border-t border-gray-200 pt-6">
            <a href="{{ route('admin.articles.index') }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-200 rounded-md hover:bg-gray-300">
                ยกเลิก
            </a>
            <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-purple-500 rounded-md hover:bg-purple-600">
                บันทึกข้อมูล
            </button>
        </div>
    </form>
</div>
@endsection