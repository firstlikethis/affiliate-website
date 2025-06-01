@props(['article'])

<div {{ $attributes->merge(['class' => 'bg-white rounded-lg shadow-md overflow-hidden hover-up article-card']) }}>
    <a href="{{ route('article.show', $article->slug) }}" class="block relative">
        <img class="w-full h-56 object-cover lazy" data-src="{{ $article->thumbnail_url }}" alt="{{ $article->title }}" src="{{ asset('images/placeholder.jpg') }}">
        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent"></div>
        <div class="absolute bottom-0 left-0 p-4">
            <span class="bg-purple-600 text-white text-xs font-medium px-2 py-1 rounded">บทความ</span>
            <h3 class="text-xl font-semibold text-white mt-2">{{ $article->title }}</h3>
        </div>
    </a>
    <div class="p-4">
        <div class="flex items-center text-gray-500 text-sm mb-3">
            <span class="flex items-center">
                <i class="far fa-calendar-alt mr-1"></i>
                {{ $article->formatted_created_at }}
            </span>
        </div>
        <p class="text-gray-600 mb-4 line-clamp-3">
            {{ \Illuminate\Support\Str::limit(strip_tags($article->content), 150) }}
        </p>
        
        @if(isset($actions))
            {{ $actions }}
        @else
            <a href="{{ route('article.show', $article->slug) }}" class="text-purple-600 font-medium hover:text-purple-800 inline-flex items-center">
                อ่านเพิ่มเติม <i class="fas fa-arrow-right ml-1"></i>
            </a>
        @endif
    </div>
</div>