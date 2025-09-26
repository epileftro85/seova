<!-- Navbar -->
<header class="bg-white shadow-sm sticky top-0 z-50" role="banner">
    <div class="max-w-7xl mx-auto px-6 py-4">
        <div class="flex justify-between items-center">
            <div class="flex items-center gap-2">
                <a href="{{ url('/') }}" class="flex items-center gap-2" aria-label="Seova SEO Virtual Assistant - Go to homepage">
                    <img src="{{ asset('img/seova-logo.svg') }}" alt="Seova SEO Virtual Assistant Logo" class="h-12 md:h-14" width="160" height="56" loading="eager" decoding="async" fetchpriority="high" />
                </a>
            </div>
            
            <!-- Desktop Navigation -->
            <nav class="space-x-6 hidden md:flex" role="navigation" aria-label="Main navigation">
                <a href="{{ url('/') }}" class="text-gray-700 hover:text-seova-orange font-medium" aria-current="@if(request()->is('/')) page @endif" data-analytics-event="nav_home">Home</a>
                <a href="{{ url('/') }}#services" class="text-gray-700 hover:text-seova-orange font-medium" data-analytics-event="nav_services">Services</a>
                <div class="relative">
                    <button id="toolsToggle" class="text-gray-700 hover:text-seova-orange font-medium focus:outline-none focus:ring-2 focus:ring-seova-orange focus:ring-offset-2 rounded" aria-expanded="false" aria-haspopup="true" aria-label="Open tools menu" data-analytics-event="nav_tools_toggle">
                        Tools 
                        <span aria-hidden="true">▼</span>
                    </button>
                    <div id="toolsMenu" class="absolute hidden bg-white shadow-md rounded-md mt-2 w-56 z-10" role="menu" aria-labelledby="toolsToggle">
                        {{-- <a href="{{ route('tools.keyword') }}" class="block px-4 py-2 text-sm text-gray-700 hover:text-seova-orange focus:text-seova-orange hover:bg-gray-50 focus:bg-gray-50 rounded focus:outline-none focus:ring-2 focus:ring-seova-orange focus:ring-offset-2" role="menuitem" data-analytics-event="nav_tools_keyword">Keyword Explorer</a> --}}
                        <a href="{{ route('tools.serp') }}" class="block px-4 py-2 text-sm text-gray-700 hover:text-seova-orange focus:text-seova-orange hover:bg-gray-50 focus:bg-gray-50 rounded focus:outline-none focus:ring-2 focus:ring-seova-orange focus:ring-offset-2" role="menuitem" data-analytics-event="nav_tools_serp">SERP Preview</a>
                        <a href="{{ route('tools.word-counter') }}" class="block px-4 py-2 text-sm text-gray-700 hover:text-seova-orange focus:text-seova-orange hover:bg-gray-50 focus:bg-gray-50 rounded focus:outline-none focus:ring-2 focus:ring-seova-orange focus:ring-offset-2" role="menuitem" data-analytics-event="nav_tools_word_counter">Word Counter</a>
                    </div>
                </div>
            </nav>
            
            <!-- Desktop CTA Button -->
            <a href="{{ url('/') }}#contact" class="bg-seova-green text-white px-4 py-2 rounded-md font-semibold hover:bg-blue-700 transition hidden md:block" aria-label="Get a free SEO quote from Seova" data-analytics-event="nav_cta_quote">Get a Free Quote</a>
            
            <!-- Mobile Menu Button -->
            <button id="mobileMenuToggle" class="md:hidden text-gray-700 hover:text-seova-orange focus:outline-none focus:ring-2 focus:ring-seova-orange focus:ring-offset-2 rounded" aria-expanded="false" aria-controls="mobileMenu" aria-label="Open mobile menu" data-analytics-event="nav_mobile_menu_toggle">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
        </div>
        
        <!-- Mobile Navigation Menu -->
        <div id="mobileMenu" class="hidden md:hidden mt-4 pb-4 border-t border-gray-200" role="navigation" aria-label="Mobile navigation">
            <nav class="flex flex-col space-y-3 mt-4">
                <a href="{{ url('/') }}" class="text-gray-700 hover:text-seova-orange font-medium py-2" aria-current="@if(request()->is('/')) page @endif" data-analytics-event="navm_home">Home</a>
                <a href="#services" class="text-gray-700 hover:text-seova-orange font-medium py-2" data-analytics-event="navm_services">Services</a>
                <div class="py-2">
                    <button id="mobileToolsToggle" class="text-gray-700 hover:text-seova-orange font-medium focus:outline-none focus:ring-2 focus:ring-seova-orange focus:ring-offset-2 rounded w-full text-left" aria-expanded="false" aria-controls="mobileToolsMenu" aria-label="Open mobile tools menu" data-analytics-event="navm_tools_toggle">
                        Tools 
                        <span aria-hidden="true">▼</span>
                    </button>
                    <div id="mobileToolsMenu" class="hidden ml-4 mt-2 space-y-2" role="menu" aria-labelledby="mobileToolsToggle">
                        {{-- <a href="{{ route('tools.keyword') }}" class="block text-sm text-gray-600 hover:text-seova-orange focus:text-seova-orange py-1 rounded focus:outline-none focus:ring-2 focus:ring-seova-orange focus:ring-offset-2" role="menuitem" data-analytics-event="navm_tools_keyword">Keyword Explorer</a> --}}
                        <a href="{{ route('tools.serp') }}" class="block text-sm text-gray-600 hover:text-seova-orange focus:text-seova-orange py-1 rounded focus:outline-none focus:ring-2 focus:ring-seova-orange focus:ring-offset-2" role="menuitem" data-analytics-event="navm_tools_serp">SERP Preview</a>
                        <a href="{{ route('tools.word-counter') }}" class="block text-sm text-gray-600 hover:text-seova-orange focus:text-seova-orange py-1 rounded focus:outline-none focus:ring-2 focus:ring-seova-orange focus:ring-offset-2" role="menuitem" data-analytics-event="navm_tools_word_counter">Word Counter</a>
                    </div>
                </div>
                <a href="#contact" class="text-gray-700 hover:text-seova-orange font-medium py-2" data-analytics-event="navm_contact">Contact</a>
                <a href="#" class="bg-blue-600 text-white px-4 py-2 rounded-md font-semibold hover:bg-blue-700 transition text-center mt-4" aria-label="Get a free SEO quote from Seova" data-analytics-event="navm_cta_quote">Get a Free Quote</a>
            </nav>
        </div>
    </div>
</header>
