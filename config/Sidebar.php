<?php

namespace Config;

class Sidebar
{
    public static function get(): array
    {
        return [
            'Guru' => [
                ['label' => 'Dashboard', 'url' => '/guru/dashboard', 'icon' => 'ri-dashboard-line'],
                ['label' => 'Materi', 'url' => '/guru/materi', 'icon' => 'ri-book-line'],
            ],
            'Siswa' => [
                ['label' => 'Dashboard', 'url' => '/siswa/dashboard', 'icon' => 'ri-dashboard-line'],
                ['label' => 'Tugas', 'url' => '/siswa/tugas', 'icon' => 'ri-task-line'],
            ]
        ];
    }
}
