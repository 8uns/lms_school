<!-- main start -->
<div class="ml-0 md:ml-72 sm:ml-0 bg-gray-100 min-h-screen"
    x-data="{ 
                modaladd: false, 
                modaledit: false,
                modaldel: false,
                userdata: {user_id : '', username : '', full_name : '', role : ''}
                 }">
    <div class="pl-15 pr-15 pb-15 pt-0">
        <div class="grid grid-cols-1 gap-6">
            <div class="bg-white rounded-2xl border border-gray-100">
                <div class="">

                    <div class="font-bold py-10 px-10 border-b border-gray-200 flex items-center justify-between">
                        <h6>
                            Data Akun Guru
                        </h6>
                        <div class="relative">
                            <button @click="modaladd = !modaladd" type="button" class="cursor-pointer bg-gradient-to-r from-blue-600 to-indigo-500 w-full rounded-2xl text-white py-3 px-5 hover:from-blue-700 hover:to-indigo-600 transition-colors">
                                <i class="ri-add-large-line"></i>
                                Tambah Akun
                            </button>
                        </div>
                    </div>

                    <div class="px-10 py-5 ">

                        <div class="overflow-x-auto bg-white border border-gray-400 mt-3 rounded-2xl text-gray-600">
                            <table class="w-full text-center">
                                <thead>
                                    <tr class="h-20">
                                        <th class="">No</th>
                                        <th class="">Nama Lengkap</th>
                                        <th class="">Username</th>
                                        <th class="">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach ($data['user'] as $user): ?>
                                        <tr class="h-15 border-b border-t border-gray-300">

                                            <td class="px-4 py-2"><?= $no++; ?></td>
                                            <td class="px-4 py-2"><?= $user['full_name']; ?></td>
                                            <td class="px-4 py-2"><?= $user['username']; ?></td>
                                            <td class="px-4 py-2 flex justify-center gap-2">
                                                <div class="w-auto relative">
                                                    <button
                                                        @click="
                                                    userdata = {user_id : '<?= $user['id'] ?>', username : '<?= $user['username'] ?>', full_name : '<?= $user['full_name'] ?>', role : '<?= $user['role'] ?>'}; 
                                                    modaledit = !modaledit
                                                    "
                                                        type="button" class="cursor-pointer  w-full rounded-2xl py-3 px-5 hover:from-slate-600 hover:to-slate-500 transition-all duration-300 hover:text-green-600 hover:shadow-lg active:scale-[0.98]">
                                                        <i class="ri-edit-2-line"></i>
                                                    </button>
                                                </div>

                                                <div class="w-auto relative">
                                                    <button
                                                        @click="
                                                    userdata = {user_id : '<?= $user['id'] ?>', full_name : '<?= $user['full_name'] ?>'}; 
                                                    modaldel = !modaldel
                                                    "
                                                        type="button" class="cursor-pointer  w-full rounded-2xl py-3 px-5 hover:from-rose-700 hover:to-red-600 transition-all duration-300 hover:text-rose-600 hover:shadow-lg active:scale-[0.98]">
                                                        <i class="ri-delete-bin-5-line"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>

                                    <?php endforeach; ?>
                                </tbody>
                            </table>


                        </div>



                    </div>



                </div>


            </div>
        </div>
    </div>

    <!-- start modal form tambah user -->
    <div class="fixed h-screen w-screen bg-black/50 left-0 top-0 z-50" x-show="modaladd">
        <form action="<?= base_url('/admin/guru') ?>" method="post">
            <div class="bg-white w-1/3 mx-auto mt-40 rounded-2xl p-10" @click.away="modaladd = false">
                <div class="flex justify-between">
                    <h6 class="font-bold text-lg mb-5">Tambah Akun Guru</h6>
                    <div class="mb-8 relative">
                        <button @click="modaladd = !modaladd" type="button" class="cursor-pointer bg-gradient-to-r from-slate-500 to-slate-400 w-full rounded-2xl text-white py-2 px-4 hover:from-slate-600 hover:to-slate-500 transition-all duration-300 shadow-md hover:shadow-lg active:scale-[0.98]">
                            <i class="ri-close-large-fill"></i>
                        </button>
                    </div>
                </div>

                <div class="mb-8 relative">
                    <label for="" class="text-gray-600 text-sm">Username</label>
                    <input required name="username" type="text" class="border text-gray-700 border-gray-400 bg-white w-full rounded-2xl py-3 px-10 text-sm" placeholder="username ...">
                </div>

                <div class="mb-8 relative">
                    <label for="" class="text-gray-600 text-sm">Nama Lengkap</label>
                    <input required name="full_name" type="text" class="border text-gray-700 border-gray-400 bg-white w-full rounded-2xl py-3 px-10 text-sm" placeholder="nama lengkap ...">
                </div>

                <div class="mb-15 relative">
                    <label for="" class="text-gray-600 text-sm">Password</label>
                    <input required name="password" type="password" class="border text-gray-700 border-gray-400 bg-white w-full rounded-2xl py-3 px-10 text-sm" placeholder="••••••••">
                </div>

                <div class="mb-2 relative">
                    <button type="submit" class="cursor-pointer bg-gradient-to-r from-blue-600 to-indigo-500 w-full rounded-2xl text-white py-3 px-5 hover:from-blue-700 hover:to-indigo-600 transition-colors">
                        Tambahkan
                    </button>
                </div>
            </div>
        </form>
    </div>
    <!-- end modal form tambah user-->


    <!-- start modal form edit user -->
    <div class="fixed h-screen w-screen bg-black/50 left-0 top-0 z-50" x-show="modaledit">
        <form :action="'<?= base_url('/admin/guru') ?>/' + userdata.user_id" method="post">
            <div class="bg-white w-1/3 mx-auto mt-40 rounded-2xl p-10" @click.away="modaledit = false">
                <div class="flex justify-between">
                    <h6 class="font-bold text-lg mb-5" x-text="'Edit Akun ' + userdata.full_name "></h6>
                    <div class="mb-8 relative">
                        <button @click="modaledit = !modaledit" type="button" class="cursor-pointer bg-gradient-to-r from-slate-500 to-slate-400 w-full rounded-2xl text-white py-2 px-4 hover:from-slate-600 hover:to-slate-500 transition-all duration-300 shadow-md hover:shadow-lg active:scale-[0.98]">
                            <i class="ri-close-large-fill"></i>
                        </button>
                    </div>
                </div>

                <div class="mb-8 relative">
                    <label for="" class="text-gray-600 text-sm">Username</label>
                    <input x-model="userdata.username" required name="username" type="text" class="border text-gray-700 border-gray-400 bg-white w-full rounded-2xl py-3 px-10 text-sm" placeholder="username ...">
                </div>

                <div class="mb-8 relative">
                    <label for="" class="text-gray-600 text-sm">Nama Lengkap</label>
                    <input x-model="userdata.full_name" required name="full_name" type="text" class="border text-gray-700 border-gray-400 bg-white w-full rounded-2xl py-3 px-10 text-sm" placeholder="nama lengkap ...">
                </div>

                <div class="mb-2 relative">
                    <button type="submit" class="cursor-pointer bg-gradient-to-r from-blue-600 to-indigo-500 w-full rounded-2xl text-white py-3 px-5 hover:from-blue-700 hover:to-indigo-600 transition-colors">
                        Update
                    </button>
                </div>

            </div>
        </form>
    </div>
    <!-- end modal form edit user-->

    <!-- start modal delete user -->
    <div class="fixed h-screen w-screen bg-black/50 left-0 top-0 z-50" x-show="modaldel">
        <div class="bg-white w-1/3 mx-auto mt-40 rounded-2xl p-10">
            <div class="flex justify-center text-center">
                <h6 class="text-lg mb-5 text-center">
                    Hapus Akun
                    <span x-text="userdata.full_name" class="font-bold"></span>
                    ?
                </h6>
            </div>

            <div class="flex justify-around">
                <div class="mb-5 relative">
                    <a :href="'<?= base_url('/admin/guru/del') ?>/' + userdata.user_id" type="button" class="block font-bold cursor-pointer bg-gradient-to-r from-rose-600 to-red-500 w-full rounded-2xl text-white py-3 px-10 hover:from-rose-700 hover:to-red-600 transition-all duration-300 shadow-md hover:shadow-lg active:scale-[0.98]">
                        Ya Hapus
                    </a>
                </div>

                <div class="mb-5 relative">
                    <button
                        @click="modaldel = !modaldel"
                        type="button" class="cursor-pointer font-bold bg-gradient-to-r from-slate-500 to-slate-400 w-full rounded-2xl text-white py-3 px-10 hover:from-slate-600 hover:to-slate-500 transition-all duration-300 shadow-md hover:shadow-lg active:scale-[0.98]">
                        Tidak
                    </button>
                </div>
            </div>


        </div>
    </div>
    <!-- end modal delete user-->
</div>
<!-- main end -->