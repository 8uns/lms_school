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
        modaluppass: false,
        modaldel: false,
        userdata: { user_id: '', username: '', full_name: '', role: '' }
    }"
    @keydown.window.escape="modaladd = false; modaledit = false; modaluppass = false; modaldel = false;">

    <div class="pl-15 pr-15 pb-15 pt-0">
        <div class="grid grid-cols-1 gap-6">
            <div class="bg-white rounded-2xl border border-gray-100 shadow-xs">
                <div>

                    <!-- Header Section & Search Bar -->
                    <div class="font-bold py-8 px-10 border-b border-gray-200 flex flex-col lg:flex-row items-start lg:items-center justify-between gap-4">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center shrink-0">
                                <i class="ri-user-settings-line text-lg"></i>
                            </div>
                            <div class="flex flex-col">
                                <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Manajemen Akun</span>
                                <h6 class="text-base font-bold text-gray-800">Data Akun Admin</h6>
                            </div>
                        </div>

                        <!-- Action Controls: Input Search & Tombol Tambah -->
                        <div class="flex flex-col sm:flex-row items-center gap-3 w-full lg:w-auto">
                            <div class="relative w-full sm:w-64">
                                <i class="ri-search-line absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400 text-base"></i>
                                <input 
                                    type="text" 
                                    x-model="search" 
                                    placeholder="Cari nama / username..." 
                                    class="w-full pl-10 pr-4 py-2 bg-gray-50 border border-gray-200 rounded-2xl text-sm focus:outline-none focus:bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all font-normal text-gray-700"
                                />
                            </div>

                            <button @click="modaladd = true" type="button" class="cursor-pointer bg-gradient-to-r from-blue-600 to-indigo-500 w-full sm:w-auto rounded-2xl text-white py-2.5 px-6 hover:from-blue-700 hover:to-indigo-600 transition-all duration-300 shadow-sm hover:shadow-md active:scale-[0.98] flex items-center justify-center gap-2 font-semibold text-sm shrink-0">
                                <i class="ri-user-add-line text-base"></i>
                                Tambah Akun
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
                                        <th class="px-6 text-left">Nama Lengkap</th>
                                        <th class="px-6 text-left">Username</th>
                                        <th class="px-6 text-left">Role</th>
                                        <th class="px-4 w-64">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 text-sm">
                                    <?php $no = 1; ?>
                                    <?php if (!empty($data['user'])): ?>
                                        <?php foreach ($data['user'] as $user): ?>
                                            <tr 
                                                class="h-16 hover:bg-gray-50/80 transition-colors"
                                                x-show="search === '' || 
                                                        '<?= strtolower(addslashes($user['full_name'])) ?>'.includes(search.toLowerCase()) || 
                                                        '<?= strtolower(addslashes($user['username'])) ?>'.includes(search.toLowerCase())"
                                            >
                                                <td class="px-4 py-2 font-medium text-gray-400"><?= $no++; ?></td>
                                                <td class="px-6 py-2 text-left font-bold text-gray-800">
                                                    <?= htmlspecialchars($user['full_name']); ?>
                                                </td>
                                                <td class="px-6 py-2 text-left font-semibold text-gray-600">
                                                    <code class="text-xs bg-gray-100 px-2.5 py-1 rounded-lg text-gray-600 font-mono"><?= htmlspecialchars($user['username']); ?></code>
                                                </td>
                                                <td class="px-6 py-2 text-left">
                                                    <span class="inline-block px-3 py-1 rounded-2xl text-xs font-semibold <?= $user['role'] === 'SuperAdmin' ? 'bg-indigo-50 text-indigo-600 border border-indigo-100' : 'bg-gray-100 text-gray-700' ?>">
                                                        <?= htmlspecialchars($user['role']); ?>
                                                    </span>
                                                </td>
                                                <td class="px-4 py-2">
                                                    <div class="flex items-center justify-center gap-1">
                                                        <!-- Tombol Ubah Password -->
                                                        <button
                                                            @click="
                                                                userdata = {user_id: '<?= $user['id'] ?>', username: '<?= addslashes($user['username']) ?>', full_name: '<?= addslashes($user['full_name']) ?>', role: '<?= addslashes($user['role']) ?>'}; 
                                                                modaluppass = true;
                                                            "
                                                            type="button" 
                                                            title="Ubah Password"
                                                            class="cursor-pointer px-2.5 py-1.5 rounded-xl text-gray-600 hover:text-amber-600 hover:bg-amber-50 active:scale-95 transition-all flex items-center gap-1 font-semibold text-xs border border-transparent hover:border-amber-200">
                                                            <i class="ri-lock-password-line text-base"></i>
                                                            <span>Password</span>
                                                        </button>

                                                        <!-- Tombol Ubah (Edit Data) -->
                                                        <button
                                                            @click="
                                                                userdata = {user_id: '<?= $user['id'] ?>', username: '<?= addslashes($user['username']) ?>', full_name: '<?= addslashes($user['full_name']) ?>', role: '<?= addslashes($user['role']) ?>'}; 
                                                                modaledit = true;
                                                            "
                                                            type="button" 
                                                            title="Ubah Akun"
                                                            class="cursor-pointer px-2.5 py-1.5 rounded-xl text-gray-600 hover:text-blue-600 hover:bg-blue-50 active:scale-95 transition-all flex items-center gap-1 font-semibold text-xs border border-transparent hover:border-blue-200">
                                                            <i class="ri-edit-line text-base"></i>
                                                            <span>Ubah</span>
                                                        </button>

                                                        <!-- Tombol Hapus -->
                                                        <button
                                                            @click="
                                                                userdata = {user_id: '<?= $user['id'] ?>', full_name: '<?= addslashes($user['full_name']) ?>'}; 
                                                                modaldel = true;
                                                            "
                                                            type="button" 
                                                            title="Hapus Akun"
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
                                            <td colspan="5" class="px-4 py-12 text-gray-400 text-center">
                                                <i class="ri-inbox-line text-4xl block mb-2 text-gray-300"></i>
                                                Belum ada data akun admin.
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

    <!-- START MODAL FORM TAMBAH USER -->
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
        
        <form action="<?= base_url('/administrator/user/admin') ?>" method="post" class="w-full max-w-lg">
            <div class="bg-white rounded-2xl p-8 shadow-xl" @click.away="modaladd = false">
                <div class="flex justify-between items-center mb-6 pb-4 border-b border-gray-100">
                    <div>
                        <h6 class="font-bold text-lg text-gray-800">Tambah Akun Admin</h6>
                        <p class="text-xs text-gray-400 font-normal">Buat kredensial administrator baru</p>
                    </div>
                    <button @click="modaladd = false" type="button" class="cursor-pointer text-gray-400 hover:text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-xl p-2 transition-all">
                        <i class="ri-close-line text-xl"></i>
                    </button>
                </div>

                <div class="space-y-4 mb-8">
                    <div>
                        <label class="text-gray-700 text-xs font-bold uppercase tracking-wider block mb-2">Username</label>
                        <input required name="username" type="text" class="border text-gray-700 border-gray-300 bg-white w-full rounded-2xl py-3 px-4 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all font-normal" placeholder="Masukkan username...">
                    </div>

                    <div>
                        <label class="text-gray-700 text-xs font-bold uppercase tracking-wider block mb-2">Nama Lengkap</label>
                        <input required name="full_name" type="text" class="border text-gray-700 border-gray-300 bg-white w-full rounded-2xl py-3 px-4 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all font-normal" placeholder="Masukkan nama lengkap...">
                    </div>

                    <div>
                        <label class="text-gray-700 text-xs font-bold uppercase tracking-wider block mb-2">Role Admin</label>
                        <select required name="role" class="border text-gray-700 border-gray-300 bg-white w-full rounded-2xl py-3 px-4 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all font-normal">
                            <option value="">Pilih Role</option>
                            <option value="SuperAdmin">SuperAdmin</option>
                            <option value="Admin">Admin</option>
                        </select>
                    </div>

                    <div>
                        <label class="text-gray-700 text-xs font-bold uppercase tracking-wider block mb-2">Password</label>
                        <input required name="password" type="password" class="border text-gray-700 border-gray-300 bg-white w-full rounded-2xl py-3 px-4 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all font-normal" placeholder="••••••••">
                    </div>
                </div>

                <div>
                    <button type="submit" class="cursor-pointer bg-gradient-to-r from-blue-600 to-indigo-500 w-full rounded-2xl text-white py-3.5 px-5 hover:from-blue-700 hover:to-indigo-600 transition-all shadow-md hover:shadow-lg font-bold text-sm active:scale-[0.98]">
                        Simpan Akun
                    </button>
                </div>
            </div>
        </form>
    </div>
    <!-- END MODAL FORM TAMBAH USER -->

    <!-- START MODAL FORM EDIT USER -->
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
        
        <form :action="'<?= base_url('/administrator/user/admin') ?>/' + userdata.user_id" method="post" class="w-full max-w-lg">
            <div class="bg-white rounded-2xl p-8 shadow-xl" @click.away="modaledit = false">
                <div class="flex justify-between items-center mb-6 pb-4 border-b border-gray-100">
                    <div>
                        <span class="text-xs font-bold text-blue-600 uppercase tracking-wider">Ubah Data</span>
                        <h6 class="font-bold text-lg text-gray-800" x-text="userdata.full_name"></h6>
                    </div>
                    <button @click="modaledit = false" type="button" class="cursor-pointer text-gray-400 hover:text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-xl p-2 transition-all">
                        <i class="ri-close-line text-xl"></i>
                    </button>
                </div>

                <div class="space-y-4 mb-8">
                    <div>
                        <label class="text-gray-700 text-xs font-bold uppercase tracking-wider block mb-2">Username</label>
                        <input x-model="userdata.username" required name="username" type="text" class="border text-gray-700 border-gray-300 bg-white w-full rounded-2xl py-3 px-4 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all font-normal" placeholder="Masukkan username...">
                    </div>

                    <div>
                        <label class="text-gray-700 text-xs font-bold uppercase tracking-wider block mb-2">Nama Lengkap</label>
                        <input x-model="userdata.full_name" required name="full_name" type="text" class="border text-gray-700 border-gray-300 bg-white w-full rounded-2xl py-3 px-4 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all font-normal" placeholder="Masukkan nama lengkap...">
                    </div>

                    <div>
                        <label class="text-gray-700 text-xs font-bold uppercase tracking-wider block mb-2">Role Admin</label>
                        <select required name="role" class="border text-gray-700 border-gray-300 bg-white w-full rounded-2xl py-3 px-4 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all font-normal">
                            <option value="">Pilih Role</option>
                            <option :selected="userdata.role == 'SuperAdmin'" value="SuperAdmin">SuperAdmin</option>
                            <option :selected="userdata.role == 'Admin'" value="Admin">Admin</option>
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
    <!-- END MODAL FORM EDIT USER -->

    <!-- START MODAL FORM EDIT PASSWORD (DENGAN VERIFIKASI DUA KALI INPUT) -->
    <div 
        class="fixed inset-0 h-screen w-screen bg-black/50 backdrop-blur-xs left-0 top-0 z-50 flex items-center justify-center p-4" 
        x-cloak 
        x-show="modaluppass"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        x-data="{ new_password: '', confirm_password: '', pass_error: false }">
        
        <form :action="'<?= base_url('/administrator/user/admin/uppas') ?>/' + userdata.user_id" 
              method="post" 
              class="w-full max-w-lg"
              @submit.prevent="
                  if (new_password !== confirm_password) {
                      pass_error = true;
                  } else {
                      pass_error = false;
                      $el.submit();
                  }
              ">
            <div class="bg-white rounded-2xl p-8 shadow-xl" @click.away="modaluppass = false; pass_error = false; new_password = ''; confirm_password = '';">
                <div class="flex justify-between items-center mb-6 pb-4 border-b border-gray-100">
                    <div>
                        <span class="text-xs font-bold text-amber-600 uppercase tracking-wider">Keamanan</span>
                        <h6 class="font-bold text-lg text-gray-800" x-text="'Ubah Password ' + userdata.full_name"></h6>
                    </div>
                    <button @click="modaluppass = false; pass_error = false; new_password = ''; confirm_password = '';" type="button" class="cursor-pointer text-gray-400 hover:text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-xl p-2 transition-all">
                        <i class="ri-close-line text-xl"></i>
                    </button>
                </div>

                <!-- Alert Error Jika Password Tidak Cocok -->
                <div x-show="pass_error" x-transition class="mb-5 p-3.5 bg-rose-50 border border-rose-200/80 rounded-xl flex items-center gap-2.5 text-xs text-rose-600 font-semibold">
                    <i class="ri-error-warning-line text-lg shrink-0"></i>
                    <span>Password dan Konfirmasi Password tidak cocok! Silakan periksa kembali.</span>
                </div>

                <div class="space-y-4 mb-8">
                    <div>
                        <label class="text-gray-700 text-xs font-bold uppercase tracking-wider block mb-2">Password Baru</label>
                        <input x-model="new_password" required name="password" type="password" class="border text-gray-700 border-gray-300 bg-white w-full rounded-2xl py-3 px-4 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all font-normal" placeholder="Masukkan password baru...">
                    </div>

                    <div>
                        <label class="text-gray-700 text-xs font-bold uppercase tracking-wider block mb-2">Konfirmasi Password Baru</label>
                        <input x-model="confirm_password" required type="password" class="border text-gray-700 border-gray-300 bg-white w-full rounded-2xl py-3 px-4 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all font-normal" placeholder="Ulangi password baru...">
                    </div>
                </div>

                <div>
                    <button type="submit" class="cursor-pointer bg-gradient-to-r from-blue-600 to-indigo-500 w-full rounded-2xl text-white py-3.5 px-5 hover:from-blue-700 hover:to-indigo-600 transition-all shadow-md hover:shadow-lg font-bold text-sm active:scale-[0.98]">
                        Update Password
                    </button>
                </div>
            </div>
        </form>
    </div>
    <!-- END MODAL FORM EDIT PASSWORD -->

    <!-- START MODAL DELETE USER -->
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
                <h6 class="text-lg font-bold text-gray-800 mb-2">Hapus Akun Admin?</h6>
                <p class="text-sm text-gray-500">
                    Apakah Anda yakin ingin menghapus akun <span x-text="userdata.full_name" class="font-bold text-gray-800"></span>? Tindakan ini tidak dapat dibatalkan.
                </p>
            </div>

            <div class="flex items-center gap-3">
                <a :href="'<?= base_url('/administrator/user/admin/del') ?>/' + userdata.user_id" class="flex-1 text-center font-bold cursor-pointer bg-gradient-to-r from-rose-600 to-red-500 rounded-2xl text-white py-3 px-5 hover:from-rose-700 hover:to-red-600 transition-all duration-300 shadow-md hover:shadow-lg active:scale-[0.98] text-sm">
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
    <!-- END MODAL DELETE USER -->

</div>
<!-- main end -->