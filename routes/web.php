<?php

use App\Core\Router;
use App\Controllers\SuperAdminDashboardController;
use App\Controllers\AdminDashboardController;
use App\Controllers\AuthController;
use App\Controllers\ProductController;
use App\Controllers\RegisterController;
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

// Auth & Register
Router::add('GET', '/login', AuthController::class, 'login');
Router::add('POST', '/login', AuthController::class, 'postLogin');
Router::add('GET', '/register', RegisterController::class, 'register');
Router::add('POST', '/register', RegisterController::class, 'postregister');
Router::add('GET', '/logout', AuthController::class, 'logout');
Router::add('GET', '/logout', AuthController::class, 'logout');



// SuperAdmin Dashboard
Router::add('GET', '/administrator/dashboard', SuperAdminDashboardController::class, 'index', [AuthMiddleware::class,  RoleMiddleware::class . ':SuperAdmin']); // dashboard superadmin
Router::add('GET', '/administrator/user/admin', SuperAdminDashboardController::class, 'userAdmin', [AuthMiddleware::class,  RoleMiddleware::class . ':SuperAdmin']); // menu manage user admin
Router::add('POST', '/administrator/user/admin', SuperAdminDashboardController::class, 'createAdmin', [AuthMiddleware::class,  RoleMiddleware::class . ':SuperAdmin']); // create admin
Router::add('POST', '/administrator/user/admin/([0-9]*)', SuperAdminDashboardController::class, 'updateAdmin', [AuthMiddleware::class,  RoleMiddleware::class . ':SuperAdmin']); // update admin
Router::add('GET', '/administrator/user/admin/del/([0-9]*)', SuperAdminDashboardController::class, 'deleteAdmin', [AuthMiddleware::class,  RoleMiddleware::class . ':SuperAdmin']); // delete admin


// Admin Dashboard
Router::add('GET', '/admin/dashboard', AdminDashboardController::class, 'index', [AuthMiddleware::class,  RoleMiddleware::class . ':Admin']); // dashboard admin
Router::add('GET', '/admin/guru', AdminDashboardController::class, 'guru', [AuthMiddleware::class,  RoleMiddleware::class . ':Admin']); // menu manage guru
Router::add('POST', '/admin/guru', AdminDashboardController::class, 'createGuru', [AuthMiddleware::class,  RoleMiddleware::class . ':Admin']); // create admin
Router::add('POST', '/admin/guru/([0-9]*)', AdminDashboardController::class, 'updateGuru', [AuthMiddleware::class,  RoleMiddleware::class . ':Admin']); // update admin
Router::add('GET', '/admin/guru/del/([0-9]*)', AdminDashboardController::class, 'deleteGuru', [AuthMiddleware::class,  RoleMiddleware::class . ':Admin']); // delete admin




// Protected Routes (Butuh Login)
Router::add('GET', '/', AuthController::class, 'index', [AuthMiddleware::class, RoleMiddleware::class . ':Admin,SuperAdmin,Guru,Siswa']);

// Debug & Develop
Router::add('GET', '/componen', ProductController::class, 'componen');
Router::add('GET', '/card', ProductController::class, 'card');

Router::run();
