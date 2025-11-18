<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\QuoteController;
use App\Http\Controllers\ToolsController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostWriteController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/privacy-policy', [HomeController::class, 'privacy'])->name('privacy-policy');
Route::get('/terms-of-service', [HomeController::class, 'terms'])->name('terms-of-service');
Route::get('/refund-policy', [HomeController::class, 'refund'])->name('refund-policy');

// Sitemap for SEO
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');

// Blog posts routes
Route::prefix('posts')->name('posts.')->group(function () {
	// Read routes (always available)
	Route::get('/', [PostController::class, 'index'])->name('index');
	Route::get('/{slug}', [PostController::class, 'show'])->name('show');

	// Create/Edit routes (only in local/when enabled)
	if (config('app.blog_posts_editable')) {
		Route::get('/create', [PostWriteController::class, 'create'])->name('create');
		Route::post('/', [PostWriteController::class, 'store'])->name('store');
		Route::get('/{post}/edit', [PostWriteController::class, 'edit'])->name('edit');
		Route::put('/{post}', [PostWriteController::class, 'update'])->name('update');
		Route::post('/{post}/publish', [PostWriteController::class, 'publish'])->name('publish');
		Route::post('/{post}/unpublish', [PostWriteController::class, 'unpublish'])->name('unpublish');
	}
});

// Quote form submission
Route::post('/quote', [QuoteController::class, 'store'])->name('quote.store');

// Tools landing + individual tool routes
Route::prefix('tools')->name('tools.')->group(function () {
	Route::get('/', [ToolsController::class, 'index'])->name('index');
	// Route::get('/keyword-explorer', [ToolsController::class, 'keywordExplorer'])->name('keyword'); // Temporarily disabled - Pending API integration
	Route::get('/serp-preview', [ToolsController::class, 'serpPreview'])->name('serp');
	Route::get('/serp-preview/fetch', [ToolsController::class, 'serpPreviewFetch'])->name('serp.fetch');
	Route::get('/word-counter', [ToolsController::class, 'wordCounter'])->name('word-counter');
	Route::get('/meta-tag-generator', [ToolsController::class, 'metaTagGenerator'])->name('meta-tag-generator');
	Route::get('/json-schema-validator', [ToolsController::class, 'jsonSchemaValidator'])->name('json-schema-validator');
	Route::post('/json-schema-validator', [ToolsController::class, 'jsonSchemaValidator'])->name('json-schema-validator.store');
});
