<?php

namespace App\Controllers;

use App\Core\Controller;

class SuperAdminDashboardController extends Controller
{
    public function __construct()
    {
        return parent::__construct();
    }
    public function index(): void
    {
        $this->view('layouts/header');
        $this->view('layouts/sidebar');
        $this->view('layouts/dashboard');
        $this->view('layouts/footer');
    }
}
