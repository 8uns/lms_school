<?php

namespace Config;

class Auth
{
    public static function get(): array
    {
        return [
            'session_name' => 'LMS_SESSION_ID',
            'login_expiry' => 3600, // 1 jam
            'password_min_length' => 8
        ];
    }
}
