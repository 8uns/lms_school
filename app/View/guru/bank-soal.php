<!-- main start -->
<div class="ml-0 md:ml-72 sm:ml-0 bg-gray-100 min-h-screen"
    x-data="{ 
                modaladd: false, 
                data: {user_id : '', username : '', full_name : ''}
                 }">
    <div class="pl-15 pr-15 pb-15 pt-0">
        <div class="grid grid-cols-1 gap-6">
            <div class="bg-white rounded-2xl border border-gray-100">
                <div class="">

                    <div class="font-bold py-10 px-10 border-b border-gray-200 flex items-center justify-between">
                        <h6>
                            <select
                                x-data
                                @change="if ($event.target.value) window.location.href = $event.target.value">
                                <?php foreach ($data['academic_years'] as $val): ?>
                                    <option <?= $selected = $val['id'] == $academic_year_id ? 'selected' :  '' ?> value="<?= base_url('/guru/bank-soal/ay/')  . $val['id'] ?>">Tahun Ajaran <?= $val['year_name'] . ' Semester ' . $val['semester'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </h6>

                        <div class="relative flex gap-2">
                            <button @click="modaladd = !modaladd" type="button" class="cursor-pointer bg-gradient-to-r from-blue-600 to-indigo-500  rounded-2xl text-white py-3 px-5 hover:from-blue-700 hover:to-indigo-600 transition-colors">
                                <i class="ri-add-large-line"></i>
                                Tambah Soal Baru
                            </button>
                        </div>
                    </div>

                    <div class="px-10 py-5 ">

                        <div class="overflow-x-auto bg-white border border-gray-400 mt-3 rounded-2xl text-gray-600">
                            <table class="w-full text-center">
                                <thead>
                                    <tr class="h-20">
                                        <th class="">No</th>
                                        <th class="">Mata Pelajaran</th>
                                        <th class="">Kelas</th>
                                        <th class="">Tahun Ajaran</th>
                                        <th class="">Total Soal</th>
                                        <th class="">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach ($data['classsubject'] as $val): ?>
                                        <tr class="h-15 border-b border-t border-gray-300">

                                            <td class="px-4 py-2"><?= $no++; ?></td>
                                            <td class="px-4 py-2"><?= $val['subject_name']; ?></td>
                                            <td class="px-4 py-2"><?= $val['class_name']; ?></td>
                                            <td class="px-4 py-2"><?= $val['year_name'] . ' ' . $val['semester']; ?></td>
                                            <td class="px-4 py-2"><?= $val['total_soal']; ?></td>

                                            <td class="px-4 py-2 flex justify-center gap-2">
                                                <div class="w-auto relative">
                                                    <a href="<?= base_url('/guru/bank-soal/soal') ?>"
                                                        class="cursor-pointer  w-full rounded-2xl py-3 px-5 hover:from-slate-600 hover:to-slate-500 transition-all duration-300 hover:text-green-600 hover:shadow-lg active:scale-[0.98]">
                                                        <i class="ri-eye-fill"></i>
                                                    </a>
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


    <!-- start modal form tambah data -->
    <div class="fixed h-screen w-screen bg-black/50 left-0 top-0 z-50" x-cloak x-show="modaladd">
        <form action="<?= base_url('/admin/siswa') ?>" method="post">
            <div class="bg-white w-1/3 mx-auto mt-40 rounded-2xl p-10" @click.away="modaladd = false">
                <div class="flex justify-between">
                    <h6 class="font-bold text-lg mb-5">Tambah Akun Siswa</h6>
                    <div class="mb-8 relative">
                        <button @click="modaladd = !modaladd" type="button" class="cursor-pointer bg-gradient-to-r from-slate-500 to-slate-400 w-full rounded-2xl text-white py-2 px-4 hover:from-slate-600 hover:to-slate-500 transition-all duration-300 shadow-md hover:shadow-lg active:scale-[0.98]">
                            <i class="ri-close-large-fill"></i>
                        </button>
                    </div>
                </div>

                <div class="mb-8 relative">
                    <label for="" class="text-gray-600 text-sm">Nama Lengkap</label>
                    <input required name="full_name" type="text" class="border text-gray-700 border-gray-400 bg-white w-full rounded-2xl py-3 px-10 text-sm" placeholder="nama lengkap ...">
                </div>

                <div class="mb-8 relative">
                    <label for="" class="text-gray-600 text-sm">Username</label>
                    <input required name="username" type="text" class="border text-gray-700 border-gray-400 bg-white w-full rounded-2xl py-3 px-10 text-sm" placeholder="username ...">
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
    <!-- end modal form tambah data-->


</div>
<!-- main end -->