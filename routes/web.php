<?php

use App\Core\Router;
use App\Controllers\HomeController;
use App\Controllers\AuthController;
use App\Controllers\ProductController;
use App\Middlewares\AuthMiddleware;

Router::add(
    'GET',
    '/products/([0-9a-zA-Z]*)/categories/([0-9a-zA-Z]*)',
    ProductController::class,
    'categories'
);


Router::add('GET', '/', HomeController::class, 'index', [AuthMiddleware::class]);
Router::add('GET', '/about', HomeController::class, 'about');
Router::add('GET', '/login', AuthController::class, 'login');
Router::add('GET', '/register', HomeController::class, 'register');
Router::add('GET', '/notfound', AuthController::class, 'notfound');


Router::run();
