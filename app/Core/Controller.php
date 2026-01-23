<?php

namespace App\Core;

abstract class Controller
{
    protected Request $request;
    protected Response $response;

    public function __construct()
    {
        $this->request = new Request();
        $this->response = new Response();
    }

    public function view(string $view, $model = [])
    {
        View::render($view, $model);
    }

    public function redirect(string $url)
    {
        header("Location: " . base_url($url));
        exit;
    }

    public function renderDashboard(string $page, array $data = []): void
    {
        $this->view('layouts/header');
        $this->view('layouts/sidebar', $data);
        $this->view('layouts/navbar', $data);
        $this->view($page, $data);
        $this->view('layouts/footer');
    }
}
