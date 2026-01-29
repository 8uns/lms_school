<!-- main start -->
<div class="ml-0 md:ml-72 sm:ml-0 bg-gray-100 min-h-screen"
    x-data="{ 
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
                                <?php foreach ($data['academicyears'] as $val): ?>
                                    <option value="<?= base_url('/admin/penugasan-guru/').$val['id'] ?>">Data Penugasan Guru Tahun Ajaran <?= $val['year_name'] . ' / ' . $val['semester'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </h6>
                        <div class="relative">
                            <button @click="modaladd = !modaladd" type="button" class="cursor-pointer bg-gradient-to-r from-blue-600 to-indigo-500 w-full rounded-2xl text-white py-3 px-5 hover:from-blue-700 hover:to-indigo-600 transition-colors">
                                <i class="ri-add-large-line"></i>
                                Tambahkan
                            </button>
                        </div>
                    </div>

                    <div class="px-10 py-5 ">

                        <div class="overflow-x-auto bg-white border border-gray-400 mt-3 rounded-2xl text-gray-600">
                            <table class="w-full text-center">
                                <thead>
                                    <tr class="h-20">
                                        <th class="">No</th>
                                        <th class="">Nama Guru</th>
                                        <th class="">Mata Pelajaran</th>
                                        <th class="">Kelas</th>
                                        <th class="">Tahun Ajaran/Semester</th>
                                        <th class="">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach ($data['teacher_assignments'] as $assigment): ?>
                                        <tr class="h-15 border-b border-t border-gray-300">

                                            <td class="px-4 py-2"><?= $no++; ?></td>
                                            <td class="px-4 py-2"><?= $assigment['teacher_name']; ?></td>
                                            <td class="px-4 py-2"><?= $assigment['subject_name']; ?></td>
                                            <td class="px-4 py-2"><?= $assigment['class_name']; ?></td>
                                            <td class="px-4 py-2"><?= $assigment['period_name']; ?></td>
                                            <td class="px-4 py-2 flex justify-center gap-2">
                                                <div class="w-auto relative">
                                                    <button
                                                        @click="
                                                                data = {
                                                                    assignment_id : '<?= $assigment['assignment_id'] ?>', 
                                                                    teacher_id : '<?= $assigment['teacher_id'] ?>', 
                                                                    subject_id : '<?= $assigment['subject_id'] ?>', 
                                                                    classroom_id : '<?= $assigment['classroom_id'] ?>', 
                                                                    academic_year_id : '<?= $assigment['academic_year_id'] ?>', 
                                                                    teacher_name : '<?= $assigment['teacher_name']; ?>', 
                                                                    subject_name : '<?= $assigment['subject_name']; ?>', 
                                                                    class_name : '<?= $assigment['class_name']; ?>', 
                                                                    period_name : '<?= $assigment['period_name']; ?>'
                                                                }; 
                                                    modaledit = !modaledit
                                                    "
                                                        type="button" class="cursor-pointer  w-full rounded-2xl py-3 px-5 hover:from-slate-600 hover:to-slate-500 transition-all duration-300 hover:text-green-600 hover:shadow-lg active:scale-[0.98]">
                                                        <i class="ri-edit-2-line"></i>
                                                    </button>
                                                </div>

                                                <div class="w-auto relative">
                                                    <button
                                                        @click="
                                                                data = {
                                                                    assignment_id : '<?= $assigment['assignment_id'] ?>', 
                                                                    teacher_id : '<?= $assigment['teacher_id'] ?>', 
                                                                    subject_id : '<?= $assigment['subject_id'] ?>', 
                                                                    classroom_id : '<?= $assigment['classroom_id'] ?>', 
                                                                    academic_year_id : '<?= $assigment['academic_year_id'] ?>', 
                                                                    teacher_name : '<?= $assigment['teacher_name']; ?>', 
                                                                    subject_name : '<?= $assigment['subject_name']; ?>', 
                                                                    class_name : '<?= $assigment['class_name']; ?>', 
                                                                    period_name : '<?= $assigment['period_name']; ?>'
                                                                }; 
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

    <!-- start modal form tambah -->
    <div class="fixed h-screen w-screen bg-black/50 left-0 top-0 z-50" x-cloak x-show="modaladd">
        <form action="<?= base_url('/admin/penugasan-guru') ?>" method="post">
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
                    <label for="" class="text-gray-600 text-sm">Nama Guru</label>
                    <select required name="teacher_id" id="" class="border text-gray-700 border-gray-400 bg-white w-full rounded-2xl py-3 px-10 mr-50 text-sm">
                        <option value="">Pilih Guru</option>
                        <?php foreach ($data['guru'] as $val): ?>
                            <option value="<?= $val['id'] ?>"><?= $val['full_name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-8 relative">
                    <label for="" class="text-gray-600 text-sm">Mata Pelajaran</label>
                    <select required name="subject_id" id="" class="border text-gray-700 border-gray-400 bg-white w-full rounded-2xl py-3 px-10 mr-50 text-sm">
                        <option value="">Pilih Mapel</option>
                        <?php foreach ($data['subject'] as $val): ?>
                            <option value="<?= $val['id'] ?>"><?= $val['subject_name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-8 relative">
                    <label for="" class="text-gray-600 text-sm">Kelas</label>
                    <select required name="classroom_id" id="" class="border text-gray-700 border-gray-400 bg-white w-full rounded-2xl py-3 px-10 mr-50 text-sm">
                        <option value="">Pilih Kelas</option>
                        <?php foreach ($data['classrooms'] as $val): ?>
                            <option value="<?= $val['id'] ?>"><?= $val['class_name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-8 relative">
                    <label for="" class="text-gray-600 text-sm">Tahun Ajaran/Semester</label>
                    <select required name="academic_year_id" id="" class="border text-gray-700 border-gray-400 bg-white w-full rounded-2xl py-3 px-10 mr-50 text-sm">
                        <option value="">Pilih Tahun Ajaran</option>
                        <?php foreach ($data['academicyears'] as $val): ?>
                            <option value="<?= $val['id'] ?>"><?= $val['year_name'] . ' ' . $val['semester'] ?></option>
                        <?php endforeach; ?>
                    </select>
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


    <!-- start modal form edit -->
    <div class="fixed h-screen w-screen bg-black/50 left-0 top-0 z-50" x-cloak x-show="modaledit">
        <form :action="'<?= base_url('/admin/penugasan-guru') ?>/' + data.assignment_id" method="post">
            <div class="bg-white w-1/3 mx-auto mt-40 rounded-2xl p-10" @click.away="modaledit = false">
                <div class="flex justify-between">
                    <h6 class="font-bold text-lg mb-5" x-text="'Edit ' + data.teacher_name "></h6>
                    <div class="mb-8 relative">
                        <button @click="modaledit = !modaledit" type="button" class="cursor-pointer bg-gradient-to-r from-slate-500 to-slate-400 w-full rounded-2xl text-white py-2 px-4 hover:from-slate-600 hover:to-slate-500 transition-all duration-300 shadow-md hover:shadow-lg active:scale-[0.98]">
                            <i class="ri-close-large-fill"></i>
                        </button>
                    </div>
                </div>

                <div class="mb-8 relative">
                    <label for="" class="text-gray-600 text-sm">Nama Guru</label>
                    <select required name="teacher_id" id="" class="border text-gray-700 border-gray-400 bg-white w-full rounded-2xl py-3 px-10 mr-50 text-sm">
                        <option value="">Pilih Guru</option>
                        <?php foreach ($data['guru'] as $val): ?>
                            <option :selected="data.teacher_id == '<?= $val['id'] ?>'" value="<?= $val['id'] ?>">
                                <?= $val['full_name'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-8 relative">
                    <label for="" class="text-gray-600 text-sm">Mata Pelajaran</label>
                    <select required name="subject_id" id="" class="border text-gray-700 border-gray-400 bg-white w-full rounded-2xl py-3 px-10 mr-50 text-sm">
                        <option value="">Pilih Mapel</option>
                        <?php foreach ($data['subject'] as $val): ?>
                            <option :selected="data.subject_id == '<?= $val['id'] ?>'" value="<?= $val['id'] ?>"><?= $val['subject_name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-8 relative">
                    <label for="" class="text-gray-600 text-sm">Kelas</label>
                    <select required name="classroom_id" id="" class="border text-gray-700 border-gray-400 bg-white w-full rounded-2xl py-3 px-10 mr-50 text-sm">
                        <option value="">Pilih Kelas</option>
                        <?php foreach ($data['classrooms'] as $val): ?>
                            <option :selected="data.classroom_id == '<?= $val['id'] ?>'" value="<?= $val['id'] ?>"><?= $val['class_name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-8 relative">
                    <label for="" class="text-gray-600 text-sm">Tahun Ajaran/Semester</label>
                    <select required name="academic_year_id" id="" class="border text-gray-700 border-gray-400 bg-white w-full rounded-2xl py-3 px-10 mr-50 text-sm">
                        <option value="">Pilih Tahun Ajaran</option>
                        <?php foreach ($data['academicyears'] as $val): ?>
                            <option :selected="data.academic_year_id == '<?= $val['id'] ?>'" value="<?= $val['id'] ?>"><?= $val['year_name'] . ' ' . $val['semester'] ?></option>
                        <?php endforeach; ?>
                    </select>
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