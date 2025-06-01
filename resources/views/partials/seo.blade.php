@if(isset($metaTags))
    <!-- Meta Description -->
    <meta name="description" content="{{ $metaTags['description'] ?? config('app.name') . ' - เว็บไซต์รวบรวมสินค้าคุณภาพและบทความรีวิว' }}">
    
    <!-- Canonical URL -->
    <link rel="canonical" href="{{ $metaTags['canonical'] ?? url()->current() }}">
    
    <!-- Open Graph Tags for Social Media -->
    <meta property="og:type" content="{{ $metaTags['og_type'] ?? 'website' }}">
    <meta property="og:title" content="{{ $metaTags['title'] ?? config('app.name') }}">
    <meta property="og:description" content="{{ $metaTags['description'] ?? config('app.name') . ' - เว็บไซต์รวบรวมสินค้าคุณภาพและบทความรีวิว' }}">
    <meta property="og:url" content="{{ $metaTags['canonical'] ?? url()->current() }}">
    <meta property="og:site_name" content="{{ config('app.name') }}">
    @if(isset($metaTags['og_image']))
        <meta property="og:image" content="{{ $metaTags['og_image'] }}">
        <meta property="og:image:width" content="1200">
        <meta property="og:image:height" content="630">
    @endif
    
    <!-- Twitter Card -->
    <meta name="twitter:card" content="{{ $metaTags['twitter_card'] ?? 'summary_large_image' }}">
    <meta name="twitter:title" content="{{ $metaTags['title'] ?? config('app.name') }}">
    <meta name="twitter:description" content="{{ $metaTags['description'] ?? config('app.name') . ' - เว็บไซต์รวบรวมสินค้าคุณภาพและบทความรีวิว' }}">
    @if(isset($metaTags['twitter_image']))
        <meta name="twitter:image" content="{{ $metaTags['twitter_image'] }}">
    @elseif(isset($metaTags['og_image']))
        <meta name="twitter:image" content="{{ $metaTags['og_image'] }}">
    @endif
    
    <!-- Additional SEO Tags -->
    <meta name="robots" content="index, follow">
    <meta name="author" content="{{ config('app.name') }}">
    
    <!-- Schema.org JSON-LD -->
    @if(isset($metaTags['schema_markup']))
        <script type="application/ld+json">
            {!! is_string($metaTags['schema_markup']) ? $metaTags['schema_markup'] : json_encode($metaTags['schema_markup']) !!}
        </script>
    @endif
    
    <!-- Product Schema if applicable -->
    @if(isset($metaTags['product_price']))
        <meta property="product:price:amount" content="{{ $metaTags['product_price'] }}">
        <meta property="product:price:currency" content="{{ $metaTags['product_currency'] ?? 'THB' }}">
    @endif
    
    <!-- Article Schema if applicable -->
    @if(isset($metaTags['article_published_time']))
        <meta property="article:published_time" content="{{ $metaTags['article_published_time'] }}">
    @endif
    
    @if(isset($metaTags['article_modified_time']))
        <meta property="article:modified_time" content="{{ $metaTags['article_modified_time'] }}">
    @endif
@else
    <!-- Default Meta Tags -->
    <meta name="description" content="{{ config('app.name') }} - เว็บไซต์รวบรวมสินค้าคุณภาพและบทความรีวิวที่น่าสนใจ">
    <link rel="canonical" href="{{ url()->current() }}">
    <meta property="og:type" content="website">
    <meta property="og:title" content="{{ config('app.name') }}">
    <meta property="og:description" content="{{ config('app.name') }} - เว็บไซต์รวบรวมสินค้าคุณภาพและบทความรีวิวที่น่าสนใจ">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:site_name" content="{{ config('app.name') }}">
    <meta name="twitter:card" content="summary">
    <meta name="twitter:title" content="{{ config('app.name') }}">
    <meta name="twitter:description" content="{{ config('app.name') }} - เว็บไซต์รวบรวมสินค้าคุณภาพและบทความรีวิวที่น่าสนใจ">
    <meta name="robots" content="index, follow">
    <meta name="author" content="{{ config('app.name') }}">
@endif