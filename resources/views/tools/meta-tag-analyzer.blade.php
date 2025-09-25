@extends('layouts.app')

@section('title', 'Meta Tag Analyzer | Seova Free SEO Tool')
@section('description', 'Analyze meta title, description, and social tags for SEO best practices.')

@section('content')
<section class="max-w-4xl mx-auto px-6 py-16" aria-labelledby="meta-analyzer-heading">
    <h1 id="meta-analyzer-heading" class="text-3xl font-bold mb-6">Meta Tag Analyzer</h1>
    <form id="metaForm" class="space-y-6" aria-describedby="meta-helper">
        <div>
            <label class="block mb-2 font-medium" for="metaTitle">Title Tag</label>
            <input id="metaTitle" type="text" class="w-full border rounded-md p-3 focus:ring-seova-orange focus:border-seova-orange" placeholder="e.g. Affordable Local SEO Services | Brand" />
        </div>
        <div>
            <label class="block mb-2 font-medium" for="metaDescription">Meta Description</label>
            <textarea id="metaDescription" class="w-full border rounded-md p-3 focus:ring-seova-orange focus:border-seova-orange h-32" placeholder="Describe the page purpose and value."></textarea>
        </div>
        <button type="button" id="analyzeMeta" class="bg-seova-green text-white px-5 py-2 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-seova-green focus:ring-offset-2">Analyze</button>
        <p id="meta-helper" class="text-sm text-gray-500">Runs locally. No data leaves your browser.</p>
    </form>
    <div id="metaResults" class="mt-8 space-y-4" aria-live="polite"></div>
</section>
@endsection

@push('scripts')
@vite('resources/js/tools/meta-tag-analyzer.js')
@endpush
