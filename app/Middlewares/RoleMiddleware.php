<?php

namespace App\Middlewares;

use App\Core\Middleware;
use App\Core\Session;
use App\Core\Response;
use App\Core\View;

class RoleMiddleware implements Middleware
{
    private array $allowedRoles;

    public function __construct(array $roles = [])
    {
        $this->allowedRoles = $roles;
    }

    public function before(): void
    {
        $userRole = Session::get('role');

        if (!in_array($userRole, $this->allowedRoles)) {
            http_response_code(403);
            View::render('errors/403');
            exit;
        }

    }
}
