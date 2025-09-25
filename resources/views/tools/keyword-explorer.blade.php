@extends('layouts.app')

@section('title', 'Keyword Explorer | Seova Free SEO Tool')
@section('description', 'Prototype keyword explorer tool to ideate and group keyword concepts for SEO planning.')

@section('content')
<section class="max-w-4xl mx-auto px-6 py-16" aria-labelledby="keyword-explorer-heading">
    <h1 id="keyword-explorer-heading" class="text-3xl font-bold mb-6">Keyword Explorer (Prototype)</h1>
    <form id="keywordForm" class="flex flex-col gap-4 mb-8" aria-describedby="keyword-helper">
        <label class="flex flex-col gap-2">
            <span class="font-medium">Seed Keywords (one per line)</span>
            <textarea id="seeds" class="border rounded-md p-3 focus:ring-seova-orange focus:border-seova-orange h-40" placeholder="seo audit\nlocal seo\nkeyword research"></textarea>
        </label>
        <button type="button" id="runKeyword" class="self-start bg-seova-green text-white px-5 py-2 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-seova-green focus:ring-offset-2">Generate Ideas</button>
        <p id="keyword-helper" class="text-sm text-gray-500">Client-side mock generation. No data sent to a server.</p>
    </form>
    <div id="keywordResults" class="space-y-4" aria-live="polite"></div>
</section>
@endsection

@push('scripts')
@vite('resources/js/tools/keyword-explorer.js')
@endpush
