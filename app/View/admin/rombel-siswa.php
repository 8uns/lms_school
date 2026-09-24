<?php

/**
 * @var array $data
 */

// Kalkulasi sederhana untuk ringkasan Dashboard
$totalClasses = !empty($data['studentclasses']) ? count($data['studentclasses']) : 0;
$totalStudents = 0;

if (!empty($data['studentclasses'])) {
    foreach ($data['studentclasses'] as $cls) {
        $totalStudents += (int)($cls['total_students'] ?? 0);
    }
}

$avgStudents = $totalClasses > 0 ? round($totalStudents / $totalClasses) : 0;
?>

<!-- main start -->
<main 
    class="md:ml-72 min-h-screen bg-slate-50 dark:bg-slate-900/90 text-slate-800 dark:text-slate-100 transition-colors duration-300"
    x-data="{ search: '' }"
    @keydown.window.escape="search = ''">
    
    <div class="p-4 sm:p-6 lg:p-8 space-y-6">

        <!-- STATS DASHBOARD WIDGET -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 lg:gap-6">
            
            <!-- CARD 1: TOTAL KELAS -->
            <div class="bg-white dark:bg-slate-800 p-5 rounded-2xl border border-slate-100 dark:border-slate-700/80 shadow-xs flex items-center justify-between transition-colors">
                <div class="space-y-1">
                    <span class="text-[11px] font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500">Total Rombel / Kelas</span>
                    <h3 class="text-2xl sm:text-3xl font-extrabold text-slate-800 dark:text-white leading-tight">
                        <?= $totalClasses ?> <span class="text-xs font-semibold text-slate-400">Kelas</span>
                    </h3>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-blue-50 dark:bg-sky-950/40 text-blue-600 dark:text-sky-400 flex items-center justify-center shrink-0">
                    <i class="ri-door-open-line text-2xl"></i>
                </div>
            </div>

            <!-- CARD 2: TOTAL SISWA -->
            <div class="bg-white dark:bg-slate-800 p-5 rounded-2xl border border-slate-100 dark:border-slate-700/80 shadow-xs flex items-center justify-between transition-colors">
                <div class="space-y-1">
                    <span class="text-[11px] font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500">Total Siswa Terdaftar</span>
                    <h3 class="text-2xl sm:text-3xl font-extrabold text-slate-800 dark:text-white leading-tight">
                        <?= number_format($totalStudents) ?> <span class="text-xs font-semibold text-slate-400">Siswa</span>
                    </h3>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-emerald-50 dark:bg-emerald-950/40 text-emerald-600 dark:text-emerald-400 flex items-center justify-center shrink-0">
                    <i class="ri-user-group-line text-2xl"></i>
                </div>
            </div>

            <!-- CARD 3: RATA-RATA KAPASITAS -->
            <div class="bg-white dark:bg-slate-800 p-5 rounded-2xl border border-slate-100 dark:border-slate-700/80 shadow-xs flex items-center justify-between transition-colors">
                <div class="space-y-1">
                    <span class="text-[11px] font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500">Rata-rata Siswa / Kelas</span>
                    <h3 class="text-2xl sm:text-3xl font-extrabold text-slate-800 dark:text-white leading-tight">
                        <?= $avgStudents ?> <span class="text-xs font-semibold text-slate-400">Siswa / Kelas</span>
                    </h3>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-amber-50 dark:bg-amber-950/40 text-amber-600 dark:text-amber-400 flex items-center justify-center shrink-0">
                    <i class="ri-pie-chart-line text-2xl"></i>
                </div>
            </div>

        </div>

        <!-- CONTAINER UTAMA -->
        <div class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-100 dark:border-slate-700/80 shadow-xs transition-colors overflow-hidden">
            
            <!-- HEADER SECTION & FILTER PERIODE -->
            <div class="p-5 sm:p-6 border-b border-slate-100 dark:border-slate-700/60 flex flex-col lg:flex-row items-start lg:items-center justify-between gap-4">
                
                <div class="flex items-center gap-3 w-full lg:w-auto">
                    <div class="w-12 h-12 rounded-2xl bg-blue-50 dark:bg-sky-950/40 text-blue-600 dark:text-sky-400 flex items-center justify-center shrink-0">
                        <i class="ri-team-line text-2xl"></i>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-[11px] font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500">Filter Periode</span>
                        <div class="mt-1">
                            <select
                                class="w-full sm:w-auto border border-slate-200 dark:border-slate-600 rounded-xl py-2 px-3 text-xs sm:text-sm font-bold text-slate-700 dark:text-slate-200 bg-slate-50 dark:bg-slate-700/50 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 cursor-pointer transition-colors"
                                @change="if ($event.target.value) window.location.href = $event.target.value">
                                <?php if (!empty($data['academic_years'])): ?>
                                    <?php foreach ($data['academic_years'] as $val): ?>
                                        <option <?= isset($data['academic_year_id']) && $val['id'] == $data['academic_year_id'] ? 'selected' : '' ?> value="<?= base_url('/admin/rombel-siswa/') . $val['id'] ?>">
                                            T.A. <?= $val['year_name'] . ' - ' . $val['semester'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- ACTION CONTROLS: INPUT SEARCH -->
                <div class="flex flex-col sm:flex-row items-center gap-3 w-full lg:w-auto">
                    <div class="relative w-full sm:w-64">
                        <i class="ri-search-line absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 dark:text-slate-500 text-base"></i>
                        <input 
                            type="text" 
                            x-model="search" 
                            placeholder="Cari kelas..." 
                            class="w-full pl-10 pr-4 py-2.5 bg-slate-50 dark:bg-slate-700/50 border border-slate-200 dark:border-slate-600 rounded-xl text-xs sm:text-sm text-slate-700 dark:text-slate-200 placeholder-slate-400 dark:placeholder-slate-500 focus:outline-none focus:bg-white dark:focus:bg-slate-700 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all font-normal"
                        />
                    </div>
                </div>
            </div>

            <!-- TABLE SECTION -->
            <div class="p-5 sm:p-6">
                <div class="overflow-x-auto border border-slate-200/80 dark:border-slate-700/80 rounded-2xl">
                    <table class="w-full text-center border-collapse">
                        <thead>
                            <tr class="bg-slate-50/80 dark:bg-slate-700/40 border-b border-slate-200/80 dark:border-slate-700/80 text-[11px] font-bold text-slate-400 dark:text-slate-400 uppercase tracking-wider">
                                <th class="px-4 py-3.5 w-16">No</th>
                                <th class="px-6 py-3.5 text-left">Kelas</th>
                                <th class="px-6 py-3.5">Jumlah Siswa</th>
                                <th class="px-4 py-3.5 w-36">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 dark:divide-slate-700/60 text-xs sm:text-sm">
                            <?php $no = 1; ?>
                            <?php if (!empty($data['studentclasses'])): ?>
                                <?php foreach ($data['studentclasses'] as $val): ?>
                                    <tr 
                                        class="hover:bg-slate-50/60 dark:hover:bg-slate-700/30 transition-colors"
                                        x-show="search === '' || '<?= strtolower(addslashes($val['class_name'] ?? '')) ?>'.includes(search.toLowerCase())"
                                    >
                                        <td class="px-4 py-4 font-medium text-slate-400 dark:text-slate-500"><?= $no++; ?></td>
                                        <td class="px-6 py-4 text-left font-bold text-slate-800 dark:text-white">
                                            Kelas <?= htmlspecialchars($val['class_name'] ?? ''); ?>
                                        </td>
                                        <td class="px-6 py-4">
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-bold bg-blue-50 dark:bg-sky-950/40 text-blue-600 dark:text-sky-400 border border-blue-100 dark:border-sky-900/50">
                                                <?= htmlspecialchars($val['total_students'] ?? '0'); ?> Siswa
                                            </span>
                                        </td>
                                        <td class="px-4 py-4">
                                            <div class="flex items-center justify-center">
                                                <a href="<?= base_url('/admin/rombel-siswa/class/') . ($val['classroom_id'] ?? '') . '/ay/' . ($data['academic_year_id'] ?? '') ?>"
                                                    title="Lihat Detail Siswa"
                                                    class="cursor-pointer px-2.5 py-1.5 rounded-xl text-slate-500 dark:text-slate-400 hover:text-blue-600 dark:hover:text-sky-400 hover:bg-blue-50 dark:hover:bg-sky-950/30 active:scale-95 transition-all flex items-center gap-1 font-semibold text-xs">
                                                    <i class="ri-eye-line text-base"></i>
                                                    <span>Detail</span>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="4" class="px-4 py-12 text-slate-400 dark:text-slate-500 text-center">
                                        <i class="ri-inbox-line text-4xl block mb-2 opacity-60"></i>
                                        Belum ada data rombongan belajar pada tahun ajaran ini.
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

    </div>
</main>
<!-- main end -->