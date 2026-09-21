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
        kelas: { id: '', class_name: '' }
    }"
    @keydown.window.escape="modaladd = false; modaledit = false; modaldel = false;">
    
    <div class="pl-15 pr-15 pb-15 pt-0">
        <div class="grid grid-cols-1 gap-6">
            <div class="bg-white rounded-2xl border border-gray-100 shadow-xs">
                <div>

                    <!-- Header Section & Search Bar -->
                    <div class="font-bold py-8 px-10 border-b border-gray-200 flex flex-col lg:flex-row items-start lg:items-center justify-between gap-4">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center shrink-0">
                                <i class="ri-building-4-line text-lg"></i>
                            </div>
                            <div class="flex flex-col">
                                <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Master Data</span>
                                <h6 class="text-base font-bold text-gray-800">Data Kelas</h6>
                            </div>
                        </div>

                        <!-- Action Controls: Input Search & Tombol Tambah -->
                        <div class="flex flex-col sm:flex-row items-center gap-3 w-full lg:w-auto">
                            <div class="relative w-full sm:w-64">
                                <i class="ri-search-line absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400 text-base"></i>
                                <input 
                                    type="text" 
                                    x-model="search" 
                                    placeholder="Cari nama kelas..." 
                                    class="w-full pl-10 pr-4 py-2 bg-gray-50 border border-gray-200 rounded-2xl text-sm focus:outline-none focus:bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all font-normal text-gray-700"
                                />
                            </div>

                            <button @click="modaladd = !modaladd" type="button" class="cursor-pointer bg-gradient-to-r from-blue-600 to-indigo-500 w-full sm:w-auto rounded-2xl text-white py-2.5 px-6 hover:from-blue-700 hover:to-indigo-600 transition-all duration-300 shadow-sm hover:shadow-md active:scale-[0.98] flex items-center justify-center gap-2 font-semibold text-sm shrink-0">
                                <i class="ri-add-line text-base"></i>
                                Tambah Kelas
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
                                        <th class="px-6 text-left">Nama Kelas</th>
                                        <th class="px-4 w-48">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 text-sm">
                                    <?php $no = 1; ?>
                                    <?php if (!empty($data['kelas'])): ?>
                                        <?php foreach ($data['kelas'] as $kelas): ?>
                                            <tr 
                                                class="h-16 hover:bg-gray-50/80 transition-colors"
                                                x-show="search === '' || 
                                                        '<?= strtolower(addslashes($kelas['class_name'])) ?>'.includes(search.toLowerCase())"
                                            >
                                                <td class="px-4 py-2 font-medium text-gray-400"><?= $no++; ?></td>
                                                <td class="px-6 py-2 text-left font-bold text-gray-800">
                                                    <?= htmlspecialchars($kelas['class_name']); ?>
                                                </td>
                                                <td class="px-4 py-2">
                                                    <div class="flex items-center justify-center gap-1">
                                                        <!-- Tombol Ubah (Edit) -->
                                                        <button
                                                            @click="
                                                                kelas = {id: '<?= $kelas['id'] ?>', class_name: '<?= addslashes($kelas['class_name']) ?>'}; 
                                                                modaledit = true;
                                                            "
                                                            type="button" 
                                                            title="Ubah Kelas"
                                                            class="cursor-pointer px-2.5 py-1.5 rounded-xl text-gray-600 hover:text-amber-600 hover:bg-amber-50 active:scale-95 transition-all flex items-center gap-1 font-semibold text-xs border border-transparent hover:border-amber-200">
                                                            <i class="ri-edit-line text-base"></i>
                                                            <span>Ubah</span>
                                                        </button>

                                                        <!-- Tombol Hapus -->
                                                        <button
                                                            @click="
                                                                kelas = {id: '<?= $kelas['id'] ?>', class_name: '<?= addslashes($kelas['class_name']) ?>'}; 
                                                                modaldel = true;
                                                            "
                                                            type="button" 
                                                            title="Hapus Kelas"
                                                            class="cursor-pointer px-2.5 py-1.5 rounded-xl text-gray-600 hover:text-rose-600 hover:bg-rose-50 active:scale-95 transition-all flex items-center gap-1 font-semibold text-xs border border-transparent hover:border-rose-200">
                                                            <i class="ri-delete-bin-line text-base"></i>
                                                            <span>Hapus</span>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="3" class="px-4 py-12 text-gray-400 text-center">
                                                <i class="ri-inbox-line text-4xl block mb-2 text-gray-300"></i>
                                                Belum ada data kelas.
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
        
        <form action="<?= base_url('/admin/kelas') ?>" method="post" class="w-full max-w-lg">
            <div class="bg-white rounded-2xl p-8 shadow-xl" @click.away="modaladd = false">
                <div class="flex justify-between items-center mb-6 pb-4 border-b border-gray-100">
                    <h6 class="font-bold text-lg text-gray-800">Tambah Kelas Baru</h6>
                    <button @click="modaladd = false" type="button" class="cursor-pointer text-gray-400 hover:text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-xl p-2 transition-all">
                        <i class="ri-close-line text-xl"></i>
                    </button>
                </div>

                <div class="space-y-5 mb-8">
                    <div>
                        <label class="text-gray-700 text-xs font-bold uppercase tracking-wider block mb-2">Nama Kelas</label>
                        <input required name="class_name" type="text" class="border text-gray-700 border-gray-300 bg-white w-full rounded-2xl py-3 px-4 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all font-normal" placeholder="Contoh: X IPA 1...">
                    </div>
                </div>

                <div>
                    <button type="submit" class="cursor-pointer bg-gradient-to-r from-blue-600 to-indigo-500 w-full rounded-2xl text-white py-3.5 px-5 hover:from-blue-700 hover:to-indigo-600 transition-all shadow-md hover:shadow-lg font-bold text-sm active:scale-[0.98]">
                        Simpan Kelas
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
        
        <form :action="'<?= base_url('/admin/kelas') ?>/' + kelas.id" method="post" class="w-full max-w-lg">
            <div class="bg-white rounded-2xl p-8 shadow-xl" @click.away="modaledit = false">
                <div class="flex justify-between items-center mb-6 pb-4 border-b border-gray-100">
                    <div>
                        <span class="text-xs font-bold text-amber-600 uppercase tracking-wider">Ubah Data</span>
                        <h6 class="font-bold text-lg text-gray-800" x-text="kelas.class_name"></h6>
                    </div>
                    <button @click="modaledit = false" type="button" class="cursor-pointer text-gray-400 hover:text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-xl p-2 transition-all">
                        <i class="ri-close-line text-xl"></i>
                    </button>
                </div>

                <div class="space-y-5 mb-8">
                    <div>
                        <label class="text-gray-700 text-xs font-bold uppercase tracking-wider block mb-2">Nama Kelas</label>
                        <input x-model="kelas.class_name" required name="class_name" type="text" class="border text-gray-700 border-gray-300 bg-white w-full rounded-2xl py-3 px-4 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all font-normal" placeholder="Masukkan nama kelas...">
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
                <h6 class="text-lg font-bold text-gray-800 mb-2">Hapus Data Kelas?</h6>
                <p class="text-sm text-gray-500">
                    Apakah Anda yakin ingin menghapus kelas <span x-text="kelas.class_name" class="font-bold text-gray-800"></span>?
                </p>
            </div>

            <div class="flex items-center gap-3">
                <a :href="'<?= base_url('/admin/kelas/del') ?>/' + kelas.id" class="flex-1 text-center font-bold cursor-pointer bg-gradient-to-r from-rose-600 to-red-500 rounded-2xl text-white py-3 px-5 hover:from-rose-700 hover:to-red-600 transition-all duration-300 shadow-md hover:shadow-lg active:scale-[0.98] text-sm">
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