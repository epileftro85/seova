@extends('layouts.app')

@section('title', 'Meta Tag Generator | Seova Free SEO Tool')
@section('description', 'Create optimized meta tags for better SEO. Generate title, description, robots, and other essential meta tags for your web pages.')

@inject('structuredData', 'App\Services\StructuredDataService')
@section('json-ld')
{!! json_encode($structuredData->metaTagGeneratorStructuredData(), JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
@endsection

@section('content')
<section class="max-w-6xl mx-auto px-6 py-12" aria-labelledby="meta-tag-generator-heading">
    <header class="mb-8">
        <h1 id="meta-tag-generator-heading" class="text-3xl font-bold tracking-tight">Meta Tag Generator</h1>
        <p class="mt-2 text-gray-600">Create optimized meta tags for better SEO. Preview how your metadata will appear and get the code ready to use.</p>
    </header>

    <div class="grid gap-10 md:grid-cols-2 items-start">
        <!-- Left: Form Inputs -->
        <form id="metaForm" class="space-y-6" aria-labelledby="meta-form-heading">
            <h2 id="meta-form-heading" class="sr-only">Meta Tag Input Form</h2>
            
            <!-- Title Tag -->
            <div>
                <label for="pageTitle" class="block mb-1 font-medium">Title Tag <span class="text-xs text-gray-500 ml-1">(<span id="titleCount">0</span>/60)</span></label>
                <input 
                    type="text" 
                    id="pageTitle" 
                    class="w-full border rounded-md p-3 focus:ring-seova-orange focus:border-seova-orange"
                    maxlength="120"
                    placeholder="Primary Keyword - Secondary Keyword | Brand Name"
                />
                <p class="text-xs text-gray-500 mt-1">Recommended: 50-60 characters for optimal display in search results.</p>
            </div>

            <!-- Meta Description -->
            <div>
                <label for="metaDesc" class="block mb-1 font-medium">Meta Description <span class="text-xs text-gray-500 ml-1">(<span id="descCount">0</span>/160)</span></label>
                <textarea 
                    id="metaDesc" 
                    class="w-full border rounded-md p-3 focus:ring-seova-orange focus:border-seova-orange h-24"
                    maxlength="320"
                    placeholder="Write a compelling description that summarizes your page content and encourages clicks..."
                ></textarea>
                <p class="text-xs text-gray-500 mt-1">Optimal length: 150-160 characters. Include a call-to-action and relevant keywords.</p>
            </div>

            <!-- Robots Meta -->
            <div>
                <label class="block mb-1 font-medium">Robots Meta Tag</label>
                <div class="space-y-2">
                    <label class="inline-flex items-center">
                        <input type="checkbox" id="robotsIndex" class="rounded border-gray-300 text-seova-orange focus:ring-seova-orange" checked>
                        <span class="ml-2">index</span>
                    </label>
                    <label class="inline-flex items-center ml-4">
                        <input type="checkbox" id="robotsFollow" class="rounded border-gray-300 text-seova-orange focus:ring-seova-orange" checked>
                        <span class="ml-2">follow</span>
                    </label>
                    <label class="inline-flex items-center ml-4">
                        <input type="checkbox" id="robotsSnippet" class="rounded border-gray-300 text-seova-orange focus:ring-seova-orange" checked>
                        <span class="ml-2">max-snippet</span>
                    </label>
                    <label class="inline-flex items-center ml-4">
                        <input type="checkbox" id="robotsImage" class="rounded border-gray-300 text-seova-orange focus:ring-seova-orange" checked>
                        <span class="ml-2">max-image-preview:large</span>
                    </label>
                </div>
            </div>

            <!-- Open Graph -->
            <div class="space-y-4">
                <h3 class="font-medium">Open Graph Tags</h3>
                
                <div>
                    <label for="ogTitle" class="block mb-1 text-sm">OG Title <span class="text-xs text-gray-500">(optional)</span></label>
                    <input 
                        type="text" 
                        id="ogTitle" 
                        class="w-full border rounded-md p-3 focus:ring-seova-orange focus:border-seova-orange"
                        placeholder="Leave blank to use the main title"
                    />
                </div>

                <div>
                    <label for="ogDesc" class="block mb-1 text-sm">OG Description <span class="text-xs text-gray-500">(optional)</span></label>
                    <textarea 
                        id="ogDesc" 
                        class="w-full border rounded-md p-3 focus:ring-seova-orange focus:border-seova-orange h-20"
                        placeholder="Leave blank to use the meta description"
                    ></textarea>
                </div>

                <div>
                    <label for="ogImage" class="block mb-1 text-sm">OG Image URL <span class="text-xs text-gray-500">(recommended)</span></label>
                    <input 
                        type="url" 
                        id="ogImage" 
                        class="w-full border rounded-md p-3 focus:ring-seova-orange focus:border-seova-orange"
                        placeholder="https://example.com/image.jpg"
                    />
                    <p class="text-xs text-gray-500 mt-1">Recommended size: 1200x630 pixels</p>
                </div>
            </div>

            <!-- Additional Tags -->
            <div class="space-y-4">
                <h3 class="font-medium">Additional Meta Tags</h3>
                
                <div>
                    <label for="canonical" class="block mb-1 text-sm">Canonical URL <span class="text-xs text-gray-500">(recommended)</span></label>
                    <input 
                        type="url" 
                        id="canonical" 
                        class="w-full border rounded-md p-3 focus:ring-seova-orange focus:border-seova-orange"
                        placeholder="https://example.com/page"
                    />
                </div>

                <div>
                    <label for="keywords" class="block mb-1 text-sm">Meta Keywords <span class="text-xs text-gray-500">(optional)</span></label>
                    <input 
                        type="text" 
                        id="keywords" 
                        class="w-full border rounded-md p-3 focus:ring-seova-orange focus:border-seova-orange"
                        placeholder="keyword1, keyword2, keyword3"
                    />
                    <p class="text-xs text-gray-500 mt-1">Note: Not used by major search engines, but may be useful for internal search.</p>
                </div>
            </div>
        </form>

        <!-- Right: Preview & Code -->
        <div class="space-y-6 md:sticky md:top-24" aria-live="polite">
            <div>
                <h2 class="text-xl font-semibold mb-4">Live Preview</h2>
                <div id="preview" class="bg-white border rounded-lg p-4">
                    <div class="text-sm text-gray-500">Fill in the form to see your meta tags preview.</div>
                </div>
            </div>

            <div>
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-xl font-semibold">Generated Code</h2>
                    <button type="button" id="copyCode" class="text-sm text-seova-orange hover:text-seova-orange-dark cursor-pointer">Copy Code</button>
                </div>
                <pre id="codeOutput" class="bg-gray-50 border rounded-lg p-4 text-sm font-mono whitespace-pre-wrap break-all"></pre>
            </div>

            <div class="bg-white border rounded-lg p-4 text-xs text-gray-600">
                <p><strong>Tips:</strong></p>
                <ul class="list-disc ml-5 space-y-1">
                    <li>Include your main keyword in both title and description</li>
                    <li>Write compelling, action-oriented descriptions</li>
                    <li>Use unique titles and descriptions for each page</li>
                    <li>Test your meta tags in the SERP Preview tool</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="mt-16 prose prose-seova max-w-none">
        <h2 class="text-2xl font-bold mb-6">Meta Tags Guide for SEO Success</h2>
        <p class="text-gray-600 mb-8">Meta tags are essential HTML elements that provide information about your web page to search engines and website visitors. While not all meta tags directly influence rankings, they play a crucial role in how your pages appear in search results and affect click-through rates.</p>

        <h3 class="text-xl font-semibold mb-4">Essential Meta Tags Explained</h3>
        <div class="space-y-6">
            <div>
                <h4 class="font-medium mb-2">📌 Title Tag</h4>
                <p class="text-gray-600">The title tag is the most important meta element for SEO. It appears as the clickable headline in search results and should:
                    <ul class="list-disc ml-6 mt-2">
                        <li>Include your primary keyword near the beginning</li>
                        <li>Stay between 50-60 characters to avoid truncation</li>
                        <li>Be unique for each page on your site</li>
                        <li>Include your brand name when relevant</li>
                    </ul>
                </p>
            </div>

            <div>
                <h4 class="font-medium mb-2">📝 Meta Description</h4>
                <p class="text-gray-600">While not a direct ranking factor, the meta description serves as your organic search ad copy. Best practices include:
                    <ul class="list-disc ml-6 mt-2">
                        <li>Keep it between 150-160 characters</li>
                        <li>Include a clear call-to-action</li>
                        <li>Match search intent</li>
                        <li>Use natural, compelling language</li>
                    </ul>
                </p>
            </div>

            <div>
                <h4 class="font-medium mb-2">🤖 Robots Meta Tag</h4>
                <p class="text-gray-600">Control how search engines interact with your pages:
                    <ul class="list-disc ml-6 mt-2">
                        <li>index/noindex: Allow or prevent indexing</li>
                        <li>follow/nofollow: Allow or prevent link following</li>
                        <li>max-snippet: Control snippet length</li>
                        <li>max-image-preview: Control image preview size</li>
                    </ul>
                </p>
            </div>

            <div>
                <h4 class="font-medium mb-2">📱 Open Graph Tags</h4>
                <p class="text-gray-600">Essential for social media sharing, Open Graph tags control how your content appears when shared on platforms like Facebook and LinkedIn:
                    <ul class="list-disc ml-6 mt-2">
                        <li>og:title - The title shown in social shares</li>
                        <li>og:description - A custom description for social media</li>
                        <li>og:image - The image displayed in social shares (1200x630px recommended)</li>
                        <li>og:url - The canonical URL of your page</li>
                    </ul>
                </p>
            </div>

            <div>
                <h4 class="font-medium mb-2">🔗 Canonical Tag</h4>
                <p class="text-gray-600">Use the canonical tag to:
                    <ul class="list-disc ml-6 mt-2">
                        <li>Prevent duplicate content issues</li>
                        <li>Consolidate ranking signals to your preferred URL</li>
                        <li>Handle multiple versions of the same content</li>
                        <li>Manage pagination and filtered content</li>
                    </ul>
                </p>
            </div>
        </div>

        <div class="bg-gray-50 border rounded-lg p-6 mt-8">
            <h4 class="font-medium mb-3">💡 Pro Tips for Meta Tag Success</h4>
            <ul class="list-disc pl-6 space-y-2">
                <li>Regularly audit your meta tags for opportunities to improve CTR</li>
                <li>A/B test different meta descriptions to find what works best</li>
                <li>Use schema markup alongside meta tags for rich results</li>
                <li>Keep your meta tags up to date as your content changes</li>
                <li>Monitor CTR in Google Search Console to identify underperforming pages</li>
            </ul>
        </div>
    </div>
</section>
@endsection

@push('scripts')
@vite('resources/js/tools/meta-tag-generator.js')
@endpush