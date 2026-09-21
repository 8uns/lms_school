<?php
/**
 * @var array $data
 */
?>

<!-- main start -->
<div class="ml-0 md:ml-72 sm:ml-0 bg-gray-100 min-h-screen"
    x-data="{ 
        search: '',
        filterLevel: '',
        modaldetail: false,
        modalclear: false,
        logdata: { id: '', timestamp: '', user: '', action: '', level: '', ip_address: '', details: '' }
    }"
    @keydown.window.escape="modaldetail = false; modalclear = false;">

    <div class="pl-15 pr-15 pb-15 pt-0">
        <div class="grid grid-cols-1 gap-6">
            
            <!-- Cards Ringkasan Log -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-xs flex items-center justify-between">
                    <div>
                        <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Aktivitas Normal</span>
                        <h4 class="text-2xl font-bold text-gray-800 mt-1">
                            <?= count(array_filter($data['logs'] ?? [], fn($l) => strtolower($l['level']) === 'info')); ?>
                        </h4>
                    </div>
                    <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center shrink-0">
                        <i class="ri-information-line text-xl"></i>
                    </div>
                </div>

                <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-xs flex items-center justify-between">
                    <div>
                        <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Peringatan</span>
                        <h4 class="text-2xl font-bold text-amber-600 mt-1">
                            <?= count(array_filter($data['logs'] ?? [], fn($l) => strtolower($l['level']) === 'warning')); ?>
                        </h4>
                    </div>
                    <div class="w-12 h-12 bg-amber-50 text-amber-600 rounded-2xl flex items-center justify-center shrink-0">
                        <i class="ri-alert-line text-xl"></i>
                    </div>
                </div>

                <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-xs flex items-center justify-between">
                    <div>
                        <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Error / Bahaya</span>
                        <h4 class="text-2xl font-bold text-rose-600 mt-1">
                            <?= count(array_filter($data['logs'] ?? [], fn($l) => in_array(strtolower($l['level']), ['danger', 'error']))); ?>
                        </h4>
                    </div>
                    <div class="w-12 h-12 bg-rose-50 text-rose-600 rounded-2xl flex items-center justify-center shrink-0">
                        <i class="ri-error-warning-line text-xl"></i>
                    </div>
                </div>
            </div>

            <!-- Main Table Card -->
            <div class="bg-white rounded-2xl border border-gray-100 shadow-xs">
                <div>

                    <!-- Header Section & Filter Controls -->
                    <div class="font-bold py-8 px-10 border-b border-gray-200 flex flex-col lg:flex-row items-start lg:items-center justify-between gap-4">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-indigo-50 text-indigo-600 rounded-2xl flex items-center justify-center shrink-0">
                                <i class="ri-terminal-window-line text-lg"></i>
                            </div>
                            <div class="flex flex-col">
                                <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Pemantauan Sistem</span>
                                <h6 class="text-base font-bold text-gray-800">Log Aktivitas Sistem</h6>
                            </div>
                        </div>

                        <!-- Action Controls: Filter, Search & Clear Log -->
                        <div class="flex flex-col sm:flex-row items-center gap-3 w-full lg:w-auto">
                            <!-- Filter Level Dropdown -->
                            <div class="relative w-full sm:w-40">
                                <select 
                                    x-model="filterLevel" 
                                    class="w-full bg-gray-50 border border-gray-200 rounded-2xl py-2 px-4 text-sm text-gray-700 font-normal focus:outline-none focus:bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all cursor-pointer">
                                    <option value="">Semua Level</option>
                                    <option value="info">Info</option>
                                    <option value="warning">Warning</option>
                                    <option value="danger">Danger/Error</option>
                                </select>
                            </div>

                            <!-- Input Search -->
                            <div class="relative w-full sm:w-64">
                                <i class="ri-search-line absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400 text-base"></i>
                                <input 
                                    type="text" 
                                    x-model="search" 
                                    placeholder="Cari user / aktivitas / IP..." 
                                    class="w-full pl-10 pr-4 py-2 bg-gray-50 border border-gray-200 rounded-2xl text-sm focus:outline-none focus:bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all font-normal text-gray-700"
                                />
                            </div>

                            <!-- Tombol Clear Logs -->
                            <button @click="modalclear = true" type="button" class="cursor-pointer bg-gradient-to-r from-rose-600 to-red-500 w-full sm:w-auto rounded-2xl text-white py-2.5 px-5 hover:from-rose-700 hover:to-red-600 transition-all duration-300 shadow-sm hover:shadow-md active:scale-[0.98] flex items-center justify-center gap-2 font-semibold text-sm shrink-0">
                                <i class="ri-delete-bin-line text-base"></i>
                                Bersihkan Log
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
                                        <th class="px-6 text-left">Waktu</th>
                                        <th class="px-6 text-left">Pengguna</th>
                                        <th class="px-6 text-left">Aktivitas / Pesan</th>
                                        <th class="px-6 text-center">Level</th>
                                        <th class="px-6 text-left">IP Address</th>
                                        <th class="px-4 w-28">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 text-sm">
                                    <?php $no = 1; ?>
                                    <?php if (!empty($data['logs'])): ?>
                                        <?php foreach ($data['logs'] as $log): ?>
                                            <?php 
                                                $levelLower = strtolower($log['level']); 
                                                $badgeClass = 'bg-gray-100 text-gray-700';
                                                if ($levelLower === 'info') $badgeClass = 'bg-blue-50 text-blue-600 border border-blue-100';
                                                elseif ($levelLower === 'warning') $badgeClass = 'bg-amber-50 text-amber-600 border border-amber-100';
                                                elseif (in_array($levelLower, ['danger', 'error'])) $badgeClass = 'bg-rose-50 text-rose-600 border border-rose-100';
                                            ?>
                                            <tr 
                                                class="h-16 hover:bg-gray-50/80 transition-colors"
                                                x-show="(search === '' || 
                                                        '<?= strtolower(addslashes($log['user'])) ?>'.includes(search.toLowerCase()) || 
                                                        '<?= strtolower(addslashes($log['action'])) ?>'.includes(search.toLowerCase()) ||
                                                        '<?= strtolower(addslashes($log['ip_address'])) ?>'.includes(search.toLowerCase())) &&
                                                        (filterLevel === '' || '<?= $levelLower ?>' === filterLevel)"
                                            >
                                                <td class="px-4 py-2 font-medium text-gray-400"><?= $no++; ?></td>
                                                <td class="px-6 py-2 text-left font-medium text-gray-500 whitespace-nowrap">
                                                    <?= htmlspecialchars($log['timestamp']); ?>
                                                </td>
                                                <td class="px-6 py-2 text-left font-bold text-gray-800">
                                                    <?= htmlspecialchars($log['user']); ?>
                                                </td>
                                                <td class="px-6 py-2 text-left font-medium text-gray-700 max-w-xs truncate">
                                                    <?= htmlspecialchars($log['action']); ?>
                                                </td>
                                                <td class="px-6 py-2 text-center">
                                                    <span class="inline-block px-3 py-1 rounded-2xl text-xs font-semibold <?= $badgeClass ?>">
                                                        <?= strtoupper(htmlspecialchars($log['level'])); ?>
                                                    </span>
                                                </td>
                                                <td class="px-6 py-2 text-left">
                                                    <code class="text-xs bg-gray-100 px-2.5 py-1 rounded-lg text-gray-600 font-mono"><?= htmlspecialchars($log['ip_address']); ?></code>
                                                </td>
                                                <td class="px-4 py-2">
                                                    <div class="flex items-center justify-center">
                                                        <!-- Tombol Detail Log -->
                                                        <button
                                                            @click="
                                                                logdata = {
                                                                    id: '<?= $log['id'] ?>',
                                                                    timestamp: '<?= addslashes($log['timestamp']) ?>',
                                                                    user: '<?= addslashes($log['user']) ?>',
                                                                    action: '<?= addslashes($log['action']) ?>',
                                                                    level: '<?= addslashes($log['level']) ?>',
                                                                    ip_address: '<?= addslashes($log['ip_address']) ?>',
                                                                    details: '<?= addslashes($log['details'] ?? '-') ?>'
                                                                };
                                                                modaldetail = true;
                                                            "
                                                            type="button" 
                                                            title="Lihat Detail Log"
                                                            class="cursor-pointer px-2.5 py-1.5 rounded-xl text-gray-600 hover:text-blue-600 hover:bg-blue-50 active:scale-95 transition-all flex items-center gap-1 font-semibold text-xs border border-transparent hover:border-blue-200">
                                                            <i class="ri-eye-line text-base"></i>
                                                            <span>Detail</span>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="7" class="px-4 py-12 text-gray-400 text-center">
                                                <i class="ri-inbox-line text-4xl block mb-2 text-gray-300"></i>
                                                Belum ada catatan log sistem.
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

    <!-- START MODAL DETAIL LOG -->
    <div 
        class="fixed inset-0 h-screen w-screen bg-black/50 backdrop-blur-xs left-0 top-0 z-50 flex items-center justify-center p-4" 
        x-cloak 
        x-show="modaldetail"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0">
        
        <div class="bg-white rounded-2xl p-8 max-w-lg w-full shadow-xl" @click.away="modaldetail = false">
            <div class="flex justify-between items-center mb-6 pb-4 border-b border-gray-100">
                <div>
                    <span class="text-xs font-bold text-blue-600 uppercase tracking-wider">Rincian Log</span>
                    <h6 class="font-bold text-lg text-gray-800" x-text="'Log ID #' + logdata.id"></h6>
                </div>
                <button @click="modaldetail = false" type="button" class="cursor-pointer text-gray-400 hover:text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-xl p-2 transition-all">
                    <i class="ri-close-line text-xl"></i>
                </button>
            </div>

            <div class="space-y-4 mb-8 text-sm">
                <div class="grid grid-cols-3 gap-2 pb-3 border-b border-gray-100">
                    <span class="text-xs font-bold uppercase tracking-wider text-gray-400">Waktu</span>
                    <span class="col-span-2 font-medium text-gray-800" x-text="logdata.timestamp"></span>
                </div>

                <div class="grid grid-cols-3 gap-2 pb-3 border-b border-gray-100">
                    <span class="text-xs font-bold uppercase tracking-wider text-gray-400">Pengguna</span>
                    <span class="col-span-2 font-bold text-gray-800" x-text="logdata.user"></span>
                </div>

                <div class="grid grid-cols-3 gap-2 pb-3 border-b border-gray-100">
                    <span class="text-xs font-bold uppercase tracking-wider text-gray-400">Level</span>
                    <div class="col-span-2">
                        <span class="inline-block px-3 py-0.5 rounded-xl text-xs font-bold"
                              :class="{
                                  'bg-blue-50 text-blue-600': logdata.level.toLowerCase() === 'info',
                                  'bg-amber-50 text-amber-600': logdata.level.toLowerCase() === 'warning',
                                  'bg-rose-50 text-rose-600': ['danger','error'].includes(logdata.level.toLowerCase())
                              }"
                              x-text="logdata.level.toUpperCase()"></span>
                    </div>
                </div>

                <div class="grid grid-cols-3 gap-2 pb-3 border-b border-gray-100">
                    <span class="text-xs font-bold uppercase tracking-wider text-gray-400">IP Address</span>
                    <div class="col-span-2">
                        <code class="text-xs bg-gray-100 px-2.5 py-1 rounded-lg text-gray-600 font-mono" x-text="logdata.ip_address"></code>
                    </div>
                </div>

                <div class="grid grid-cols-3 gap-2 pb-3 border-b border-gray-100">
                    <span class="text-xs font-bold uppercase tracking-wider text-gray-400">Aktivitas</span>
                    <span class="col-span-2 font-semibold text-gray-800" x-text="logdata.action"></span>
                </div>

                <div>
                    <span class="text-xs font-bold uppercase tracking-wider text-gray-400 block mb-2">Detail Payload / Keterangan</span>
                    <div class="bg-gray-50 border border-gray-200 rounded-2xl p-4 text-xs font-mono text-gray-700 whitespace-pre-wrap break-all max-h-40 overflow-y-auto" x-text="logdata.details"></div>
                </div>
            </div>

            <div>
                <button @click="modaldetail = false" type="button" class="cursor-pointer bg-gray-100 hover:bg-gray-200 text-gray-700 w-full rounded-2xl py-3 px-5 transition-all font-bold text-sm">
                    Tutup
                </button>
            </div>
        </div>
    </div>
    <!-- END MODAL DETAIL LOG -->

    <!-- START MODAL CLEAR LOGS -->
    <div 
        class="fixed inset-0 h-screen w-screen bg-black/50 backdrop-blur-xs left-0 top-0 z-50 flex items-center justify-center p-4" 
        x-cloak 
        x-show="modalclear"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0">
        
        <div class="bg-white rounded-2xl p-8 max-w-md w-full shadow-xl" @click.away="modalclear = false">
            <div class="text-center mb-6">
                <div class="w-12 h-12 bg-rose-100 text-rose-500 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <i class="ri-delete-bin-line text-2xl"></i>
                </div>
                <h6 class="text-lg font-bold text-gray-800 mb-2">Bersihkan Semua Log?</h6>
                <p class="text-sm text-gray-500">
                    Apakah Anda yakin ingin mengosongkan seluruh riwayat log sistem? Tindakan ini bersifat permanen.
                </p>
            </div>

            <div class="flex items-center gap-3">
                <a :href="'<?= base_url('/administrator/logs/clear') ?>'" class="flex-1 text-center font-bold cursor-pointer bg-gradient-to-r from-rose-600 to-red-500 rounded-2xl text-white py-3 px-5 hover:from-rose-700 hover:to-red-600 transition-all duration-300 shadow-md hover:shadow-lg active:scale-[0.98] text-sm">
                    Ya, Bersihkan
                </a>

                <button
                    @click="modalclear = false"
                    type="button" class="flex-1 font-bold cursor-pointer bg-gray-100 text-gray-700 rounded-2xl py-3 px-5 hover:bg-gray-200 transition-all duration-300 text-sm">
                    Batal
                </button>
            </div>
        </div>
    </div>
    <!-- END MODAL CLEAR LOGS -->

</div>
<!-- main end -->