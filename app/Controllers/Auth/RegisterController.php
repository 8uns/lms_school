<?php

namespace App\Controllers\Auth;

use App\Core\Controller;
use App\Core\Session;
use App\Models\UserModel;

class RegisterController extends Controller
{
    private UserModel $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        return parent::__construct();
    }

    public function register()
    {
        if (Session::get('user_id')) {
            $this->redirect('/');
        }
        $this->view('layouts/header');
        $this->view('auth/register');
        $this->view('layouts/footer');
    }

    public function postregister()
    {
        if ($this->userModel->create($_POST)) {
            Session::setFlash('doneregis', "Berhasil Melakukan Registrasi!");
            $this->redirect('/login');
        }
        Session::setFlash('error_message', "Gagal Melakukan Registrasi!");
        $this->redirect('/login');
        return false;
    }
}
