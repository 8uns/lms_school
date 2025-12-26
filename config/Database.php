<?php

namespace Config;

class Database {
    public static function getConfig(): array {
        return [
            'host' => $_ENV['DB_HOST'] ?? 'localhost',
            'user' => $_ENV['DB_USER'] ?? 'admin',
            'pass' => $_ENV['DB_PASS'] ?? '#apacoba',
            'name' => $_ENV['DB_NAME'] ?? 'lms_school_db',
        ];
    }
}