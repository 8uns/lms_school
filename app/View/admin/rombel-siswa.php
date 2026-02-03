<!-- main start -->
<div class="ml-0 md:ml-72 sm:ml-0 bg-gray-100 min-h-screen"
    x-data="{ 
                modaladd: false, 
                modaledit: false,
                modaldel: false,
                // data: {
                //     assignment_id : '', 
                //     teacher_id : '', 
                //     subject_id : '', 
                //     classroom_id : '', 
                //     academic_year_id : '', 
                //     teacher_name : '', 
                //     subject_name : '', 
                //     class_name : '', 
                //     period_name : ''
                // }
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
                                    <option <?= $selected = $val['id'] == $academic_year_id ? 'selected' :  '' ?> value="<?= base_url('/admin/rombel-siswa/') . $val['id'] ?>">Tahun Ajaran <?= $val['year_name'] . ' Semester ' . $val['semester'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </h6>
                        <!-- <div class="relative">
                            <button @click="modaladd = !modaladd" type="button" class="cursor-pointer bg-gradient-to-r from-blue-600 to-indigo-500 w-full rounded-2xl text-white py-3 px-5 hover:from-blue-700 hover:to-indigo-600 transition-colors">
                                <i class="ri-settings-line"></i>
                                Kelola Rombel
                            </button>
                        </div> -->
                    </div>

                    <div class="px-10 py-5 ">

                        <div class="overflow-x-auto bg-white border border-gray-400 mt-3 rounded-2xl text-gray-600">
                            <table class="w-full text-center">
                                <thead>
                                    <tr class="h-20">
                                        <th class="">No</th>
                                        <th class="">Kelas</th>
                                        <th class="">Jumlah Siswa</th>
                                        <th class="">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach ($data['studentclasses'] as $val): ?>
                                        <tr class="h-15 border-b border-t border-gray-300">

                                            <td class="px-4 py-2"><?= $no++; ?></td>
                                            <td class="px-4 py-2"><?= $val['class_name']; ?></td>
                                            <td class="px-4 py-2"><?= $val['total_students']; ?></td>
                                            <!-- <td class="px-4 py-2 flex justify-center gap-2">
                                                <div class="w-auto relative">
                                                    <button
                                                        @click="
                                                                data = {
                                                                    assignment_id : '<?= $val['assignment_id'] ?>', 
                                                                    teacher_id : '<?= $val['teacher_id'] ?>', 
                                                                    subject_id : '<?= $val['subject_id'] ?>', 
                                                                    classroom_id : '<?= $val['classroom_id'] ?>', 
                                                                    academic_year_id : '<?= $val['academic_year_id'] ?>', 
                                                                    teacher_name : '<?= $val['teacher_name']; ?>', 
                                                                    subject_name : '<?= $val['subject_name']; ?>', 
                                                                    class_name : '<?= $val['class_name']; ?>', 
                                                                    period_name : '<?= $val['period_name']; ?>'
                                                                }; 
                                                    modaledit = !modaledit
                                                    "
                                                        type="button" class="cursor-pointer  w-full rounded-2xl py-3 px-5 hover:from-slate-600 hover:to-slate-500 transition-all duration-300 hover:text-green-600 hover:shadow-lg active:scale-[0.98]">
                                                        <i class="ri-group-3-fill"></i>
                                                    </button>
                                                </div>

                                            </td> -->
                                            <td>
                                                <a href="/admin/rombel-siswa/class/<?= $val['classroom_id'] ?>/ay/<?= $academic_year_id ?>" class="block hover:text-blue-700 py-5 font-bold text-sm">
                                                    <i class="ri-group-3-fill"></i>
                                                </a>
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
        <div class="bg-white w-1/3 mx-auto mt-40 rounded-2xl p-10" @click.away="modaladd = false">
            <div class="font-bold py-5 px-10 border-b border-gray-200 items-center justify-center text-center">
                <h6 class="text-xl">
                    Pilih Kelas
                </h6>

            </div>

            <div class="px-0 py-5">
                <div class="overflow-auto h-160 bg-white border border-gray-400 mt-3 rounded-2xl text-gray-600">
                    <table class="w-full text-center">
                        <!-- <thead>
                            <tr class="h-20">
                                <th class="">Kelas</th>
                            </tr>
                        </thead> -->
                        <tbody>
                            <?php $no = 1; ?>
                            <?php foreach ($data['classrooms'] as $val): ?>
                                <tr class="border-b border-t border-gray-300">
                                    <td class="p-0 m-0">
                                        <a href="/admin/rombel-siswa/class/<?= $val['id'] ?>" class="block hover:text-blue-700 py-5 font-bold text-sm">

                                            Kelas <?= $val['class_name']; ?>
                                        </a>

                                    </td>
                                </tr>

                            <?php endforeach; ?>
                        </tbody>
                    </table>


                </div>



            </div>
        </div>
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
                        <?php foreach ($data['academic_years'] as $val): ?>
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


</div>
<!-- main end -->