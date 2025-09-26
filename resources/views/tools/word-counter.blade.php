@extends('layouts.app')

@section('title', 'Word Counter & Text Analyzer | Seova Free SEO Tool')
@section('description', 'Free tool to count words, characters, sentences and calculate reading time. Perfect for content optimization and SEO writing.')

@inject('structuredData', 'App\Services\StructuredDataService')
@section('json-ld')
{!! json_encode($structuredData->wordCounterStructuredData(), JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
@endsection

@section('content')
<section class="max-w-6xl mx-auto px-6 py-12" aria-labelledby="word-counter-heading">
    <header class="mb-8">
        <h1 id="word-counter-heading" class="text-3xl font-bold tracking-tight">Word Counter & Text Analyzer</h1>
        <p class="mt-2 text-gray-600">Count words, characters, and analyze text structure for optimal content length and readability.</p>
    </header>

    <div class="grid gap-10 md:grid-cols-2 items-start">
        <!-- Left: Text Input -->
        <div class="space-y-6">
            <div>
                <label for="content" class="block mb-2 font-medium">Your Text</label>
                <textarea 
                    id="content" 
                    class="w-full h-96 border rounded-md p-4 focus:ring-seova-orange focus:border-seova-orange font-mono text-sm"
                    placeholder="Paste or type your content here..."
                ></textarea>
            </div>
            <div class="flex gap-4">
                <button type="button" id="clearText" class="text-gray-600 hover:text-gray-800">Clear</button>
                <button type="button" id="copyText" class="text-seova-orange hover:text-seova-orange-dark">Copy</button>
            </div>
        </div>

        <!-- Right: Statistics Panel -->
        <div class="space-y-6 md:sticky md:top-24">
            <h2 class="text-xl font-semibold">Text Statistics</h2>
            
            <div class="grid gap-4 sm:grid-cols-2">
                <!-- Word Count -->
                <div class="bg-white p-4 rounded-lg border">
                    <div class="text-sm text-gray-600">Words</div>
                    <div class="text-2xl font-bold mt-1" id="wordCount">0</div>
                </div>
                
                <!-- Character Count -->
                <div class="bg-white p-4 rounded-lg border">
                    <div class="text-sm text-gray-600">Characters</div>
                    <div class="text-2xl font-bold mt-1" id="charCount">0</div>
                    <div class="text-xs text-gray-500 mt-1" id="charNoSpaces">0 excluding spaces</div>
                </div>
                
                <!-- Sentences -->
                <div class="bg-white p-4 rounded-lg border">
                    <div class="text-sm text-gray-600">Sentences</div>
                    <div class="text-2xl font-bold mt-1" id="sentenceCount">0</div>
                </div>
                
                <!-- Paragraphs -->
                <div class="bg-white p-4 rounded-lg border">
                    <div class="text-sm text-gray-600">Paragraphs</div>
                    <div class="text-2xl font-bold mt-1" id="paragraphCount">0</div>
                </div>
                
                <!-- Reading Time -->
                <div class="sm:col-span-2 bg-white p-4 rounded-lg border">
                    <div class="text-sm text-gray-600">Estimated Reading Time</div>
                    <div class="text-2xl font-bold mt-1" id="readingTime">0 min</div>
                    <div class="text-xs text-gray-500 mt-1">Based on 200 words per minute</div>
                </div>
            </div>

            <div class="bg-white border rounded-lg p-4 text-xs text-gray-600">
                <p><strong>Tips:</strong></p>
                <ul class="list-disc ml-5 space-y-1">
                    <li>Ideal blog post length: 1,500-2,500 words for SEO</li>
                    <li>Meta descriptions: Keep under 160 characters</li>
                    <li>Page titles: 50-60 characters recommended</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="mt-16 prose prose-seova max-w-none">
        <h2 class="text-2xl font-bold mb-6">Why Word Count Matters for SEO</h2>
        <p class="text-gray-600 mb-8">Content length is a crucial factor in SEO success. Studies show that longer, well-structured content tends to rank better in search results. However, quality always trumps quantity. Our word counter tool helps you optimize your content's length while maintaining readability.</p>

        <h3 class="text-xl font-semibold mb-4">Key Content Length Guidelines</h3>
        <div class="space-y-6">
            <div>
                <h4 class="font-medium mb-2">📝 Blog Posts and Articles</h4>
                <p class="text-gray-600">The ideal blog post length for SEO is typically between 1,500 and 2,500 words. This length allows you to cover topics comprehensively while maintaining reader engagement. Longer content often attracts more backlinks and social shares.</p>
            </div>

            <div>
                <h4 class="font-medium mb-2">🎯 Meta Descriptions</h4>
                <p class="text-gray-600">Keep meta descriptions between 150-160 characters to prevent truncation in search results. While they don't directly influence rankings, compelling meta descriptions can improve click-through rates.</p>
            </div>

            <div>
                <h4 class="font-medium mb-2">📱 Social Media Posts</h4>
                <p class="text-gray-600">Different platforms have different optimal lengths:
                    <ul class="list-disc ml-6 mt-2">
                        <li>Twitter: 240 characters maximum</li>
                        <li>Facebook: 40-80 characters for posts</li>
                        <li>LinkedIn: 1,300 characters for posts</li>
                        <li>Instagram: 2,200 characters for captions</li>
                    </ul>
                </p>
            </div>

            <div>
                <h4 class="font-medium mb-2">📊 Content Structure</h4>
                <p class="text-gray-600">Break up your content into digestible chunks:
                    <ul class="list-disc ml-6 mt-2">
                        <li>Paragraphs: 2-4 sentences for readability</li>
                        <li>Sentences: 20 words or fewer for clarity</li>
                        <li>Include subheadings every 300-350 words</li>
                    </ul>
                </p>
            </div>
        </div>

        <h3 class="text-xl font-semibold mt-12 mb-4">Tips for Writing SEO-Optimized Content</h3>
        <div class="space-y-4 text-gray-600">
            <ol class="list-decimal pl-6 space-y-3">
                <li><strong>Focus on reader value</strong> - Length should be determined by the topic's complexity and user intent.</li>
                <li><strong>Use clear structure</strong> - Break content into sections with descriptive subheadings.</li>
                <li><strong>Include relevant keywords</strong> - Maintain a natural keyword density of 1-2%.</li>
                <li><strong>Monitor engagement metrics</strong> - Track time on page and bounce rates to optimize content length.</li>
            </ol>

            <div class="bg-gray-50 border rounded-lg p-6 mt-8">
                <h4 class="font-medium mb-3">💡 Pro Writing Tips</h4>
                <ul class="list-disc pl-6 space-y-2">
                    <li>Write for your audience first, search engines second</li>
                    <li>Use short paragraphs and varied sentence lengths</li>
                    <li>Include examples and evidence to support claims</li>
                    <li>End with a clear call-to-action</li>
                </ul>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
@vite('resources/js/tools/word-counter.js')
@endpush