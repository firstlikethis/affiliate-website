<!-- resources/views/admin/articles/index.blade.php -->
@extends('layouts.admin')

@section('title', 'จัดการบทความ')

@section('page-title', 'จัดการบทความ')

@section('content')
<div class="bg-white rounded-lg shadow-sm overflow-hidden">
    <div class="p-6 flex justify-between items-center border-b">
        <h2 class="text-xl font-semibold text-gray-800">บทความทั้งหมด</h2>
        <a href="{{ route('admin.articles.create') }}" class="bg-purple-500 hover:bg-purple-600 text-white px-4 py-2 rounded-md text-sm font-medium">
            <i class="fas fa-plus mr-2"></i>เพิ่มบทความ
        </a>
    </div>
    
    <div class="overflow-x-auto">
        @if(count($articles) > 0)
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">รูปภาพ</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">หัวข้อบทความ</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">แท็ก</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">วันที่สร้าง</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">สินค้า/ยอดเข้าชม</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">จัดการ</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($articles as $article)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($article->thumbnail)
                                    <img src="{{ asset('storage/' . $article->thumbnail) }}" alt="{{ $article->title }}" class="h-12 w-16 object-cover rounded">
                                @else
                                    <div class="h-12 w-16 bg-gray-200 flex items-center justify-center rounded">
                                        <i class="fas fa-image text-gray-400"></i>
                                    </div>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $article->title }}</div>
                                <div class="text-xs text-gray-500">{{ $article->slug }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex flex-wrap gap-1">
                                    @forelse($article->tags as $tag)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                            {{ $tag->name }}
                                        </span>
                                    @empty
                                        <span class="text-xs text-gray-500">ไม่มีแท็ก</span>
                                    @endforelse
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $article->created_at->format('d/m/Y') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <div class="flex items-center mb-1">
                                    <i class="fas fa-box text-gray-400 mr-1"></i>
                                    <span>{{ $article->products->count() }} รายการ</span>
                                </div>
                                <div class="flex items-center">
                                    <i class="far fa-eye text-gray-400 mr-1"></i>
                                    <span>{{ number_format($article->views) }} ครั้ง</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="{{ route('article.show', $article->slug) }}" target="_blank" class="text-blue-600 hover:text-blue-900 mr-3">
                                    <i class="fas fa-eye"></i> ดู
                                </a>
                                
                                <a href="{{ route('admin.articles.edit', $article) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">
                                    <i class="fas fa-edit"></i> แก้ไข
                                </a>
                                
                                <form action="{{ route('admin.articles.destroy', $article) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('คุณแน่ใจหรือไม่ที่จะลบบทความนี้?')">
                                        <i class="fas fa-trash"></i> ลบ
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            
            <!-- Pagination -->
            <div class="px-6 py-4">
                {{ $articles->links() }}
            </div>
        @else
            <div class="p-6 text-center">
                <p class="text-gray-500">ยังไม่มีข้อมูลบทความ</p>
                <a href="{{ route('admin.articles.create') }}" class="mt-2 inline-flex items-center text-sm text-purple-500 hover:text-purple-700">
                    <i class="fas fa-plus mr-1"></i> เพิ่มบทความใหม่
                </a>
            </div>
        @endif
    </div>
</div>
@endsection