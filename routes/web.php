<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\QuoteController;

Route::get('/', [HomeController::class, 'index'])->name('home');

// Quote form submission
Route::post('/quote', [QuoteController::class, 'store'])->name('quote.store');
