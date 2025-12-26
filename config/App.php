<?php

namespace Config;

class App
{
    public static function get(): array
    {
        return [
            'name' => 'LMS SMP N 1 HALBAR',
            'base_url' => 'http://localhost:8888',
            'env' => 'development', // atau 'production'
            'timezone' => 'Asia/Jayapura'
        ];
    }
}
