<!-- main start -->
<div class="ml-0 md:ml-72 sm:ml-0 bg-gray-100 min-h-screen"
    x-data="{ 
                modaladd: false, 
                modaledit: false,
                modaldel: false,
                subjects: {id : '', subject_name : ''}
            }">
    <div class="pl-15 pr-15 pb-15 pt-0">
        <div class="grid grid-cols-1 gap-6">
            <div class="bg-white rounded-2xl border border-gray-100">
                <div class="">

                    <div class="font-bold py-10 px-10 border-b border-gray-200 flex items-center justify-between">
                        <h6>
                            Data Mata Pelajaran
                        </h6>
                        <div class="relative">
                            <button @click="modaladd = !modaladd" type="button" class="cursor-pointer bg-gradient-to-r from-blue-600 to-indigo-500 w-full rounded-2xl text-white py-3 px-5 hover:from-blue-700 hover:to-indigo-600 transition-colors">
                                <i class="ri-add-large-line"></i>
                                Tambah Mata Pelajaran
                            </button>
                        </div>
                    </div>

                    <div class="px-10 py-5 ">

                        <div class="overflow-x-auto bg-white border border-gray-400 mt-3 rounded-2xl text-gray-600">
                            <table class="w-full text-center">
                                <thead>
                                    <tr class="h-20">
                                        <th class="">No</th>
                                        <th class="">Nama Mata Pelajaran</th>
                                        <th class="">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach ($data['subjects'] as $subjects): ?>
                                        <tr class="h-15 border-b border-t border-gray-300">

                                            <td class="px-4 py-2"><?= $no++; ?></td>
                                            <td class="px-4 py-2"><?= $subjects['subject_name']; ?></td>
                                            <td class="px-4 py-2 flex justify-center gap-2">
                                                <div class="w-auto relative">
                                                    <button
                                                        @click="
                                                    subjects = {id : '<?= $subjects['id'] ?>', subject_name : '<?= $subjects['subject_name'] ?>'}; 
                                                    modaledit = !modaledit
                                                    "
                                                        type="button" class="cursor-pointer  w-full rounded-2xl py-3 px-5 hover:from-slate-600 hover:to-slate-500 transition-all duration-300 hover:text-green-600 hover:shadow-lg active:scale-[0.98]">
                                                        <i class="ri-edit-2-line"></i>
                                                    </button>
                                                </div>

                                                <div class="w-auto relative">
                                                    <button
                                                        @click="
                                                    subjects = {id : '<?= $subjects['id'] ?>', subject_name : '<?= $subjects['subject_name'] ?>'}; 
                                                    modaldel = !modaldel
                                                    "
                                                        type="button"
                                                        class="cursor-pointer  w-full rounded-2xl py-3 px-5 hover:from-rose-700 hover:to-red-600 transition-all duration-300 hover:text-rose-600 hover:shadow-lg active:scale-[0.98]">
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

    <!-- start modal form tambah-->
    <div class="fixed inset-0 bg-black/50 z-50" x-show="modaladd">
        <form action="<?= base_url('/admin/mata-pelajaran') ?>" method="post">
            <div class="bg-white w-1/3 mx-auto mt-40 rounded-2xl p-10" @click.outside="modaladd = false">
                <div class="flex justify-between">
                    <h6 class="font-bold text-lg mb-5">Tambah Mata Pelajaran</h6>
                    <div class="mb-8 relative">
                        <button @click="modaladd = !modaladd" type="button" class="cursor-pointer bg-gradient-to-r from-slate-500 to-slate-400 w-full rounded-2xl text-white py-2 px-4 hover:from-slate-600 hover:to-slate-500 transition-all duration-300 shadow-md hover:shadow-lg active:scale-[0.98]">
                            <i class="ri-close-large-fill"></i>
                        </button>
                    </div>
                </div>


                <div class="mb-8 relative">
                    <label for="" class="text-gray-600 text-sm">Nama Mata Pelajaran</label>
                    <input required name="subject_name" type="text" class="border text-gray-700 border-gray-400 bg-white w-full rounded-2xl py-3 px-10 text-sm" placeholder="nama Mata Pelajaran ...">
                </div>

                <div class="mb-2 relative">
                    <button type="submit" class="cursor-pointer bg-gradient-to-r from-blue-600 to-indigo-500 w-full rounded-2xl text-white py-3 px-5 hover:from-blue-700 hover:to-indigo-600 transition-colors">
                        Tambahkan
                    </button>
                </div>
            </div>
        </form>
    </div>
    <!-- end modal form tambah -->


    <!-- start modal form edit-->
    <div class="fixed inset-0 bg-black/50 z-50" x-show="modaledit">
        <form :action="'<?= base_url('/admin/mata-pelajaran') ?>/' + subjects.id" method="post">
            <div class="bg-white w-1/3 mx-auto mt-40 rounded-2xl p-10" @click.outside="modaledit = false">
                <div class="flex justify-between">
                    <h6 class="font-bold text-lg mb-5" x-text="'Edit Mata Pelajaran ' + subjects.subject_name"></h6>
                    <div class="mb-8 relative">
                        <button @click="modaledit = !modaledit" type="button" class="cursor-pointer bg-gradient-to-r from-slate-500 to-slate-400 w-full rounded-2xl text-white py-2 px-4 hover:from-slate-600 hover:to-slate-500 transition-all duration-300 shadow-md hover:shadow-lg active:scale-[0.98]">
                            <i class="ri-close-large-fill"></i>
                        </button>
                    </div>
                </div>

                <div class="mb-8 relative">
                    <label for="" class="text-gray-600 text-sm">Nama Mata Pelajaran</label>
                    <input x-model="subjects.subject_name" required name="subject_name" type="text" class="border text-gray-700 border-gray-400 bg-white w-full rounded-2xl py-3 px-10 text-sm" placeholder="nama Mata Pelajaran ...">
                </div>

                <div class="mb-2 relative">
                    <button type="submit" class="cursor-pointer bg-gradient-to-r from-blue-600 to-indigo-500 w-full rounded-2xl text-white py-3 px-5 hover:from-blue-700 hover:to-indigo-600 transition-colors">
                        Update
                    </button>
                </div>

            </div>
        </form>
    </div>
    <!-- end modal form edit -->

    <!-- start modal delete-->
    <div class="fixed inset-0 bg-black/50 z-50" x-show="modaldel">
        <div class="bg-white w-1/3 mx-auto mt-40 rounded-2xl p-10" @click.outside="modaldel = false">
            <div class="flex justify-center text-center">
                <h6 class="text-lg mb-5 text-center">
                    Hapus Akun
                    <span x-text="subjects.subject_name" class="font-bold"></span>
                    ?
                </h6>
            </div>

            <div class="flex justify-around">
                <div class="mb-5 relative">
                    <a :href="'<?= base_url('/admin/mata-pelajaran/del') ?>/' + subjects.id" type="button" class="block font-bold cursor-pointer bg-gradient-to-r from-rose-600 to-red-500 w-full rounded-2xl text-white py-3 px-10 hover:from-rose-700 hover:to-red-600 transition-all duration-300 shadow-md hover:shadow-lg active:scale-[0.98]">
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
    <!-- end modal delete -->
</div>
<!-- main end -->