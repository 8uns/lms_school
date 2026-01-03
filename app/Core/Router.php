<?php

namespace App\Core;

use App\Core\View;


class Router
{
    private static array $routes = [];


    public static function add(
        string $method,
        string $path,
        string $controller,
        string $function,
        array $middleware = []
    ): void {
        self::$routes[] = [
            'method' => $method,
            'path' => $path,
            'controller' => $controller,
            'function' => $function,
            'middleware' => $middleware,
        ];
    }

    public static function run(): void
    {
        $path = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] :  "/";
        $method = $_SERVER['REQUEST_METHOD'];

        foreach (self::$routes as $route) {
            $pattern = "#^" . $route['path'] . "$#";
            if (preg_match($pattern, $path, $variables) && $method == $route['method']) {

                // call middleware
                foreach ($route['middleware'] as $middleware) {
                    // Pisahkan nama class dan parameter (misal: RoleMiddleware:admin,guru)
                    $parts = explode(':', $middleware);
                    $className = $parts[0];
                    $arguments = isset($parts[1]) ? explode(',', $parts[1]) : [];

                    // Buat instance dan kirim arguments ke constructor
                    $instance = new $className($arguments);
                    $instance->before();
                }

                $controller = new $route['controller'];
                $function = $route['function'];
                // $controller->$function();
                array_shift($variables);
                call_user_func_array([$controller, $function], $variables);

                return;
            }
        }

        http_response_code(404);
        View::render('errors/404');
        exit;
    }
}
