<?php
    /**
    * @var array $data
    */
?>
<!-- main start -->
<div class="ml-0 md:ml-72 sm:ml-0 bg-gray-100 min-h-screen"
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
    
    <div class="pl-15 pr-15 pb-15 pt-0">
        <div class="grid grid-cols-1 gap-6">
            <div class="bg-white rounded-2xl border border-gray-100 shadow-xs">
                <div>
                    <!-- Header Section & Filter Tahun Ajaran -->
                    <div class="font-bold py-8 px-10 border-b border-gray-200 flex flex-col lg:flex-row items-start lg:items-center justify-between gap-4">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center shrink-0">
                                <i class="ri-user-shared-line text-lg"></i>
                            </div>
                            <div class="flex flex-col">
                                <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Filter Periode</span>
                                <div class="flex items-center gap-2">
                                    <select
                                        class="border border-gray-300 rounded-2xl py-1.5 px-3 text-sm font-bold text-gray-700 bg-white focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 cursor-pointer transition-all"
                                        @change="if ($event.target.value) window.location.href = $event.target.value">
                                        <?php foreach ($data['academic_years'] as $val): ?>
                                            <option <?= $val['id'] == $data['academic_year_id'] ? 'selected' : '' ?> value="<?= base_url('/admin/penugasan-guru/') . $val['id'] ?>">
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
                                    x-model="search" 
                                    placeholder="Cari guru / mapel..." 
                                    class="w-full pl-10 pr-4 py-2 bg-gray-50 border border-gray-200 rounded-2xl text-sm focus:outline-none focus:bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all font-normal text-gray-700"
                                />
                            </div>

                            <button @click="modaladd = !modaladd" type="button" class="cursor-pointer bg-gradient-to-r from-blue-600 to-indigo-500 w-full sm:w-auto rounded-2xl text-white py-2.5 px-6 hover:from-blue-700 hover:to-indigo-600 transition-all duration-300 shadow-sm hover:shadow-md active:scale-[0.98] flex items-center justify-center gap-2 font-semibold text-sm shrink-0">
                                <i class="ri-add-large-line text-base"></i>
                                Tambah Penugasan
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
                                        <th class="px-6 text-left">Nama Guru</th>
                                        <th class="px-6 text-left">Mata Pelajaran</th>
                                        <th class="px-4">Kelas</th>
                                        <th class="px-4">Tahun Ajaran / Semester</th>
                                        <th class="px-4 w-36">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 text-sm">
                                    <?php $no = 1; ?>
                                    <?php if (!empty($data['teacher_assignments'])): ?>
                                        <?php foreach ($data['teacher_assignments'] as $assigment): ?>
                                            <tr 
                                                class="h-16 hover:bg-gray-50/80 transition-colors"
                                                x-show="search === '' || 
                                                        '<?= strtolower(addslashes($assigment['teacher_name'])) ?>'.includes(search.toLowerCase()) || 
                                                        '<?= strtolower(addslashes($assigment['subject_name'])) ?>'.includes(search.toLowerCase())"
                                            >
                                                <td class="px-4 py-2 font-medium text-gray-400"><?= $no++; ?></td>
                                                <td class="px-6 py-2 text-left font-bold text-gray-800">
                                                    <?= htmlspecialchars($assigment['teacher_name']); ?>
                                                </td>
                                                <td class="px-6 py-2 text-left font-medium">
                                                    <span class="inline-flex items-center px-3 py-1 rounded-xl text-xs font-medium bg-emerald-50 text-emerald-700 border border-emerald-200/60">
                                                        <?= htmlspecialchars($assigment['subject_name']); ?>
                                                    </span>
                                                </td>
                                                <td class="px-4 py-2">
                                                    <span class="inline-flex items-center px-3 py-1 rounded-xl text-xs font-bold bg-blue-50 text-blue-700 border border-blue-100">
                                                        <?= htmlspecialchars($assigment['class_name']); ?>
                                                    </span>
                                                </td>
                                                <td class="px-4 py-2 text-gray-600 font-medium">
                                                    <?= htmlspecialchars($assigment['period_name']); ?>
                                                </td>
                                                <td class="px-4 py-2">
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
                                                            class="cursor-pointer px-3 py-2 rounded-xl text-gray-600 hover:text-amber-600 hover:bg-amber-50 active:scale-95 transition-all flex items-center gap-1.5 font-semibold text-xs border border-transparent hover:border-amber-200">
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
                                                            class="cursor-pointer px-3 py-2 rounded-xl text-gray-600 hover:text-rose-600 hover:bg-rose-50 active:scale-95 transition-all flex items-center gap-1.5 font-semibold text-xs border border-transparent hover:border-rose-200">
                                                            <i class="ri-delete-bin-line text-base"></i>
                                                            <span>Hapus</span>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="6" class="px-4 py-12 text-gray-400 text-center">
                                                <i class="ri-inbox-line text-4xl block mb-2 text-gray-300"></i>
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
        </div>
    </div>

    <!-- START MODAL FORM TAMBAH -->
    <div 
        class="fixed inset-0 h-screen w-screen bg-black/50 backdrop-blur-xs left-0 top-0 z-50 flex items-center justify-center p-4" 
        x-cloak 
        x-show="modaladd"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0">
        
        <form action="<?= base_url('/admin/penugasan-guru') ?>" method="post" class="w-full max-w-lg">
            <div class="bg-white rounded-2xl p-8 shadow-xl" @click.away="modaladd = false">
                <div class="flex justify-between items-center mb-6 pb-4 border-b border-gray-100">
                    <h6 class="font-bold text-lg text-gray-800">Tambah Penugasan Guru</h6>
                    <button @click="modaladd = false" type="button" class="cursor-pointer text-gray-400 hover:text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-xl p-2 transition-all">
                        <i class="ri-close-line text-xl"></i>
                    </button>
                </div>

                <div class="space-y-5 mb-8">
                    <div>
                        <label class="text-gray-700 text-xs font-bold uppercase tracking-wider block mb-2">Nama Guru</label>
                        <select required name="teacher_id" class="border text-gray-700 border-gray-300 bg-white w-full rounded-2xl py-3 px-4 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all">
                            <option value="">-- Pilih Guru --</option>
                            <?php foreach ($data['guru'] as $val): ?>
                                <option value="<?= $val['id'] ?>"><?= htmlspecialchars($val['full_name']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div>
                        <label class="text-gray-700 text-xs font-bold uppercase tracking-wider block mb-2">Mata Pelajaran</label>
                        <select required name="subject_id" class="border text-gray-700 border-gray-300 bg-white w-full rounded-2xl py-3 px-4 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all">
                            <option value="">-- Pilih Mapel --</option>
                            <?php foreach ($data['subject'] as $val): ?>
                                <option value="<?= $val['id'] ?>"><?= htmlspecialchars($val['subject_name']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div>
                        <label class="text-gray-700 text-xs font-bold uppercase tracking-wider block mb-2">Kelas</label>
                        <select required name="classroom_id" class="border text-gray-700 border-gray-300 bg-white w-full rounded-2xl py-3 px-4 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all">
                            <option value="">-- Pilih Kelas --</option>
                            <?php foreach ($data['classrooms'] as $val): ?>
                                <option value="<?= $val['id'] ?>"><?= htmlspecialchars($val['class_name']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div>
                        <label class="text-gray-700 text-xs font-bold uppercase tracking-wider block mb-2">Tahun Ajaran / Semester</label>
                        <select required name="academic_year_id" class="border text-gray-700 border-gray-300 bg-white w-full rounded-2xl py-3 px-4 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all">
                            <option value="">-- Pilih Tahun Ajaran --</option>
                            <?php foreach ($data['academic_years'] as $val): ?>
                                <option value="<?= $val['id'] ?>"><?= htmlspecialchars($val['year_name'] . ' - Semester ' . $val['semester']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div>
                    <button type="submit" class="cursor-pointer bg-gradient-to-r from-blue-600 to-indigo-500 w-full rounded-2xl text-white py-3.5 px-5 hover:from-blue-700 hover:to-indigo-600 transition-all shadow-md hover:shadow-lg font-bold text-sm active:scale-[0.98]">
                        Simpan Penugasan
                    </button>
                </div>
            </div>
        </form>
    </div>
    <!-- END MODAL FORM TAMBAH -->

    <!-- START MODAL FORM EDIT -->
    <div 
        class="fixed inset-0 h-screen w-screen bg-black/50 backdrop-blur-xs left-0 top-0 z-50 flex items-center justify-center p-4" 
        x-cloak 
        x-show="modaledit"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0">
        
        <form :action="'<?= base_url('/admin/penugasan-guru') ?>/' + data.assignment_id" method="post" class="w-full max-w-lg">
            <div class="bg-white rounded-2xl p-8 shadow-xl" @click.away="modaledit = false">
                <div class="flex justify-between items-center mb-6 pb-4 border-b border-gray-100">
                    <div>
                        <span class="text-xs font-bold text-amber-600 uppercase tracking-wider">Ubah Data</span>
                        <h6 class="font-bold text-lg text-gray-800" x-text="data.teacher_name"></h6>
                    </div>
                    <button @click="modaledit = false" type="button" class="cursor-pointer text-gray-400 hover:text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-xl p-2 transition-all">
                        <i class="ri-close-line text-xl"></i>
                    </button>
                </div>

                <div class="space-y-5 mb-8">
                    <div>
                        <label class="text-gray-700 text-xs font-bold uppercase tracking-wider block mb-2">Nama Guru</label>
                        <select required name="teacher_id" class="border text-gray-700 border-gray-300 bg-white w-full rounded-2xl py-3 px-4 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all">
                            <option value="">-- Pilih Guru --</option>
                            <?php foreach ($data['guru'] as $val): ?>
                                <option :selected="data.teacher_id == '<?= $val['id'] ?>'" value="<?= $val['id'] ?>">
                                    <?= htmlspecialchars($val['full_name']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div>
                        <label class="text-gray-700 text-xs font-bold uppercase tracking-wider block mb-2">Mata Pelajaran</label>
                        <select required name="subject_id" class="border text-gray-700 border-gray-300 bg-white w-full rounded-2xl py-3 px-4 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all">
                            <option value="">-- Pilih Mapel --</option>
                            <?php foreach ($data['subject'] as $val): ?>
                                <option :selected="data.subject_id == '<?= $val['id'] ?>'" value="<?= $val['id'] ?>">
                                    <?= htmlspecialchars($val['subject_name']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div>
                        <label class="text-gray-700 text-xs font-bold uppercase tracking-wider block mb-2">Kelas</label>
                        <select required name="classroom_id" class="border text-gray-700 border-gray-300 bg-white w-full rounded-2xl py-3 px-4 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all">
                            <option value="">-- Pilih Kelas --</option>
                            <?php foreach ($data['classrooms'] as $val): ?>
                                <option :selected="data.classroom_id == '<?= $val['id'] ?>'" value="<?= $val['id'] ?>">
                                    <?= htmlspecialchars($val['class_name']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div>
                        <label class="text-gray-700 text-xs font-bold uppercase tracking-wider block mb-2">Tahun Ajaran / Semester</label>
                        <select required name="academic_year_id" class="border text-gray-700 border-gray-300 bg-white w-full rounded-2xl py-3 px-4 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all">
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
                    <button type="submit" class="cursor-pointer bg-gradient-to-r from-blue-600 to-indigo-500 w-full rounded-2xl text-white py-3.5 px-5 hover:from-blue-700 hover:to-indigo-600 transition-all shadow-md hover:shadow-lg font-bold text-sm active:scale-[0.98]">
                        Perbarui Data
                    </button>
                </div>
            </div>
        </form>
    </div>
    <!-- END MODAL FORM EDIT -->

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
                    <i class="ri-delete-bin-line text-2xl"></i>
                </div>
                <h6 class="text-lg font-bold text-gray-800 mb-2">Hapus Penugasan Guru?</h6>
                <p class="text-sm text-gray-500">
                    Apakah Anda yakin ingin menghapus penugasan untuk <span x-text="data.teacher_name" class="font-bold text-gray-800"></span>?
                </p>
            </div>

            <div class="flex items-center gap-3">
                <a :href="'<?= base_url('/admin/penugasan-guru/del') ?>/' + data.assignment_id" class="flex-1 text-center font-bold cursor-pointer bg-gradient-to-r from-rose-600 to-red-500 rounded-2xl text-white py-3 px-5 hover:from-rose-700 hover:to-red-600 transition-all duration-300 shadow-md hover:shadow-lg active:scale-[0.98] text-sm">
                    Ya, Hapus
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