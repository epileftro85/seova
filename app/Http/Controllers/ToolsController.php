<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class ToolsController extends Controller
{
    public function index(): View
    {
        return view('tools.index');
    }

    public function keywordExplorer(): View
    {
        return view('tools.keyword-explorer');
    }

    public function metaTagAnalyzer(): View
    {
        return view('tools.meta-tag-analyzer');
    }

    public function siteCrawler(): View
    {
        return view('tools.site-crawler');
    }

    public function serpPreview(): View
    {
        return view('tools.serp-preview');
    }
}
