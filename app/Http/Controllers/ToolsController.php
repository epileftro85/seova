<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

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

    public function wordCounter(): View
    {
        return view('tools.word-counter');
    }

    /**
     * Lightweight metadata fetcher for SERP preview tool.
     * Accepts ?url=https://example.com and returns JSON: { title, description }
     */
    public function serpPreviewFetch(Request $request)
    {
        $request->validate([
            'url' => ['required','url','max:2048']
        ]);

        $url = $request->input('url');
        try {
            $response = Http::timeout(8)->withHeaders([
                'User-Agent' => 'SeovaMetaBot/1.0 (+https://seova.pro/tools/serp-preview)'
            ])->get($url);

            if(!$response->ok()) {
                return response()->json(['error' => 'Unable to fetch the URL (HTTP '.$response->status().').'], 422);
            }

            $html = $response->body();

            // Very small / fast parse: regex fallbacks (we avoid full DOM parser dependency here)
            $title = null;
            if(preg_match('/<title[^>]*>(.*?)<\/title>/is', $html, $m)) {
                $title = html_entity_decode(trim($m[1]));
            }
            $description = null;
            if(preg_match('/<meta[^>]+name=["\']description["\'][^>]*content=["\']([^"\']+)["\'][^>]*>/i', $html, $m)) {
                $description = html_entity_decode(trim($m[1]));
            } elseif(preg_match('/<meta[^>]+content=["\']([^"\']+)["\'][^>]*name=["\']description["\'][^>]*>/i', $html, $m)) { // attribute order variation
                $description = html_entity_decode(trim($m[1]));
            }

            $title = Str::limit($title ?? '', 120, ''); // provide generous limit, client truncates
            $description = Str::limit($description ?? '', 500, '');

            return response()->json([
                'title' => $title ?: null,
                'description' => $description ?: null,
                'fetched' => now()->toIso8601String(),
            ]);
        } catch(\Throwable $e) {
            return response()->json(['error' => 'Fetch failed: '.$e->getMessage()], 500);
        }
    }
}
