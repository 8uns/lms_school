<?php
$data['superadmin_name'] = "superadmin_name";
$data['active_academic_year'] = "active_academic_year";
$data['total_admins'] = 10;
$data['total_teachers'] = 50;
$data['total_students'] = 200;
$data['today_access_logs_count'] = 15;
$data['recent_logs'] = [
    [
        'full_name' => 'John Doe',
        'role' => 'Admin',
        'action' => 'Login',
        'ip_address' => '180.12.12.12',
        'created_at' => '2024-06-01 10:00:00',
    ],
];
$data['deleted_users_count'] = 5;
$data['deleted_subjects_count'] = 2;
$data['inactive_academic_years_count'] = 1;
$data['db_name'] = 'lms_database';
$data['db_version'] = '8.0.23';
$data['last_backup_time'] = '2024-06-01 09:00:00';

?>
<?php
/**
 * @var array $data
 */
?>

<!-- main start -->
<div class="ml-0 md:ml-72 sm:ml-0 bg-gray-100 min-h-screen">
    <div class="pl-15 pr-15 pb-15 pt-0">
        <div class="grid grid-cols-1 gap-6">

            <!-- BANNER WELCOME & TAHUN AJARAN -->
            <div class="bg-white rounded-2xl border border-gray-100 p-8 shadow-xs flex flex-col md:flex-row items-center justify-between gap-4">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-gray-100 rounded-2xl flex items-center justify-center text-gray-700">
                        <i class="ri-user-settings-fill text-2xl"></i>
                    </div>
                    <div>
                        <span class="text-xs font-bold uppercase tracking-wider text-gray-400">Super Administrator System</span>
                        <h3 class="text-xl font-bold text-gray-800">Selamat Datang, <?= $data['superadmin_name'] ?>!</h3>
                    </div>
                </div>
                <div>
                    <span class="inline-flex items-center gap-2 bg-gray-100 text-gray-700 px-5 py-3 rounded-2xl border border-gray-200 text-sm font-bold">
                        <i class="ri-calendar-event-fill text-gray-500"></i> Tahun Ajaran Aktif: <?= $data['active_academic_year'] ?>
                    </span>
                </div>
            </div>

            <!-- STATS CARDS GRID -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

                <!-- CARD: TOTAL ADMIN -->
                <div class="bg-white rounded-2xl border border-gray-100 p-6 flex flex-col justify-between">
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-sm font-bold text-gray-500">Total Admin</span>
                        <div class="w-10 h-10 bg-gray-100 rounded-2xl flex items-center justify-center text-gray-700">
                            <i class="ri-user-settings-fill text-lg"></i>
                        </div>
                    </div>
                    <div>
                        <div class="text-3xl font-extrabold text-gray-800 mb-1"><?= $data['total_admins'] ?></div>
                        <p class="text-xs text-gray-400">Pengelola Sistem</p>
                    </div>
                    <div class="pt-4 border-t border-gray-100 mt-3">
                        <a href="<?= base_url('/administrator/user/admin') ?>" class="text-xs font-bold text-blue-600 hover:text-indigo-600 flex items-center gap-1 transition-colors">
                            Kelola Admin <i class="ri-arrow-right-s-line"></i>
                        </a>
                    </div>
                </div>

                <!-- CARD: TOTAL GURU -->
                <div class="bg-white rounded-2xl border border-gray-100 p-6 flex flex-col justify-between">
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-sm font-bold text-gray-500">Total Guru</span>
                        <div class="w-10 h-10 bg-gray-100 rounded-2xl flex items-center justify-center text-gray-700">
                            <i class="ri-user-2-fill text-lg"></i>
                        </div>
                    </div>
                    <div>
                        <div class="text-3xl font-extrabold text-gray-800 mb-1"><?= $data['total_teachers'] ?></div>
                        <p class="text-xs text-gray-400">Tenaga Pengajar</p>
                    </div>
                    <div class="pt-4 border-t border-gray-100 mt-3">
                        <a href="<?= base_url('/administrator/user/teacher') ?>" class="text-xs font-bold text-blue-600 hover:text-indigo-600 flex items-center gap-1 transition-colors">
                            Lihat Rincian <i class="ri-arrow-right-s-line"></i>
                        </a>
                    </div>
                </div>

                <!-- CARD: TOTAL SISWA -->
                <div class="bg-white rounded-2xl border border-gray-100 p-6 flex flex-col justify-between">
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-sm font-bold text-gray-500">Total Siswa</span>
                        <div class="w-10 h-10 bg-gray-100 rounded-2xl flex items-center justify-center text-gray-700">
                            <i class="ri-user-5-fill text-lg"></i>
                        </div>
                    </div>
                    <div>
                        <div class="text-3xl font-extrabold text-gray-800 mb-1"><?= $data['total_students'] ?></div>
                        <p class="text-xs text-gray-400">Peserta Didik Aktif</p>
                    </div>
                    <div class="pt-4 border-t border-gray-100 mt-3">
                        <a href="<?= base_url('/administrator/user/student') ?>" class="text-xs font-bold text-blue-600 hover:text-indigo-600 flex items-center gap-1 transition-colors">
                            Lihat Rincian <i class="ri-arrow-right-s-line"></i>
                        </a>
                    </div>
                </div>

                <!-- CARD: LOG HARI INI -->
                <div class="bg-white rounded-2xl border border-gray-100 p-6 flex flex-col justify-between">
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-sm font-bold text-gray-500">Aktivitas Hari Ini</span>
                        <div class="w-10 h-10 bg-gray-100 rounded-2xl flex items-center justify-center text-gray-700">
                            <i class="ri-mac-fill text-lg"></i>
                        </div>
                    </div>
                    <div>
                        <div class="text-3xl font-extrabold text-gray-800 mb-1"><?= $data['today_access_logs_count'] ?></div>
                        <p class="text-xs text-gray-400">Akses Teratat</p>
                    </div>
                    <div class="pt-4 border-t border-gray-100 mt-3">
                        <span class="inline-block px-3 py-1 rounded-2xl text-xs font-semibold bg-gray-100 text-gray-700">
                            System Active
                        </span>
                    </div>
                </div>

            </div>

            <!-- AKSES PINTAS MODUL -->
            <div class="bg-white rounded-2xl border border-gray-100">
                <div class="font-bold py-6 px-10 border-b border-gray-200">
                    <h6 class="text-lg">Akses Pintas Modul</h6>
                    <p class="text-xs text-gray-400 font-normal mt-1">Navigasi cepat ke area manajemen penting</p>
                </div>
                <div class="p-10">
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                        <a href="<?= base_url('/administrator/user/admin') ?>" class="p-4 rounded-2xl border border-gray-200 hover:border-blue-500 hover:shadow-xs transition-all flex items-center justify-between group">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-gray-100 rounded-xl flex items-center justify-center text-gray-700 group-hover:bg-blue-600 group-hover:text-white transition-colors">
                                    <i class="ri-user-settings-fill text-lg"></i>
                                </div>
                                <span class="text-sm font-bold text-gray-700 group-hover:text-blue-600 transition-colors">Kelola Admin</span>
                            </div>
                            <i class="ri-arrow-right-s-line text-gray-400 group-hover:text-blue-600 transition-colors"></i>
                        </a>

                        <a href="<?= base_url('/administrator/logs') ?>" class="p-4 rounded-2xl border border-gray-200 hover:border-blue-500 hover:shadow-xs transition-all flex items-center justify-between group">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-gray-100 rounded-xl flex items-center justify-center text-gray-700 group-hover:bg-blue-600 group-hover:text-white transition-colors">
                                    <i class="ri-mac-fill text-lg"></i>
                                </div>
                                <span class="text-sm font-bold text-gray-700 group-hover:text-blue-600 transition-colors">Log Monitoring</span>
                            </div>
                            <i class="ri-arrow-right-s-line text-gray-400 group-hover:text-blue-600 transition-colors"></i>
                        </a>

                        <a href="<?= base_url('/administrator/sessions') ?>" class="p-4 rounded-2xl border border-gray-200 hover:border-blue-500 hover:shadow-xs transition-all flex items-center justify-between group">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-gray-100 rounded-xl flex items-center justify-center text-gray-700 group-hover:bg-blue-600 group-hover:text-white transition-colors">
                                    <i class="ri-record-circle-fill text-lg"></i>
                                </div>
                                <span class="text-sm font-bold text-gray-700 group-hover:text-blue-600 transition-colors">Force Logout</span>
                            </div>
                            <i class="ri-arrow-right-s-line text-gray-400 group-hover:text-blue-600 transition-colors"></i>
                        </a>

                        <a href="<?= base_url('/administrator/backup') ?>" class="p-4 rounded-2xl border border-gray-200 hover:border-blue-500 hover:shadow-xs transition-all flex items-center justify-between group">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-gray-100 rounded-xl flex items-center justify-center text-gray-700 group-hover:bg-blue-600 group-hover:text-white transition-colors">
                                    <i class="ri-hard-drive-3-fill text-lg"></i>
                                </div>
                                <span class="text-sm font-bold text-gray-700 group-hover:text-blue-600 transition-colors">Backup Database</span>
                            </div>
                            <i class="ri-arrow-right-s-line text-gray-400 group-hover:text-blue-600 transition-colors"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- SECTION MONITORING & STATUS SISTEM -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                <!-- TABEL LOG AKTIVITAS -->
                <div class="lg:col-span-2 bg-white rounded-2xl border border-gray-100 flex flex-col justify-between">
                    <div>
                        <div class="font-bold py-6 px-8 border-b border-gray-200 flex items-center justify-between">
                            <div>
                                <h6 class="text-lg">Aktivitas Sistem Terbaru</h6>
                                <p class="text-xs text-gray-400 font-normal mt-1">Riwayat akses pengguna ke platform</p>
                            </div>
                            <a href="<?= base_url('/administrator/logs') ?>" class="text-xs font-bold text-blue-600 hover:text-indigo-600 flex items-center gap-1 transition-colors">
                                Lihat Semua <i class="ri-arrow-right-s-line"></i>
                            </a>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full text-left text-sm">
                                <thead class="bg-gray-50 border-b border-gray-100 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    <tr>
                                        <th class="py-3 px-6">Pengguna</th>
                                        <th class="py-3 px-6">Role</th>
                                        <th class="py-3 px-6">Aksi</th>
                                        <th class="py-3 px-6">IP Address</th>
                                        <th class="py-3 px-6">Waktu</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100 text-gray-700">
                                    <?php if (!empty($data['recent_logs'])): ?>
                                        <?php foreach ($data['recent_logs'] as $log): ?>
                                            <tr class="hover:bg-gray-50/50 transition-colors">
                                                <td class="py-4 px-6 font-bold text-gray-800"><?= $log['full_name'] ?></td>
                                                <td class="py-4 px-6">
                                                    <span class="px-2.5 py-1 rounded-xl text-xs font-semibold bg-gray-100 text-gray-700">
                                                        <?= $log['role'] ?>
                                                    </span>
                                                </td>
                                                <td class="py-4 px-6"><?= $log['action'] ?></td>
                                                <td class="py-4 px-6"><code class="text-xs bg-gray-100 px-2 py-1 rounded-lg text-gray-600 font-mono"><?= $log['ip_address'] ?></code></td>
                                                <td class="py-4 px-6 text-xs text-gray-400"><?= $log['created_at'] ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="5" class="py-8 text-center text-gray-400 text-xs">Belum ada riwayat aktivitas.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- SIDEBAR STATUS (SOFT DELETE & DB INFO) -->
                <div class="space-y-6">

                    <!-- SOFT DELETE STATS -->
                    <div class="bg-white rounded-2xl border border-gray-100 p-6">
                        <div class="flex items-center justify-between pb-4 border-b border-gray-100 mb-4">
                            <h6 class="font-bold text-gray-800">Data Terhapus</h6>
                            <span class="text-xs font-semibold text-gray-400">Soft Delete</span>
                        </div>
                        <div class="space-y-3 text-xs">
                            <div class="flex justify-between items-center py-1">
                                <span class="text-gray-600 flex items-center gap-2"><i class="ri-user-line text-gray-400"></i> Akun User</span>
                                <span class="font-extrabold text-gray-800 bg-gray-100 px-2.5 py-1 rounded-xl"><?= $data['deleted_users_count'] ?></span>
                            </div>
                            <div class="flex justify-between items-center py-1">
                                <span class="text-gray-600 flex items-center gap-2"><i class="ri-book-2-line text-gray-400"></i> Mata Pelajaran</span>
                                <span class="font-extrabold text-gray-800 bg-gray-100 px-2.5 py-1 rounded-xl"><?= $data['deleted_subjects_count'] ?></span>
                            </div>
                            <div class="flex justify-between items-center py-1">
                                <span class="text-gray-600 flex items-center gap-2"><i class="ri-calendar-line text-gray-400"></i> Tahun Ajaran Nonaktif</span>
                                <span class="font-extrabold text-gray-800 bg-gray-100 px-2.5 py-1 rounded-xl"><?= $data['inactive_academic_years_count'] ?></span>
                            </div>
                        </div>
                        <div class="pt-4 mt-2 border-t border-gray-100">
                            <a href="<?= base_url('/administrator/trash') ?>" class="w-full inline-flex justify-center items-center gap-2 text-xs font-bold text-red-600 bg-red-50 hover:bg-red-100 py-3 rounded-2xl transition-colors">
                                <i class="ri-refresh-line"></i> Buka Menu Restore
                            </a>
                        </div>
                    </div>

                    <!-- DB INFO -->
                    <div class="bg-white rounded-2xl border border-gray-100 p-6">
                        <div class="flex items-center justify-between pb-4 border-b border-gray-100 mb-4">
                            <h6 class="font-bold text-gray-800">Server Database</h6>
                            <i class="ri-database-2-line text-gray-400"></i>
                        </div>
                        <div class="space-y-3 text-xs">
                            <div class="flex justify-between items-center">
                                <span class="text-gray-500">Database</span>
                                <span class="font-bold text-gray-800"><?= $data['db_name'] ?></span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-500">Versi Engine</span>
                                <span class="font-bold text-gray-800"><?= $data['db_version'] ?></span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-500">Backup Terakhir</span>
                                <span class="font-bold text-gray-800"><?= $data['last_backup_time'] ?></span>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </div>
</div>
<!-- main end -->