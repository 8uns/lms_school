<?php
    /**
    * @var array $data
    */

    // Kalkulasi sederhana untuk ringkasan Dashboard khusus kelas
    $totalStudentsInClass = !empty($data['studentInClass']) ? count($data['studentInClass']) : 0;
    $availableStudents = !empty($data['students']) ? count($data['students']) : 0;
?>

<!-- main start -->
<main 
    class="md:ml-72 min-h-screen bg-slate-50 dark:bg-slate-900/90 text-slate-800 dark:text-slate-100 transition-colors duration-300"
    x-data="{ 
        searchMain: '',
        modaladd: false, 
        modaldel: false,
        data: {
            student_classes_id: '',
            classroom_id: '',
            academic_year_id: '',
            full_name: '',
        } 
    }"
    @keydown.window.escape="modaladd = false; modaldel = false;">

    <div class="p-4 sm:p-6 lg:p-8 space-y-6">

        <!-- STATS DASHBOARD WIDGET KHUSUS KELAS -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 lg:gap-6">
            
            <!-- CARD 1: KELAS AKTIF -->
            <div class="bg-white dark:bg-slate-800 p-5 rounded-2xl border border-slate-100 dark:border-slate-700/80 shadow-xs flex items-center justify-between transition-colors">
                <div class="space-y-1">
                    <span class="text-[11px] font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500">Kelas Dipilih</span>
                    <h3 class="text-2xl sm:text-3xl font-extrabold text-slate-800 dark:text-white leading-tight">
                        Kelas <?= htmlspecialchars($data['classrooms']['class_name'] ?? '-') ?>
                    </h3>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-blue-50 dark:bg-sky-950/40 text-blue-600 dark:text-sky-400 flex items-center justify-center shrink-0">
                    <i class="ri-building-4-line text-2xl"></i>
                </div>
            </div>

            <!-- CARD 2: SISWA DALAM KELAS -->
            <div class="bg-white dark:bg-slate-800 p-5 rounded-2xl border border-slate-100 dark:border-slate-700/80 shadow-xs flex items-center justify-between transition-colors">
                <div class="space-y-1">
                    <span class="text-[11px] font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500">Siswa Dalam Kelas</span>
                    <h3 class="text-2xl sm:text-3xl font-extrabold text-slate-800 dark:text-white leading-tight">
                        <?= $totalStudentsInClass ?> <span class="text-xs font-semibold text-slate-400">Siswa</span>
                    </h3>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-emerald-50 dark:bg-emerald-950/40 text-emerald-600 dark:text-emerald-400 flex items-center justify-center shrink-0">
                    <i class="ri-user-shared-line text-2xl"></i>
                </div>
            </div>

            <!-- CARD 3: SISWA BELUM MASUK KELAS -->
            <div class="bg-white dark:bg-slate-800 p-5 rounded-2xl border border-slate-100 dark:border-slate-700/80 shadow-xs flex items-center justify-between transition-colors">
                <div class="space-y-1">
                    <span class="text-[11px] font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500">Siswa Belum Diplot</span>
                    <h3 class="text-2xl sm:text-3xl font-extrabold text-slate-800 dark:text-white leading-tight">
                        <?= $availableStudents ?> <span class="text-xs font-semibold text-slate-400">Siswa</span>
                    </h3>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-amber-50 dark:bg-amber-950/40 text-amber-600 dark:text-amber-400 flex items-center justify-center shrink-0">
                    <i class="ri-user-add-line text-2xl"></i>
                </div>
            </div>

        </div>

        <!-- CONTAINER UTAMA (DATA SISWA DALAM KELAS) -->
        <div class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-100 dark:border-slate-700/80 shadow-xs transition-colors overflow-hidden">
            
            <!-- HEADER SECTION & FILTER PERIODE -->
            <div class="p-5 sm:p-6 border-b border-slate-100 dark:border-slate-700/60 flex flex-col lg:flex-row items-start lg:items-center justify-between gap-4">
                
                <div class="flex items-center gap-3 w-full lg:w-auto">
                    <div class="w-12 h-12 rounded-2xl bg-blue-50 dark:bg-sky-950/40 text-blue-600 dark:text-sky-400 flex items-center justify-center shrink-0">
                        <i class="ri-group-line text-2xl"></i>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-[11px] font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500">
                            Siswa Kelas <?= htmlspecialchars($data['classrooms']['class_name'] ?? '') ?>
                        </span>
                        <div class="mt-1">
                            <select
                                class="w-full sm:w-auto border border-slate-200 dark:border-slate-600 rounded-xl py-2 px-3 text-xs sm:text-sm font-bold text-slate-700 dark:text-slate-200 bg-slate-50 dark:bg-slate-700/50 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 cursor-pointer transition-colors"
                                @change="if ($event.target.value) window.location.href = $event.target.value">
                                <?php if (!empty($data['academic_years'])): ?>
                                    <?php foreach ($data['academic_years'] as $val): ?>
                                        <option <?= isset($data['academic_year_id']) && $val['id'] == $data['academic_year_id'] ? 'selected' : '' ?> value="<?= base_url('/admin/rombel-siswa/class/') . $data['classrooms']['id'] . '/ay/' . $val['id'] ?>">
                                            Tahun Ajaran <?= $val['year_name'] . ' - Semester ' . $val['semester'] ?>
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
                            x-model="searchMain" 
                            placeholder="Cari NISN / nama..." 
                            class="w-full pl-10 pr-4 py-2.5 bg-slate-50 dark:bg-slate-700/50 border border-slate-200 dark:border-slate-600 rounded-xl text-xs sm:text-sm text-slate-700 dark:text-slate-200 placeholder-slate-400 dark:placeholder-slate-500 focus:outline-none focus:bg-white dark:focus:bg-slate-700 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all font-normal"
                        />
                    </div>

                    <button @click="modaladd = !modaladd" type="button" class="cursor-pointer bg-gradient-to-r from-blue-600 to-indigo-500 w-full sm:w-auto rounded-xl text-white py-2.5 px-5 hover:from-blue-700 hover:to-indigo-600 transition-all duration-300 shadow-sm hover:shadow-md active:scale-[0.98] flex items-center justify-center gap-2 font-semibold text-xs sm:text-sm shrink-0">
                        <i class="ri-user-add-line text-base"></i>
                        Tambah Siswa
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
                                <th class="px-6 py-3.5 text-left">NISN</th>
                                <th class="px-6 py-3.5 text-left">Nama Siswa</th>
                                <th class="px-4 py-3.5 w-36">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 dark:divide-slate-700/60 text-xs sm:text-sm">
                            <?php $no = 1; ?>
                            <?php if (!empty($data['studentInClass'])): ?>
                                <?php foreach ($data['studentInClass'] as $val): ?>
                                    <tr 
                                        class="hover:bg-slate-50/60 dark:hover:bg-slate-700/30 transition-colors"
                                        x-show="searchMain === '' || 
                                                '<?= strtolower(addslashes($val['nisn'] ?? '')) ?>'.includes(searchMain.toLowerCase()) || 
                                                '<?= strtolower(addslashes($val['full_name'] ?? '')) ?>'.includes(searchMain.toLowerCase())"
                                    >
                                        <td class="px-4 py-4 font-medium text-slate-400 dark:text-slate-500"><?= $no++; ?></td>
                                        <td class="px-6 py-4 text-left font-semibold text-slate-600 dark:text-slate-300"><?= htmlspecialchars($val['nisn'] ?? ''); ?></td>
                                        <td class="px-6 py-4 text-left font-bold text-slate-800 dark:text-white"><?= htmlspecialchars($val['full_name'] ?? ''); ?></td>
                                        <td class="px-4 py-4">
                                            <div class="flex items-center justify-center">
                                                <button
                                                    @click="
                                                        data = {
                                                            student_classes_id: '<?= $val['student_classe_id'] ?? ''; ?>',
                                                            classroom_id: '<?= $data['classrooms']['id'] ?? '' ?>',
                                                            academic_year_id: '<?= $data['academic_year_id'] ?? '' ?>',
                                                            full_name: '<?= addslashes($val['full_name'] ?? ''); ?>'
                                                        };
                                                        modaldel = true;
                                                    "
                                                    type="button" 
                                                    title="Keluarkan dari kelas"
                                                    class="cursor-pointer px-2.5 py-1.5 rounded-xl text-slate-500 dark:text-slate-400 hover:text-rose-600 dark:hover:text-rose-400 hover:bg-rose-50 dark:hover:bg-rose-950/30 active:scale-95 transition-all flex items-center gap-1.5 font-semibold text-xs">
                                                    <i class="ri-user-unfollow-line text-base"></i>
                                                    <span>Keluarkan</span>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="4" class="px-4 py-12 text-slate-400 dark:text-slate-500 text-center">
                                        <i class="ri-inbox-line text-4xl block mb-2 opacity-60"></i>
                                        Belum ada siswa yang dimasukkan ke dalam kelas ini.
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

    </div>

    <!-- START MODAL TAMBAH / KELOLA SISWA -->
    <div class="fixed inset-0 h-screen w-screen bg-slate-900/60 backdrop-blur-xs left-0 top-0 z-50 flex items-center justify-center p-4"
        x-cloak
        x-show="modaladd"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        x-data="{ 
            searchModal: '', 
            students: <?= htmlspecialchars(json_encode($data['students'] ?? []), ENT_QUOTES, 'UTF-8') ?>,
            get filteredStudents() {
                if (!this.searchModal.trim()) return this.students;
                return this.students.filter(
                    i => i.full_name.toLowerCase().includes(this.searchModal.toLowerCase()) || 
                         i.nisn.toLowerCase().includes(this.searchModal.toLowerCase())
                )
            }
        }">
        <form action="<?= base_url("/admin/rombel-siswa") ?>" method="post" class="w-full max-w-4xl">
            <input type="hidden" name="classroom_id" value="<?= $data['classrooms']['id'] ?? '' ?>">
            <input type="hidden" name="academic_year_id" value="<?= $data['academic_year_id'] ?? '' ?>">

            <div class="bg-white dark:bg-slate-800 rounded-2xl p-6 sm:p-8 shadow-xl border border-slate-100 dark:border-slate-700/80 transition-colors" @click.away="modaladd = false">
                <div class="flex justify-between items-center pb-4 border-b border-slate-100 dark:border-slate-700/60">
                    <div>
                        <span class="text-xs font-bold text-blue-600 dark:text-sky-400 uppercase tracking-wider">Rombongan Belajar</span>
                        <h6 class="font-bold text-base sm:text-lg text-slate-800 dark:text-white">
                            Kelola Siswa Kelas <?= htmlspecialchars($data['classrooms']['class_name'] ?? '') ?>
                        </h6>
                    </div>
                    <button @click="modaladd = false" type="button" class="cursor-pointer text-slate-400 hover:text-slate-600 dark:hover:text-slate-200 bg-slate-100 dark:bg-slate-700/60 rounded-xl p-2 transition-all">
                        <i class="ri-close-line text-xl"></i>
                    </button>
                </div>

                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 my-6">
                    <h6 class="font-bold text-slate-700 dark:text-slate-300 text-xs sm:text-sm">
                        Pilih Siswa yang Dimasukkan:
                    </h6>

                    <div class="relative w-full sm:w-80">
                        <i class="ri-search-line text-slate-400 dark:text-slate-500 absolute left-3.5 top-1/2 -translate-y-1/2 text-base"></i>
                        <input 
                            x-model="searchModal" 
                            type="text" 
                            class="border border-slate-200 dark:border-slate-600 bg-slate-50 dark:bg-slate-700/50 w-full rounded-xl py-2 pl-10 pr-4 text-xs sm:text-sm text-slate-700 dark:text-slate-200 placeholder-slate-400 dark:placeholder-slate-500 focus:outline-none focus:bg-white dark:focus:bg-slate-700 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all font-normal" 
                            placeholder="Cari NISN atau Nama Siswa...">
                    </div>
                </div>

                <div class="overflow-y-auto max-h-96 border border-slate-200/80 dark:border-slate-700/80 rounded-2xl">
                    <table class="w-full text-center border-collapse">
                        <thead class="sticky top-0 bg-slate-50 dark:bg-slate-700 border-b border-slate-200 dark:border-slate-600 text-[11px] font-bold text-slate-400 dark:text-slate-400 uppercase tracking-wider z-10">
                            <tr class="h-12 sm:h-14">
                                <th class="px-4 w-16">No</th>
                                <th class="px-6 text-left">NISN</th>
                                <th class="px-6 text-left">Nama Siswa</th>
                                <th class="px-4 w-28">Pilih</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 dark:divide-slate-700/60 text-xs sm:text-sm">
                            <template x-for="(val, index) in filteredStudents" :key="val.student_id || index">
                                <tr class="h-12 sm:h-14 hover:bg-slate-50/60 dark:hover:bg-slate-700/30 transition-colors">
                                    <td class="px-4 py-2 text-slate-400 dark:text-slate-500 font-medium" x-text="index + 1"></td>
                                    <td class="px-6 py-2 text-left font-semibold text-slate-600 dark:text-slate-300" x-text="val.nisn"></td>
                                    <td class="px-6 py-2 text-left font-bold text-slate-800 dark:text-white" x-text="val.full_name"></td>
                                    <td class="px-4 py-2">
                                        <div class="flex items-center justify-center">
                                            <label class="relative inline-flex items-center justify-center cursor-pointer">
                                                <input type="checkbox" name="student_id[]" :value="val.student_id"
                                                    class="peer appearance-none w-5 h-5 border-2 border-slate-300 dark:border-slate-600 rounded-md checked:bg-blue-600 dark:checked:bg-sky-500 checked:border-blue-600 dark:checked:border-sky-500 hover:border-indigo-400 dark:hover:border-sky-400 bg-white dark:bg-slate-700 transition-all duration-200 cursor-pointer" />
                                                <i class="ri-check-line absolute text-white text-sm opacity-0 peer-checked:opacity-100 pointer-events-none transition-opacity duration-200"></i>
                                            </label>
                                        </div>
                                    </td>
                                </tr>
                            </template>
                            <template x-if="filteredStudents.length === 0">
                                <tr>
                                    <td colspan="4" class="px-4 py-8 text-slate-400 dark:text-slate-500 text-center">
                                        Tidak ada siswa yang ditemukan.
                                    </td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                </div>

                <div class="mt-6 sm:mt-8 flex justify-end gap-3">
                    <button 
                        @click="modaladd = false" 
                        type="button" 
                        class="cursor-pointer font-bold bg-slate-100 dark:bg-slate-700/60 text-slate-700 dark:text-slate-300 hover:bg-slate-200 dark:hover:bg-slate-700 rounded-xl py-2.5 px-5 transition-all text-xs sm:text-sm">
                        Batal
                    </button>
                    <button 
                        type="submit" 
                        class="cursor-pointer font-bold bg-gradient-to-r from-blue-600 to-indigo-500 rounded-xl text-white py-2.5 px-6 hover:from-blue-700 hover:to-indigo-600 transition-all shadow-md hover:shadow-lg active:scale-[0.98] text-xs sm:text-sm flex items-center gap-2">
                        <i class="ri-save-3-line text-base"></i>
                        Simpan Penambahan
                    </button>
                </div>
            </div>
        </form>
    </div>
    <!-- END MODAL TAMBAH / KELOLA SISWA -->

    <!-- START MODAL DELETE -->
    <div 
        class="fixed inset-0 h-screen w-screen bg-slate-900/60 backdrop-blur-xs left-0 top-0 z-50 flex items-center justify-center p-4" 
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
                <div class="w-12 h-12 bg-rose-50 dark:bg-rose-950/40 text-rose-500 dark:text-rose-400 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <i class="ri-user-unfollow-line text-2xl"></i>
                </div>
                <h6 class="text-base sm:text-lg font-bold text-slate-800 dark:text-white mb-2">Keluarkan Siswa?</h6>
                <p class="text-xs sm:text-sm text-slate-500 dark:text-slate-400">
                    Apakah Anda yakin ingin mengeluarkan <span x-text="data.full_name" class="font-bold text-slate-800 dark:text-white"></span> dari kelas ini?
                </p>
            </div>

            <div class="flex items-center gap-3">
                <a :href="'<?= base_url('/admin/rombel-siswa/del') ?>/' + data.student_classes_id + '/class/' + data.classroom_id + '/ay/' + data.academic_year_id" type="button" class="flex-1 text-center font-bold cursor-pointer bg-gradient-to-r from-rose-600 to-red-500 rounded-xl text-white py-2.5 px-4 hover:from-rose-700 hover:to-red-600 transition-all duration-300 shadow-md hover:shadow-lg active:scale-[0.98] text-xs sm:text-sm">
                    Ya, Keluarkan
                </a>

                <button
                    @click="modaldel = false"
                    type="button" class="flex-1 font-bold cursor-pointer bg-slate-100 dark:bg-slate-700/60 text-slate-700 dark:text-slate-300 rounded-xl py-2.5 px-4 hover:bg-slate-200 dark:hover:bg-slate-700 transition-all duration-300 text-xs sm:text-sm">
                    Batal
                </button>
            </div>
        </div>
    </div>
    <!-- END MODAL DELETE -->

</main>
<!-- main end -->