<?php

use App\Core\Router;
use App\Controllers\SuperAdminDashboardController;
use App\Controllers\AdminDashboardController;
use App\Controllers\AdminGuruController;
use App\Controllers\AdminSiswaController;
use App\Controllers\AdminClassroomController;
use App\Controllers\AdminAcademicyearsController;
use App\Controllers\AdminSubjectController;
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



#####// SuperAdmin Dashboard
Router::add('GET', '/administrator/dashboard', SuperAdminDashboardController::class, 'index', [AuthMiddleware::class,  RoleMiddleware::class . ':SuperAdmin']); // dashboard superadmin
Router::add('GET', '/administrator/user/admin', SuperAdminDashboardController::class, 'userAdmin', [AuthMiddleware::class,  RoleMiddleware::class . ':SuperAdmin']); // menu manage user admin
Router::add('POST', '/administrator/user/admin', SuperAdminDashboardController::class, 'createAdmin', [AuthMiddleware::class,  RoleMiddleware::class . ':SuperAdmin']); // create admin
Router::add('POST', '/administrator/user/admin/([0-9]*)', SuperAdminDashboardController::class, 'updateAdmin', [AuthMiddleware::class,  RoleMiddleware::class . ':SuperAdmin']); // update admin
Router::add('GET', '/administrator/user/admin/del/([0-9]*)', SuperAdminDashboardController::class, 'deleteAdmin', [AuthMiddleware::class,  RoleMiddleware::class . ':SuperAdmin']); // delete admin


#####// Admin Dashboard
Router::add('GET', '/admin/dashboard', AdminDashboardController::class, 'index', [AuthMiddleware::class,  RoleMiddleware::class . ':Admin']); // dashboard admin

// guru management
Router::add('GET', '/admin/guru', AdminGuruController::class, 'index', [AuthMiddleware::class,  RoleMiddleware::class . ':Admin']); // menu manage guru
Router::add('POST', '/admin/guru', AdminGuruController::class, 'createGuru', [AuthMiddleware::class,  RoleMiddleware::class . ':Admin']); // create admin
Router::add('POST', '/admin/guru/([0-9]*)', AdminGuruController::class, 'updateGuru', [AuthMiddleware::class,  RoleMiddleware::class . ':Admin']); // update guru
Router::add('GET', '/admin/guru/del/([0-9]*)', AdminGuruController::class, 'deleteGuru', [AuthMiddleware::class,  RoleMiddleware::class . ':Admin']); // delete guru

// siswa management
Router::add('GET', '/admin/siswa', AdminSiswaController::class, 'index', [AuthMiddleware::class,  RoleMiddleware::class . ':Admin']); // menu manage siswa
Router::add('POST', '/admin/siswa', AdminSiswaController::class, 'createSiswa', [AuthMiddleware::class,  RoleMiddleware::class . ':Admin']); // create siswa
Router::add('POST', '/admin/siswa/([0-9]*)', AdminSiswaController::class, 'updateSiswa', [AuthMiddleware::class,  RoleMiddleware::class . ':Admin']); // update siswa
Router::add('GET', '/admin/siswa/del/([0-9]*)', AdminSiswaController::class, 'deleteSiswa', [AuthMiddleware::class,  RoleMiddleware::class . ':Admin']); // delete siswa

// kelas management
Router::add('GET', '/admin/kelas', AdminClassroomController::class, 'index', [AuthMiddleware::class,  RoleMiddleware::class . ':Admin']); // menu manage kelas
Router::add('POST', '/admin/kelas', AdminClassroomController::class, 'createKelas', [AuthMiddleware::class,  RoleMiddleware::class . ':Admin']); // create kelas
Router::add('POST', '/admin/kelas/([0-9]*)', AdminClassroomController::class, 'updateKelas', [AuthMiddleware::class,  RoleMiddleware::class . ':Admin']); // update kelas
Router::add('GET', '/admin/kelas/del/([0-9]*)', AdminClassroomController::class, 'deleteKelas', [AuthMiddleware::class,  RoleMiddleware::class . ':Admin']); // delete kelas

// tahun ajaran management
Router::add('GET', '/admin/tahun-ajaran', AdminAcademicyearsController::class, 'index', [AuthMiddleware::class,  RoleMiddleware::class . ':Admin']); // menu manage tahun ajaran
Router::add('POST', '/admin/tahun-ajaran', AdminAcademicyearsController::class, 'createTahunAjaran', [AuthMiddleware::class,  RoleMiddleware::class . ':Admin']); // create tahun ajaran
Router::add('POST', '/admin/tahun-ajaran/([0-9]*)', AdminAcademicyearsController::class, 'updateTahunAjaran', [AuthMiddleware::class,  RoleMiddleware::class . ':Admin']); // update tahun ajaran
Router::add('GET', '/admin/tahun-ajaran/del/([0-9]*)', AdminAcademicyearsController::class, 'deleteTahunAjaran', [AuthMiddleware::class,  RoleMiddleware::class . ':Admin']); // delete tahun ajaran

// mata pelajaran management
Router::add('GET', '/admin/mata-pelajaran', AdminSubjectController::class, 'index', [AuthMiddleware::class,  RoleMiddleware::class . ':Admin']); // menu manage mata pelajaran
Router::add('POST', '/admin/mata-pelajaran', AdminSubjectController::class, 'createMataPelajaran', [AuthMiddleware::class,  RoleMiddleware::class . ':Admin']); // create mata pelajaran
Router::add('POST', '/admin/mata-pelajaran/([0-9]*)', AdminSubjectController::class, 'updateMataPelajaran', [AuthMiddleware::class,  RoleMiddleware::class . ':Admin']); // update mata pelajaran
Router::add('GET', '/admin/mata-pelajaran/del/([0-9]*)', AdminSubjectController::class, 'deleteMataPelajaran', [AuthMiddleware::class,  RoleMiddleware::class . ':Admin']); // delete mata pelajaran

#####// Protected Routes (Butuh Login)
Router::add('GET', '/', AuthController::class, 'index', [AuthMiddleware::class, RoleMiddleware::class . ':Admin,SuperAdmin,Guru,Siswa']);

#####// Debug & Develop
Router::add('GET', '/componen', ProductController::class, 'componen');
Router::add('GET', '/card', ProductController::class, 'card');

Router::run();
