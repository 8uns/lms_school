<?php

/**
 * @var array $data
 */
// Hitung total statistik untuk dashboard mini
$totalMatpel   = count($data['question_subject'] ?? []);
$totalSeluruhSoal = array_reduce($data['question_subject'] ?? [], function ($carry, $item) {
    return $carry + (int)($item['total_soal'] ?? 0);
}, 0);
?>

<!-- main start -->
<main
    class="md:ml-72 min-h-screen bg-slate-50 dark:bg-slate-900/90 text-slate-800 dark:text-slate-100 transition-colors duration-300"
    x-data="{ 
        search: '',
        modaladd: false, 
        modaledit: false,
        modaldel: false,
        data: {
            subject_id : '', 
            class_id : '', 
            subject_name : '', 
            class_name : ''
        }
    }"
    @keydown.window.escape="modaladd = false; modaledit = false; modaldel = false;">

    <div class="p-4 sm:p-6 lg:p-8 space-y-6">

        <!-- DASHBOARD MINI / STATS CARDS -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-5 sm:gap-6">

            <!-- CARD 1: MATA PELAJARAN -->
            <div class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-100 dark:border-slate-700/80 p-5 sm:p-6 flex items-center justify-between shadow-xs transition-colors hover:border-blue-200 dark:hover:border-blue-900/50">
                <div>
                    <span class="text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider block mb-1">Mata Pelajaran Aktif</span>
                    <h3 class="text-2xl sm:text-3xl font-extrabold text-slate-800 dark:text-white">
                        <?= $totalMatpel ?>
                    </h3>
                    <p class="text-xs text-emerald-600 dark:text-emerald-400 font-semibold mt-2 flex items-center gap-1">
                        <i class="ri-checkbox-circle-line"></i>
                        <span>Kombinasi Mapel & Rombel</span>
                    </p>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-blue-50 dark:bg-sky-950/40 text-blue-600 dark:text-sky-400 flex items-center justify-center shrink-0">
                    <i class="ri-book-read-line text-2xl"></i>
                </div>
            </div>

            <!-- CARD 2: TOTAL SOAL -->
            <div class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-100 dark:border-slate-700/80 p-5 sm:p-6 flex items-center justify-between shadow-xs transition-colors hover:border-blue-200 dark:hover:border-blue-900/50">
                <div>
                    <span class="text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider block mb-1">Total Soal Dibuat</span>
                    <h3 class="text-2xl sm:text-3xl font-extrabold text-slate-800 dark:text-white">
                        <?= $totalSeluruhSoal ?>
                    </h3>
                    <p class="text-xs text-blue-600 dark:text-sky-400 font-semibold mt-2 flex items-center gap-1">
                        <i class="ri-file-list-3-line"></i>
                        <span>Pilihan Ganda & Esai</span>
                    </p>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-emerald-50 dark:bg-emerald-950/40 text-emerald-600 dark:text-emerald-400 flex items-center justify-center shrink-0">
                    <i class="ri-questionnaire-line text-2xl"></i>
                </div>
            </div>

            <!-- CARD 3: STATUS BANK SOAL -->
            <div class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-100 dark:border-slate-700/80 p-5 sm:p-6 flex items-center justify-between shadow-xs transition-colors hover:border-blue-200 dark:hover:border-blue-900/50">
                <div>
                    <span class="text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider block mb-1">Status Bank Soal</span>
                    <h3 class="text-2xl sm:text-3xl font-extrabold text-emerald-600 dark:text-emerald-400">
                        Siap
                    </h3>
                    <p class="text-xs text-amber-600 dark:text-amber-400 font-semibold mt-2 flex items-center gap-1">
                        <i class="ri-folder-shield-2-line"></i>
                        <span>Terhubung ke Ujian</span>
                    </p>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-amber-50 dark:bg-amber-950/40 text-amber-600 dark:text-amber-400 flex items-center justify-center shrink-0">
                    <i class="ri-folder-keyhole-line text-2xl"></i>
                </div>
            </div>

        </div>

        <!-- CONTAINER UTAMA -->
        <div class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-100 dark:border-slate-700/80 shadow-xs transition-colors overflow-hidden">

            <!-- HEADER SECTION & FILTER PERIODE + SEARCH -->
            <div class="p-5 sm:p-6 border-b border-slate-100 dark:border-slate-700/60 flex flex-col lg:flex-row items-start lg:items-center justify-between gap-4">

                <div class="flex items-center gap-3 w-full lg:w-auto">
                    <div class="w-12 h-12 rounded-2xl bg-blue-50 dark:bg-sky-950/40 text-blue-600 dark:text-sky-400 flex items-center justify-center shrink-0">
                        <i class="ri-user-shared-line text-2xl"></i>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-[11px] font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500">Filter Periode</span>
                        <div class="mt-1">
                            <select
                                class="w-full sm:w-auto border border-slate-200 dark:border-slate-600 rounded-xl py-2 px-3 text-xs sm:text-sm font-bold text-slate-700 dark:text-slate-200 bg-slate-50 dark:bg-slate-700/50 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 cursor-pointer transition-colors"
                                @change="if ($event.target.value) window.location.href = $event.target.value">
                                <?php if (!empty($data['academic_years'])): ?>
                                    <?php foreach ($data['academic_years'] as $val): ?>
                                        <option <?= isset($data['academic_year_id']) && $val['id'] == $data['academic_year_id'] ? 'selected' : '' ?> value="<?= base_url('/admin/bank-soal/') . $val['id'] ?>">
                                            T.A. <?= $val['year_name'] . ' - ' . $val['semester'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- ACTION CONTROLS: INPUT SEARCH & TOMBOL TAMBAH -->
                <div class="flex flex-col sm:flex-row items-center gap-3 w-full lg:w-auto">
                    <div class="relative w-full sm:w-64">
                        <i class="ri-search-line absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 dark:text-slate-500 text-base"></i>
                        <input
                            type="text"
                            x-model="search"
                            placeholder="Cari mapel / kelas..."
                            class="w-full pl-10 pr-4 py-2.5 bg-slate-50 dark:bg-slate-700/50 border border-slate-200 dark:border-slate-600 rounded-xl text-xs sm:text-sm text-slate-700 dark:text-slate-200 placeholder-slate-400 dark:placeholder-slate-500 focus:outline-none focus:bg-white dark:focus:bg-slate-700 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all font-normal" />
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
                                <th class="px-6 py-3.5 text-left">Mata Pelajaran</th>
                                <th class="px-4 py-3.5">Kelas / Rombel</th>
                                <th class="px-4 py-3.5">Total Soal</th>
                                <th class="px-4 py-3.5 w-48">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 dark:divide-slate-700/60 text-xs sm:text-sm">
                            <?php if (!empty($data['question_subject'])): ?>
                                <?php $no = 1; ?>
                                <?php foreach ($data['question_subject'] as $val): ?>
                                    <tr
                                        class="hover:bg-slate-50/60 dark:hover:bg-slate-700/30 transition-colors"
                                        x-show="search === '' || 
                                                '<?= strtolower(addslashes($val['subject_name'])) ?>'.includes(search.toLowerCase()) || 
                                                '<?= strtolower(addslashes($val['class_name'])) ?>'.includes(search.toLowerCase())">
                                        
                                        <td class="px-4 py-4 font-medium text-slate-400 dark:text-slate-500"><?= $no++; ?></td>
                                        
                                        <td class="px-6 py-4 text-left font-bold text-slate-800 dark:text-white">
                                            <?= htmlspecialchars($val['subject_name']); ?>
                                        </td>
                                        
                                        <td class="px-4 py-4">
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-bold bg-blue-50 dark:bg-sky-950/40 text-blue-600 dark:text-sky-400 border border-blue-100 dark:border-sky-900/50">
                                                Kelas <?= htmlspecialchars($val['class_name']); ?>
                                            </span>
                                        </td>

                                        <td class="px-4 py-4 font-medium">
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-semibold bg-emerald-50 dark:bg-emerald-950/40 text-emerald-600 dark:text-emerald-400 border border-emerald-100 dark:border-emerald-900/50">
                                                <?= htmlspecialchars($val['total_soal']); ?> Soal
                                            </span>
                                        </td>

                                        <td class="px-4 py-4">
                                            <div class="flex items-center justify-center gap-1">
                                                <!-- Tombol Kelola Soal -->
                                                <a href="<?= base_url('/guru/bank-soal/subject/' . $val['subject_id'] . '/class/' . $val['class_id']) ?>"
                                                    title="Kelola Soal"
                                                    class="cursor-pointer px-2.5 py-1.5 rounded-xl text-slate-500 dark:text-slate-400 hover:text-blue-600 dark:hover:text-sky-400 hover:bg-blue-50 dark:hover:bg-sky-950/30 active:scale-95 transition-all flex items-center gap-1 font-semibold text-xs">
                                                    <i class="ri-eye-line text-base"></i>
                                                    <span>Kelola</span>
                                                </a>

                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5" class="px-4 py-12 text-slate-400 dark:text-slate-500 text-center">
                                        <i class="ri-inbox-line text-4xl block mb-2 opacity-60"></i>
                                        Belum ada data bank soal untuk mata pelajaran Anda.
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <!-- FOOTER INFO -->
                <div class="mt-4 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs text-slate-400 dark:text-slate-500">
                    <span>Menampilkan seluruh mata pelajaran & kelas yang aktif</span>
                    <span class="font-semibold text-slate-500 dark:text-slate-400">Total <?= $totalMatpel ?> Kelas Terdaftar</span>
                </div>
            </div>

        </div>

    </div>

   


</main>
<!-- main end -->