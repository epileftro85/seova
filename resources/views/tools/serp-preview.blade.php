@extends('layouts.app')

@section('title', 'SERP Preview | Seova Free SEO Tool')
@section('description', 'Preview how your page title and meta description might appear in search results.')

@section('content')
<section class="max-w-4xl mx-auto px-6 py-16" aria-labelledby="serp-preview-heading">
    <h1 id="serp-preview-heading" class="text-3xl font-bold mb-6">SERP Preview</h1>
    <form id="serpForm" class="space-y-6" aria-describedby="serp-helper">
        <div>
            <label class="block mb-2 font-medium" for="serpTitle">Title</label>
            <input id="serpTitle" type="text" class="w-full border rounded-md p-3 focus:ring-seova-orange focus:border-seova-orange" placeholder="E.g. Affordable SEO Services for Startups" />
        </div>
        <div>
            <label class="block mb-2 font-medium" for="serpDescription">Description</label>
            <textarea id="serpDescription" class="w-full border rounded-md p-3 focus:ring-seova-orange focus:border-seova-orange h-32" placeholder="Write a compelling snippet that would earn clicks."></textarea>
        </div>
        <button type="button" id="renderSerp" class="bg-seova-green text-white px-5 py-2 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-seova-green focus:ring-offset-2">Preview</button>
        <p id="serp-helper" class="text-sm text-gray-500">No data sent to a backend. Local preview only.</p>
    </form>
    <div id="serpResults" class="mt-10" aria-live="polite"></div>
</section>
@endsection

@push('scripts')
@vite('resources/js/tools/serp-preview.js')
@endpush
