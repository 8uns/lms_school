<?php

namespace Config;

class Sidebar
{
    public static function get(): array
    {
        return [
            // SUPER ADMIN SIDEBAR
            'SuperAdmin' => [
                [
                    'CategoryLabel' => 'Main Menu',
                ],
                [
                    'label' => 'Dashboard',
                    'url' => '/administrator/dashboard',
                    'icon' => 'ri-dashboard-fill',
                    'sublabel' => false,
                ],
                // [
                //     'label' => 'User',
                //     'url' => '/administrator/user',
                //     'icon' => 'ri-arrow-drop-right-line',
                //     'sublabel' => [
                //         [
                //             'label' => 'Admin',
                //             'url' => '/administrator/user/admin',
                //         ],
                //         // [
                //         //     'label' => 'Guru',
                //         //     'url' => '/administrator/user/guru',
                //         // ],
                //         // [
                //         //     'label' => 'Siswa',
                //         //     'url' => '/administrator/user/siswa',
                //         // ],
                //     ]
                // ],

                [
                    'CategoryLabel' => 'User Management',
                ],
                [
                    'label' => 'Akun Admin',
                    'url' => '/administrator/user/admin',
                    'icon' => 'ri-user-settings-fill',
                    'sublabel' => false
                ],

                [
                    'CategoryLabel' => 'Security & Audit',
                ],
                [
                    'label' => 'Monitoring Log System',
                    'url' => '/administrator/user/admin',
                    'icon' => 'ri-mac-fill',
                    'sublabel' => false
                ],
                [
                    'label' => 'Force Logout User',
                    'url' => '/administrator/user/admin',
                    'icon' => 'ri-record-circle-fill',
                    'sublabel' => false
                ],

                [
                    'CategoryLabel' => 'Data Recovery',
                ],
                [
                    'label' => 'Restore Deleted Data',
                    'url' => '/administrator/user/admin',
                    'icon' => 'ri-reply-all-fill',
                    'sublabel' => false
                ],

                [
                    'CategoryLabel' => 'Maintenance',
                ],
                [
                    'label' => 'Backup & Restore Database',
                    'url' => '/administrator/user/admin',
                    'icon' => 'ri-hard-drive-3-fill',
                    'sublabel' => false
                ],

            ],
            // ADMIN SIDEBAR
            'Admin' => [



                [
                    'CategoryLabel' => 'Main Menu',
                ],
                [
                    'label' => 'Dashboard',
                    'url' => '/admin/dashboard',
                    'icon' => 'ri-dashboard-fill',
                    'sublabel' => false,
                ],


                [
                    'CategoryLabel' => 'Manajemen Akademik',
                ],
                [
                    'label' => 'Penugasan Guru',
                    'url' => '/admin/penugasan-guru',
                    'icon' => 'ri-info-card-fill',
                    'sublabel' => false
                ],
                [
                    'label' => 'Rombel Siswa',
                    'url' => '/admin/rombel-siswa',
                    'icon' => 'ri-group-3-fill',
                    'sublabel' => false
                ],
                [
                    'label' => 'Kurikulum/RPP',
                    'url' => '/admin/kurikulum-rpp',
                    'icon' => 'ri-book-read-fill',
                    'sublabel' => false,
                ],


                [
                    'CategoryLabel' => 'Master Data',
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

                [
                    'CategoryLabel' => 'Laporan',
                ],
                [
                    'label' => 'Rekapitulasi Data',
                    'url' => '/admin/rekap-data',
                    'icon' => 'ri-file-3-fill',
                    'sublabel' => false,
                ],

            ],
            // GURU SIDEBAR
            'Guru' => [
                [
                    'CategoryLabel' => 'Main Menu',
                ],
                [
                    'label' => 'Dashboard',
                    'url' => '/guru/dashboard',
                    'icon' => 'ri-dashboard-fill',
                    'sublabel' => false,
                ],


                [
                    'CategoryLabel' => 'Materi Belajar',
                ],
                [
                    'label' => 'Bahan Ajar',
                    'url' => '/guru/bahan-ajar',
                    'icon' => 'ri-info-card-fill',
                    'sublabel' => false
                ],
                [
                    'label' => 'Diskusi Materi',
                    'url' => '/guru/diskusi-materi',
                    'icon' => 'ri-group-3-fill',
                    'sublabel' => false
                ],
                [
                    'label' => 'Akses Perencanaan',
                    'url' => '/guru/akses-perencanaan',
                    'icon' => 'ri-book-read-fill',
                    'sublabel' => false,
                ],


                [
                    'CategoryLabel' => 'Evaluasi & Asesmen',
                ],
                [
                    'label' => 'Bank Soal',
                    'url' => '/guru/bank-soal',
                    'icon' => 'ri-user-2-fill',
                    'sublabel' => false
                ],
                [
                    'label' => 'Daftar Asesmen',
                    'url' => '/guru/daftar-asesmen',
                    'icon' => 'ri-user-5-fill',
                    'sublabel' => false
                ],
                [
                    'label' => 'Monitoring Ujian',
                    'url' => '/guru/monitoring-ujian',
                    'icon' => 'ri-home-6-fill',
                    'sublabel' => false,
                ],

                [
                    'CategoryLabel' => 'Penilaian',
                ],
                [
                    'label' => 'Koreksi Manual',
                    'url' => '/guru/koreksi-manual',
                    'icon' => 'ri-file-3-fill',
                    'sublabel' => false,
                ],
                [
                    'label' => 'Daftar Nilai',
                    'url' => '/guru/daftar-nilai',
                    'icon' => 'ri-file-3-fill',
                    'sublabel' => false,
                ],
            ],
            // SISWA SIDEBAR
            'Siswa' => [
                [
                    'CategoryLabel' => 'Main Menu',
                ],
                [
                    'label' => 'Dashboard',
                    'url' => '/admin/dashboard',
                    'icon' => 'ri-dashboard-fill',
                    'sublabel' => false,
                ],


                [
                    'CategoryLabel' => 'Akademik',
                ],
                [
                    'label' => 'Materi Pembelajaran',
                    'url' => '/admin/penugasan-guru',
                    'icon' => 'ri-info-card-fill',
                    'sublabel' => false
                ],
                [
                    'label' => 'Diskusi Saya',
                    'url' => '/admin/rombel-siswa',
                    'icon' => 'ri-group-3-fill',
                    'sublabel' => false
                ],


                [
                    'CategoryLabel' => 'Ujian & Tugas',
                ],
                [
                    'label' => 'Daftar Ujian Aktif',
                    'url' => '/admin/penugasan-guru',
                    'icon' => 'ri-info-card-fill',
                    'sublabel' => false
                ],
                [
                    'label' => 'Riwayat Ujian',
                    'url' => '/admin/rombel-siswa',
                    'icon' => 'ri-group-3-fill',
                    'sublabel' => false
                ],

                [
                    'CategoryLabel' => 'Hasil Belajar',
                ],
                [
                    'label' => 'Lihat Nilai',
                    'url' => '/admin/penugasan-guru',
                    'icon' => 'ri-info-card-fill',
                    'sublabel' => false
                ],

            ],
        ];
    }
}
