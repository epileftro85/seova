<?php
namespace Routes;

require_once __DIR__.'/init.php';

get('/', 'HomeController@home');
get('/clients/daruma-software', 'HomeController@daruma');
post('/contact', 'HomeController@contact');

post('/register', 'AuthController@register');
post('/login', 'AuthController@doLogin');

get('/dashboard', 'DashController@index', ['auth']);

dispatch();