<?php
    /**
    * @var array $data
    */
?>

<!-- main start -->
<div class="ml-0 md:ml-72 sm:ml-0 bg-gray-100 min-h-screen"
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

    <!-- start data siswa dalam kelas -->
    <div class="pl-15 pr-15 pb-15 pt-0">
        <div class="grid grid-cols-1 gap-6">
            <div class="bg-white rounded-2xl border border-gray-100 shadow-xs">
                <div>

                    <!-- Header Section & Filter Tahun Ajaran -->
                    <div class="font-bold py-8 px-10 border-b border-gray-200 flex flex-col lg:flex-row items-start lg:items-center justify-between gap-4">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center shrink-0">
                                <i class="ri-group-line text-lg"></i>
                            </div>
                            <div class="flex flex-col">
                                <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider">
                                    Siswa Kelas <?= htmlspecialchars($data['classrooms']['class_name']) ?>
                                </span>
                                <div class="flex items-center gap-2">
                                    <select
                                        class="border border-gray-300 rounded-2xl py-1.5 px-3 text-sm font-bold text-gray-700 bg-white focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 cursor-pointer transition-all"
                                        @change="if ($event.target.value) window.location.href = $event.target.value">
                                        <?php foreach ($data['academic_years'] as $val): ?>
                                            <option <?= $val['id'] == $data['academic_year_id'] ? 'selected' : '' ?> value="<?= base_url('/admin/rombel-siswa/class/') . $data['classrooms']['id'] . '/ay/' . $val['id'] ?>">
                                                Tahun Ajaran <?= $val['year_name'] . ' - Semester ' . $val['semester'] ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Action Controls: Input Search & Tombol Tambah -->
                        <div class="flex flex-col sm:flex-row items-center gap-3 w-full lg:w-auto">
                            <div class="relative w-full sm:w-64">
                                <i class="ri-search-line absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400 text-base"></i>
                                <input 
                                    type="text" 
                                    x-model="searchMain" 
                                    placeholder="Cari NISN / nama..." 
                                    class="w-full pl-10 pr-4 py-2 bg-gray-50 border border-gray-200 rounded-2xl text-sm focus:outline-none focus:bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all font-normal text-gray-700"
                                />
                            </div>

                            <button @click="modaladd = !modaladd" type="button" class="cursor-pointer bg-gradient-to-r from-blue-600 to-indigo-500 w-full sm:w-auto rounded-2xl text-white py-2.5 px-6 hover:from-blue-700 hover:to-indigo-600 transition-all duration-300 shadow-sm hover:shadow-md active:scale-[0.98] flex items-center justify-center gap-2 font-semibold text-sm shrink-0">
                                <i class="ri-user-add-line text-base"></i>
                                Tambah Siswa
                            </button>
                        </div>
                    </div>

                    <!-- Table Section -->
                    <div class="px-10 py-6">
                        <div class="overflow-x-auto bg-white border border-gray-300 rounded-2xl text-gray-600 shadow-2xs">
                            <table class="w-full text-center border-collapse">
                                <thead>
                                    <tr class="h-16 bg-gray-50/50 border-b border-gray-200 text-xs font-bold text-gray-500 uppercase tracking-wider">
                                        <th class="px-4 w-16">No</th>
                                        <th class="px-6 text-left">NISN</th>
                                        <th class="px-6 text-left">Nama Siswa</th>
                                        <th class="px-4 w-36">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 text-sm">
                                    <?php $no = 1; ?>
                                    <?php if (!empty($data['studentInClass'])): ?>
                                        <?php foreach ($data['studentInClass'] as $val): ?>
                                            <tr 
                                                class="h-16 hover:bg-gray-50/80 transition-colors"
                                                x-show="searchMain === '' || 
                                                        '<?= strtolower(addslashes($val['nisn'])) ?>'.includes(searchMain.toLowerCase()) || 
                                                        '<?= strtolower(addslashes($val['full_name'])) ?>'.includes(searchMain.toLowerCase())"
                                            >
                                                <td class="px-4 py-2 font-medium text-gray-400"><?= $no++; ?></td>
                                                <td class="px-6 py-2 text-left font-semibold text-gray-600"><?= htmlspecialchars($val['nisn']); ?></td>
                                                <td class="px-6 py-2 text-left font-bold text-gray-800"><?= htmlspecialchars($val['full_name']); ?></td>
                                                <td class="px-4 py-2">
                                                    <div class="flex items-center justify-center">
                                                        <button
                                                            @click="
                                                                data = {
                                                                    student_classes_id: '<?= $val['student_classe_id']; ?>',
                                                                    classroom_id: '<?= $data['classrooms']['id'] ?>',
                                                                    academic_year_id: '<?= $data['academic_year_id'] ?>',
                                                                    full_name: '<?= addslashes($val['full_name']); ?>'
                                                                };
                                                                modaldel = true;
                                                            "
                                                            type="button" 
                                                            title="Keluarkan dari kelas"
                                                            class="cursor-pointer px-3 py-2 rounded-xl text-gray-600 hover:text-rose-600 hover:bg-rose-50 active:scale-95 transition-all flex items-center gap-1.5 font-semibold text-xs border border-transparent hover:border-rose-200">
                                                            <i class="ri-user-unfollow-line text-base"></i>
                                                            <span>Keluarkan</span>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="4" class="px-4 py-12 text-gray-400 text-center">
                                                <i class="ri-inbox-line text-4xl block mb-2 text-gray-300"></i>
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
        </div>
    </div>
    <!-- end data siswa dalam kelas -->

    <!-- START MODAL TAMBAH / KELOLA SISWA -->
    <div class="fixed inset-0 h-screen w-screen bg-black/50 backdrop-blur-xs left-0 top-0 z-50 flex items-center justify-center p-4"
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
            students: <?= htmlspecialchars(json_encode($data['students']), ENT_QUOTES, 'UTF-8') ?>,
            get filteredStudents() {
                if (!this.searchModal.trim()) return this.students;
                return this.students.filter(
                    i => i.full_name.toLowerCase().includes(this.searchModal.toLowerCase()) || 
                         i.nisn.toLowerCase().includes(this.searchModal.toLowerCase())
                )
            }
        }">
        <form action="<?= base_url("/admin/rombel-siswa") ?>" method="post" class="w-full max-w-4xl">
            <input type="hidden" name="classroom_id" value="<?= $data['classrooms']['id'] ?>">
            <input type="hidden" name="academic_year_id" value="<?= $data['academic_year_id'] ?>">

            <div class="bg-white rounded-2xl p-8 shadow-xl" @click.away="modaladd = false">
                <div class="flex justify-between items-center pb-4 border-b border-gray-100">
                    <div>
                        <span class="text-xs font-bold text-blue-600 uppercase tracking-wider">Rombongan Belajar</span>
                        <h6 class="font-bold text-lg text-gray-800">
                            Kelola Siswa Kelas <?= htmlspecialchars($data['classrooms']['class_name']) ?>
                        </h6>
                    </div>
                    <button @click="modaladd = false" type="button" class="cursor-pointer text-gray-400 hover:text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-xl p-2 transition-all">
                        <i class="ri-close-line text-xl"></i>
                    </button>
                </div>

                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 my-6">
                    <h6 class="font-bold text-gray-700 text-sm">
                        Pilih Siswa yang Dimasukkan:
                    </h6>

                    <div class="relative w-full sm:w-80">
                        <i class="ri-search-line text-gray-400 absolute left-3.5 top-1/2 -translate-y-1/2 text-base"></i>
                        <input 
                            x-model="searchModal" 
                            type="text" 
                            class="border border-gray-300 bg-white w-full rounded-2xl py-2 pl-10 pr-4 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all font-normal" 
                            placeholder="Cari NISN atau Nama Siswa...">
                    </div>
                </div>

                <div class="overflow-y-auto max-h-96 border border-gray-300 rounded-2xl shadow-2xs">
                    <table class="w-full text-center border-collapse">
                        <thead class="sticky top-0 bg-gray-50 border-b border-gray-200 text-xs font-bold text-gray-500 uppercase tracking-wider z-10">
                            <tr class="h-14">
                                <th class="px-4 w-16">No</th>
                                <th class="px-6 text-left">NISN</th>
                                <th class="px-6 text-left">Nama Siswa</th>
                                <th class="px-4 w-28">Pilih</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 text-sm">
                            <template x-for="(val, index) in filteredStudents" :key="val.student_id || index">
                                <tr class="h-14 hover:bg-gray-50/80 transition-colors">
                                    <td class="px-4 py-2 text-gray-400 font-medium" x-text="index + 1"></td>
                                    <td class="px-6 py-2 text-left font-semibold text-gray-600" x-text="val.nisn"></td>
                                    <td class="px-6 py-2 text-left font-bold text-gray-800" x-text="val.full_name"></td>
                                    <td class="px-4 py-2">
                                        <div class="flex items-center justify-center">
                                            <label class="relative inline-flex items-center justify-center cursor-pointer">
                                                <input type="checkbox" name="student_id[]" :value="val.student_id"
                                                    class="peer appearance-none w-5 h-5 border-2 border-gray-300 rounded-md checked:bg-blue-600 checked:border-blue-600 hover:border-indigo-400 transition-all duration-200 cursor-pointer" />
                                                <i class="ri-check-line absolute text-white text-sm opacity-0 peer-checked:opacity-100 pointer-events-none transition-opacity duration-200"></i>
                                            </label>
                                        </div>
                                    </td>
                                </tr>
                            </template>
                            <template x-if="filteredStudents.length === 0">
                                <tr>
                                    <td colspan="4" class="px-4 py-8 text-gray-400 text-center">
                                        Tidak ada siswa yang ditemukan.
                                    </td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                </div>

                <div class="mt-8 flex justify-end gap-3">
                    <button 
                        @click="modaladd = false" 
                        type="button" 
                        class="cursor-pointer font-bold bg-gray-100 text-gray-700 rounded-2xl py-3 px-6 hover:bg-gray-200 transition-all text-sm">
                        Batal
                    </button>
                    <button 
                        type="submit" 
                        class="cursor-pointer font-bold bg-gradient-to-r from-blue-600 to-indigo-500 rounded-2xl text-white py-3 px-8 hover:from-blue-700 hover:to-indigo-600 transition-all shadow-md hover:shadow-lg active:scale-[0.98] text-sm flex items-center gap-2">
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
        class="fixed inset-0 h-screen w-screen bg-black/50 backdrop-blur-xs left-0 top-0 z-50 flex items-center justify-center p-4" 
        x-cloak 
        x-show="modaldel"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0">
        
        <div class="bg-white rounded-2xl p-8 max-w-md w-full shadow-xl" @click.away="modaldel = false">
            <div class="text-center mb-6">
                <div class="w-12 h-12 bg-rose-100 text-rose-500 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <i class="ri-user-unfollow-line text-2xl"></i>
                </div>
                <h6 class="text-lg font-bold text-gray-800 mb-2">Keluarkan Siswa?</h6>
                <p class="text-sm text-gray-500">
                    Apakah Anda yakin ingin mengeluarkan <span x-text="data.full_name" class="font-bold text-gray-800"></span> dari kelas ini?
                </p>
            </div>

            <div class="flex items-center gap-3">
                <a :href="'<?= base_url('/admin/rombel-siswa/del') ?>/' + data.student_classes_id + '/class/' + data.classroom_id + '/ay/' + data.academic_year_id" type="button" class="flex-1 text-center font-bold cursor-pointer bg-gradient-to-r from-rose-600 to-red-500 rounded-2xl text-white py-3 px-5 hover:from-rose-700 hover:to-red-600 transition-all duration-300 shadow-md hover:shadow-lg active:scale-[0.98] text-sm">
                    Ya, Keluarkan
                </a>

                <button
                    @click="modaldel = false"
                    type="button" class="flex-1 font-bold cursor-pointer bg-gray-100 text-gray-700 rounded-2xl py-3 px-5 hover:bg-gray-200 transition-all duration-300 text-sm">
                    Batal
                </button>
            </div>
        </div>
    </div>
    <!-- END MODAL DELETE -->

</div>
<!-- main end -->