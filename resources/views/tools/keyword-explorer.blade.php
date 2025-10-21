@extends('layouts.app')

@section('title', 'Keyword Explorer | Seova Free SEO Tool')
@section('description', 'Research and analyze keywords for SEO. Get search volume, difficulty, and related keyword suggestions.')

@section('content')
<section class="max-w-6xl mx-auto px-6 py-12" aria-labelledby="keyword-explorer-heading">
    <header class="mb-8">
        <h1 id="keyword-explorer-heading" class="text-3xl font-bold tracking-tight">Keyword Explorer</h1>
        <p class="mt-2 text-gray-600">Research keywords, analyze search volumes, and discover related terms to improve your SEO strategy.</p>
    </header>

    <div class="grid gap-10 md:grid-cols-2 items-start">
        <!-- Left: Form Inputs -->
        <form id="keywordForm" class="space-y-6" aria-describedby="keyword-helper">
            <!-- Main Keyword Input -->
            <div>
                <label for="mainKeyword" class="block mb-1 font-medium">Primary Keyword</label>
                <input id="mainKeyword" type="text" 
                    class="w-full border rounded-md p-3 focus:ring-seova-orange focus:border-seova-orange" 
                    placeholder="Enter a keyword to analyze..."
                />
            </div>

            <!-- Bulk Keywords Input -->
            <div>
                <label for="bulkKeywords" class="block mb-1 font-medium">Bulk Analysis (Optional)</label>
                <textarea id="bulkKeywords" 
                    class="w-full border rounded-md p-3 focus:ring-seova-orange focus:border-seova-orange h-32" 
                    placeholder="Enter multiple keywords (one per line)..."
                ></textarea>
                <p class="text-xs text-gray-500 mt-1">Analyze up to 100 keywords at once.</p>
            </div>

            <!-- Location & Language -->
            <div class="grid gap-4 sm:grid-cols-2">
                <div>
                    <label for="country" class="block mb-1 font-medium">Country</label>
                    <select id="country" class="w-full border rounded-md p-3 focus:ring-seova-orange focus:border-seova-orange bg-white">
                        <option value="ar">Argentina</option>
                        <option value="au">Australia</option>
                        <option value="br">Brazil</option>
                        <option value="ca">Canada</option>
                        <option value="cl">Chile</option>
                        <option value="co">Colombia</option>
                        <option value="fr">France</option>
                        <option value="de">Germany</option>
                        <option value="in">India</option>
                        <option value="it">Italy</option>
                        <option value="jp">Japan</option>
                        <option value="mx">Mexico</option>
                        <option value="nz">New Zealand</option>
                        <option value="pt">Portugal</option>
                        <option value="es">Spain</option>
                        <option value="se">Sweden</option>
                        <option value="gb">United Kingdom</option>
                        <option value="us" selected>United States</option>
                        <option value="uy">Uruguay</option>
                        <option value="ve">Venezuela</option>
                    </select>
                </div>
                <div>
                    <label for="language" class="block mb-1 font-medium">Language</label>
                    <select id="language" class="w-full border rounded-md p-3 focus:ring-seova-orange focus:border-seova-orange bg-white">
                        <option value="en" selected>English</option>
                        <option value="en-gb">English (UK)</option>
                        <option value="en-au">English (Australia)</option>
                        <option value="es">Spanish (Spain)</option>
                        <option value="es-419">Spanish (Latin America)</option>
                        <option value="es-ar">Spanish (Argentina)</option>
                        <option value="es-mx">Spanish (Mexico)</option>
                        <option value="pt">Portuguese (Portugal)</option>
                        <option value="pt-br">Portuguese (Brazil)</option>
                        <option value="fr">French</option>
                        <option value="fr-ca">French (Canada)</option>
                        <option value="de">German</option>
                        <option value="it">Italian</option>
                        <option value="ja">Japanese</option>
                        <option value="sv">Swedish</option>
                        <option value="hi">Hindi</option>
                        <option value="ar">Arabic</option>
                        <option value="zh">Chinese (Simplified)</option>
                        <option value="zh-tw">Chinese (Traditional)</option>
                        <option value="ko">Korean</option>
                        <option value="ru">Russian</option>
                    </select>
                </div>
            </div>

            <!-- Filters -->
            <div>
                <label class="block mb-3 font-medium">Filters</label>
                <div class="space-y-3">
                    <!-- Search Volume Range -->
                    <div>
                        <label for="volumeRange" class="block text-sm text-gray-600 mb-1">Monthly Search Volume</label>
                        <div class="flex gap-4">
                            <input type="range" id="volumeRange" min="0" max="100" class="flex-1" />
                            <span id="volumeDisplay" class="text-sm text-gray-600 w-16 text-right">0</span>
                        </div>
                        <div class="flex justify-between text-xs text-gray-500 mt-1">
                            <span>0</span>
                            <span>50k+</span>
                            <span>100k+</span>
                        </div>
                    </div>

                    <!-- Keyword Difficulty -->
                    <div>
                        <label for="difficultyRange" class="block text-sm text-gray-600 mb-1">Keyword Difficulty</label>
                        <div class="flex gap-4">
                            <input type="range" id="difficultyRange" min="0" max="100" class="flex-1" />
                            <span id="difficultyDisplay" class="text-sm text-gray-600 w-16 text-right">0</span>
                        </div>
                        <div class="flex justify-between text-xs text-gray-500 mt-1">
                            <span>Easy</span>
                            <span>Medium</span>
                            <span>Hard</span>
                        </div>
                    </div>

                    <!-- Competition Level -->
                    <div>
                        <label class="block text-sm text-gray-600 mb-1">Competition Level</label>
                        <div class="flex gap-3">
                            <label class="flex-1">
                                <input type="radio" name="competition" value="low" class="sr-only peer">
                                <div class="text-center p-2 border rounded-md peer-checked:bg-green-50 peer-checked:border-green-500 peer-checked:text-green-700 cursor-pointer hover:bg-gray-50">
                                    <span class="text-sm">Low</span>
                                </div>
                            </label>
                            <label class="flex-1">
                                <input type="radio" name="competition" value="medium" class="sr-only peer">
                                <div class="text-center p-2 border rounded-md peer-checked:bg-yellow-50 peer-checked:border-yellow-500 peer-checked:text-yellow-700 cursor-pointer hover:bg-gray-50">
                                    <span class="text-sm">Medium</span>
                                </div>
                            </label>
                            <label class="flex-1">
                                <input type="radio" name="competition" value="high" class="sr-only peer">
                                <div class="text-center p-2 border rounded-md peer-checked:bg-red-50 peer-checked:border-red-500 peer-checked:text-red-700 cursor-pointer hover:bg-gray-50">
                                    <span class="text-sm">High</span>
                                </div>
                            </label>
                        </div>
                    </div>

                    <!-- Search Intent -->
                    <div class="space-y-2">
                        <label class="block text-sm text-gray-600">Search Intent</label>
                        <div class="grid sm:grid-cols-2 gap-2">
                            <label class="inline-flex items-center gap-2 p-2 border rounded-md hover:bg-gray-50 cursor-pointer">
                                <input type="checkbox" class="rounded border-gray-300 text-seova-green" value="informational">
                                <span class="text-sm">Informational</span>
                            </label>
                            <label class="inline-flex items-center gap-2 p-2 border rounded-md hover:bg-gray-50 cursor-pointer">
                                <input type="checkbox" class="rounded border-gray-300 text-seova-green" value="navigational">
                                <span class="text-sm">Navigational</span>
                            </label>
                            <label class="inline-flex items-center gap-2 p-2 border rounded-md hover:bg-gray-50 cursor-pointer">
                                <input type="checkbox" class="rounded border-gray-300 text-seova-green" value="commercial">
                                <span class="text-sm">Commercial</span>
                            </label>
                            <label class="inline-flex items-center gap-2 p-2 border rounded-md hover:bg-gray-50 cursor-pointer">
                                <input type="checkbox" class="rounded border-gray-300 text-seova-green" value="transactional">
                                <span class="text-sm">Transactional</span>
                            </label>
                        </div>
                    </div>

                    <!-- Additional Filters -->
                    <div class="space-y-2">
                        <label class="block text-sm text-gray-600">Additional Filters</label>
                        <div class="grid sm:grid-cols-2 gap-2">
                            <label class="inline-flex items-center gap-2 p-2 border rounded-md hover:bg-gray-50 cursor-pointer">
                                <input type="checkbox" class="rounded border-gray-300 text-seova-green" value="featured-snippet">
                                <span class="text-sm">Featured Snippet</span>
                            </label>
                            <label class="inline-flex items-center gap-2 p-2 border rounded-md hover:bg-gray-50 cursor-pointer">
                                <input type="checkbox" class="rounded border-gray-300 text-seova-green" value="local-intent">
                                <span class="text-sm">Local Intent</span>
                            </label>
                            <label class="inline-flex items-center gap-2 p-2 border rounded-md hover:bg-gray-50 cursor-pointer">
                                <input type="checkbox" class="rounded border-gray-300 text-seova-green" value="shopping">
                                <span class="text-sm">Shopping</span>
                            </label>
                            <label class="inline-flex items-center gap-2 p-2 border rounded-md hover:bg-gray-50 cursor-pointer">
                                <input type="checkbox" class="rounded border-gray-300 text-seova-green" value="video">
                                <span class="text-sm">Video Content</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="flex items-center gap-4">
                <button type="submit" id="analyzeKeywords" 
                    class="bg-seova-green text-white px-6 py-2 rounded-md hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-seova-green focus:ring-offset-2">
                    Analyze Keywords
                </button>
                <span id="statusBadge" class="text-xs px-2 py-1 rounded bg-gray-200 text-gray-700">Ready</span>
            </div>

            <p id="keyword-helper" class="text-xs text-gray-500">Limited to 100 requests per day per IP. Data is cached for 24 hours.</p>
        </form>

        <!-- Right: Results Panel -->
        <div class="space-y-6 md:sticky md:top-24" aria-live="polite">
            <!-- Main Keyword Analysis -->
            <div id="keywordResults" class="space-y-6">
                <div class="text-sm text-gray-500" id="initialMessage">Enter a keyword above to see analysis results.</div>
                
                <!-- Keyword Metrics Card -->
                <div id="keywordMetrics" class="hidden bg-white border rounded-lg overflow-hidden">
                    <div class="border-b px-4 py-3 bg-gray-50">
                        <h3 class="font-medium" id="analysedKeyword">Keyword Analysis</h3>
                    </div>
                    <div class="p-4">
                        <div class="grid sm:grid-cols-3 gap-4">
                            <!-- Search Volume -->
                            <div class="space-y-1">
                                <div class="text-xs text-gray-500">Monthly Searches</div>
                                <div class="text-2xl font-semibold" id="searchVolume">-</div>
                            </div>
                            <!-- Keyword Difficulty -->
                            <div class="space-y-1">
                                <div class="text-xs text-gray-500">Difficulty</div>
                                <div class="flex items-baseline gap-2">
                                    <span class="text-2xl font-semibold" id="keywordDifficulty">-</span>
                                    <span class="text-sm text-gray-500">/100</span>
                                </div>
                            </div>
                            <!-- CPC -->
                            <div class="space-y-1">
                                <div class="text-xs text-gray-500">CPC (USD)</div>
                                <div class="text-2xl font-semibold" id="keywordCPC">-</div>
                            </div>
                        </div>
                        
                        <!-- Additional Metrics -->
                        <div class="mt-4 pt-4 border-t grid sm:grid-cols-2 gap-4">
                            <div class="space-y-1">
                                <div class="text-xs text-gray-500">Competition</div>
                                <div class="flex items-center gap-2">
                                    <span id="competitionLevel">-</span>
                                    <span id="competitionIndicator" class="w-2 h-2 rounded-full"></span>
                                </div>
                            </div>
                            <div class="space-y-1">
                                <div class="text-xs text-gray-500">Intent</div>
                                <div id="searchIntent">-</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Trend Graph -->
                <div id="trendGraph" class="hidden bg-white border rounded-lg overflow-hidden">
                    <div class="border-b px-4 py-3 bg-gray-50">
                        <h3 class="font-medium">Search Volume Trend</h3>
                    </div>
                    <div class="p-4">
                        <div class="h-48" id="volumeChart">
                            <!-- Chart.js will render here -->
                        </div>
                    </div>
                </div>

                <!-- SERP Features -->
                <div id="serpFeatures" class="hidden bg-white border rounded-lg overflow-hidden">
                    <div class="border-b px-4 py-3 bg-gray-50">
                        <h3 class="font-medium">SERP Features</h3>
                    </div>
                    <div class="p-4">
                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-3" id="serpFeaturesList">
                            <!-- Features will be dynamically added here -->
                        </div>
                    </div>
                </div>

                <!-- Related Keywords Table -->
                <div id="relatedKeywords" class="hidden bg-white border rounded-lg overflow-hidden">
                    <div class="border-b px-4 py-3 bg-gray-50 flex justify-between items-center">
                        <h3 class="font-medium">Related Keywords</h3>
                        <div class="flex items-center gap-2">
                            <select id="keywordSort" class="text-sm border rounded px-2 py-1">
                                <option value="volume">Volume</option>
                                <option value="difficulty">Difficulty</option>
                                <option value="cpc">CPC</option>
                            </select>
                            <button id="exportKeywords" class="text-sm px-3 py-1 bg-seova-green text-white rounded hover:bg-green-600">
                                Export
                            </button>
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Keyword</th>
                                    <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase">Volume</th>
                                    <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase">Difficulty</th>
                                    <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase">CPC</th>
                                    <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase">Trend</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200" id="relatedKeywordsList">
                                <!-- Related keywords will be dynamically added here -->
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Export Options -->
                <div id="exportOptions" class="hidden bg-white border rounded-lg overflow-hidden">
                    <div class="border-b px-4 py-3 bg-gray-50">
                        <h3 class="font-medium">Export Options</h3>
                    </div>
                    <div class="p-4 space-y-3">
                        <div class="flex flex-wrap gap-3">
                            <button class="px-4 py-2 border rounded-md hover:bg-gray-50 text-sm flex items-center gap-2">
                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                                CSV
                            </button>
                            <button class="px-4 py-2 border rounded-md hover:bg-gray-50 text-sm flex items-center gap-2">
                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                                Excel
                            </button>
                            <button class="px-4 py-2 border rounded-md hover:bg-gray-50 text-sm flex items-center gap-2">
                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                                PDF Report
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pro Tips -->
            <div class="bg-white border rounded-lg p-4 text-xs text-gray-600">
                <p><strong>Pro Tips:</strong></p>
                <ul class="list-disc ml-5 space-y-1">
                    <li>Start with broad topics and analyze related keywords</li>
                    <li>Consider search intent when selecting keywords</li>
                    <li>Look for long-tail variations with lower competition</li>
                    <li>Check seasonal trends before finalizing your strategy</li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Educational Content -->
    <div class="mt-16 prose prose-seova max-w-none">
        <h2 class="text-2xl font-bold mb-6">How to Use the Keyword Explorer Tool</h2>
        <p class="text-gray-600 mb-8">Understanding keyword metrics helps you make informed decisions about your content strategy...</p>
        
        <!-- Additional educational content will go here -->
    </div>
</section>
@endsection

@push('scripts')
@vite('resources/js/tools/keyword-explorer.js')
@endpush
