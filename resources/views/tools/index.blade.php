@extends('layouts.app')

@section('title', 'Free SEO Tools | Seova')
@section('description', 'Access free SEO utilities: keyword explorer, meta tag analyzer, site crawler, and SERP preview to optimize your site.')

@section('hero')
<section class="bg-white relative" aria-labelledby="tools-hero-heading">
    <div class="max-w-7xl mx-auto px-6 py-20 text-center">
        <h1 id="tools-hero-heading" class="text-5xl font-bold text-gray-900 mb-4">Free, Fast & Privacy-Friendly SEO Tools</h1>
        <p class="text-lg text-gray-600 mb-6 max-w-3xl mx-auto">A growing toolbox to help you ideate keywords, validate metadata, preview SERPs, and analyze internal structure — no logins, no tracking scripts, no paywalls.</p>
        <a href="#tools-grid" class="inline-block bg-seova-green text-white font-semibold px-6 py-3 rounded-lg hover:bg-seova-green transition focus:outline-none focus:ring-2 focus:ring-seova-green focus:ring-offset-2" aria-label="Skip to the list of free SEO tools">Explore Tools</a>
        <p class="mt-2 text-sm text-gray-500">Updated progressively as we release new prototypes.</p>
    </div>
    <div class="absolute bottom-0 left-0 w-full overflow-hidden leading-none rotate-180" aria-hidden="true">
        <svg viewBox="0 0 1200 120" preserveAspectRatio="none" class="w-full h-16">
            <path d="M0,0V46.29c47.59,22,103.77,29.05,158,17.26C255.58,45.6,320,0,400,0s144.42,45.6,242,63.55c54.23,11.79,110.41,4.74,158-17.26V0Z" fill="#f9fafb" />
        </svg>
    </div>
</section>
@endsection

@section('content')
<section id="tools-grid" class="max-w-5xl mx-auto px-6 py-16" aria-labelledby="tools-landing-heading">
    <h1 id="tools-landing-heading" class="text-4xl font-bold mb-6">Free SEO Tools</h1>
    <p class="text-gray-600 mb-10 max-w-2xl">Explore our early toolkit. Lightweight, fast, and privacy-friendly. More features coming soon.</p>
    <ul class="grid gap-6 md:grid-cols-2">
        {{-- <li class="p-6 rounded-lg bg-white shadow hover:shadow-md transition">
            <h2 class="text-xl font-semibold mb-2"><a href="{{ route('tools.keyword') }}" class="text-seova-orange hover:underline">Keyword Explorer</a></h2>
            <p class="text-sm text-gray-600">Discover and structure keyword ideas (prototype).</p>
        </li> --}}
        <li class="p-6 rounded-lg bg-white shadow hover:shadow-md transition">
            <h2 class="text-xl font-semibold mb-2"><a href="{{ route('tools.serp') }}" class="text-seova-orange hover:underline">SERP Preview</a></h2>
            <p class="text-sm text-gray-600">Simulate how your snippet may appear in search.</p>
        </li>
        <li class="p-6 rounded-lg bg-white shadow hover:shadow-md transition">
            <h2 class="text-xl font-semibold mb-2"><a href="{{ route('tools.word-counter') }}" class="text-seova-orange hover:underline">Word Counter</a></h2>
            <p class="text-sm text-gray-600">Count words, characters, and analyze text structure.</p>
        </li>
    </ul>
</section>
@endsection
