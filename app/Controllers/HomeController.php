<?php
namespace App\Controllers;

use App\Controllers\Controller;
use App\Utils\View;

class HomeController extends Controller
{
	public function home()
	{
        $this->redirectIfAuthenticated();

        View::make()
            ->with([
                'title' => 'Data-Driven SEO for Small Business Growth | Seova',
                'description' => 'Seova provides data-driven SEO virtual assistant services. Our  technical experts and a data analyst helps small businesses achieve measurable growth.',
                'csrf' => $this->set_csrf(),
                'javascript' => [
                    'js/jquery-3.3.1.min.js',
                    // 'js/bootstrap.bundle.min.js',
                    'js/singlePageNav.min.js',
                    // 'js/slick.js',
                    'js/parallax.min.js',
                    'js/main.js'
                ],
                'headjs' => [],
                'stylesheets' => [
                    'fontawesome/css/all.min.css',
                    'css/bootstrap.min.css',
                    // 'css/slick.css',
                    'css/main.css'
                ]
            ])
            ->display('home', 'layout');
	}
}