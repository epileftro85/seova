<!-- Navbar -->
<header class="bg-white shadow-sm sticky top-0 z-50" role="banner">
    <div class="max-w-7xl mx-auto px-6 py-4">
        <div class="flex justify-between items-center">
            <div class="flex items-center gap-2">
                <a href="{{ url('/') }}" class="flex items-center gap-2" aria-label="Seova SEO Virtual Assistant - Go to homepage">
                    <img src="{{ asset('img/seova-logo.svg') }}" alt="Seova SEO Virtual Assistant Logo" class="h-12 md:h-14" />
                </a>
            </div>
            
            <!-- Desktop Navigation -->
            <nav class="space-x-6 hidden md:flex" role="navigation" aria-label="Main navigation">
                <a href="{{ url('/') }}" class="text-gray-700 hover:text-orange-500 font-medium" aria-current="@if(request()->is('/')) page @endif">Home</a>
                <a href="{{ url('/') }}#services" class="text-gray-700 hover:text-orange-500 font-medium">Services</a>
                <div class="relative">
                    <button id="toolsToggle" class="text-gray-700 hover:text-orange-500 font-medium focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 rounded" aria-expanded="false" aria-haspopup="true" aria-label="Open tools menu">
                        Tools 
                        <span aria-hidden="true">▼</span>
                    </button>
                    <div id="toolsMenu" class="absolute hidden bg-white shadow-md rounded-md mt-2 w-48 z-10" role="menu" aria-labelledby="toolsToggle">
                        <a href="#keyword-explorer" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Keyword Explorer</a>
                        <a href="#meta-analyzer" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Meta Tag Analyzer</a>
                        <a href="#site-crawler" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Site Crawler</a>
                        <a href="#serp-preview" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">SERP Preview</a>
                    </div>
                </div>
            </nav>
            
            <!-- Desktop CTA Button -->
            <a href="#" class="bg-blue-600 text-white px-4 py-2 rounded-md font-semibold hover:bg-blue-700 transition hidden md:block" aria-label="Get a free SEO quote from Seova">Get a Free Quote</a>
            
            <!-- Mobile Menu Button -->
            <button id="mobileMenuToggle" class="md:hidden text-gray-700 hover:text-orange-500 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 rounded" aria-expanded="false" aria-controls="mobileMenu" aria-label="Open mobile menu">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
        </div>
        
        <!-- Mobile Navigation Menu -->
        <div id="mobileMenu" class="hidden md:hidden mt-4 pb-4 border-t border-gray-200" role="navigation" aria-label="Mobile navigation">
            <nav class="flex flex-col space-y-3 mt-4">
                <a href="{{ url('/') }}" class="text-gray-700 hover:text-orange-500 font-medium py-2" aria-current="@if(request()->is('/')) page @endif">Home</a>
                <a href="#services" class="text-gray-700 hover:text-orange-500 font-medium py-2">Services</a>
                <div class="py-2">
                    <button id="mobileToolsToggle" class="text-gray-700 hover:text-orange-500 font-medium focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 rounded w-full text-left" aria-expanded="false" aria-controls="mobileToolsMenu" aria-label="Open mobile tools menu">
                        Tools 
                        <span aria-hidden="true">▼</span>
                    </button>
                    <div id="mobileToolsMenu" class="hidden ml-4 mt-2 space-y-2" role="menu" aria-labelledby="mobileToolsToggle">
                        <a href="#keyword-explorer" class="block text-sm text-gray-600 hover:text-orange-500 py-1" role="menuitem">Keyword Explorer</a>
                        <a href="#meta-analyzer" class="block text-sm text-gray-600 hover:text-orange-500 py-1" role="menuitem">Meta Tag Analyzer</a>
                        <a href="#site-crawler" class="block text-sm text-gray-600 hover:text-orange-500 py-1" role="menuitem">Site Crawler</a>
                        <a href="#serp-preview" class="block text-sm text-gray-600 hover:text-orange-500 py-1" role="menuitem">SERP Preview</a>
                    </div>
                </div>
                <a href="#contact" class="text-gray-700 hover:text-orange-500 font-medium py-2">Contact</a>
                <a href="#" class="bg-blue-600 text-white px-4 py-2 rounded-md font-semibold hover:bg-blue-700 transition text-center mt-4" aria-label="Get a free SEO quote from Seova">Get a Free Quote</a>
            </nav>
        </div>
    </div>
</header>
