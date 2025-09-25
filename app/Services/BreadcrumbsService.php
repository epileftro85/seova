<?php

namespace App\Services;

use Illuminate\Http\Request;

class BreadcrumbsService
{
    /**
     * Generate breadcrumb items for the current request.
     * Home is always first. Hide breadcrumbs entirely on home route.
     * If you later map route names to human labels, extend the labelForSegment method.
     *
     * @return array{items: array<int,array{label:string,url:string}>, hidden: bool}
     */
    public function generate(Request $request): array
    {
        $isHome = $request->is('/');
        $items = [
            ['label' => 'Home', 'url' => url('/')],
        ];

        if (!$isHome) {
            $segments = $request->segments();
            $aggregate = '';
            foreach ($segments as $segment) {
                $aggregate .= '/' . $segment;
                $items[] = [
                    'label' => $this->labelForSegment($segment),
                    'url' => url($aggregate),
                ];
            }
        }

        return [
            'items' => $items,
            'hidden' => $isHome || count($items) === 1,
        ];
    }

    protected function labelForSegment(string $segment): string
    {
        // Basic transform; replace with route-name mapping if needed.
        return ucwords(str_replace(['-', '_'], ' ', $segment));
    }
}
