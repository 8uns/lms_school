<?php

use App\Core\Helper;
use App\Core\Session;

/**
 * URL Helpers
 */
if (!function_exists('base_url')) {
    function base_url(string $path = ''): string
    {
        return Helper::baseUrl($path);
    }
}

if (!function_exists('get_flash')) {
    function get_flash(string $key = ''): ?string
    {
        return Session::getFlash($key);
    }
}

function dd($data)
{
    echo "<pre style='background: #222; color: #5ef764; padding: 20px; border-radius: 5px;'>";
    var_dump($data);
    echo "</pre>";
    die();
}
