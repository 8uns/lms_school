<?php

namespace App\Core;

class Request
{
    // Mengambil data $_POST dengan filter keamanan
    public function post(string $key = null, $default = null)
    {
        if ($key === null) return $_POST;
        $data = $_POST[$key] ?? $default;
        // Anti XSS Sederhana
        return is_string($data) ? htmlspecialchars($data) : $data;
    }

    public function get(string $key = null, $default = null)
    {
        if ($key === null) return $_GET;
        return $_GET[$key] ?? $default;
    }

    public function method(): string
    {
        return $_SERVER['REQUEST_METHOD'];
    }
}
