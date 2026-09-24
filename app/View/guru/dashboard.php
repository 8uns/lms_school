<?php
/**
 * @var array $data
 */
?>

<!-- main start -->
<main class="md:ml-72 min-h-screen bg-slate-50 dark:bg-slate-900/90 text-slate-800 dark:text-slate-100 transition-colors duration-300">
    <div class="p-4 sm:p-6 lg:p-8 space-y-6">

        <!-- BANNER WELCOME & TAHUN AJARAN -->
        <div class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-100 dark:border-slate-700/80 p-6 sm:p-8 shadow-xs flex flex-col md:flex-row items-start md:items-center justify-between gap-5 transition-colors">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-2xl bg-blue-50 dark:bg-sky-950/40 text-blue-600 dark:text-sky-400 flex items-center justify-center shrink-0">
                    <i class="ri-user-star-fill text-2xl"></i>
                </div>
                <div>
                    <span class="text-[11px] font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500">
                        Tahun Ajaran Aktif: <?= htmlspecialchars(($data['activeYear']['year_name'] ?? '-') . ' ' . ($data['activeYear']['semester'] ?? '')) ?>
                    </span>
                    <h3 class="text-lg sm:text-xl font-bold text-slate-800 dark:text-white mt-0.5">
                        Selamat Datang, <?= htmlspecialchars($data['teacherName'] ?? 'Bapak/Ibu Guru') ?>
                    </h3>
                </div>
            </div>
            <a href="<?= base_url('/guru/daftar-asesmen') ?>" class="w-full md:w-auto inline-flex items-center justify-center gap-2 cursor-pointer bg-gradient-to-r from-blue-900 via-blue-700 to-sky-500 hover:from-blue-950 hover:via-blue-800 hover:to-sky-600 text-white py-2.5 px-5 rounded-2xl text-xs sm:text-sm font-bold shadow-xs hover:shadow-md transition-all active:scale-[0.98]">
                <i class="ri-add-line text-base"></i>
                <span>Buat Asesmen Baru</span>
            </a>
        </div>

        <!-- STATS CARDS GRID -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 sm:gap-6">

            <!-- CARD: KELAS & MAPEL DIAMPU -->
            <div class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-100 dark:border-slate-700/80 p-5 sm:p-6 flex flex-col justify-between shadow-xs transition-colors hover:border-blue-200 dark:hover:border-blue-900/50">
                <div>
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Kelas Diampu</span>
                        <div class="w-10 h-10 rounded-xl bg-blue-50 dark:bg-sky-950/40 text-blue-600 dark:text-sky-400 flex items-center justify-center">
                            <i class="ri-home-6-fill text-lg"></i>
                        </div>
                    </div>
                    <div class="text-3xl font-extrabold text-slate-800 dark:text-white mb-1">
                        <?= htmlspecialchars($data['totalAssignedClasses'] ?? 0) ?>
                    </div>
                    <p class="text-xs text-slate-400 dark:text-slate-500">Rombongan Belajar</p>
                </div>
                <div class="pt-3 border-t border-slate-100 dark:border-slate-700/60 mt-4">
                    <a href="<?= base_url('/guru/bahan-ajar') ?>" class="text-xs font-bold text-blue-600 dark:text-sky-400 hover:underline inline-flex items-center gap-1 transition-colors">
                        <span>Lihat Penugasan</span>
                        <i class="ri-arrow-right-s-line"></i>
                    </a>
                </div>
            </div>

            <!-- CARD: BANK SOAL -->
            <div class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-100 dark:border-slate-700/80 p-5 sm:p-6 flex flex-col justify-between shadow-xs transition-colors hover:border-blue-200 dark:hover:border-blue-900/50">
                <div>
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Bank Soal</span>
                        <div class="w-10 h-10 rounded-xl bg-sky-50 dark:bg-sky-950/40 text-sky-600 dark:text-sky-400 flex items-center justify-center">
                            <i class="ri-questionnaire-fill text-lg"></i>
                        </div>
                    </div>
                    <div class="text-3xl font-extrabold text-slate-800 dark:text-white mb-1">
                        <?= htmlspecialchars($data['totalQuestions'] ?? 0) ?>
                    </div>
                    <p class="text-xs text-slate-400 dark:text-slate-500">Total Soal Dibuat</p>
                </div>
                <div class="pt-3 border-t border-slate-100 dark:border-slate-700/60 mt-4">
                    <a href="<?= base_url('/guru/bank-soal') ?>" class="text-xs font-bold text-blue-600 dark:text-sky-400 hover:underline inline-flex items-center gap-1 transition-colors">
                        <span>Kelola Soal</span>
                        <i class="ri-arrow-right-s-line"></i>
                    </a>
                </div>
            </div>

            <!-- CARD: BAHAN AJAR -->
            <div class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-100 dark:border-slate-700/80 p-5 sm:p-6 flex flex-col justify-between shadow-xs transition-colors hover:border-blue-200 dark:hover:border-blue-900/50">
                <div>
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Bahan Ajar</span>
                        <div class="w-10 h-10 rounded-xl bg-emerald-50 dark:bg-emerald-950/40 text-emerald-600 dark:text-emerald-400 flex items-center justify-center">
                            <i class="ri-book-read-fill text-lg"></i>
                        </div>
                    </div>
                    <div class="text-3xl font-extrabold text-slate-800 dark:text-white mb-1">
                        <?= htmlspecialchars($data['totalTeachingMaterials'] ?? 0) ?>
                    </div>
                    <p class="text-xs text-slate-400 dark:text-slate-500">Materi Terpublikasi</p>
                </div>
                <div class="pt-3 border-t border-slate-100 dark:border-slate-700/60 mt-4">
                    <a href="<?= base_url('/guru/bahan-ajar') ?>" class="text-xs font-bold text-blue-600 dark:text-sky-400 hover:underline inline-flex items-center gap-1 transition-colors">
                        <span>Unggah Materi</span>
                        <i class="ri-arrow-right-s-line"></i>
                    </a>
                </div>
            </div>

            <!-- CARD: PERLU KOREKSI MANUAL -->
            <div class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-100 dark:border-slate-700/80 p-5 sm:p-6 flex flex-col justify-between shadow-xs transition-colors hover:border-blue-200 dark:hover:border-blue-900/50">
                <div>
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Perlu Koreksi</span>
                        <div class="w-10 h-10 rounded-xl bg-amber-50 dark:bg-amber-950/40 text-amber-600 dark:text-amber-400 flex items-center justify-center">
                            <i class="ri-edit-box-fill text-lg"></i>
                        </div>
                    </div>
                    <div class="text-3xl font-extrabold text-slate-800 dark:text-white mb-1">
                        <?= htmlspecialchars($data['totalPendingGrading'] ?? 0) ?>
                    </div>
                    <p class="text-xs text-slate-400 dark:text-slate-500">Jawaban Esai / Tugas</p>
                </div>
                <div class="pt-3 border-t border-slate-100 dark:border-slate-700/60 mt-4">
                    <a href="<?= base_url('/guru/koreksi-manual') ?>" class="text-xs font-bold text-amber-600 dark:text-amber-400 hover:underline inline-flex items-center gap-1 transition-colors">
                        <span>Periksa Sekarang</span>
                        <i class="ri-arrow-right-s-line"></i>
                    </a>
                </div>
            </div>

        </div>

        <!-- SECTION DUA KOLOM: AKSI CEPAT & ASESMEN AKTIF -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            <!-- DAFTAR KELAS & MATA PELAJARAN DIAMPU (2 KOLOM) -->
            <div class="lg:col-span-2 bg-white dark:bg-slate-800 rounded-2xl border border-slate-100 dark:border-slate-700/80 shadow-xs transition-colors overflow-hidden">
                <div class="p-5 sm:p-6 border-b border-slate-100 dark:border-slate-700/60 flex items-center justify-between">
                    <div>
                        <h4 class="text-base font-bold text-slate-800 dark:text-white">Daftar Penugasan Mengajar</h4>
                        <p class="text-xs text-slate-400 dark:text-slate-500 mt-0.5">Kelas dan Mata Pelajaran yang Anda ampu semester ini</p>
                    </div>
                </div>

                <div class="p-5 sm:p-6">
                    <?php if (!empty($data['assignedList'])): ?>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <?php foreach ($data['assignedList'] as $assign): ?>
                                <div class="border border-slate-200/80 dark:border-slate-700 rounded-2xl p-4 bg-slate-50/50 dark:bg-slate-700/30 flex items-center justify-between">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-xl bg-blue-100 dark:bg-blue-900/40 text-blue-600 dark:text-sky-400 flex items-center justify-center font-bold text-sm">
                                            <?= htmlspecialchars($assign['class_name'] ?? '-') ?>
                                        </div>
                                        <div>
                                            <h5 class="text-sm font-bold text-slate-800 dark:text-slate-100"><?= htmlspecialchars($assign['subject_name'] ?? '-') ?></h5>
                                            <span class="text-xs text-slate-400 dark:text-slate-500">Kelas <?= htmlspecialchars($assign['class_name'] ?? '-') ?></span>
                                        </div>
                                    </div>
                                    <a href="<?= base_url('/guru/bahan-ajar') ?>" class="p-2 rounded-xl text-slate-400 hover:text-blue-600 hover:bg-white dark:hover:bg-slate-700 transition-all">
                                        <i class="ri-arrow-right-line text-lg"></i>
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <div class="text-center py-8 text-slate-400 dark:text-slate-500 text-xs">
                            <i class="ri-inbox-archive-line text-3xl mb-2 block"></i>
                            Belum ada penugasan mengajar pada tahun ajaran aktif ini.
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- STATUS ASESMEN & AKSI CEPAT (1 KOLOM) -->
            <div class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-100 dark:border-slate-700/80 p-5 sm:p-6 shadow-xs transition-colors flex flex-col justify-between">
                <div>
                    <h4 class="text-base font-bold text-slate-800 dark:text-white mb-1">Akses Cepat Guru</h4>
                    <p class="text-xs text-slate-400 dark:text-slate-500 mb-5">Pintasan ke fitur utama evaluasi & materi</p>

                    <div class="space-y-3">
                        <a href="<?= base_url('/guru/monitoring-ujian') ?>" class="flex items-center justify-between p-3 rounded-xl border border-slate-100 dark:border-slate-700 hover:border-blue-300 dark:hover:border-blue-700 bg-slate-50/50 dark:bg-slate-700/30 transition-all group">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-lg bg-emerald-100 dark:bg-emerald-950/50 text-emerald-600 dark:text-emerald-400 flex items-center justify-center">
                                    <i class="ri-tv-2-fill text-sm"></i>
                                </div>
                                <span class="text-xs font-semibold text-slate-700 dark:text-slate-200 group-hover:text-blue-600 dark:group-hover:text-sky-400">Monitoring Ujian Live</span>
                            </div>
                            <i class="ri-arrow-right-s-line text-slate-400 group-hover:translate-x-1 transition-transform"></i>
                        </a>

                        <a href="<?= base_url('/guru/daftar-nilai') ?>" class="flex items-center justify-between p-3 rounded-xl border border-slate-100 dark:border-slate-700 hover:border-blue-300 dark:hover:border-blue-700 bg-slate-50/50 dark:bg-slate-700/30 transition-all group">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-lg bg-purple-100 dark:bg-purple-950/50 text-purple-600 dark:text-purple-400 flex items-center justify-center">
                                    <i class="ri-file-chart-fill text-sm"></i>
                                </div>
                                <span class="text-xs font-semibold text-slate-700 dark:text-slate-200 group-hover:text-blue-600 dark:group-hover:text-sky-400">Daftar & Rekap Nilai</span>
                            </div>
                            <i class="ri-arrow-right-s-line text-slate-400 group-hover:translate-x-1 transition-transform"></i>
                        </a>

                        <a href="<?= base_url('/guru/diskusi-materi') ?>" class="flex items-center justify-between p-3 rounded-xl border border-slate-100 dark:border-slate-700 hover:border-blue-300 dark:hover:border-blue-700 bg-slate-50/50 dark:bg-slate-700/30 transition-all group">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-lg bg-sky-100 dark:bg-sky-950/50 text-sky-600 dark:text-sky-400 flex items-center justify-center">
                                    <i class="ri-discuss-fill text-sm"></i>
                                </div>
                                <span class="text-xs font-semibold text-slate-700 dark:text-slate-200 group-hover:text-blue-600 dark:group-hover:text-sky-400">Diskusi Pembelajaran</span>
                            </div>
                            <i class="ri-arrow-right-s-line text-slate-400 group-hover:translate-x-1 transition-transform"></i>
                        </a>

                        <a href="<?= base_url('/guru/akses-perencanaan') ?>" class="flex items-center justify-between p-3 rounded-xl border border-slate-100 dark:border-slate-700 hover:border-blue-300 dark:hover:border-blue-700 bg-slate-50/50 dark:bg-slate-700/30 transition-all group">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-lg bg-amber-100 dark:bg-amber-950/50 text-amber-600 dark:text-amber-400 flex items-center justify-center">
                                    <i class="ri-file-text-fill text-sm"></i>
                                </div>
                                <span class="text-xs font-semibold text-slate-700 dark:text-slate-200 group-hover:text-blue-600 dark:group-hover:text-sky-400">RPP / Kurikulum</span>
                            </div>
                            <i class="ri-arrow-right-s-line text-slate-400 group-hover:translate-x-1 transition-transform"></i>
                        </a>
                    </div>
                </div>

                <div class="pt-4 mt-6 border-t border-slate-100 dark:border-slate-700/60">
                    <span class="text-[11px] text-slate-400 dark:text-slate-500 block text-center">
                        Sistem Informasi LMS School v1.0
                    </span>
                </div>
            </div>

        </div>

    </div>
</main>
<!-- main end -->