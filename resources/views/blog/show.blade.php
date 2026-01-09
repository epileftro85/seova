@extends('layouts.app')

@section('title', $post->seo_title ?? $post->title . ' | Seova Blog')
@section('description', $post->seo_description ?? $post->excerpt ?? substr(strip_tags($post->content), 0, 160))
@section('keywords', $post->seo_keywords ?? '')

@section('og_title', $post->title)
@section('og_description', $post->excerpt ?? substr(strip_tags($post->content), 0, 160))
@section('og_image', $post->featured_image ?? '')

@section('json-ld')
<script type="application/ld+json">@json($structuredData, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE)</script>

@if(config('services.meta.pixel_id'))
<script>
if (window.fbq) {
    // Wait for consent if needed, or fire if already granted/default
    // The main app.blade.php handles revocation state.
    // If revoked, this might not send, which is correct.
    fbq('track', 'ViewContent', {
        content_name: @json($post->title),
        content_category: 'Blog Post',
        content_ids: [@json($post->id)],
        content_type: 'product' // 'product' is standard for content items
    });
}
</script>
@endif
@endsection

@section('hero')
<!-- Hero Section -->
<section class="bg-white relative" aria-labelledby="post-title">
    <div class="max-w-4xl mx-auto px-6 py-16 text-center">
        <a href="{{ route('posts.index') }}" class="inline-block text-seova-orange hover:text-seova-orange/80 mb-4 text-sm font-semibold">
            ← Back to Blog
        </a>

        <h1 id="post-title" class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">{{ $post->title }}</h1>

        <div class="flex flex-col md:flex-row items-center justify-center gap-4 text-gray-600 mb-8">
            <time datetime="{{ $post->published_at->format('Y-m-d') }}" class="text-sm">
                Published {{ $post->published_at->format('F d, Y') }}
            </time>
            <span class="hidden md:inline text-gray-300">•</span>
            <span class="text-sm">{{ ceil(str_word_count($post->content) / 200) }} minute read</span>
            <span class="hidden md:inline text-gray-300">•</span>
            <span class="text-sm">{{ str_word_count($post->content) }} words</span>
        </div>

        @if($post->featured_image)
            <picture>
                <!-- Try WebP first (modern browsers) -->
                <source srcset="{{ \App\Helpers\ImageHelper::webpUrl($post->featured_image) }}" type="image/webp">
                <!-- Fallback to JPEG -->
                <img src="{{ \App\Helpers\ImageHelper::jpgUrl($post->featured_image) }}" alt="{{ $post->title }}" class="w-full max-w-2xl rounded-lg shadow-lg mb-8" loading="lazy">
            </picture>
        @endif
    </div>

    <!-- Decorative Wave Divider -->
    <div class="absolute bottom-0 left-0 w-full overflow-hidden leading-none rotate-180" aria-hidden="true">
        <svg viewBox="0 0 1200 120" preserveAspectRatio="none" class="w-full h-20">
            <path d="M0,0V46.29c47.59,22,103.77,29.05,158,17.26C255.58,45.6,320,0,400,0s144.42,45.6,242,63.55c54.23,11.79,110.41,4.74,158-17.26V0Z" fill="#f9fafb"></path>
        </svg>
    </div>
</section>
@endsection

@section('content')
<!-- Post Content -->
<article class="bg-gray-50 py-16 px-6">
    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-lg shadow-lg p-8 md:p-12 ql-editor prose prose-lg max-w-none">
            {!! $post->content !!}
        </div>

        <!-- Post Meta -->
        <div class="mt-12 bg-white rounded-lg shadow p-6 md:p-8">
            <div class="border-t pt-6 mt-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Key Topics</h3>
                @if($post->seo_keywords)
                    <div class="flex flex-wrap gap-2">
                        @foreach(explode(',', $post->seo_keywords) as $keyword)
                            <span class="inline-block px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-sm">
                                {{ trim($keyword) }}
                            </span>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-600">No keywords specified</p>
                @endif
            </div>
        </div>

        <!-- Navigation -->
        <nav class="mt-12" aria-label="Post navigation">
            <div class="flex flex-col md:flex-row gap-6">
                <a href="{{ route('posts.index') }}" class="flex items-center justify-center md:justify-start gap-2 px-6 py-3 bg-gray-200 text-gray-900 rounded-lg hover:bg-gray-300 transition font-semibold">
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M15 19l-7-7 7-7"/>
                    </svg>
                    Back to Blog
                </a>
                @if(config('app.blog_posts_editable'))
                <a href="{{ route('posts.edit', $post) }}" class="flex items-center justify-center md:justify-start gap-2 px-6 py-3 bg-seova-orange text-white rounded-lg hover:bg-seova-orange/90 transition font-semibold">
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                    </svg>
                    Edit Post
                </a>
                @endif
            </div>
        </nav>

        <!-- FAQs Section -->
        @if(!empty($faqs))
        <div class="mt-12 border-t pt-12">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Frequently Asked Questions</h2>
            <div class="space-y-6">
                @foreach($faqs as $faq)
                <details class="bg-gray-50 p-6 rounded-lg cursor-pointer group">
                    <summary class="font-semibold text-gray-900 text-lg hover:text-seova-orange transition">
                        {{ $faq['question'] }}
                    </summary>
                    <p class="text-gray-600 mt-4 leading-relaxed">
                        {{ $faq['answer'] }}
                    </p>
                </details>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</article>

<!-- Related Resources -->
<section class="bg-white py-16 px-6">
    <div class="max-w-6xl mx-auto">
        <h2 class="text-3xl font-bold text-gray-900 mb-8 text-center">Explore More Resources</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- More Blog Posts -->
            <div class="bg-gray-50 p-6 rounded-lg">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">More Blog Posts</h3>
                <p class="text-gray-600 mb-4">Discover more SEO insights and strategies</p>
                <a href="{{ route('posts.index') }}" class="inline-flex items-center text-seova-orange hover:text-seova-orange/80 font-semibold transition">
                    Read More Articles
                    <svg class="w-4 h-4 ml-2" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M5 12h14M12 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>

            <!-- Free Tools -->
            <div class="bg-gray-50 p-6 rounded-lg">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Free SEO Tools</h3>
                <p class="text-gray-600 mb-4">Try our suite of free SEO tools to improve your site</p>
                <a href="{{ route('tools.index') }}" class="inline-flex items-center text-seova-orange hover:text-seova-orange/80 font-semibold transition">
                    Explore Tools
                    <svg class="w-4 h-4 ml-2" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M5 12h14M12 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</section>

@include('partials.quote-form')

@endsection
