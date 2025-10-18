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
	// Route::get('/keyword-explorer', [ToolsController::class, 'keywordExplorer'])->name('keyword'); // Temporarily disabled - Pending API integration
	Route::get('/serp-preview', [ToolsController::class, 'serpPreview'])->name('serp');
	Route::get('/serp-preview/fetch', [ToolsController::class, 'serpPreviewFetch'])->name('serp.fetch');
	Route::get('/word-counter', [ToolsController::class, 'wordCounter'])->name('word-counter');
	Route::get('/meta-tag-generator', [ToolsController::class, 'metaTagGenerator'])->name('meta-tag-generator');
	Route::get('/json-schema-validator', [ToolsController::class, 'jsonSchemaValidator'])->name('json-schema-validator');
	Route::post('/json-schema-validator', [ToolsController::class, 'jsonSchemaValidator'])->name('json-schema-validator.store');
});
