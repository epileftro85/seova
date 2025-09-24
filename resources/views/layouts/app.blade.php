<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'Seova – SEO Virtual Assistant')</title>
    
    <!-- SEO Meta Tags -->
    <meta name="description" content="@yield('description', 'Seova is your SEO Virtual Assistant. Get technical SEO audits, keyword strategy, and data-driven insights to grow your business organically.')">
    <meta name="keywords" content="@yield('keywords', 'SEO, search engine optimization, virtual assistant, keyword research, technical SEO, site audit, SEO tools')">
    <meta name="author" content="Seova SEO Assistant">
    <meta name="robots" content="@yield('robots', 'index, follow')">
    
    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="@yield('og_title', 'Seova – SEO Virtual Assistant')">
    <meta property="og:description" content="@yield('og_description', 'Smart SEO solutions for small businesses. Technical expertise and data analysis to help you grow organically.')">
    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="@yield('og_image', asset('img/seova-og-image.jpg'))">
    <meta property="og:site_name" content="Seova">
    
    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('twitter_title', 'Seova – SEO Virtual Assistant')">
    <meta name="twitter:description" content="@yield('twitter_description', 'Smart SEO solutions for small businesses. Get technical expertise and data analysis.')">
    <meta name="twitter:image" content="@yield('twitter_image', asset('img/seova-twitter-card.jpg'))">
    
    <!-- Canonical URL -->
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Favicons -->
    <link rel="apple-touch-icon" sizes="180x180" href="/img/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/img/favicon/favicon-16x16.png">
    <link rel="manifest" href="/img/favicon/site.webmanifest">
    
    @yield('meta')
    
    <!-- CSS -->
    @vite('resources/css/app.css')
    
    @stack('styles')
</head>
<body class="bg-gray-50 text-gray-800 font-sans">
    <!-- Skip Links for Accessibility -->
    <a href="#main-content" class="sr-only focus:not-sr-only focus:absolute focus:top-4 focus:left-4 bg-blue-600 text-white px-4 py-2 rounded-md z-50">Skip to main content</a>

    @include('partials.navbar')

    @yield('hero')

    <!-- Main Content -->
    <main id="main-content" role="main">
        @yield('content')
    </main>

    @yield('additional-sections')

    <!-- CTA Footer (optional for marketing pages) -->
    @if(isset($showCTA) && $showCTA)
        <section class="bg-white text-center py-12" aria-labelledby="cta-heading">
            <h2 id="cta-heading" class="text-2xl font-bold mb-4">Ready to grow smarter?</h2>
            <p class="text-gray-600 mb-6">Let's talk. Get a free quote and discover how Seova can help your business thrive.</p>
            <a href="#" class="bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 transition" aria-label="Get a free SEO quote from Seova">Get a Free Quote</a>
        </section>
    @endif

    <!-- Footer -->
    <footer class="bg-gray-800 text-white text-center py-6" role="contentinfo">
        <p>&copy; {{ date('Y') }} Seova.pro — Data-Driven SEO Virtual Assistant. All rights reserved.</p>
    </footer>

    <!-- JavaScript -->
    @vite('resources/js/app.js')
    @stack('scripts')
</body>
</html>