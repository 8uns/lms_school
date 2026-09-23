<?php
/**
 * @var array $data
 */

// Kalkulasi ringkasan untuk Widget Stats
$totalClasses = !empty($data['kelas']) ? count($data['kelas']) : 0;
?>

<!-- main start -->
<main 
    class="md:ml-72 min-h-screen bg-slate-50 dark:bg-slate-900/90 text-slate-800 dark:text-slate-100 transition-colors duration-300"
    x-data="{ 
        search: '',
        modaladd: false, 
        modaledit: false,
        modaldel: false,
        kelas: { id: '', class_name: '' }
    }"
    @keydown.window.escape="modaladd = false; modaledit = false; modaldel = false;">

    <div class="p-4 sm:p-6 lg:p-8 space-y-6">

        <!-- STATS DASHBOARD WIDGET MANAJEMEN KELAS -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 lg:gap-6">
            
            <!-- CARD 1: TOTAL KELAS -->
            <div class="bg-white dark:bg-slate-800 p-5 rounded-2xl border border-slate-100 dark:border-slate-700/80 shadow-xs flex items-center justify-between transition-colors">
                <div class="space-y-1">
                    <span class="text-[11px] font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500">Total Kelas</span>
                    <h3 class="text-2xl sm:text-3xl font-extrabold text-slate-800 dark:text-white leading-tight">
                        <?= $totalClasses ?> <span class="text-xs font-semibold text-slate-400">Rombel</span>
                    </h3>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-blue-50 dark:bg-sky-950/40 text-blue-600 dark:text-sky-400 flex items-center justify-center shrink-0">
                    <i class="ri-building-4-line text-2xl"></i>
                </div>
            </div>

            <!-- CARD 2: STATUS DATA -->
            <div class="bg-white dark:bg-slate-800 p-5 rounded-2xl border border-slate-100 dark:border-slate-700/80 shadow-xs flex items-center justify-between transition-colors">
                <div class="space-y-1">
                    <span class="text-[11px] font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500">Status Master</span>
                    <h3 class="text-2xl sm:text-3xl font-extrabold text-emerald-600 dark:text-emerald-400 leading-tight">
                        Aktif
                    </h3>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-emerald-50 dark:bg-emerald-950/40 text-emerald-600 dark:text-emerald-400 flex items-center justify-center shrink-0">
                    <i class="ri-checkbox-circle-line text-2xl"></i>
                </div>
            </div>

            <!-- CARD 3: INTEGRASI ROMBEL -->
            <div class="bg-white dark:bg-slate-800 p-5 rounded-2xl border border-slate-100 dark:border-slate-700/80 shadow-xs flex items-center justify-between transition-colors">
                <div class="space-y-1">
                    <span class="text-[11px] font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500">Tingkat Akademik</span>
                    <h3 class="text-2xl sm:text-3xl font-extrabold text-slate-800 dark:text-white leading-tight">
                        Reguler
                    </h3>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-indigo-50 dark:bg-indigo-950/40 text-indigo-600 dark:text-indigo-400 flex items-center justify-center shrink-0">
                    <i class="ri-bookmark-3-line text-2xl"></i>
                </div>
            </div>

        </div>

        <!-- CONTAINER UTAMA (DATA KELAS) -->
        <div class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-100 dark:border-slate-700/80 shadow-xs transition-colors overflow-hidden">
            
            <!-- HEADER SECTION & ACTION CONTROLS -->
            <div class="p-5 sm:p-6 border-b border-slate-100 dark:border-slate-700/60 flex flex-col lg:flex-row items-start lg:items-center justify-between gap-4">
                
                <div class="flex items-center gap-3 w-full lg:w-auto">
                    <div class="w-12 h-12 rounded-2xl bg-blue-50 dark:bg-sky-950/40 text-blue-600 dark:text-sky-400 flex items-center justify-center shrink-0">
                        <i class="ri-building-4-line text-2xl"></i>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-[11px] font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500">
                            Master Data
                        </span>
                        <h6 class="text-base sm:text-lg font-bold text-slate-800 dark:text-white">
                            Data Kelas
                        </h6>
                    </div>
                </div>

                <!-- ACTION CONTROLS: INPUT SEARCH & TAMBAH -->
                <div class="flex flex-col sm:flex-row items-center gap-3 w-full lg:w-auto">
                    <div class="relative w-full sm:w-64">
                        <i class="ri-search-line absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 dark:text-slate-500 text-base"></i>
                        <input 
                            type="text" 
                            x-model="search" 
                            placeholder="Cari nama kelas..." 
                            class="w-full pl-10 pr-4 py-2.5 bg-slate-50 dark:bg-slate-700/50 border border-slate-200 dark:border-slate-600 rounded-xl text-xs sm:text-sm text-slate-700 dark:text-slate-200 placeholder-slate-400 dark:placeholder-slate-500 focus:outline-none focus:bg-white dark:focus:bg-slate-700 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all font-normal"
                        />
                    </div>

                    <button @click="modaladd = !modaladd" type="button" class="cursor-pointer bg-gradient-to-r from-blue-600 to-indigo-500 w-full sm:w-auto rounded-xl text-white py-2.5 px-5 hover:from-blue-700 hover:to-indigo-600 transition-all duration-300 shadow-sm hover:shadow-md active:scale-[0.98] flex items-center justify-center gap-2 font-semibold text-xs sm:text-sm shrink-0">
                        <i class="ri-add-line text-base"></i>
                        Tambah Kelas
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
                                <th class="px-6 py-3.5 text-left">Nama Kelas</th>
                                <th class="px-4 py-3.5 w-48">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 dark:divide-slate-700/60 text-xs sm:text-sm">
                            <?php $no = 1; ?>
                            <?php if (!empty($data['kelas'])): ?>
                                <?php foreach ($data['kelas'] as $kelas): ?>
                                    <tr 
                                        class="hover:bg-slate-50/60 dark:hover:bg-slate-700/30 transition-colors"
                                        x-show="search === '' || 
                                                '<?= strtolower(addslashes($kelas['class_name'])) ?>'.includes(search.toLowerCase())"
                                    >
                                        <td class="px-4 py-4 font-medium text-slate-400 dark:text-slate-500"><?= $no++; ?></td>
                                        <td class="px-6 py-4 text-left font-bold text-slate-800 dark:text-white">
                                            <?= htmlspecialchars($kelas['class_name']); ?>
                                        </td>
                                        <td class="px-4 py-4">
                                            <div class="flex items-center justify-center gap-1">
                                                <!-- Tombol Ubah -->
                                                <button
                                                    @click="
                                                        kelas = {id: '<?= $kelas['id'] ?>', class_name: '<?= addslashes($kelas['class_name']) ?>'}; 
                                                        modaledit = true;
                                                    "
                                                    type="button" 
                                                    title="Ubah Kelas"
                                                    class="cursor-pointer px-2.5 py-1.5 rounded-xl text-slate-500 dark:text-slate-400 hover:text-amber-600 dark:hover:text-amber-400 hover:bg-amber-50 dark:hover:bg-amber-950/30 active:scale-95 transition-all flex items-center gap-1 font-semibold text-xs">
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
                                    <td colspan="3" class="px-4 py-12 text-slate-400 dark:text-slate-500 text-center">
                                        <i class="ri-inbox-line text-4xl block mb-2 opacity-60"></i>
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

    <!-- START MODAL FORM TAMBAH -->
    <div 
        class="fixed inset-0 h-screen w-screen bg-slate-900/60 backdrop-blur-xs left-0 top-0 z-50 flex items-center justify-center p-4" 
        x-cloak 
        x-show="modaladd"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0">
        
        <form action="<?= base_url('/admin/kelas') ?>" method="post" class="w-full max-w-lg">
            <div class="bg-white dark:bg-slate-800 rounded-2xl p-6 sm:p-8 shadow-xl border border-slate-100 dark:border-slate-700/80 transition-colors" @click.away="modaladd = false">
                <div class="flex justify-between items-center pb-4 border-b border-slate-100 dark:border-slate-700/60 mb-6">
                    <h6 class="font-bold text-base sm:text-lg text-slate-800 dark:text-white">Tambah Kelas Baru</h6>
                    <button @click="modaladd = false" type="button" class="cursor-pointer text-slate-400 hover:text-slate-600 dark:hover:text-slate-200 bg-slate-100 dark:bg-slate-700/60 rounded-xl p-2 transition-all">
                        <i class="ri-close-line text-xl"></i>
                    </button>
                </div>

                <div class="space-y-4 mb-8">
                    <div>
                        <label class="text-slate-700 dark:text-slate-300 text-xs font-bold uppercase tracking-wider block mb-2">Nama Kelas</label>
                        <input required name="class_name" type="text" class="border border-slate-200 dark:border-slate-600 bg-slate-50 dark:bg-slate-700/50 text-slate-800 dark:text-slate-100 w-full rounded-xl py-2.5 px-4 text-xs sm:text-sm focus:outline-none focus:bg-white dark:focus:bg-slate-700 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all font-normal" placeholder="Contoh: X IPA 1...">
                    </div>
                </div>

                <div>
                    <button type="submit" class="cursor-pointer bg-gradient-to-r from-blue-600 to-indigo-500 w-full rounded-xl text-white py-3 px-5 hover:from-blue-700 hover:to-indigo-600 transition-all shadow-md hover:shadow-lg font-bold text-xs sm:text-sm active:scale-[0.98]">
                        Simpan Kelas
                    </button>
                </div>
            </div>
        </form>
    </div>
    <!-- END MODAL FORM TAMBAH -->

    <!-- START MODAL FORM EDIT -->
    <div 
        class="fixed inset-0 h-screen w-screen bg-slate-900/60 backdrop-blur-xs left-0 top-0 z-50 flex items-center justify-center p-4" 
        x-cloak 
        x-show="modaledit"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0">
        
        <form :action="'<?= base_url('/admin/kelas') ?>/' + kelas.id" method="post" class="w-full max-w-lg">
            <div class="bg-white dark:bg-slate-800 rounded-2xl p-6 sm:p-8 shadow-xl border border-slate-100 dark:border-slate-700/80 transition-colors" @click.away="modaledit = false">
                <div class="flex justify-between items-center pb-4 border-b border-slate-100 dark:border-slate-700/60 mb-6">
                    <div>
                        <span class="text-xs font-bold text-amber-600 dark:text-amber-400 uppercase tracking-wider">Ubah Data</span>
                        <h6 class="font-bold text-base sm:text-lg text-slate-800 dark:text-white" x-text="kelas.class_name"></h6>
                    </div>
                    <button @click="modaledit = false" type="button" class="cursor-pointer text-slate-400 hover:text-slate-600 dark:hover:text-slate-200 bg-slate-100 dark:bg-slate-700/60 rounded-xl p-2 transition-all">
                        <i class="ri-close-line text-xl"></i>
                    </button>
                </div>

                <div class="space-y-4 mb-8">
                    <div>
                        <label class="text-slate-700 dark:text-slate-300 text-xs font-bold uppercase tracking-wider block mb-2">Nama Kelas</label>
                        <input x-model="kelas.class_name" required name="class_name" type="text" class="border border-slate-200 dark:border-slate-600 bg-slate-50 dark:bg-slate-700/50 text-slate-800 dark:text-slate-100 w-full rounded-xl py-2.5 px-4 text-xs sm:text-sm focus:outline-none focus:bg-white dark:focus:bg-slate-700 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all font-normal" placeholder="Masukkan nama kelas...">
                    </div>
                </div>

                <div>
                    <button type="submit" class="cursor-pointer bg-gradient-to-r from-blue-600 to-indigo-500 w-full rounded-xl text-white py-3 px-5 hover:from-blue-700 hover:to-indigo-600 transition-all shadow-md hover:shadow-lg font-bold text-xs sm:text-sm active:scale-[0.98]">
                        Perbarui Data
                    </button>
                </div>
            </div>
        </form>
    </div>
    <!-- END MODAL FORM EDIT -->

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
                    <i class="ri-delete-bin-line text-2xl"></i>
                </div>
                <h6 class="text-base sm:text-lg font-bold text-slate-800 dark:text-white mb-2">Hapus Data Kelas?</h6>
                <p class="text-xs sm:text-sm text-slate-500 dark:text-slate-400">
                    Apakah Anda yakin ingin menghapus kelas <span x-text="kelas.class_name" class="font-bold text-slate-800 dark:text-white"></span>?
                </p>
            </div>

            <div class="flex items-center gap-3">
                <a :href="'<?= base_url('/admin/kelas/del') ?>/' + kelas.id" class="flex-1 text-center font-bold cursor-pointer bg-gradient-to-r from-rose-600 to-red-500 rounded-xl text-white py-2.5 px-4 hover:from-rose-700 hover:to-red-600 transition-all duration-300 shadow-md hover:shadow-lg active:scale-[0.98] text-xs sm:text-sm">
                    Ya, Hapus
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