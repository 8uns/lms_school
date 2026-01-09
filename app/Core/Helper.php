<?php

namespace App\Core;

use Config\App;

class Helper
{
    // base URL localhost, ip, or dns
    public static function baseUrl(string $path = ''): string
    {
        $protocol = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? "https" : "http";

        $host = $_SERVER['HTTP_HOST'];

        $script = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));

        $base_url = $protocol . "://" . $host . $script;

        return rtrim($base_url, '/') . $path;
    }


    // /**
    //  * Format Rupiah
    //  */
    public static function formatRupiah(int $angka): string
    {
        return "Rp " . number_format($angka, 0, ',', '.');
    }

    public static function redirect(string $url)
    {
        header("Location: " . self::baseUrl($url));
        exit;
    }
}
