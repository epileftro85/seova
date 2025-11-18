@extends('layouts.app')

@section('title', 'Blog - Seova SEO Articles & Resources')
@section('description', 'Read our latest blog posts about SEO strategies, technical SEO tips, keyword research, and content optimization for small businesses.')
@section('keywords', 'SEO blog, SEO articles, SEO guides, search engine optimization tips, SEO tutorial')

@section('og_title', 'Blog - Seova SEO Articles & Resources')
@section('og_description', 'Discover SEO strategies and tips from Seova SEO experts.')

@section('json-ld')
<script type="application/ld+json">@json($structuredData, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE)</script>
@endsection

@section('hero')
<!-- Hero Section -->
<section class="bg-white relative" aria-labelledby="blog-hero">
    <div class="max-w-7xl mx-auto px-6 py-20 text-center">
        <h1 id="blog-hero" class="text-5xl font-bold text-gray-900 mb-4">SEO Blog & Resources</h1>
        <p class="text-lg text-gray-600 mb-6">Expert insights on SEO strategy, technical implementation, and data-driven growth for small businesses.</p>
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
<!-- Blog Posts Grid -->
<section class="bg-gray-50 py-16 px-6">
    <div class="max-w-6xl mx-auto">
        @if($posts->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($posts as $post)
                    <article class="bg-white rounded-lg shadow hover:shadow-lg transition overflow-hidden">
                        @if($post->featured_image)
                            <picture>
                                <source srcset="{{ \App\Helpers\ImageHelper::webpUrl($post->featured_image) }}" type="image/webp">
                                <img src="{{ \App\Helpers\ImageHelper::jpgUrl($post->featured_image) }}" alt="{{ $post->title }}" class="w-full h-48 object-cover" loading="lazy">
                            </picture>
                        @else
                            <div class="w-full h-48 bg-gradient-to-br from-seova-orange to-seova-green flex items-center justify-center">
                                <span class="text-white text-sm font-semibold">Featured Image</span>
                            </div>
                        @endif

                        <div class="p-6">
                            <div class="flex items-center gap-2 mb-3">
                                <time datetime="{{ $post->published_at->format('Y-m-d') }}" class="text-sm text-gray-500">
                                    {{ $post->published_at->format('M d, Y') }}
                                </time>
                                <span class="text-gray-300">•</span>
                                <span class="text-sm text-gray-500">{{ ceil(str_word_count($post->content) / 200) }} min read</span>
                            </div>

                            <h3 class="text-xl font-semibold text-gray-900 mb-3 hover:text-seova-orange transition">
                                <a href="{{ route('posts.show', $post->slug) }}">{{ $post->title }}</a>
                            </h3>

                            <p class="text-gray-600 mb-4 line-clamp-2">{{ $post->excerpt ?: substr(strip_tags($post->content), 0, 150) . '...' }}</p>

                            <a href="{{ route('posts.show', $post->slug) }}" class="inline-flex items-center text-seova-orange hover:text-seova-orange/80 font-semibold transition">
                                Read More
                                <svg class="w-4 h-4 ml-2" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M5 12h14M12 5l7 7-7 7"/>
                                </svg>
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>

            <!-- Pagination -->
            @if($posts->hasPages())
                <div class="mt-12">
                    {{ $posts->links() }}
                </div>
            @endif
        @else
            <div class="text-center py-12">
                <p class="text-lg text-gray-600">No posts available yet. Check back soon!</p>
            </div>
        @endif
    </div>
</section>

@include('partials.quote-form')

@endsection
