<?php

use App\Services\BreadcrumbsService;
use Illuminate\Http\Request;

it('generates breadcrumbs for nested path', function () {
    $service = new BreadcrumbsService();
    $request = Request::create('/services/advanced-audit', 'GET');

    $data = $service->generate($request);

    expect($data['hidden'])->toBeFalse();
    expect($data['items'])->toHaveCount(3);
    expect($data['items'][0]['label'])->toBe('Home');
    expect($data['items'][1]['label'])->toBe('Services');
    expect($data['items'][2]['label'])->toBe('Advanced Audit');
});

it('hides breadcrumbs on home', function () {
    $service = new BreadcrumbsService();
    $request = Request::create('/', 'GET');

    $data = $service->generate($request);

    expect($data['hidden'])->toBeTrue();
    expect($data['items'])->toHaveCount(1);
});
