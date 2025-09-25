@extends('layouts.app')

@section('title', 'Site Crawler | Seova Free SEO Tool')
@section('description', 'Lightweight site crawler prototype to fetch and list internal links to limited depth.')

@section('content')
<section class="max-w-4xl mx-auto px-6 py-16" aria-labelledby="crawler-heading">
    <h1 id="crawler-heading" class="text-3xl font-bold mb-6">Site Crawler (Prototype)</h1>
    <form id="crawlForm" class="flex flex-col gap-4 mb-8" aria-describedby="crawler-helper">
        <label class="flex flex-col gap-2">
            <span class="font-medium">Start URL</span>
            <input id="crawlUrl" type="url" class="border rounded-md p-3 focus:ring-seova-orange focus:border-seova-orange" placeholder="https://example.com" />
        </label>
        <label class="flex items-center gap-2 text-sm">
            <input type="checkbox" id="sameHostOnly" checked /> <span>Restrict to same host</span>
        </label>
        <button type="button" id="runCrawl" class="self-start bg-seova-green text-white px-5 py-2 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-seova-green focus:ring-offset-2">Crawl</button>
        <p id="crawler-helper" class="text-sm text-gray-500">Client-side only. Restricted depth & may be limited by CORS.</p>
    </form>
    <div id="crawlResults" class="space-y-4" aria-live="polite"></div>
</section>
@endsection

@push('scripts')
@vite('resources/js/tools/site-crawler.js')
@endpush
