<?php

namespace App\Http\Middleware;

use App\Services\BreadcrumbsService;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class ShareBreadcrumbs
{
    public function __construct(protected BreadcrumbsService $service)
    {
    }

    public function handle(Request $request, Closure $next)
    {
        $result = $this->service->generate($request);
        View::share('breadcrumbs', $result['items']);
        View::share('breadcrumbsHidden', $result['hidden']);
        return $next($request);
    }
}
