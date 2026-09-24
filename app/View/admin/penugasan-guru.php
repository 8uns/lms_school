<?php

/**
 * @var array $data
 */
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
            assignment_id : '', 
            teacher_id : '', 
            subject_id : '', 
            classroom_id : '', 
            academic_year_id : '', 
            teacher_name : '', 
            subject_name : '', 
            class_name : '', 
            period_name : ''
        }
    }"
    @keydown.window.escape="modaladd = false; modaledit = false; modaldel = false;">

    <div class="p-4 sm:p-6 lg:p-8 space-y-6">

        <!-- STATS WIDGETS SECTION -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 sm:gap-6">

            <!-- TOTAL PENUGASAN -->
            <div class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-100 dark:border-slate-700/80 p-5 sm:p-6 flex items-center justify-between shadow-xs transition-colors hover:border-blue-200 dark:hover:border-blue-900/50">
                <div>
                    <span class="text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider block mb-1">Total Penugasan</span>
                    <h3 class="text-2xl sm:text-3xl font-extrabold text-slate-800 dark:text-white">
                        <?= !empty($data['penugasan']) ? count($data['penugasan']) : 0; ?>
                    </h3>
                    <p class="text-xs text-emerald-600 dark:text-emerald-400 font-semibold mt-2 flex items-center gap-1">
                        <i class="ri-checkbox-circle-line"></i>
                        <span>Penugasan Aktif</span>
                    </p>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-blue-50 dark:bg-sky-950/40 text-blue-600 dark:text-sky-400 flex items-center justify-center shrink-0">
                    <i class="ri-assignment-user-line text-2xl"></i>
                </div>
            </div>

            <!-- GURU BERTUGAS -->
            <div class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-100 dark:border-slate-700/80 p-5 sm:p-6 flex items-center justify-between shadow-xs transition-colors hover:border-blue-200 dark:hover:border-blue-900/50">
                <div>
                    <span class="text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider block mb-1">Guru Bertugas</span>
                    <h3 class="text-2xl sm:text-3xl font-extrabold text-slate-800 dark:text-white">
                        <?= !empty($data['total_guru_assigned']) ? $data['total_guru_assigned'] : 0; ?>
                    </h3>
                    <p class="text-xs text-blue-600 dark:text-sky-400 font-semibold mt-2 flex items-center gap-1">
                        <i class="ri-user-follow-line"></i>
                        <span>Terdistribusi di Kelas</span>
                    </p>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-sky-50 dark:bg-sky-950/40 text-sky-600 dark:text-sky-400 flex items-center justify-center shrink-0">
                    <i class="ri-teacher-line text-2xl"></i>
                </div>
            </div>

            <!-- MAPEL TERAMPU -->
            <div class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-100 dark:border-slate-700/80 p-5 sm:p-6 flex items-center justify-between shadow-xs transition-colors sm:col-span-2 lg:col-span-1 hover:border-blue-200 dark:hover:border-blue-900/50">
                <div>
                    <span class="text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider block mb-1">Mata Pelajaran</span>
                    <h3 class="text-2xl sm:text-3xl font-extrabold text-slate-800 dark:text-white">
                        <?= !empty($data['total_mapel']) ? $data['total_mapel'] : 0; ?>
                    </h3>
                    <p class="text-xs text-amber-600 dark:text-amber-400 font-semibold mt-2 flex items-center gap-1">
                        <i class="ri-book-read-line"></i>
                        <span>Terhubung ke Kurikulum</span>
                    </p>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-amber-50 dark:bg-amber-950/40 text-amber-600 dark:text-amber-400 flex items-center justify-center shrink-0">
                    <i class="ri-book-open-line text-2xl"></i>
                </div>
            </div>

        </div>
        <!-- CONTAINER UTAMA -->
        <div class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-100 dark:border-slate-700/80 shadow-xs transition-colors overflow-hidden">

            <!-- HEADER SECTION & FILTER PERIODE -->
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
                                <?php foreach ($data['academic_years'] as $val): ?>
                                    <option <?= $val['id'] == $data['academic_year_id'] ? 'selected' : '' ?> value="<?= base_url('/admin/penugasan-guru/') . $val['id'] ?>">
                                        T.A. <?= $val['year_name'] . ' - ' . $val['semester'] ?>
                                    </option>
                                <?php endforeach; ?>
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
                            placeholder="Cari guru / mapel..."
                            class="w-full pl-10 pr-4 py-2.5 bg-slate-50 dark:bg-slate-700/50 border border-slate-200 dark:border-slate-600 rounded-xl text-xs sm:text-sm text-slate-700 dark:text-slate-200 placeholder-slate-400 dark:placeholder-slate-500 focus:outline-none focus:bg-white dark:focus:bg-slate-700 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all font-normal" />
                    </div>

                    <button
                        @click="modaladd = !modaladd"
                        type="button"
                        class="w-full sm:w-auto inline-flex items-center justify-center gap-2 cursor-pointer bg-gradient-to-r from-blue-900 via-blue-700 to-sky-500 hover:from-blue-950 hover:via-blue-800 hover:to-sky-600 text-white py-2.5 px-5 rounded-2xl text-xs sm:text-sm font-bold shadow-xs hover:shadow-md transition-all active:scale-[0.98] shrink-0">
                        <i class="ri-add-line text-base"></i>
                        <span>Tambah Penugasan</span>
                    </button>
                </div>
            </div>

            <!-- TABLE SECTION -->
            <div class="p-5 sm:p-6">
                <div class="overflow-x-auto border border-slate-200/80 dark:border-slate-700/80 rounded-2xl">
                    <table class="w-full text-center border-collapse">
                        <thead>
                            <tr class="bg-slate-50/80 dark:bg-slate-700/40 border-b border-slate-200/80 dark:border-slate-700/80 text-[11px] font-bold text-slate-400 dark:text-slate-400 uppercase tracking-wider">
                                <th class="px-4 py-3.5 w-16">No</th>
                                <th class="px-6 py-3.5 text-left">Nama Guru</th>
                                <th class="px-6 py-3.5 text-left">Mata Pelajaran</th>
                                <th class="px-4 py-3.5">Kelas</th>
                                <th class="px-4 py-3.5">Tahun Ajaran / Semester</th>
                                <th class="px-4 py-3.5 w-36">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 dark:divide-slate-700/60 text-xs sm:text-sm">
                            <?php $no = 1; ?>
                            <?php if (!empty($data['teacher_assignments'])): ?>
                                <?php foreach ($data['teacher_assignments'] as $assigment): ?>
                                    <tr
                                        class="hover:bg-slate-50/60 dark:hover:bg-slate-700/30 transition-colors"
                                        x-show="search === '' || 
                                                '<?= strtolower(addslashes($assigment['teacher_name'])) ?>'.includes(search.toLowerCase()) || 
                                                '<?= strtolower(addslashes($assigment['subject_name'])) ?>'.includes(search.toLowerCase())">
                                        <td class="px-4 py-4 font-medium text-slate-400 dark:text-slate-500"><?= $no++; ?></td>
                                        <td class="px-6 py-4 text-left font-bold text-slate-800 dark:text-white">
                                            <?= htmlspecialchars($assigment['teacher_name']); ?>
                                        </td>
                                        <td class="px-6 py-4 text-left font-medium">
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-semibold bg-emerald-50 dark:bg-emerald-950/40 text-emerald-600 dark:text-emerald-400 border border-emerald-100 dark:border-emerald-900/50">
                                                <?= htmlspecialchars($assigment['subject_name']); ?>
                                            </span>
                                        </td>
                                        <td class="px-4 py-4">
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-bold bg-blue-50 dark:bg-sky-950/40 text-blue-600 dark:text-sky-400 border border-blue-100 dark:border-sky-900/50">
                                                <?= htmlspecialchars($assigment['class_name']); ?>
                                            </span>
                                        </td>
                                        <td class="px-4 py-4 text-slate-500 dark:text-slate-400 font-medium">
                                            <?= htmlspecialchars($assigment['period_name']); ?>
                                        </td>
                                        <td class="px-4 py-4">
                                            <div class="flex items-center justify-center gap-1">
                                                <!-- Tombol Ubah (Edit) -->
                                                <button
                                                    @click="
                                                        data = {
                                                            assignment_id : '<?= $assigment['assignment_id'] ?>', 
                                                            teacher_id : '<?= $assigment['teacher_id'] ?>', 
                                                            subject_id : '<?= $assigment['subject_id'] ?>', 
                                                            classroom_id : '<?= $assigment['classroom_id'] ?>', 
                                                            academic_year_id : '<?= $assigment['academic_year_id'] ?>', 
                                                            teacher_name : '<?= addslashes($assigment['teacher_name']); ?>', 
                                                            subject_name : '<?= addslashes($assigment['subject_name']); ?>', 
                                                            class_name : '<?= addslashes($assigment['class_name']); ?>', 
                                                            period_name : '<?= addslashes($assigment['period_name']); ?>'
                                                        }; 
                                                        modaledit = true;
                                                    "
                                                    type="button"
                                                    title="Ubah Penugasan"
                                                    class="cursor-pointer px-2.5 py-1.5 rounded-xl text-slate-500 dark:text-slate-400 hover:text-amber-600 dark:hover:text-amber-400 hover:bg-amber-50 dark:hover:bg-amber-950/30 active:scale-95 transition-all flex items-center gap-1 font-semibold text-xs">
                                                    <i class="ri-edit-line text-base"></i>
                                                    <span>Ubah</span>
                                                </button>

                                                <!-- Tombol Hapus -->
                                                <button
                                                    @click="
                                                        data = {
                                                            assignment_id : '<?= $assigment['assignment_id'] ?>', 
                                                            teacher_name : '<?= addslashes($assigment['teacher_name']); ?>'
                                                        }; 
                                                        modaldel = true;
                                                    "
                                                    type="button"
                                                    title="Hapus Penugasan"
                                                    class="cursor-pointer px-2.5 py-1.5 rounded-xl text-slate-500 dark:text-slate-400 hover:text-rose-600 dark:hover:text-rose-400 hover:bg-rose-50 dark:hover:bg-rose-950/30 active:scale-95 transition-all flex items-center gap-1 font-semibold text-xs">
                                                    <i class="ri-delete-bin-line text-base"></i>
                                                    <span>Hapus</span>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="px-4 py-12 text-slate-400 dark:text-slate-500 text-center">
                                        <i class="ri-inbox-line text-4xl block mb-2 opacity-60"></i>
                                        Belum ada data penugasan guru untuk tahun ajaran ini.
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

    </div>

    <!-- START MODAL FORM TAMBAH -->
    <div
        class="fixed inset-0 h-screen w-screen bg-slate-900/60 dark:bg-slate-950/80 backdrop-blur-xs left-0 top-0 z-50 flex items-center justify-center p-4"
        x-cloak
        x-show="modaladd"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0">

        <form action="<?= base_url('/admin/penugasan-guru') ?>" method="post" class="w-full max-w-lg">
            <div class="bg-white dark:bg-slate-800 rounded-2xl p-6 sm:p-8 shadow-xl border border-slate-100 dark:border-slate-700/80 transition-colors" @click.away="modaladd = false">

                <div class="flex justify-between items-center mb-6 pb-4 border-b border-slate-100 dark:border-slate-700/60">
                    <h6 class="font-bold text-base sm:text-lg text-slate-800 dark:text-white">Tambah Penugasan Guru</h6>
                    <button @click="modaladd = false" type="button" class="cursor-pointer text-slate-400 hover:text-slate-600 dark:hover:text-slate-200 bg-slate-100 dark:bg-slate-700 rounded-xl p-2 transition-colors">
                        <i class="ri-close-line text-lg"></i>
                    </button>
                </div>

                <div class="space-y-4 mb-6">
                    <div>
                        <label class="text-slate-600 dark:text-slate-400 text-xs font-bold uppercase tracking-wider block mb-1.5">Nama Guru</label>
                        <select required name="teacher_id" class="w-full border border-slate-200 dark:border-slate-600 bg-slate-50 dark:bg-slate-700/50 rounded-xl py-2.5 px-3.5 text-xs sm:text-sm text-slate-800 dark:text-slate-100 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-colors">
                            <option value="">-- Pilih Guru --</option>
                            <?php foreach ($data['guru'] as $val): ?>
                                <option value="<?= $val['id'] ?>"><?= htmlspecialchars($val['full_name']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div>
                        <label class="text-slate-600 dark:text-slate-400 text-xs font-bold uppercase tracking-wider block mb-1.5">Mata Pelajaran</label>
                        <select required name="subject_id" class="w-full border border-slate-200 dark:border-slate-600 bg-slate-50 dark:bg-slate-700/50 rounded-xl py-2.5 px-3.5 text-xs sm:text-sm text-slate-800 dark:text-slate-100 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-colors">
                            <option value="">-- Pilih Mapel --</option>
                            <?php foreach ($data['subject'] as $val): ?>
                                <option value="<?= $val['id'] ?>"><?= htmlspecialchars($val['subject_name']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div>
                        <label class="text-slate-600 dark:text-slate-400 text-xs font-bold uppercase tracking-wider block mb-1.5">Kelas</label>
                        <select required name="classroom_id" class="w-full border border-slate-200 dark:border-slate-600 bg-slate-50 dark:bg-slate-700/50 rounded-xl py-2.5 px-3.5 text-xs sm:text-sm text-slate-800 dark:text-slate-100 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-colors">
                            <option value="">-- Pilih Kelas --</option>
                            <?php foreach ($data['classrooms'] as $val): ?>
                                <option value="<?= $val['id'] ?>"><?= htmlspecialchars($val['class_name']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div>
                        <label class="text-slate-600 dark:text-slate-400 text-xs font-bold uppercase tracking-wider block mb-1.5">Tahun Ajaran / Semester</label>
                        <select required name="academic_year_id" class="w-full border border-slate-200 dark:border-slate-600 bg-slate-50 dark:bg-slate-700/50 rounded-xl py-2.5 px-3.5 text-xs sm:text-sm text-slate-800 dark:text-slate-100 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-colors">
                            <option value="">-- Pilih Tahun Ajaran --</option>
                            <?php foreach ($data['academic_years'] as $val): ?>
                                <option value="<?= $val['id'] ?>"><?= htmlspecialchars($val['year_name'] . ' - Semester ' . $val['semester']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div>
                    <button type="submit" class="w-full cursor-pointer bg-gradient-to-r from-blue-900 via-blue-700 to-sky-500 hover:from-blue-950 hover:via-blue-800 hover:to-sky-600 text-white py-3 px-5 rounded-2xl text-xs sm:text-sm font-bold shadow-xs hover:shadow-md transition-all active:scale-[0.98]">
                        Simpan Penugasan
                    </button>
                </div>
            </div>
        </form>
    </div>
    <!-- END MODAL FORM TAMBAH -->

    <!-- START MODAL FORM EDIT -->
    <div
        class="fixed inset-0 h-screen w-screen bg-slate-900/60 dark:bg-slate-950/80 backdrop-blur-xs left-0 top-0 z-50 flex items-center justify-center p-4"
        x-cloak
        x-show="modaledit"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0">

        <form :action="'<?= base_url('/admin/penugasan-guru') ?>/' + data.assignment_id" method="post" class="w-full max-w-lg">
            <div class="bg-white dark:bg-slate-800 rounded-2xl p-6 sm:p-8 shadow-xl border border-slate-100 dark:border-slate-700/80 transition-colors" @click.away="modaledit = false">

                <div class="flex justify-between items-center mb-6 pb-4 border-b border-slate-100 dark:border-slate-700/60">
                    <div>
                        <span class="text-[11px] font-bold text-amber-600 dark:text-amber-400 uppercase tracking-wider block">Ubah Data</span>
                        <h6 class="font-bold text-base sm:text-lg text-slate-800 dark:text-white" x-text="data.teacher_name"></h6>
                    </div>
                    <button @click="modaledit = false" type="button" class="cursor-pointer text-slate-400 hover:text-slate-600 dark:hover:text-slate-200 bg-slate-100 dark:bg-slate-700 rounded-xl p-2 transition-colors">
                        <i class="ri-close-line text-lg"></i>
                    </button>
                </div>

                <div class="space-y-4 mb-6">
                    <div>
                        <label class="text-slate-600 dark:text-slate-400 text-xs font-bold uppercase tracking-wider block mb-1.5">Nama Guru</label>
                        <select required name="teacher_id" class="w-full border border-slate-200 dark:border-slate-600 bg-slate-50 dark:bg-slate-700/50 rounded-xl py-2.5 px-3.5 text-xs sm:text-sm text-slate-800 dark:text-slate-100 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-colors">
                            <option value="">-- Pilih Guru --</option>
                            <?php foreach ($data['guru'] as $val): ?>
                                <option :selected="data.teacher_id == '<?= $val['id'] ?>'" value="<?= $val['id'] ?>">
                                    <?= htmlspecialchars($val['full_name']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div>
                        <label class="text-slate-600 dark:text-slate-400 text-xs font-bold uppercase tracking-wider block mb-1.5">Mata Pelajaran</label>
                        <select required name="subject_id" class="w-full border border-slate-200 dark:border-slate-600 bg-slate-50 dark:bg-slate-700/50 rounded-xl py-2.5 px-3.5 text-xs sm:text-sm text-slate-800 dark:text-slate-100 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-colors">
                            <option value="">-- Pilih Mapel --</option>
                            <?php foreach ($data['subject'] as $val): ?>
                                <option :selected="data.subject_id == '<?= $val['id'] ?>'" value="<?= $val['id'] ?>">
                                    <?= htmlspecialchars($val['subject_name']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div>
                        <label class="text-slate-600 dark:text-slate-400 text-xs font-bold uppercase tracking-wider block mb-1.5">Kelas</label>
                        <select required name="classroom_id" class="w-full border border-slate-200 dark:border-slate-600 bg-slate-50 dark:bg-slate-700/50 rounded-xl py-2.5 px-3.5 text-xs sm:text-sm text-slate-800 dark:text-slate-100 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-colors">
                            <option value="">-- Pilih Kelas --</option>
                            <?php foreach ($data['classrooms'] as $val): ?>
                                <option :selected="data.classroom_id == '<?= $val['id'] ?>'" value="<?= $val['id'] ?>">
                                    <?= htmlspecialchars($val['class_name']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div>
                        <label class="text-slate-600 dark:text-slate-400 text-xs font-bold uppercase tracking-wider block mb-1.5">Tahun Ajaran / Semester</label>
                        <select required name="academic_year_id" class="w-full border border-slate-200 dark:border-slate-600 bg-slate-50 dark:bg-slate-700/50 rounded-xl py-2.5 px-3.5 text-xs sm:text-sm text-slate-800 dark:text-slate-100 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-colors">
                            <option value="">-- Pilih Tahun Ajaran --</option>
                            <?php foreach ($data['academic_years'] as $val): ?>
                                <option :selected="data.academic_year_id == '<?= $val['id'] ?>'" value="<?= $val['id'] ?>">
                                    <?= htmlspecialchars($val['year_name'] . ' - Semester ' . $val['semester']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div>
                    <button type="submit" class="w-full cursor-pointer bg-gradient-to-r from-blue-900 via-blue-700 to-sky-500 hover:from-blue-950 hover:via-blue-800 hover:to-sky-600 text-white py-3 px-5 rounded-2xl text-xs sm:text-sm font-bold shadow-xs hover:shadow-md transition-all active:scale-[0.98]">
                        Perbarui Data
                    </button>
                </div>
            </div>
        </form>
    </div>
    <!-- END MODAL FORM EDIT -->

    <!-- START MODAL DELETE -->
    <div
        class="fixed inset-0 h-screen w-screen bg-slate-900/60 dark:bg-slate-950/80 backdrop-blur-xs left-0 top-0 z-50 flex items-center justify-center p-4"
        x-cloak
        x-show="modaldel"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0">

        <div class="bg-white dark:bg-slate-800 rounded-2xl p-6 sm:p-8 max-w-md w-full shadow-xl border border-slate-100 dark:border-slate-700/80 transition-colors" @click.away="modaldel = false">
            <div class="text-center mb-6">
                <div class="w-12 h-12 bg-rose-50 dark:bg-rose-950/40 text-rose-600 dark:text-rose-400 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <i class="ri-delete-bin-line text-2xl"></i>
                </div>
                <h6 class="text-base sm:text-lg font-bold text-slate-800 dark:text-white mb-2">Hapus Penugasan Guru?</h6>
                <p class="text-xs sm:text-sm text-slate-500 dark:text-slate-400">
                    Apakah Anda yakin ingin menghapus penugasan untuk <span x-text="data.teacher_name" class="font-bold text-slate-800 dark:text-slate-200"></span>?
                </p>
            </div>

            <div class="flex items-center gap-3">
                <a :href="'<?= base_url('/admin/penugasan-guru/del') ?>/' + data.assignment_id" class="flex-1 text-center font-bold cursor-pointer bg-gradient-to-r from-rose-600 to-red-600 hover:from-rose-700 hover:to-red-700 text-white py-2.5 px-4 rounded-2xl transition-all shadow-xs hover:shadow-md active:scale-[0.98] text-xs sm:text-sm">
                    Ya, Hapus
                </a>

                <button
                    @click="modaldel = false"
                    type="button"
                    class="flex-1 font-bold cursor-pointer bg-slate-100 dark:bg-slate-700/60 text-slate-600 dark:text-slate-300 hover:bg-slate-200 dark:hover:bg-slate-700 rounded-2xl py-2.5 px-4 transition-colors text-xs sm:text-sm">
                    Batal
                </button>
            </div>
        </div>
    </div>
    <!-- END MODAL DELETE -->

</main>
<!-- main end -->