@props(['article'])

<div {{ $attributes->merge(['class' => 'bg-white rounded-lg shadow-sm overflow-hidden hover-up article-card']) }}>
    <a href="{{ route('article.show', $article->slug) }}" class="block relative">
        <div class="article-image">
            <img class="lazy" data-src="{{ $article->thumbnail_url }}" alt="{{ $article->title }}" src="{{ asset('images/placeholder.jpg') }}">
        </div>
    </a>
    <div class="p-4">
        <div class="flex items-center text-gray-500 text-sm mb-3">
            <span class="flex items-center">
                <i class="far fa-calendar-alt mr-1"></i>
                {{ $article->formatted_created_at }}
            </span>
        </div>
        <a href="{{ route('article.show', $article->slug) }}">
            <h3 class="text-lg font-medium text-gray-800 mb-2 hover:text-slate-700 transition">{{ $article->title }}</h3>
        </a>
        <p class="text-gray-600 mb-4 line-clamp-3">
            {{ \Illuminate\Support\Str::limit(strip_tags($article->content), 150) }}
        </p>
        
        @if(isset($actions))
            {{ $actions }}
        @else
            <a href="{{ route('article.show', $article->slug) }}" class="text-slate-700 font-medium hover:text-slate-900 inline-flex items-center">
                อ่านเพิ่มเติม <i class="fas fa-arrow-right ml-1"></i>
            </a>
        @endif
    </div>
</div>