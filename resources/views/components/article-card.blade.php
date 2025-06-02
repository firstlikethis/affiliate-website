<!-- resources/views/components/article-card.blade.php -->
@props(['article'])

<div {{ $attributes->merge(['class' => 'bg-white rounded-lg shadow-sm overflow-hidden hover-up article-card']) }}>
    <a href="{{ route('article.show', $article->slug) }}" class="block relative">
        <div class="article-image">
            <img class="lazy" data-src="{{ $article->thumbnail_url }}" alt="{{ $article->title }}" src="{{ asset('images/placeholder.jpg') }}">
            
            @if($article->views > 0)
                <div class="absolute top-0 right-0 bg-gray-900/60 text-white text-xs px-2 py-1 rounded-bl-lg m-2 flex items-center">
                    <i class="far fa-eye mr-1"></i> {{ number_format($article->views) }}
                </div>
            @endif
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
            <h3 class="text-lg font-medium text-gray-800 mb-2 hover:text-purple-700 transition">{{ $article->title }}</h3>
        </a>
        <p class="text-gray-600 mb-4 line-clamp-3">
            {{ \Illuminate\Support\Str::limit(strip_tags($article->content), 150) }}
        </p>
        
        @if(isset($actions))
            {{ $actions }}
        @else
            <!-- Tags -->
            @if($article->tags->count() > 0)
                <div class="flex flex-wrap gap-2 mb-4">
                    @foreach($article->tags as $tag)
                        <a href="{{ route('article.tag', $tag->slug) }}" class="px-2 py-1 bg-purple-100 text-purple-700 text-xs rounded-full hover:bg-purple-200">
                            {{ $tag->name }}
                        </a>
                    @endforeach
                </div>
            @endif
            
            <div class="flex justify-between items-center">
                <span class="text-gray-500 text-sm flex items-center">
                    <i class="far fa-eye mr-1"></i> {{ number_format($article->views) }}
                </span>
                <a href="{{ route('article.show', $article->slug) }}" class="text-purple-600 font-medium hover:text-purple-800 inline-flex items-center">
                    อ่านเพิ่มเติม <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
        @endif
    </div>
</div>