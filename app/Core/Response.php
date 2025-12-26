<?php

namespace App\Core;

class Response
{
    public static function setStatusCode(int $code)
    {
        http_response_code($code);
    }

    public static function json(array $data)
    {
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }
}
