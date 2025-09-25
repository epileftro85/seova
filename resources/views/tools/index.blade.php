@extends('layouts.app')

@section('title', 'Free SEO Tools | Seova')
@section('description', 'Access free SEO utilities: keyword explorer, meta tag analyzer, site crawler, and SERP preview to optimize your site.')

@section('content')
<section class="max-w-5xl mx-auto px-6 py-16" aria-labelledby="tools-landing-heading">
    <h1 id="tools-landing-heading" class="text-4xl font-bold mb-6">Free SEO Tools</h1>
    <p class="text-gray-600 mb-10 max-w-2xl">Explore our early toolkit. Lightweight, fast, and privacy-friendly. More features coming soon.</p>
    <ul class="grid gap-6 md:grid-cols-2">
        <li class="p-6 rounded-lg bg-white shadow hover:shadow-md transition">
            <h2 class="text-xl font-semibold mb-2"><a href="{{ route('tools.keyword') }}" class="text-seova-orange hover:underline">Keyword Explorer</a></h2>
            <p class="text-sm text-gray-600">Discover and structure keyword ideas (prototype).</p>
        </li>
        <li class="p-6 rounded-lg bg-white shadow hover:shadow-md transition">
            <h2 class="text-xl font-semibold mb-2"><a href="{{ route('tools.meta') }}" class="text-seova-orange hover:underline">Meta Tag Analyzer</a></h2>
            <p class="text-sm text-gray-600">Validate title, description, and social tags.</p>
        </li>
        <li class="p-6 rounded-lg bg-white shadow hover:shadow-md transition">
            <h2 class="text-xl font-semibold mb-2"><a href="{{ route('tools.crawler') }}" class="text-seova-orange hover:underline">Site Crawler</a></h2>
            <p class="text-sm text-gray-600">Fetch and inspect internal links (limited depth).</p>
        </li>
        <li class="p-6 rounded-lg bg-white shadow hover:shadow-md transition">
            <h2 class="text-xl font-semibold mb-2"><a href="{{ route('tools.serp') }}" class="text-seova-orange hover:underline">SERP Preview</a></h2>
            <p class="text-sm text-gray-600">Simulate how your snippet may appear in search.</p>
        </li>
    </ul>
</section>
@endsection
