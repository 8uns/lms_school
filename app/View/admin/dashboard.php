<?php
/**
 * @var array $data
 */
?>

<!-- main start -->
<main class="md:ml-72 min-h-screen bg-slate-50 dark:bg-slate-900/90 text-slate-800 dark:text-slate-100 transition-colors duration-300">
    <div class="p-4 sm:p-6 lg:p-8 space-y-6">

        <!-- BANNER TAHUN AJARAN -->
        <div class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-100 dark:border-slate-700/80 p-6 sm:p-8 shadow-xs flex flex-col md:flex-row items-start md:items-center justify-between gap-5 transition-colors">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-2xl bg-blue-50 dark:bg-sky-950/40 text-blue-600 dark:text-sky-400 flex items-center justify-center shrink-0">
                    <i class="ri-calendar-event-fill text-2xl"></i>
                </div>
                <div>
                    <span class="text-[11px] font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500">Tahun Ajaran Aktif</span>
                    <h3 class="text-lg sm:text-xl font-bold text-slate-800 dark:text-white mt-0.5">
                        <?= htmlspecialchars(($data['activeYear']['year_name'] ?? '-') . ' ' . ($data['activeYear']['semester'] ?? '')) ?>
                    </h3>
                </div>
            </div>
            <a href="<?= base_url('/admin/tahun-ajaran') ?>" class="w-full md:w-auto inline-flex items-center justify-center gap-2 cursor-pointer bg-gradient-to-r from-blue-900 via-blue-700 to-sky-500 hover:from-blue-950 hover:via-blue-800 hover:to-sky-600 text-white py-2.5 px-5 rounded-2xl text-xs sm:text-sm font-bold shadow-xs hover:shadow-md transition-all active:scale-[0.98]">
                <i class="ri-settings-3-line text-base"></i>
                <span>Kelola Tahun Ajaran</span>
            </a>
        </div>

        <!-- STATS CARDS GRID -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 sm:gap-6">

            <!-- CARD: GURU -->
            <div class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-100 dark:border-slate-700/80 p-5 sm:p-6 flex flex-col justify-between shadow-xs transition-colors hover:border-blue-200 dark:hover:border-blue-900/50">
                <div>
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Guru</span>
                        <div class="w-10 h-10 rounded-xl bg-blue-50 dark:bg-sky-950/40 text-blue-600 dark:text-sky-400 flex items-center justify-center">
                            <i class="ri-user-2-fill text-lg"></i>
                        </div>
                    </div>
                    <div class="text-3xl font-extrabold text-slate-800 dark:text-white mb-4">
                        <?= htmlspecialchars($data['totalTeachers'] ?? 0) ?>
                    </div>
                </div>
                <div class="space-y-1.5 pt-3 border-t border-slate-100 dark:border-slate-700/60 text-xs">
                    <div class="flex justify-between text-slate-500 dark:text-slate-400">
                        <span>Sudah Penugasan:</span>
                        <span class="font-bold text-slate-800 dark:text-slate-200"><?= htmlspecialchars($data['assignedTeachers'] ?? 0) ?></span>
                    </div>
                    <div class="flex justify-between text-slate-500 dark:text-slate-400">
                        <span>Belum Penugasan:</span>
                        <span class="font-bold text-rose-600 dark:text-rose-400"><?= htmlspecialchars($data['unassignedTeachers'] ?? 0) ?></span>
                    </div>
                </div>
            </div>

            <!-- CARD: MATA PELAJARAN -->
            <div class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-100 dark:border-slate-700/80 p-5 sm:p-6 flex flex-col justify-between shadow-xs transition-colors hover:border-blue-200 dark:hover:border-blue-900/50">
                <div>
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Mata Pelajaran</span>
                        <div class="w-10 h-10 rounded-xl bg-sky-50 dark:bg-sky-950/40 text-sky-600 dark:text-sky-400 flex items-center justify-center">
                            <i class="ri-book-2-fill text-lg"></i>
                        </div>
                    </div>
                    <div class="text-3xl font-extrabold text-slate-800 dark:text-white mb-1">
                        <?= htmlspecialchars($data['totalSubjects'] ?? 0) ?>
                    </div>
                    <p class="text-xs text-slate-400 dark:text-slate-500">Terdaftar di Sistem</p>
                </div>
                <div class="pt-3 border-t border-slate-100 dark:border-slate-700/60 mt-4">
                    <a href="<?= base_url('/admin/mata-pelajaran') ?>" class="text-xs font-bold text-blue-600 dark:text-sky-400 hover:underline inline-flex items-center gap-1 transition-colors">
                        <span>Lihat Rincian</span>
                        <i class="ri-arrow-right-s-line"></i>
                    </a>
                </div>
            </div>

            <!-- CARD: KELAS -->
            <div class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-100 dark:border-slate-700/80 p-5 sm:p-6 flex flex-col justify-between shadow-xs transition-colors hover:border-blue-200 dark:hover:border-blue-900/50">
                <div>
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Ruang Kelas</span>
                        <div class="w-10 h-10 rounded-xl bg-emerald-50 dark:bg-emerald-950/40 text-emerald-600 dark:text-emerald-400 flex items-center justify-center">
                            <i class="ri-home-6-fill text-lg"></i>
                        </div>
                    </div>
                    <div class="text-3xl font-extrabold text-slate-800 dark:text-white mb-1">
                        <?= htmlspecialchars($data['totalClassrooms'] ?? 0) ?>
                    </div>
                    <p class="text-xs text-slate-400 dark:text-slate-500">Rombongan Belajar</p>
                </div>
                <div class="pt-3 border-t border-slate-100 dark:border-slate-700/60 mt-4">
                    <a href="<?= base_url('/admin/kelas') ?>" class="text-xs font-bold text-blue-600 dark:text-sky-400 hover:underline inline-flex items-center gap-1 transition-colors">
                        <span>Kelola Kelas</span>
                        <i class="ri-arrow-right-s-line"></i>
                    </a>
                </div>
            </div>

            <!-- CARD: ASESMEN AKTIF -->
            <div class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-100 dark:border-slate-700/80 p-5 sm:p-6 flex flex-col justify-between shadow-xs transition-colors hover:border-blue-200 dark:hover:border-blue-900/50">
                <div>
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Asesmen Aktif</span>
                        <div class="w-10 h-10 rounded-xl bg-purple-50 dark:bg-purple-950/40 text-purple-600 dark:text-purple-400 flex items-center justify-center">
                            <i class="ri-file-list-3-fill text-lg"></i>
                        </div>
                    </div>
                    <div class="text-3xl font-extrabold text-slate-800 dark:text-white mb-1">
                        <?= htmlspecialchars($data['totalActiveAssessments'] ?? 0) ?>
                    </div>
                    <p class="text-xs text-slate-400 dark:text-slate-500">Sedang Dipublish</p>
                </div>
                <div class="pt-3 border-t border-slate-100 dark:border-slate-700/60 mt-4">
                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-[11px] font-semibold bg-emerald-50 dark:bg-emerald-950/40 text-emerald-600 dark:text-emerald-400">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                        <span>Berlangsung</span>
                    </span>
                </div>
            </div>

        </div>

        <!-- REKAPITULASI SISWA -->
        <div class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-100 dark:border-slate-700/80 shadow-xs transition-colors overflow-hidden">
            <div class="p-5 sm:p-6 border-b border-slate-100 dark:border-slate-700/60 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                <div>
                    <h4 class="text-base font-bold text-slate-800 dark:text-white">Statistik & Rekapitulasi Siswa</h4>
                    <p class="text-xs text-slate-400 dark:text-slate-500 mt-0.5">Distribusi jumlah siswa keseluruhan dan aktif per tingkat kelas</p>
                </div>
                <div class="bg-slate-50 dark:bg-slate-700/50 px-4 py-2 rounded-xl border border-slate-200/60 dark:border-slate-600 flex items-center gap-2.5 shrink-0">
                    <i class="ri-user-5-fill text-blue-600 dark:text-sky-400 text-sm"></i>
                    <span class="text-xs text-slate-500 dark:text-slate-400 font-medium">Total Siswa:</span>
                    <span class="text-sm font-extrabold text-slate-800 dark:text-white"><?= htmlspecialchars($data['totalStudents'] ?? 0) ?> Siswa</span>
                </div>
            </div>

            <div class="p-5 sm:p-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 sm:gap-6">
                    
                    <!-- KELAS VII -->
                    <div class="border border-slate-200/80 dark:border-slate-700 rounded-2xl p-4 sm:p-5 bg-slate-50/50 dark:bg-slate-700/30 flex items-center justify-between">
                        <div>
                            <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500">Tingkat Kelas</span>
                            <h5 class="text-base font-bold text-slate-700 dark:text-slate-200 mt-0.5">Kelas VII</h5>
                        </div>
                        <div class="text-right">
                            <span class="text-2xl sm:text-3xl font-black text-slate-800 dark:text-white"><?= htmlspecialchars($data['totalClassVII'] ?? 0) ?></span>
                            <span class="text-[11px] text-slate-400 dark:text-slate-500 block">Siswa Aktif</span>
                        </div>
                    </div>

                    <!-- KELAS VIII -->
                    <div class="border border-slate-200/80 dark:border-slate-700 rounded-2xl p-4 sm:p-5 bg-slate-50/50 dark:bg-slate-700/30 flex items-center justify-between">
                        <div>
                            <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500">Tingkat Kelas</span>
                            <h5 class="text-base font-bold text-slate-700 dark:text-slate-200 mt-0.5">Kelas VIII</h5>
                        </div>
                        <div class="text-right">
                            <span class="text-2xl sm:text-3xl font-black text-slate-800 dark:text-white"><?= htmlspecialchars($data['totalClassVIII'] ?? 0) ?></span>
                            <span class="text-[11px] text-slate-400 dark:text-slate-500 block">Siswa Aktif</span>
                        </div>
                    </div>

                    <!-- KELAS IX -->
                    <div class="border border-slate-200/80 dark:border-slate-700 rounded-2xl p-4 sm:p-5 bg-slate-50/50 dark:bg-slate-700/30 flex items-center justify-between">
                        <div>
                            <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500">Tingkat Kelas</span>
                            <h5 class="text-base font-bold text-slate-700 dark:text-slate-200 mt-0.5">Kelas IX</h5>
                        </div>
                        <div class="text-right">
                            <span class="text-2xl sm:text-3xl font-black text-slate-800 dark:text-white"><?= htmlspecialchars($data['totalClassIX'] ?? 0) ?></span>
                            <span class="text-[11px] text-slate-400 dark:text-slate-500 block">Siswa Aktif</span>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
</main>
<!-- main end -->