<!-- main start -->
<div class="ml-0 md:ml-72 sm:ml-0 bg-gray-100 min-h-screen"
    x-data="{ 
                modaladd: false, 
                modaldel: false, 
                 }">

    <!-- start data siswa dalam kelas -->
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
                                    <option <?= $selected = $val['id'] == $academic_year_id ? 'selected' :  '' ?> value="<?= base_url('/admin/rombel-siswa/class/') . $classrooms['id'] . '/ay/' . $val['id'] ?>">Tahun Ajaran <?= $val['year_name'] . ' Semester ' . $val['semester'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </h6>


                        <div class="relative">
                            <button @click="modaladd = !modaladd" type="button" class="cursor-pointer bg-gradient-to-r from-blue-600 to-indigo-500 w-full rounded-2xl text-white py-3 px-5 hover:from-blue-700 hover:to-indigo-600 transition-colors">
                                <i class="ri-add-large-line"></i>
                                Tambah Siswa
                            </button>
                        </div>
                    </div>

                    <div class="px-10 py-5 ">

                        <div class="overflow-x-auto bg-white border border-gray-400 mt-3 rounded-2xl text-gray-600">
                            <table class="w-full text-center">
                                <thead>
                                    <tr class="h-20">
                                        <th class="">No</th>
                                        <th class="">NISN</th>
                                        <th class="">Nama Siswa</th>
                                        <th class="">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <input type="text" name="classroom_id" hidden value="<?= $classrooms['id'] ?>">
                                    <input type="text" name="academic_year_id" hidden value="<?= $academic_year_id ?>">
                                    <?php foreach ($data['siswa'] as $val): ?>
                                        <tr class="h-15 border-b border-t border-gray-300">

                                            <td class="px-4 py-2"><?= $no++; ?></td>
                                            <td class="px-4 py-2"><?= $val['username']; ?></td>
                                            <td class="px-4 py-2"><?= $val['full_name']; ?></td>
                                            <td class="px-4 py-2 justify-center">
                                                <div class="w-auto relative">
                                                    <button
                                                        @click="
                                                                // data = {
                                                                //     assignment_id : '<?= $assigment['assignment_id'] ?>', 
                                                                //     teacher_id : '<?= $assigment['teacher_id'] ?>', 
                                                                //     subject_id : '<?= $assigment['subject_id'] ?>', 
                                                                //     classroom_id : '<?= $assigment['classroom_id'] ?>', 
                                                                //     academic_year_id : '<?= $assigment['academic_year_id'] ?>', 
                                                                //     teacher_name : '<?= $assigment['teacher_name']; ?>', 
                                                                //     subject_name : '<?= $assigment['subject_name']; ?>', 
                                                                //     class_name : '<?= $assigment['class_name']; ?>', 
                                                                //     period_name : '<?= $assigment['period_name']; ?>'
                                                                // }; 
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

                            <!-- start modal simpan perubahan-->
                            <div class="fixed inset-0 bg-black/50 z-50" x-cloak x-show="modaladd">
                                <div class="relative bg-white w-[70%] mx-auto mt-40 rounded-2xl p-10" @click.outside="modaladd = false">

                                    <div class="flex justify-between items-center mb-2 border-b border-gray-200 py-2">
                                        <h6 class="text-lg mb-5 text-center items-center font-bold">
                                            Kelola Data Siswa Kelas <?= $classrooms['class_name'] ?>
                                        </h6>
                                        <button
                                            @click="modaladd = !modaladd"
                                            type="button" class="cursor-pointer w-auto block font-bold bg-gradient-to-r from-slate-500 to-slate-400 rounded-2xl text-white py-1 px-3 hover:from-slate-600 hover:to-slate-500 transition-all duration-300 shadow-md hover:shadow-lg active:scale-[0.98]">
                                            <i class="ri-close-line"></i>
                                        </button>
                                    </div>

                                    <div class="flex justify-between items-center mb-2 mt-10">
                                        <h6 class="text-lg text-center items-center font-bold">
                                            Data Siswa
                                        </h6>

                                        <div class="mb-8 relative w-100">
                                            <i class="ri-search-ai-line text-gray-500 absolute left-3 top-2 "></i>
                                            <input type="text" class="border text-gray-700 border-gray-400 bg-white w-full rounded-2xl py-3 px-10 text-sm" placeholder="form input ...">
                                        </div>


                                    </div>


                                    <div class="overflow-auto max-h-150 bg-white border border-gray-400 mt-3 rounded-2xl text-gray-600">

                                        <form action="<?= base_url("/admin/rombel-siswa") ?>" method="post">
                                            <table class="w-full text-center ">
                                                <thead>
                                                    <tr class="h-20">
                                                        <th class="">No</th>
                                                        <th class="">NISN</th>
                                                        <th class="">Nama Siswa</th>
                                                        <th class="">Tambahkan</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $no = 1; ?>
                                                    <input type="text" name="classroom_id" hidden value="<?= $classrooms['id'] ?>">
                                                    <input type="text" name="academic_year_id" hidden value="<?= $academic_year_id ?>">
                                                    <?php foreach ($data['students'] as $val): ?>
                                                        <tr class="h-15 border-b border-t border-gray-300">

                                                            <td class="px-4 py-2"><?= $no++; ?></td>
                                                            <td class="px-4 py-2"><?= $val['nisn']; ?></td>
                                                            <td class="px-4 py-2"><?= $val['full_name']; ?></td>
                                                            <td class="px-4 py-2 justify-center">
                                                                <div class="w-auto text-center justify-center items-center">
                                                                    <!-- <input type="checkbox" name="student_id_<?= $val['id'] ?>" class=" text-gray-700 inline-block bg-white mr-2.5 items-center text-center "> -->
                                                                    <div class="relative items-center">
                                                                        <input type="checkbox" name="student_id_<?= $val['id'] ?>" class="peer appearance-none w-5 h-5 border-2 border-gray-300 rounded-md checked:bg-blue-600 checked:border-blubg-blue-600 hover:border-indigo-400 transition-all duration-200 cursor-pointer" />
                                                                        <i class="ri-check-line absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 text-white text-sm opacity-0 peer-checked:opacity-100 pointer-events-none transition-opacity duration-200"></i>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>

                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </form>
                                    </div>

                                    <div class="flex justify-around mt-15">
                                        <div class="mb-5 relative">
                                            <button type="submit" :href="'<?= base_url('/admin/kelas/del') ?>/' + kelas.id" class="block font-bold cursor-pointer bg-gradient-to-r from-cyan-600 to-green-500 w-full rounded-2xl text-white py-3 px-10 hover:from-cyan-700 hover:to-green-600 transition-all duration-300 shadow-md hover:shadow-lg active:scale-[0.98]">
                                                <i class="ri-save-3-line inline-block mr-2"></i>
                                                Simpan
                                            </button>
                                        </div>
                                    </div>


                                </div>
                            </div>
                            <!-- end modal simpan perubahan -->

                        </div>



                    </div>



                </div>


            </div>
        </div>
    </div>
    <!-- end data siswa dalam kelas -->




    <!-- start modal delete -->
    <div class="fixed h-screen w-screen bg-black/50 left-0 top-0 z-50" x-cloak x-show="modaldel">
        <div class="bg-white w-1/3 mx-auto mt-40 rounded-2xl p-10" @click.away="modaldel = false">
            <div class="flex justify-center text-center">
                <h6 class="text-lg mb-5 text-center">
                    Hapus
                    <span x-text="data.teacher_name" class="font-bold"></span>
                    ?
                </h6>
            </div>

            <div class="flex justify-around">
                <div class="mb-5 relative">
                    <a :href="'<?= base_url('/admin/penugasan-guru/del') ?>/' + data.assignment_id" type="button" class="block font-bold cursor-pointer bg-gradient-to-r from-rose-600 to-red-500 w-full rounded-2xl text-white py-3 px-10 hover:from-rose-700 hover:to-red-600 transition-all duration-300 shadow-md hover:shadow-lg active:scale-[0.98]">
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
    <!-- end modal delete-->

</div>
<!-- main end -->