@props(['product', 'featured' => false])

<div {{ $attributes->merge(['class' => 'bg-white rounded-lg shadow-sm overflow-hidden hover-up product-card']) }}>
    <div class="relative">
        <a href="{{ $product->affiliate_link }}" target="_blank" rel="nofollow noopener">
            <img class="w-full h-48 object-cover lazy" data-src="{{ $product->image_url }}" alt="{{ $product->name }}" src="{{ asset('images/placeholder.jpg') }}">
            @if($product->is_featured || $featured)
                <div class="absolute top-0 right-0 bg-slate-700 text-white text-xs font-bold px-2 py-1 m-2 rounded">แนะนำ</div>
            @endif
            
            @if(isset($badge))
                <div class="absolute top-0 left-0 bg-slate-700 text-white text-xs font-bold px-2 py-1 m-2 rounded">
                    {{ $badge }}
                </div>
            @endif
        </a>
    </div>
    <div class="p-4">
        <a href="{{ $product->affiliate_link }}" target="_blank" rel="nofollow noopener" class="block">
            <h3 class="text-lg font-medium text-gray-800 mb-2 line-clamp-2 h-14 product-title">{{ $product->name }}</h3>
            <p class="text-gray-500 text-sm mb-2">{{ $product->category->name }}</p>
            <div class="flex justify-between items-center">
                <span class="text-slate-700 font-bold product-price">{{ number_format($product->price, 2) }} บาท</span>
            </div>
        </a>
        
        @if(isset($actions))
            {{ $actions }}
        @else
            <a href="{{ $product->affiliate_link }}" target="_blank" rel="nofollow noopener" class="btn-detail w-full mt-4">
                <i class="fas fa-eye"></i> ดูเพิ่มเติม
            </a>
        @endif
    </div>
</div>