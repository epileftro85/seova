@extends('layouts.app')

@section('title', 'Serp Preview | SeoVa')
@section('description', 'Preview how your page title and meta description might appear in search results.')

@section('og_title', 'SERP Preview Tool | Seova Free SEO Tool')
@section('og_description', 'Craft SEO‑friendly titles & meta descriptions and see how they may appear in Google or Bing. Fetch an existing page or write manually.')
@section('twitter_title', 'SERP Preview Tool | Seova Free SEO Tool')
@section('twitter_description', 'Craft SEO‑friendly titles & meta descriptions and see how they may appear in Google or Bing. Fetch an existing page or write manually.')

@section('json-ld')
<script type="application/ld+json">@json($structuredData, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE)</script>
@endsection

@section('content')
<section class="max-w-6xl mx-auto px-6 py-12" aria-labelledby="serp-preview-heading">
    <header class="mb-8">
        <h1 id="serp-preview-heading" class="text-3xl font-bold tracking-tight">Google and Bing SERP Preview Tool</h1>
        <p class="mt-2 text-gray-600">Craft SEO‑friendly titles & meta descriptions and see how they may appear in Google or Bing. Fetch an existing page or write manually.</p>
    </header>

    <div class="grid gap-10 md:grid-cols-2 items-start">
        <!-- Left: Form Inputs -->
        <form id="serpForm" class="space-y-6" aria-describedby="serp-helper">
            <!-- Unified URL + Fetch Toggle -->
            <div>
                <label for="pageUrl" class="block mb-1 font-medium">Page URL</label>
                <div class="flex gap-2 items-center">
                    <input id="pageUrl" type="url" placeholder="https://example.com/path" class="flex-1 border rounded-md p-3 focus:ring-seova-orange focus:border-seova-orange" />
                    <label class="flex items-center gap-2 text-sm cursor-pointer select-none">
                        <input id="toggleFetch" type="checkbox" class="sr-only peer">
                        <span class="relative inline-block w-11 h-6 rounded-full bg-gray-300 transition-colors peer-checked:bg-seova-green after:content-[''] after:absolute after:top-0.5 after:left-0.5 after:w-5 after:h-5 after:rounded-full after:bg-white after:shadow after:transition-transform peer-checked:after:translate-x-5"></span>
                        <span>Fetch</span>
                    </label>
                    <button type="button" id="fetchMeta" class="hidden px-4 py-2 bg-seova-green text-white rounded-md hover:bg-green-600">Fetch</button>
                </div>
                <p class="text-xs text-gray-500 mt-1">Toggle “Fetch” to pull title & description from the live page. Otherwise edit manually below.</p>
            </div>

            <!-- Site Name -->
            <div>
                <label for="siteName" class="block mb-1 font-medium">Site Name</label>
                <input id="siteName" type="text" placeholder="Example" class="w-full border rounded-md p-3 focus:ring-seova-orange focus:border-seova-orange" maxlength="60" />
            </div>

            <!-- Manual Inputs -->
            <div>
                <label class="block mb-1 font-medium" for="serpTitle">Title <span id="titleCount" class="text-xs text-gray-500 ml-1">0 / 65</span></label>
                <input id="serpTitle" type="text" class="w-full border rounded-md p-3 focus:ring-seova-orange focus:border-seova-orange" maxlength="120" placeholder="Affordable SEO Services for Startups | Brand" />
                <p class="text-xs text-gray-500 mt-1">Recommended: 50–65 characters.</p>
            </div>
            <div>
                <label class="block mb-1 font-medium" for="serpDescription">Meta Description <span id="descCount" class="text-xs text-gray-500 ml-1">0 / 160</span></label>
                <textarea id="serpDescription" class="w-full border rounded-md p-3 focus:ring-seova-orange focus:border-seova-orange h-32" maxlength="320" placeholder="Describe the value of the page & entice the click."></textarea>
                <p class="text-xs text-gray-500 mt-1">Recommended: up to ~155–160 characters (desktop).</p>
            </div>

            <div>
                <label class="block mb-1 font-medium" for="boldKeywords">Bold keywords (comma separated)</label>
                <input id="boldKeywords" type="text" class="w-full border rounded-md p-3 focus:ring-seova-orange focus:border-seova-orange" placeholder="e.g. affordable, startups, seo" />
                <p class="text-xs text-gray-500 mt-1">Enter words separated by commas. Matches in the meta description will be wrapped in bold.</p>
            </div>

            <!-- Engine + Actions -->
            <div class="flex flex-wrap items-end gap-4">
                <div>
                    <label for="engine" class="block mb-1 font-medium">Search Engine Style</label>
                    <div class="relative">
                        <select id="engine" class="appearance-none border rounded-md py-2 pl-3 pr-10 focus:ring-seova-orange focus:border-seova-orange w-full bg-white">
                            <option value="google" selected>Google</option>
                            <option value="bing">Bing</option>
                        </select>
                        <svg class="pointer-events-none w-4 h-4 text-gray-500 absolute right-3 top-1/2 -translate-y-1/2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
                    </div>
                </div>
                <div>
                    <label for="desktopWidth" class="block mb-1 font-medium">Viewport</label>
                    <div class="relative">
                        <select id="desktopWidth" class="appearance-none border rounded-md py-2 pl-3 pr-10 focus:ring-seova-orange focus:border-seova-orange w-full bg-white">
                            <option value="desktop" selected>Desktop</option>
                            <option value="mobile">Mobile</option>
                        </select>
                        <svg class="pointer-events-none w-4 h-4 text-gray-500 absolute right-3 top-1/2 -translate-y-1/2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
                    </div>
                </div>
                    <div id="googleOptions" class="flex flex-col gap-2 text-xs mt-2">
                        <label class="inline-flex items-center gap-2">
                            <input id="optGoogleModern" type="checkbox" class="rounded border-gray-300" checked>
                            <span>Modern Google layout</span>
                        </label>
                        <label class="inline-flex items-center gap-2">
                            <input id="optShowDate" type="checkbox" class="rounded border-gray-300">
                            <span>Show date before description</span>
                        </label>
                        <label class="inline-flex items-center gap-2">
                            <input id="optShowRating" type="checkbox" class="rounded border-gray-300">
                            <span>Include sample rating snippet</span>
                        </label>
                    </div>
                <button type="button" id="renderSerp" class="ml-auto bg-seova-green text-white px-5 py-2 rounded-md hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-seova-green focus:ring-offset-2">Update Preview</button>
            </div>
            <p id="serp-helper" class="text-xs text-gray-500">No personal data stored. If Fetch is on, we request only the target HTML to extract the &lt;title&gt; & meta description.</p>
        </form>

        <!-- Right: Preview Panel -->
        <div class="space-y-6 md:sticky md:top-24" aria-live="polite">
            <div class="flex items-center gap-4">
                <h2 class="text-xl font-semibold">Preview</h2>
                <span id="statusBadge" class="text-xs px-2 py-1 rounded bg-gray-200 text-gray-700">Idle</span>
            </div>
            <div id="serpResults" class="relative transition-all duration-300" data-viewport="desktop">
                <div class="text-sm text-gray-500">Your preview will appear here.</div>
            </div>
            <div class="bg-white border rounded-lg p-4 text-xs text-gray-600">
                <p><strong>Tips:</strong></p>
                <ul class="list-disc ml-5 space-y-1">
                    <li>Avoid truncation by keeping titles concise (brand name optional).</li>
                    <li>Use action-oriented language in descriptions & include a USP.</li>
                    <li>Search engines may rewrite elements—this is only a simulation.</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="mt-16 prose prose-seova max-w-none">
        <h2 id="why-serp" class="text-2xl font-bold mb-6">Why SERP (Search Engine Results Page) Optimization Is Critical</h2>
        <p class="text-gray-600 mb-8">Your website's <strong>SERP appearance</strong> is often the first impression potential visitors have of your brand. A well-optimized <strong>search result snippet</strong> can dramatically improve <strong>click-through rates</strong> and drive more qualified traffic to your website. Studies show that moving from position #2 to position #1 in <strong>search engine results</strong> can increase CTR by up to 200%.</p>

        <h3 class="text-xl font-semibold mb-4">Key SERP Features Explained</h3>
        <div class="space-y-6">
            <div>
                <h4 class="font-medium mb-2">📝 Title Tag Optimization</h4>
                <p class="text-gray-600">The <strong>SEO title tag</strong> (50-60 characters) is your headline in search results. It should include your <strong>primary keyword</strong> naturally and compel users to click. Our <strong>SERP preview tool</strong> helps you visualize how your title appears and ensures it doesn't get truncated.</p>
            </div>

            <div>
                <h4 class="font-medium mb-2">📄 Meta Description Impact</h4>
                <p class="text-gray-600">While <strong>meta descriptions</strong> don't directly influence rankings, they act as your <strong>organic search ad copy</strong>. A well-crafted description (around 155-160 characters) can significantly improve <strong>search visibility</strong> by clearly communicating your page's value proposition.</p>
            </div>

            <div>
                <h4 class="font-medium mb-2">🔍 Site Name & URL Structure</h4>
                <p class="text-gray-600">Google often displays your <strong>site name</strong> and <strong>breadcrumb path</strong>. A clean <strong>URL structure</strong> helps users understand your content hierarchy and can improve trust signals. Our preview tool shows how Google might display your site's structure.</p>
            </div>

            <div>
                <h4 class="font-medium mb-2">🎯 Keyword Highlighting in Search Results</h4>
                <p class="text-gray-600">When users search on Google, the search engine automatically <strong>highlights matching keywords</strong> in the results by making them bold. This visual emphasis helps searchers quickly spot the most relevant results for their query. Our <strong>keyword highlighting preview</strong> feature lets you simulate how your listing will appear when users search for specific terms, helping you optimize your meta description for maximum visibility and impact.</p>
            </div>

            <div>
                <h4 class="font-medium mb-2">📱 Mobile vs Desktop Display</h4>
                <p class="text-gray-600">With <strong>mobile-first indexing</strong>, it's crucial to optimize your SERP appearance for both devices. <strong>Mobile search snippets</strong> are narrower and may truncate content earlier. Our viewport toggle helps you ensure your snippets look great everywhere.</p>
            </div>
        </div>

        <h3 id="optimization-guide" class="text-xl font-semibold mt-12 mb-4">How to Create High-Performance SERP Snippets</h3>
        <div class="space-y-4 text-gray-600">
            <p>Creating effective SERP snippets is both an art and a science. Here's how to maximize your search visibility:</p>

            <ol class="list-decimal pl-6 space-y-3">
                <li><strong>Front-load important keywords</strong> - Place primary keywords near the beginning of titles and descriptions where they have the most impact.</li>
                <li><strong>Write compelling calls-to-action</strong> - Use action words and highlight unique value propositions in your meta descriptions.</li>
                <li><strong>Monitor click-through rates</strong> - Use Google Search Console to track which snippets perform best and iterate based on data.</li>
                <li><strong>Match search intent</strong> - Ensure your title and description align with what users expect to find when they search for your target keywords.</li>
                <li><strong>Test different formats</strong> - Experiment with including prices, years, or brackets in titles to improve CTR.</li>
            </ol>

            <div class="bg-gray-50 border rounded-lg p-6 mt-8">
                <h4 class="font-medium mb-3">💡 Pro Tips for SERP Success</h4>
                <ul class="list-disc pl-6 space-y-2">
                    <li>Include your brand name in titles for branded searches (usually at the end, separated by a pipe | or dash -)</li>
                    <li>Use schema markup to enable rich snippets like ratings, dates, or product information</li>
                    <li>Keep titles under 60 characters and descriptions under 160 to avoid truncation</li>
                    <li>Write naturally for humans while incorporating relevant keywords</li>
                    <li>Update meta descriptions seasonally or for special promotions</li>
                </ul>
            </div>

            <p class="mt-8">Remember: Your SERP snippet is your 24/7 salesperson in search results. It should be clear, compelling, and optimized for both users and search engines. Use our SERP Preview Tool to craft and test your snippets before they go live.</p>
        </div>
    </div>
</section>
@endsection

@push('scripts')
@vite('resources/js/tools/serp-preview.js')
@endpush
