<?php

namespace App\Controllers\Guru;

use App\Core\Controller;
use App\Models\UserModel;
use Config\Sidebar;
use App\Core\Session;


class GuruDashboardController extends Controller
{
    private UserModel $userModel;

    public function __construct()
    {
        parent::__construct();
        $this->userModel = new UserModel();
    }
     public function index(): void
    {
        $data['page'] = 'Dashboard';
        $data['subpage'] = false;
        $data['full_name'] = Session::get('full_name');
        $data['role'] = Session::get('role');
        $data['sidebar'] = Sidebar::get()[$_SESSION['role']];
        $this->renderDashboard('/layouts/comingsoon', $data);
    }
  
}
