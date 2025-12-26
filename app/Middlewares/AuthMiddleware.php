<?php

namespace App\Middlewares;

use App\Core\Middleware;
use App\Core\View;

class AuthMiddleware implements Middleware
{
    function before(): void
    {
        session_start();
        if (!isset($_SESSION['user'])) {
            View::render("login");
            exit;
        }
    }
}
