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
        modalresetpass: false,
        userdata: { user_id: '', username: '', full_name: '' }
    }"
    @keydown.window.escape="modaladd = false; modaledit = false; modaldel = false; modalresetpass = false;">
    
    <div class="p-4 sm:p-6 lg:p-8 space-y-6">
        
        <!-- STATS WIDGETS SECTION -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 sm:gap-6">
            
            <!-- TOTAL GURU -->
            <div class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-100 dark:border-slate-700/80 p-5 sm:p-6 flex items-center justify-between shadow-xs transition-colors hover:border-blue-200 dark:hover:border-blue-900/50">
                <div>
                    <span class="text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider block mb-1">Total Guru</span>
                    <h3 class="text-2xl sm:text-3xl font-extrabold text-slate-800 dark:text-white">
                        <?= !empty($data['user']) ? count($data['user']) : 0; ?>
                    </h3>
                    <p class="text-xs text-emerald-600 dark:text-emerald-400 font-semibold mt-2 flex items-center gap-1">
                        <i class="ri-checkbox-circle-line"></i>
                        <span>Akun Aktif Terdaftar</span>
                    </p>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-blue-50 dark:bg-sky-950/40 text-blue-600 dark:text-sky-400 flex items-center justify-center shrink-0">
                    <i class="ri-user-star-line text-2xl"></i>
                </div>
            </div>

            <!-- HAK AKSES -->
            <div class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-100 dark:border-slate-700/80 p-5 sm:p-6 flex items-center justify-between shadow-xs transition-colors hover:border-blue-200 dark:hover:border-blue-900/50">
                <div>
                    <span class="text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider block mb-1">Hak Akses</span>
                    <h3 class="text-2xl sm:text-3xl font-extrabold text-slate-800 dark:text-white">Pengajar</h3>
                    <p class="text-xs text-blue-600 dark:text-sky-400 font-semibold mt-2 flex items-center gap-1">
                        <i class="ri-shield-user-line"></i>
                        <span>Akses Pengajar LMS</span>
                    </p>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-sky-50 dark:bg-sky-950/40 text-sky-600 dark:text-sky-400 flex items-center justify-center shrink-0">
                    <i class="ri-user-settings-line text-2xl"></i>
                </div>
            </div>

            <!-- AKSI CEPAT -->
            <div class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-100 dark:border-slate-700/80 p-5 sm:p-6 flex items-center justify-between shadow-xs transition-colors sm:col-span-2 lg:col-span-1 hover:border-blue-200 dark:hover:border-blue-900/50">
                <div>
                    <span class="text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider block mb-1">Aksi Cepat</span>
                    <h3 class="text-xl sm:text-2xl font-extrabold text-slate-800 dark:text-white">Reset & Kelola</h3>
                    <p class="text-xs text-amber-600 dark:text-amber-400 font-semibold mt-2 flex items-center gap-1">
                        <i class="ri-key-2-line"></i>
                        <span>Sesuai Username</span>
                    </p>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-amber-50 dark:bg-amber-950/40 text-amber-600 dark:text-amber-400 flex items-center justify-center shrink-0">
                    <i class="ri-lock-password-line text-2xl"></i>
                </div>
            </div>

        </div>

        <!-- MAIN CONTENT AREA -->
        <div class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-100 dark:border-slate-700/80 shadow-xs transition-colors overflow-hidden">
            
            <!-- HEADER SECTION & SEARCH BAR -->
            <div class="p-5 sm:p-6 border-b border-slate-100 dark:border-slate-700/60 flex flex-col lg:flex-row items-start lg:items-center justify-between gap-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-2xl bg-blue-50 dark:bg-sky-950/40 text-blue-600 dark:text-sky-400 flex items-center justify-center shrink-0">
                        <i class="ri-user-star-line text-lg"></i>
                    </div>
                    <div>
                        <span class="text-[11px] font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500">Manajemen Akun</span>
                        <h4 class="text-base font-bold text-slate-800 dark:text-white mt-0.5">Data Akun Guru</h4>
                    </div>
                </div>

                <!-- ACTION CONTROLS -->
                <div class="flex flex-col sm:flex-row items-center gap-3 w-full lg:w-auto">
                    <div class="relative w-full sm:w-64">
                        <i class="ri-search-line absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-base"></i>
                        <input 
                            type="text" 
                            x-model="search" 
                            placeholder="Cari nama / username..." 
                            class="w-full pl-10 pr-4 py-2 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-2xl text-xs sm:text-sm text-slate-800 dark:text-slate-100 placeholder-slate-400 dark:placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all"
                        />
                    </div>

                    <button 
                        @click="modaladd = !modaladd" 
                        type="button" 
                        class="w-full sm:w-auto inline-flex items-center justify-center gap-2 cursor-pointer bg-gradient-to-r from-blue-900 via-blue-700 to-sky-500 hover:from-blue-950 hover:via-blue-800 hover:to-sky-600 text-white py-2.5 px-5 rounded-2xl text-xs sm:text-sm font-bold shadow-xs hover:shadow-md transition-all active:scale-[0.98] shrink-0">
                        <i class="ri-user-add-line text-base"></i>
                        <span>Tambah Akun</span>
                    </button>
                </div>
            </div>

            <!-- TABLE SECTION -->
            <div class="p-5 sm:p-6">
                <div class="overflow-x-auto rounded-2xl border border-slate-100 dark:border-slate-700/80">
                    <table class="w-full text-center border-collapse">
                        <thead>
                            <tr class="h-12 bg-slate-50/80 dark:bg-slate-700/40 border-b border-slate-100 dark:border-slate-700/80 text-[11px] font-bold text-slate-400 dark:text-slate-400 uppercase tracking-wider">
                                <th class="px-4 w-16">No</th>
                                <th class="px-6 text-left">Nama Lengkap</th>
                                <th class="px-6 text-left">Username</th>
                                <th class="px-4 w-64">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 dark:divide-slate-700/60 text-xs sm:text-sm">
                            <?php $no = 1; ?>
                            <?php if (!empty($data['user'])): ?>
                                <?php foreach ($data['user'] as $user): ?>
                                    <tr 
                                        class="h-16 hover:bg-slate-50/60 dark:hover:bg-slate-700/30 transition-colors"
                                        x-show="search === '' || 
                                                '<?= strtolower(addslashes($user['full_name'])) ?>'.includes(search.toLowerCase()) || 
                                                '<?= strtolower(addslashes($user['username'])) ?>'.includes(search.toLowerCase())"
                                    >
                                        <td class="px-4 py-2 font-medium text-slate-400 dark:text-slate-500"><?= $no++; ?></td>
                                        <td class="px-6 py-2 text-left font-bold text-slate-800 dark:text-slate-100">
                                            <div class="flex items-center gap-3">
                                                <div class="w-8 h-8 rounded-full bg-blue-50 dark:bg-sky-950/60 text-blue-600 dark:text-sky-400 font-bold flex items-center justify-center text-xs shrink-0 border border-blue-100 dark:border-sky-900/50">
                                                    <?= strtoupper(substr($user['full_name'], 0, 1)); ?>
                                                </div>
                                                <span><?= htmlspecialchars($user['full_name']); ?></span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-2 text-left font-semibold">
                                            <span class="px-3 py-1 bg-slate-100 dark:bg-slate-700/60 text-slate-600 dark:text-slate-300 rounded-lg text-xs font-mono border border-slate-200/60 dark:border-slate-600">
                                                @<?= htmlspecialchars($user['username']); ?>
                                            </span>
                                        </td>
                                        <td class="px-4 py-2">
                                            <div class="flex items-center justify-center gap-1">
                                                <!-- Reset Password -->
                                                <button
                                                    @click="
                                                        userdata = {user_id: '<?= $user['id'] ?>', username: '<?= addslashes($user['username']) ?>', full_name: '<?= addslashes($user['full_name']) ?>'}; 
                                                        modalresetpass = true;
                                                    "
                                                    type="button" 
                                                    title="Reset Password"
                                                    class="cursor-pointer px-2.5 py-1.5 rounded-xl text-slate-500 dark:text-slate-400 hover:text-emerald-600 dark:hover:text-emerald-400 hover:bg-emerald-50 dark:hover:bg-emerald-950/40 active:scale-95 transition-all flex items-center gap-1 font-semibold text-xs border border-transparent hover:border-emerald-200 dark:hover:border-emerald-800/40">
                                                    <i class="ri-rotate-lock-line text-base"></i>
                                                    <span>Reset Pass</span>
                                                </button>

                                                <!-- Ubah (Edit) -->
                                                <button
                                                    @click="
                                                        userdata = {user_id: '<?= $user['id'] ?>', username: '<?= addslashes($user['username']) ?>', full_name: '<?= addslashes($user['full_name']) ?>'}; 
                                                        modaledit = true;
                                                    "
                                                    type="button" 
                                                    title="Ubah Akun"
                                                    class="cursor-pointer px-2.5 py-1.5 rounded-xl text-slate-500 dark:text-slate-400 hover:text-amber-600 dark:hover:text-amber-400 hover:bg-amber-50 dark:hover:bg-amber-950/40 active:scale-95 transition-all flex items-center gap-1 font-semibold text-xs border border-transparent hover:border-amber-200 dark:hover:border-amber-800/40">
                                                    <i class="ri-edit-line text-base"></i>
                                                    <span>Ubah</span>
                                                </button>

                                                <!-- Hapus -->
                                                <button
                                                    @click="
                                                        userdata = {user_id: '<?= $user['id'] ?>', full_name: '<?= addslashes($user['full_name']) ?>'}; 
                                                        modaldel = true;
                                                    "
                                                    type="button" 
                                                    title="Hapus Akun"
                                                    class="cursor-pointer px-2.5 py-1.5 rounded-xl text-slate-500 dark:text-slate-400 hover:text-rose-600 dark:hover:text-rose-400 hover:bg-rose-50 dark:hover:bg-rose-950/40 active:scale-95 transition-all flex items-center gap-1 font-semibold text-xs border border-transparent hover:border-rose-200 dark:hover:border-rose-800/40">
                                                    <i class="ri-delete-bin-line text-base"></i>
                                                    <span>Hapus</span>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="4" class="px-4 py-12 text-slate-400 dark:text-slate-500 text-center">
                                        <i class="ri-inbox-line text-4xl block mb-2 opacity-60"></i>
                                        Belum ada data akun guru.
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

    </div>

    <!-- MODAL FORM TAMBAH USER -->
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
        
        <form action="<?= base_url('/admin/guru') ?>" method="post" class="w-full max-w-lg">
            <div class="bg-white dark:bg-slate-800 border border-slate-100 dark:border-slate-700/80 rounded-2xl p-6 sm:p-8 shadow-xl" @click.away="modaladd = false">
                <div class="flex justify-between items-center mb-6 pb-4 border-b border-slate-100 dark:border-slate-700/60">
                    <h6 class="font-bold text-lg text-slate-800 dark:text-white">Tambah Akun Guru</h6>
                    <button @click="modaladd = false" type="button" class="cursor-pointer text-slate-400 hover:text-slate-600 dark:hover:text-slate-200 bg-slate-100 dark:bg-slate-700 hover:bg-slate-200 dark:hover:bg-slate-600 rounded-xl p-2 transition-all">
                        <i class="ri-close-line text-xl"></i>
                    </button>
                </div>

                <div class="space-y-4 mb-6">
                    <div>
                        <label class="text-slate-700 dark:text-slate-300 text-xs font-bold uppercase tracking-wider block mb-2">Nama Lengkap</label>
                        <input required name="full_name" type="text" class="w-full bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-2xl py-3 px-4 text-sm text-slate-800 dark:text-slate-100 placeholder-slate-400 dark:placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all" placeholder="Masukkan nama lengkap...">
                    </div>

                    <div>
                        <label class="text-slate-700 dark:text-slate-300 text-xs font-bold uppercase tracking-wider block mb-2">Username</label>
                        <input required name="username" type="text" class="w-full bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-2xl py-3 px-4 text-sm text-slate-800 dark:text-slate-100 placeholder-slate-400 dark:placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all" placeholder="Masukkan username...">
                    </div>

                    <div>
                        <label class="text-slate-700 dark:text-slate-300 text-xs font-bold uppercase tracking-wider block mb-2">Password</label>
                        <input required name="password" type="password" class="w-full bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-2xl py-3 px-4 text-sm text-slate-800 dark:text-slate-100 placeholder-slate-400 dark:placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all" placeholder="••••••••">
                    </div>
                </div>

                <div>
                    <button type="submit" class="cursor-pointer bg-gradient-to-r from-blue-900 via-blue-700 to-sky-500 hover:from-blue-950 hover:via-blue-800 hover:to-sky-600 text-white w-full rounded-2xl py-3.5 px-5 transition-all shadow-md hover:shadow-lg font-bold text-sm active:scale-[0.98]">
                        Simpan Akun
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- MODAL FORM EDIT USER -->
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
        
        <form :action="'<?= base_url('/admin/guru') ?>/' + userdata.user_id" method="post" class="w-full max-w-lg">
            <div class="bg-white dark:bg-slate-800 border border-slate-100 dark:border-slate-700/80 rounded-2xl p-6 sm:p-8 shadow-xl" @click.away="modaledit = false">
                <div class="flex justify-between items-center mb-6 pb-4 border-b border-slate-100 dark:border-slate-700/60">
                    <div>
                        <span class="text-[11px] font-bold text-amber-600 dark:text-amber-400 uppercase tracking-wider">Ubah Data</span>
                        <h6 class="font-bold text-lg text-slate-800 dark:text-white" x-text="userdata.full_name"></h6>
                    </div>
                    <button @click="modaledit = false" type="button" class="cursor-pointer text-slate-400 hover:text-slate-600 dark:hover:text-slate-200 bg-slate-100 dark:bg-slate-700 hover:bg-slate-200 dark:hover:bg-slate-600 rounded-xl p-2 transition-all">
                        <i class="ri-close-line text-xl"></i>
                    </button>
                </div>

                <div class="space-y-4 mb-6">
                    <div>
                        <label class="text-slate-700 dark:text-slate-300 text-xs font-bold uppercase tracking-wider block mb-2">Nama Lengkap</label>
                        <input x-model="userdata.full_name" required name="full_name" type="text" class="w-full bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-2xl py-3 px-4 text-sm text-slate-800 dark:text-slate-100 placeholder-slate-400 dark:placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all" placeholder="Masukkan nama lengkap...">
                    </div>

                    <div>
                        <label class="text-slate-700 dark:text-slate-300 text-xs font-bold uppercase tracking-wider block mb-2">Username</label>
                        <input x-model="userdata.username" required name="username" type="text" class="w-full bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-2xl py-3 px-4 text-sm text-slate-800 dark:text-slate-100 placeholder-slate-400 dark:placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all" placeholder="Masukkan username...">
                    </div>
                </div>

                <div>
                    <button type="submit" class="cursor-pointer bg-gradient-to-r from-blue-900 via-blue-700 to-sky-500 hover:from-blue-950 hover:via-blue-800 hover:to-sky-600 text-white w-full rounded-2xl py-3.5 px-5 transition-all shadow-md hover:shadow-lg font-bold text-sm active:scale-[0.98]">
                        Perbarui Data
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- MODAL DELETE USER -->
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
        
        <div class="bg-white dark:bg-slate-800 border border-slate-100 dark:border-slate-700/80 rounded-2xl p-6 sm:p-8 max-w-md w-full shadow-xl" @click.away="modaldel = false">
            <div class="text-center mb-6">
                <div class="w-12 h-12 bg-rose-50 dark:bg-rose-950/40 text-rose-600 dark:text-rose-400 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <i class="ri-delete-bin-line text-2xl"></i>
                </div>
                <h6 class="text-lg font-bold text-slate-800 dark:text-white mb-2">Hapus Akun Guru?</h6>
                <p class="text-xs sm:text-sm text-slate-500 dark:text-slate-400">
                    Apakah Anda yakin ingin menghapus akun <span x-text="userdata.full_name" class="font-bold text-slate-800 dark:text-slate-200"></span>?
                </p>
            </div>

            <div class="flex items-center gap-3">
                <a :href="'<?= base_url('/admin/guru/del') ?>/' + userdata.user_id" class="flex-1 text-center font-bold cursor-pointer bg-gradient-to-r from-rose-600 to-red-500 hover:from-rose-700 hover:to-red-600 rounded-2xl text-white py-3 px-5 transition-all duration-300 shadow-md hover:shadow-lg active:scale-[0.98] text-xs sm:text-sm">
                    Ya, Hapus
                </a>

                <button
                    @click="modaldel = false"
                    type="button" class="flex-1 font-bold cursor-pointer bg-slate-100 dark:bg-slate-700 text-slate-700 dark:text-slate-200 hover:bg-slate-200 dark:hover:bg-slate-600 rounded-2xl py-3 px-5 transition-all duration-300 text-xs sm:text-sm">
                    Batal
                </button>
            </div>
        </div>
    </div>

    <!-- MODAL RESET PASSWORD -->
    <div 
        class="fixed inset-0 h-screen w-screen bg-slate-900/60 backdrop-blur-xs left-0 top-0 z-50 flex items-center justify-center p-4" 
        x-cloak 
        x-show="modalresetpass"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0">
        
        <div class="bg-white dark:bg-slate-800 border border-slate-100 dark:border-slate-700/80 rounded-2xl p-6 sm:p-8 max-w-md w-full shadow-xl" @click.away="modalresetpass = false">
            <div class="text-center mb-6">
                <div class="w-12 h-12 bg-emerald-50 dark:bg-emerald-950/40 text-emerald-600 dark:text-emerald-400 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <i class="ri-rotate-lock-line text-2xl"></i>
                </div>
                <h6 class="text-lg font-bold text-slate-800 dark:text-white mb-2">Reset Password Akun?</h6>
                <p class="text-xs sm:text-sm text-slate-500 dark:text-slate-400 mb-3">
                    Apakah Anda yakin ingin mereset password untuk <span x-text="userdata.full_name" class="font-bold text-slate-800 dark:text-slate-200"></span>?
                </p>
                <div class="bg-emerald-50 dark:bg-emerald-950/30 border border-emerald-200/60 dark:border-emerald-800/40 rounded-xl p-3 text-xs text-emerald-800 dark:text-emerald-300 font-medium">
                    Password baru akan sama dengan username: <span x-text="userdata.username" class="font-bold"></span>
                </div>
            </div>

            <div class="flex items-center gap-3">
                <a :href="'<?= base_url('/admin/guru/reset') ?>/' + userdata.user_id" class="flex-1 text-center font-bold cursor-pointer bg-gradient-to-r from-emerald-600 to-teal-500 hover:from-emerald-700 hover:to-teal-600 rounded-2xl text-white py-3 px-5 transition-all duration-300 shadow-md hover:shadow-lg active:scale-[0.98] text-xs sm:text-sm">
                    Ya, Reset
                </a>

                <button
                    @click="modalresetpass = false"
                    type="button" class="flex-1 font-bold cursor-pointer bg-slate-100 dark:bg-slate-700 text-slate-700 dark:text-slate-200 hover:bg-slate-200 dark:hover:bg-slate-600 rounded-2xl py-3 px-5 transition-all duration-300 text-xs sm:text-sm">
                    Batal
                </button>
            </div>
        </div>
    </div>

</main>
<!-- main end -->