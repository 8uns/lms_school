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
}
