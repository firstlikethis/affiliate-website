@extends('layouts.admin')

@section('title', 'แก้ไขหมวดหมู่')

@section('page-title', 'แก้ไขหมวดหมู่')

@section('content')
<div class="bg-white rounded-lg shadow-sm overflow-hidden">
    <form action="{{ route('admin.categories.update', $category) }}" method="POST" class="p-6">
        @csrf
        @method('PUT')
        
        <div class="mb-6">
            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">ชื่อหมวดหมู่ <span class="text-red-500">*</span></label>
            <input type="text" name="name" id="name" value="{{ old('name', $category->name) }}" required
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-200">
            @error('name')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>
        
        <div class="mb-6">
            <label for="description" class="block text-sm font-medium text-gray-700 mb-2">คำอธิบาย</label>
            <textarea name="description" id="description" rows="3"
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-200">{{ old('description', $category->description) }}</textarea>
            @error('description')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>
        
        <div class="mb-6 border-t border-gray-200 pt-4">
            <h3 class="text-lg font-medium text-gray-700 mb-4">ข้อมูล SEO</h3>
            
            <div class="mb-4">
                <label for="meta_title" class="block text-sm font-medium text-gray-700 mb-2">Meta Title</label>
                <input type="text" name="meta_title" id="meta_title" value="{{ old('meta_title', $category->meta_title) }}"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-200">
                <p class="mt-1 text-xs text-gray-500">ถ้าเว้นว่าง ระบบจะใช้ชื่อหมวดหมู่แทน (แนะนำไม่เกิน 70 ตัวอักษร)</p>
                @error('meta_title')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-4">
                <label for="meta_description" class="block text-sm font-medium text-gray-700 mb-2">Meta Description</label>
                <textarea name="meta_description" id="meta_description" rows="2"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-200">{{ old('meta_description', $category->meta_description) }}</textarea>
                <p class="mt-1 text-xs text-gray-500">ถ้าเว้นว่าง ระบบจะใช้คำอธิบายแทน (แนะนำไม่เกิน 160 ตัวอักษร)</p>
                @error('meta_description')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>
        </div>
        
        <div class="mb-6 border-t border-gray-200 pt-4">
            <h3 class="text-lg font-medium text-gray-700 mb-4">ข้อมูลอื่นๆ</h3>
            
            <div class="mb-4">
                <p class="text-sm text-gray-700 mb-2">สร้างเมื่อ: {{ $category->created_at->format('d/m/Y H:i') }}</p>
                <p class="text-sm text-gray-700 mb-2">แก้ไขล่าสุด: {{ $category->updated_at->format('d/m/Y H:i') }}</p>
                <p class="text-sm text-gray-700 mb-2">URL: <a href="{{ route('category.show', ['category' => $category]) }}" target="_blank" class="text-blue-500 hover:underline">{{ route('category.show', ['category' => $category]) }}</a></p>
            </div>
        </div>
        
        <div class="flex justify-end space-x-3">
            <a href="{{ route('admin.categories.index') }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-200 rounded-md hover:bg-gray-300">
                ยกเลิก
            </a>
            <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-blue-500 rounded-md hover:bg-blue-600">
                บันทึกข้อมูล
            </button>
        </div>
    </form>
</div>
@endsection