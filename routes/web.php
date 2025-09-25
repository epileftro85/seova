<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\QuoteController;
use App\Http\Controllers\ToolsController;

Route::get('/', [HomeController::class, 'index'])->name('home');

// Quote form submission
Route::post('/quote', [QuoteController::class, 'store'])->name('quote.store');

// Tools landing + individual tool routes
Route::prefix('tools')->name('tools.')->group(function () {
	Route::get('/', [ToolsController::class, 'index'])->name('index');
	Route::get('/keyword-explorer', [ToolsController::class, 'keywordExplorer'])->name('keyword');
	Route::get('/meta-tag-analyzer', [ToolsController::class, 'metaTagAnalyzer'])->name('meta');
	Route::get('/site-crawler', [ToolsController::class, 'siteCrawler'])->name('crawler');
	Route::get('/serp-preview', [ToolsController::class, 'serpPreview'])->name('serp');
	Route::get('/serp-preview/fetch', [ToolsController::class, 'serpPreviewFetch'])->name('serp.fetch');
});
