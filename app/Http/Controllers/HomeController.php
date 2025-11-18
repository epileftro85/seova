<?php

namespace App\Http\Controllers;

use App\Services\StructuredDataService;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __construct(private readonly StructuredDataService $structuredDataService)
    {
    }

    public function index(): View
    {
        return view('home', [
            'structuredData' => $this->structuredDataService->homeStructuredData(),
        ]);
    }

    public function privacy(): View
    {
        return view('privacy-policy');
    }

    public function terms(): View
    {
        return view('terms-of-service');
    }

    public function refund(): View
    {
        return view('refund-policy');
    }
}
