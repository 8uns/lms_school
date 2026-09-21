<?php

/**
 * @var array $data
 */
?>

<!-- main start -->
<div class="ml-0 md:ml-72 sm:ml-0 bg-gray-100 min-h-screen"
    x-data="{ search: '' }">
    <div class="pl-15 pr-15 pb-15 pt-0">
        <div class="grid grid-cols-1 gap-6">
            <div class="bg-white rounded-2xl border border-gray-100 shadow-xs">
                <div>
                    <!-- Header Section & Filter Tahun Ajaran -->
                    <div class="font-bold py-8 px-10 border-b border-gray-200 flex flex-col lg:flex-row items-start lg:items-center justify-between gap-4">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center shrink-0">
                                <i class="ri-team-line text-lg"></i>
                            </div>
                            <div class="flex flex-col">
                                <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Rombongan Belajar</span>
                                <div class="flex items-center gap-2">
                                    <select
                                        class="border border-gray-300 rounded-2xl py-1.5 px-3 text-sm font-bold text-gray-700 bg-white focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 cursor-pointer transition-all"
                                        @change="if ($event.target.value) window.location.href = $event.target.value">
                                        <?php foreach ($data['academic_years'] as $val): ?>
                                            <option <?= $val['id'] == $data['academic_year_id'] ? 'selected' : '' ?> value="<?= base_url('/admin/rombel-siswa/') . $val['id'] ?>">
                                                Tahun Ajaran <?= $val['year_name'] . ' - Semester ' . $val['semester'] ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Action Controls: Input Search -->
                        <div class="flex flex-col sm:flex-row items-center gap-3 w-full lg:w-auto">
                            <div class="relative w-full sm:w-64">
                                <i class="ri-search-line absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400 text-base"></i>
                                <input 
                                    type="text" 
                                    x-model="search" 
                                    placeholder="Cari kelas..." 
                                    class="w-full pl-10 pr-4 py-2 bg-gray-50 border border-gray-200 rounded-2xl text-sm focus:outline-none focus:bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all font-normal text-gray-700"
                                />
                            </div>
                        </div>
                    </div>

                    <!-- Table Section -->
                    <div class="px-10 py-6">
                        <div class="overflow-x-auto bg-white border border-gray-300 rounded-2xl text-gray-600 shadow-2xs">
                            <table class="w-full text-center border-collapse">
                                <thead>
                                    <tr class="h-16 bg-gray-50/50 border-b border-gray-200 text-xs font-bold text-gray-500 uppercase tracking-wider">
                                        <th class="px-4 w-16">No</th>
                                        <th class="px-6 text-left">Kelas</th>
                                        <th class="px-6">Jumlah Siswa</th>
                                        <th class="px-4 w-36">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 text-sm">
                                    <?php $no = 1; ?>
                                    <?php if (!empty($data['studentclasses'])): ?>
                                        <?php foreach ($data['studentclasses'] as $val): ?>
                                            <tr 
                                                class="h-16 hover:bg-gray-50/80 transition-colors"
                                                x-show="search === '' || '<?= strtolower(addslashes($val['class_name'])) ?>'.includes(search.toLowerCase())"
                                            >
                                                <td class="px-4 py-2 font-medium text-gray-400"><?= $no++; ?></td>
                                                <td class="px-6 py-2 text-left font-bold text-gray-800">
                                                    Kelas <?= htmlspecialchars($val['class_name']); ?>
                                                </td>
                                                <td class="px-6 py-2">
                                                    <span class="inline-flex items-center px-3 py-1 rounded-xl text-xs font-bold bg-blue-50 text-blue-700 border border-blue-100">
                                                        <?= htmlspecialchars($val['total_students']); ?> Siswa
                                                    </span>
                                                </td>
                                                <td class="px-4 py-2">
                                                    <div class="flex items-center justify-center">
                                                        <a href="<?= base_url('/admin/rombel-siswa/class/') . $val['classroom_id'] . '/ay/' . $data['academic_year_id'] ?>"
                                                            title="Lihat Detail Siswa"
                                                            class="cursor-pointer px-3 py-2 rounded-xl text-gray-600 hover:text-blue-600 hover:bg-blue-50 active:scale-95 transition-all flex items-center gap-1.5 font-semibold text-xs border border-transparent hover:border-blue-200">
                                                            <i class="ri-eye-line text-base"></i>
                                                            <span>Detail</span>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="4" class="px-4 py-12 text-gray-400 text-center">
                                                <i class="ri-inbox-line text-4xl block mb-2 text-gray-300"></i>
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
        </div>
    </div>
</div>
<!-- main end -->