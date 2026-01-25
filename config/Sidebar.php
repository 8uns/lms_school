<?php

namespace Config;

class Sidebar
{
    public static function get(): array
    {
        return [
            'SuperAdmin' => [
                [
                    'label' => 'Dashboard',
                    'url' => '/administrator/dashboard',
                    'icon' => 'ri-dashboard-fill',
                    'sublabel' => false,
                ],
                [
                    'label' => 'User',
                    'url' => '/administrator/user',
                    'icon' => 'ri-arrow-drop-right-line',
                    'sublabel' => [
                        [
                            'label' => 'Admin',
                            'url' => '/administrator/user/admin',
                        ],
                        // [
                        //     'label' => 'Guru',
                        //     'url' => '/administrator/user/guru',
                        // ],
                        // [
                        //     'label' => 'Siswa',
                        //     'url' => '/administrator/user/siswa',
                        // ],
                    ]
                ],
                // [
                //     'label' => 'Kelas',
                //     'url' => '/administrator/dashboard',
                //     'icon' => 'ri-home-office-fill',
                //     'sublabel' => false,
                // ],
                // [
                //     'label' => 'Setting',
                //     'url' => '/administrator/dashboard',
                //     'icon' => 'ri-settings-4-fill',
                //     'sublabel' => false,
                // ],
            ],
            'Admin' => [
                [
                    'label' => 'Dashboard',
                    'url' => '/admin/dashboard',
                    'icon' => 'ri-dashboard-fill',
                    'sublabel' => false,
                ],
                [
                    'label' => 'Akun Guru',
                    'url' => '/admin/guru',
                    'icon' => 'ri-user-2-fill',
                    'sublabel' => false
                ],
                [
                    'label' => 'Akun Siswa',
                    'url' => '/admin/siswa',
                    'icon' => 'ri-user-5-fill',
                    'sublabel' => false
                ],
                [
                    'label' => 'Kelas',
                    'url' => '/admin/kelas',
                    'icon' => 'ri-home-6-fill',
                    'sublabel' => false,
                ],
                [
                    'label' => 'Tahun Ajaran',
                    'url' => '/admin/tahun-ajaran',
                    'icon' => 'ri-calendar-fill',
                    'sublabel' => false,
                ],
                 [
                    'label' => 'Mata Pelajaran',
                    'url' => '/admin/mata-pelajaran',
                    'icon' => 'ri-book-2-fill',
                    'sublabel' => false,
                ],
            ],
            
            // 'Guru' => [
            //     ['label' => 'Dashboard', 'url' => '/guru/dashboard', 'icon' => 'ri-dashboard-line'],
            //     ['label' => 'Materi', 'url' => '/guru/materi', 'icon' => 'ri-book-line'],
            // ],
            // 'Siswa' => [
            //     ['label' => 'Dashboard', 'url' => '/siswa/dashboard', 'icon' => 'ri-dashboard-line'],
            //     ['label' => 'Tugas', 'url' => '/siswa/tugas', 'icon' => 'ri-task-line'],
            // ]
        ];
    }
}
