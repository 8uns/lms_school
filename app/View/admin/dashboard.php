<?php

/**
 * @var array $data
 */
?>

<!-- main start -->
<div class="ml-0 md:ml-72 sm:ml-0 bg-gray-100 min-h-screen">
    <div class="pl-15 pr-15 pb-15 pt-0">
        <div class="grid grid-cols-1 gap-6">

            <!-- BANNER TAHUN AJARAN -->
            <div class="bg-white rounded-2xl border border-gray-100 p-8 shadow-xs flex flex-col md:flex-row items-center justify-between gap-4">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-gray-100 rounded-2xl flex items-center justify-center text-gray-700">
                        <i class="ri-calendar-event-fill text-2xl"></i>
                    </div>
                    <div>
                        <span class="text-xs font-bold uppercase tracking-wider text-gray-400">Tahun Ajaran Aktif</span>
                        <h3 class="text-xl font-bold text-gray-800"> <?= $data['activeYear']['year_name'] . ' ' . $data['activeYear']['semester'] ?></h3>
                    </div>
                </div>
                <div>
                    <a href="<?= base_url('/admin/tahun-ajaran') ?>" class="inline-block cursor-pointer bg-linear-to-r from-blue-600 to-indigo-500 rounded-2xl text-white py-3 px-5 hover:from-blue-700 hover:to-indigo-600 transition-colors text-sm font-bold">
                        <i class="ri-settings-3-line"></i> Kelola Tahun Ajaran
                    </a>
                </div>
            </div>

            <!-- STATS CARDS GRID -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

                <!-- CARD: GURU -->
                <div class="bg-white rounded-2xl border border-gray-100 p-6 flex flex-col justify-between">
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-sm font-bold text-gray-500">Guru</span>
                        <div class="w-10 h-10 bg-gray-100 rounded-2xl flex items-center justify-center text-gray-700">
                            <i class="ri-user-2-fill text-lg"></i>
                        </div>
                    </div>
                    <div class="text-3xl font-extrabold text-gray-800 mb-3"><?= $data['totalTeachers'] ?></div>
                    <div class="space-y-1 pt-3 border-t border-gray-100 text-xs">
                        <div class="flex justify-between text-gray-600">
                            <span>Sudah Penugasan:</span>
                            <span class="font-bold text-gray-800"><?= $data['assignedTeachers'] ?></span>
                        </div>
                        <div class="flex justify-between text-gray-600">
                            <span>Belum Penugasan:</span>
                            <span class="font-bold text-gray-800"><?= $data['unassignedTeachers'] ?></span>
                        </div>
                    </div>
                </div>

                <!-- CARD: MATA PELAJARAN -->
                <div class="bg-white rounded-2xl border border-gray-100 p-6 flex flex-col justify-between">
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-sm font-bold text-gray-500">Mata Pelajaran</span>
                        <div class="w-10 h-10 bg-gray-100 rounded-2xl flex items-center justify-center text-gray-700">
                            <i class="ri-book-2-fill text-lg"></i>
                        </div>
                    </div>
                    <div>
                        <div class="text-3xl font-extrabold text-gray-800 mb-1"><?= $data['totalSubjects'] ?></div>
                        <p class="text-xs text-gray-400">Terdaftar di Sistem</p>
                    </div>
                    <div class="pt-4 border-t border-gray-100 mt-3">
                        <a href="<?= base_url('/admin/mata-pelajaran') ?>" class="text-xs font-bold text-blue-600 hover:text-indigo-600 flex items-center gap-1 transition-colors">
                            Lihat Rincian <i class="ri-arrow-right-s-line"></i>
                        </a>
                    </div>
                </div>

                <!-- CARD: KELAS -->
                <div class="bg-white rounded-2xl border border-gray-100 p-6 flex flex-col justify-between">
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-sm font-bold text-gray-500">Ruang Kelas</span>
                        <div class="w-10 h-10 bg-gray-100 rounded-2xl flex items-center justify-center text-gray-700">
                            <i class="ri-home-6-fill text-lg"></i>
                        </div>
                    </div>
                    <div>
                        <div class="text-3xl font-extrabold text-gray-800 mb-1"><?= $data['totalClassrooms'] ?></div>
                        <p class="text-xs text-gray-400">Rombongan Belajar</p>
                    </div>
                    <div class="pt-4 border-t border-gray-100 mt-3">
                        <a href="<?= base_url('/admin/kelas') ?>" class="text-xs font-bold text-blue-600 hover:text-indigo-600 flex items-center gap-1 transition-colors">
                            Kelola Kelas <i class="ri-arrow-right-s-line"></i>
                        </a>
                    </div>
                </div>

                <!-- CARD: ASESMEN AKTIF -->
                <div class="bg-white rounded-2xl border border-gray-100 p-6 flex flex-col justify-between">
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-sm font-bold text-gray-500">Asesmen Aktif</span>
                        <div class="w-10 h-10 bg-gray-100 rounded-2xl flex items-center justify-center text-gray-700">
                            <i class="ri-file-list-3-fill text-lg"></i>
                        </div>
                    </div>
                    <div>
                        <div class="text-3xl font-extrabold text-gray-800 mb-1"><?= $data['totalActiveAssessments'] ?></div>
                        <p class="text-xs text-gray-400">Sedang Dipublish</p>
                    </div>
                    <div class="pt-4 border-t border-gray-100 mt-3">
                        <span class="inline-block px-3 py-1 rounded-2xl text-xs font-semibold bg-gray-100 text-gray-700">
                            Status Aktif
                        </span>
                    </div>
                </div>

            </div>

            <!-- REKAPITULASI SISWA -->
            <div class="bg-white rounded-2xl border border-gray-100">
                <div class="font-bold py-6 px-10 border-b border-gray-200 flex items-center justify-between">
                    <div>
                        <h6 class="text-lg">Statistik & Rekapitulasi Siswa</h6>
                        <p class="text-xs text-gray-400 font-normal mt-1">Distribusi jumlah siswa keseluruhan dan aktif per tingkat kelas</p>
                    </div>
                    <div class="bg-gray-100 px-5 py-2.5 rounded-2xl border border-gray-200 flex items-center gap-2">
                        <i class="ri-user-5-fill text-gray-600"></i>
                        <span class="text-xs text-gray-500 font-semibold">Total Siswa:</span>
                        <span class="text-sm font-extrabold text-gray-800"><?= $data['totalStudents'] ?> Siswa</span>
                    </div>
                </div>

                <div class="p-10">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- KELAS VII -->
                        <div class="border border-gray-300 rounded-2xl p-5 bg-white flex items-center justify-between">
                            <div>
                                <span class="text-xs font-bold uppercase tracking-wider text-gray-400">Tingkat Kelas</span>
                                <h5 class="text-lg font-bold text-gray-700">Kelas VII</h5>
                            </div>
                            <div class="text-right">
                                <span class="text-3xl font-black text-gray-800"><?= $data['totalClassVII'] ?></span>
                                <span class="text-xs text-gray-500 block">Siswa Aktif</span>
                            </div>
                        </div>

                        <!-- KELAS VIII -->
                        <div class="border border-gray-300 rounded-2xl p-5 bg-white flex items-center justify-between">
                            <div>
                                <span class="text-xs font-bold uppercase tracking-wider text-gray-400">Tingkat Kelas</span>
                                <h5 class="text-lg font-bold text-gray-700">Kelas VIII</h5>
                            </div>
                            <div class="text-right">
                                <span class="text-3xl font-black text-gray-800"><?= $data['totalClassVIII'] ?></span>
                                <span class="text-xs text-gray-500 block">Siswa Aktif</span>
                            </div>
                        </div>

                        <!-- KELAS IX -->
                        <div class="border border-gray-300 rounded-2xl p-5 bg-white flex items-center justify-between">
                            <div>
                                <span class="text-xs font-bold uppercase tracking-wider text-gray-400">Tingkat Kelas</span>
                                <h5 class="text-lg font-bold text-gray-700">Kelas IX</h5>
                            </div>
                            <div class="text-right">
                                <span class="text-3xl font-black text-gray-800"><?= $data['totalClassIX'] ?></span>
                                <span class="text-xs text-gray-500 block">Siswa Aktif</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>
<!-- main end -->