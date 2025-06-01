@extends('layouts.admin')

@section('title', 'แก้ไขสินค้า')

@section('page-title', 'แก้ไขสินค้า')

@section('content')
<div class="bg-white rounded-lg shadow-sm overflow-hidden">
    <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data" class="p-6">
        @csrf
        @method('PUT')
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <div class="mb-6">
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">ชื่อสินค้า <span class="text-red-500">*</span></label>
                    <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-200">
                    @error('name')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="mb-6">
                    <label for="category_id" class="block text-sm font-medium text-gray-700 mb-2">หมวดหมู่ <span class="text-red-500">*</span></label>
                    <select name="category_id" id="category_id" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-200">
                        <option value="">-- เลือกหมวดหมู่ --</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="mb-6">
                    <label for="price" class="block text-sm font-medium text-gray-700 mb-2">ราคา (บาท) <span class="text-red-500">*</span></label>
                    <input type="number" step="0.01" min="0" name="price" id="price" value="{{ old('price', $product->price) }}" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-200">
                    @error('price')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="mb-6">
                    <label for="affiliate_link" class="block text-sm font-medium text-gray-700 mb-2">ลิงก์ Affiliate <span class="text-red-500">*</span></label>
                    <input type="url" name="affiliate_link" id="affiliate_link" value="{{ old('affiliate_link', $product->affiliate_link) }}" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-200">
                    <p class="mt-1 text-xs text-gray-500">ลิงก์ Affiliate ที่จะพาไปยังหน้าสินค้าบน Lazada หรือ Shopee</p>
                    @error('affiliate_link')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="mb-6">
                    <label for="is_featured" class="flex items-center">
                        <input type="checkbox" name="is_featured" id="is_featured" value="1" {{ old('is_featured', $product->is_featured) ? 'checked' : '' }}
                            class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                        <span class="ml-2 text-sm text-gray-700">แนะนำสินค้านี้ (แสดงในหน้าแรก)</span>
                    </label>
                </div>
            </div>
            
            <div>
                <div class="mb-6">
                    <label for="image" class="block text-sm font-medium text-gray-700 mb-2">รูปภาพสินค้า</label>
                    <input type="file" name="image" id="image" accept="image/*"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-200"
                        onchange="previewImage(this, 'imagePreview')">
                    <p class="mt-1 text-xs text-gray-500">รูปภาพควรมีขนาดไม่เกิน 2MB และเป็นไฟล์ประเภท JPEG, PNG, GIF, หรือ WEBP (เว้นว่างไว้หากไม่ต้องการเปลี่ยนรูปภาพ)</p>
                    @error('image')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                    
                    <div class="mt-2">
                        <img id="imagePreview" src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}" class="mt-2 max-h-48 rounded">
                    </div>
                </div>
                
                <div class="mb-6 border-t border-gray-200 pt-4">
                    <h3 class="text-lg font-medium text-gray-700 mb-4">ข้อมูล SEO</h3>
                    
                    <div class="mb-4">
                        <label for="meta_title" class="block text-sm font-medium text-gray-700 mb-2">Meta Title</label>
                        <input type="text" name="meta_title" id="meta_title" value="{{ old('meta_title', $product->meta_title) }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-200">
                        <p class="mt-1 text-xs text-gray-500">ถ้าเว้นว่าง ระบบจะใช้ชื่อสินค้าแทน (แนะนำไม่เกิน 70 ตัวอักษร)</p>
                        @error('meta_title')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="mb-4">
                        <label for="meta_description" class="block text-sm font-medium text-gray-700 mb-2">Meta Description</label>
                        <textarea name="meta_description" id="meta_description" rows="2"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-200">{{ old('meta_description', $product->meta_description) }}</textarea>
                        <p class="mt-1 text-xs text-gray-500">ถ้าเว้นว่าง ระบบจะใช้ชื่อสินค้าแทน (แนะนำไม่เกิน 160 ตัวอักษร)</p>
                        @error('meta_description')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                
                <div class="mb-6 border-t border-gray-200 pt-4">
                    <h3 class="text-lg font-medium text-gray-700 mb-4">ข้อมูลอื่นๆ</h3>
                    
                    <div class="mb-4">
                        <p class="text-sm text-gray-700 mb-2">สร้างเมื่อ: {{ $product->created_at->format('d/m/Y H:i') }}</p>
                        <p class="text-sm text-gray-700 mb-2">แก้ไขล่าสุด: {{ $product->updated_at->format('d/m/Y H:i') }}</p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="flex justify-end space-x-3 mt-6 border-t border-gray-200 pt-6">
            <a href="{{ route('admin.products.index') }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-200 rounded-md hover:bg-gray-300">
                ยกเลิก
            </a>
            <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-green-500 rounded-md hover:bg-green-600">
                บันทึกข้อมูล
            </button>
        </div>
    </form>
</div>
@endsection