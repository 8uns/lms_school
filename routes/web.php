<?php

use App\Core\Router;
use App\Controllers\SuperAdminDashboardController;
use App\Controllers\AuthController;
use App\Middlewares\AuthMiddleware;
use App\Middlewares\RoleMiddleware;

// Contoh Penggunaan dengan banyak data
// Router::add(
//     'GET',
//     '/products/([0-9a-zA-Z]*)/categories/([0-9a-zA-Z]*)',
//     ProductController::class,
//     'categories'
// );
// Router::add('GET', '/products/([0-9a-zA-Z]*)/categories/([0-9a-zA-Z]*)', HomeController::class, 'categories', [AuthMiddleware::class]);

// Public Routes
Router::add('GET', '/login', AuthController::class, 'login');
Router::add('GET', '/logout', AuthController::class, 'logout');
Router::add('POST', '/login', AuthController::class, 'postLogin');


// Protected Routes (Butuh Login)
// Router::add('GET', '/', HomeController::class, 'index', [AuthMiddleware::class, RoleMiddleware::class . ':Admin,SuperAdmin']);
Router::add('GET', '/logout', AuthController::class, 'logout');
Router::add('GET', '/administrator/dashboard', SuperAdminDashboardController::class, 'index', [AuthMiddleware::class,  RoleMiddleware::class . ':SuperAdmin']);

Router::run();
