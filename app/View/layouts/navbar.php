<!-- menu bar start -->
<div 
    x-data="{ openDropdown: null }"
    @click.away="openDropdown = null"
    @keydown.window.escape="openDropdown = null"
    class="py-2 px-6 bg-white dark:bg-slate-800 flex items-center justify-between border-b border-slate-200 dark:border-slate-700/80 h-16 md:ml-72 sm:ml-0 z-40 relative transition-colors duration-300">
    
    <!-- Left: Sidebar Toggle & Brand Title -->
    <div class="flex items-center gap-4">
        <button 
            type="button" 
            @click="opensidebar = !opensidebar"
            class="w-10 h-10 rounded-2xl bg-slate-50 dark:bg-slate-700/50 hover:bg-slate-100 dark:hover:bg-slate-700 text-slate-600 dark:text-slate-300 flex items-center justify-center transition-all cursor-pointer active:scale-95">
            <i class="ri-menu-line text-xl"></i>
        </button>

        <div class="flex items-center gap-2">
            <div class="w-8 h-8 bg-gradient-to-tr from-blue-900 via-blue-700 to-sky-500 rounded-xl flex items-center justify-center text-white shadow-xs hidden sm:flex">
                <i class="ri-node-tree text-sm"></i>
            </div>
            <h1 class="text-sm sm:text-base font-bold text-slate-800 dark:text-white truncate">
                LMS Asesmen SMP N 1 Halbar
            </h1>
        </div>
    </div>

    <!-- Right: Quick Actions & Profile -->
    <ul class="flex items-center gap-2">
        
        <!-- Action Search -->
        <li class="relative">
            <button 
                type="button"
                @click="openDropdown = (openDropdown === 'search' ? null : 'search')"
                :class="{ 'bg-slate-100 dark:bg-slate-700 text-blue-600 dark:text-sky-400': openDropdown === 'search' }"
                class="w-10 h-10 rounded-2xl text-slate-500 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-700 hover:text-slate-700 dark:hover:text-slate-200 flex items-center justify-center transition-all cursor-pointer">
                <i class="ri-search-2-line text-lg"></i>
            </button>

            <!-- Search Popover -->
            <div
                x-cloak 
                x-show="openDropdown === 'search'"
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 translate-y-2"
                x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100 translate-y-0"
                x-transition:leave-end="opacity-0 translate-y-2"
                class="absolute right-0 top-14 w-72 sm:w-80 bg-white dark:bg-slate-800 p-3 rounded-2xl border border-slate-100 dark:border-slate-700 shadow-xl z-50">
                <form action="" method="GET" class="relative">
                    <i class="ri-search-line absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-base"></i>
                    <input 
                        type="text" 
                        placeholder="Cari sesuatu..."
                        class="w-full pl-10 pr-4 py-2.5 bg-slate-50 dark:bg-slate-700/50 border border-slate-200 dark:border-slate-600 rounded-xl text-sm text-slate-800 dark:text-slate-100 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-600 dark:focus:border-sky-400 font-normal">
                </form>
            </div>
        </li>

        <!-- Action Notification -->
        <li class="relative">
            <button 
                type="button"
                @click="openDropdown = (openDropdown === 'notification' ? null : 'notification')"
                :class="{ 'bg-slate-100 dark:bg-slate-700 text-blue-600 dark:text-sky-400': openDropdown === 'notification' }"
                class="w-10 h-10 rounded-2xl text-slate-500 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-700 hover:text-slate-700 dark:hover:text-slate-200 flex items-center justify-center transition-all cursor-pointer relative">
                <i class="ri-notification-3-line text-lg"></i>
                <span class="absolute top-2.5 right-2.5 w-2 h-2 bg-blue-600 dark:bg-sky-400 rounded-full ring-2 ring-white dark:ring-slate-800"></span>
            </button>

            <!-- Notification Popover -->
            <div
                x-cloak 
                x-show="openDropdown === 'notification'"
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 translate-y-2"
                x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100 translate-y-0"
                x-transition:leave-end="opacity-0 translate-y-2"
                class="absolute right-0 top-14 w-80 bg-white dark:bg-slate-800 rounded-2xl border border-slate-100 dark:border-slate-700 shadow-xl z-50 overflow-hidden">
                <div class="p-4 border-b border-slate-100 dark:border-slate-700/60 flex items-center justify-between">
                    <h6 class="text-slate-800 dark:text-white font-bold text-sm">Notifikasi</h6>
                    <span class="text-xs bg-blue-50 dark:bg-sky-950/40 text-blue-600 dark:text-sky-400 font-semibold px-2 py-0.5 rounded-lg">Baru</span>
                </div>
                <div class="max-h-72 overflow-y-auto divide-y divide-slate-100 dark:divide-slate-700/50">
                    <a href="#" class="p-3.5 flex items-start gap-3 hover:bg-slate-50 dark:hover:bg-slate-700/50 transition-colors group">
                        <div class="w-8 h-8 rounded-xl bg-blue-50 dark:bg-sky-950/40 text-blue-600 dark:text-sky-400 flex items-center justify-center shrink-0 mt-0.5">
                            <i class="ri-user-follow-line text-sm"></i>
                        </div>
                        <div>
                            <p class="text-xs font-medium text-slate-700 dark:text-slate-300 group-hover:text-blue-600 dark:group-hover:text-sky-400 transition-colors line-clamp-2">
                                Pengguna baru telah mendaftar ke sistem LMS.
                            </p>
                            <span class="text-[10px] text-slate-400 mt-1 block">5 menit yang lalu</span>
                        </div>
                    </a>
                    <a href="#" class="p-3.5 flex items-start gap-3 hover:bg-slate-50 dark:hover:bg-slate-700/50 transition-colors group">
                        <div class="w-8 h-8 rounded-xl bg-blue-50 dark:bg-sky-950/40 text-blue-600 dark:text-sky-400 flex items-center justify-center shrink-0 mt-0.5">
                            <i class="ri-file-list-3-line text-sm"></i>
                        </div>
                        <div>
                            <p class="text-xs font-medium text-slate-700 dark:text-slate-300 group-hover:text-blue-600 dark:group-hover:text-sky-400 transition-colors line-clamp-2">
                                Ujian Asesmen Matematika telah diperbarui.
                            </p>
                            <span class="text-[10px] text-slate-400 mt-1 block">1 jam yang lalu</span>
                        </div>
                    </a>
                </div>
            </div>
        </li>

        <!-- Divider -->
        <div class="h-6 w-px bg-slate-200 dark:bg-slate-700 mx-1"></div>

        <!-- Profile Dropdown -->
        <li class="relative">
            <button 
                type="button"
                @click="openDropdown = (openDropdown === 'profile' ? null : 'profile')"
                class="flex items-center gap-2 p-1 rounded-2xl hover:bg-slate-100 dark:hover:bg-slate-700 transition-all cursor-pointer">
                <div class="w-9 h-9 rounded-xl bg-gradient-to-tr from-blue-900 via-blue-700 to-sky-500 text-white flex items-center justify-center font-bold text-sm shadow-xs">
                    <?= strtoupper(substr($full_name ?? 'A', 0, 1)) ?>
                </div>
                <div class="hidden md:flex flex-col text-left pr-1">
                    <span class="text-xs font-bold text-slate-800 dark:text-white leading-tight"><?= htmlspecialchars($full_name ?? 'User') ?></span>
                    <span class="text-[10px] font-medium text-slate-400 capitalize"><?= htmlspecialchars($role ?? 'Guest') ?></span>
                </div>
                <i class="ri-arrow-down-s-line text-slate-400 text-sm hidden sm:block"></i>
            </button>

            <!-- Profile Popover -->
            <div
                x-cloak 
                x-show="openDropdown === 'profile'"
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 translate-y-2"
                x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100 translate-y-0"
                x-transition:leave-end="opacity-0 translate-y-2"
                class="absolute right-0 top-14 w-56 bg-white dark:bg-slate-800 p-2 rounded-2xl border border-slate-100 dark:border-slate-700 shadow-xl z-50">
                
                <div class="p-3 border-b border-slate-100 dark:border-slate-700/60 mb-1">
                    <p class="text-xs font-bold text-slate-800 dark:text-white"><?= htmlspecialchars($full_name ?? 'User') ?></p>
                    <p class="text-[11px] text-slate-400 capitalize mt-0.5"><?= htmlspecialchars($role ?? 'Administrator') ?></p>
                </div>

                <ul class="space-y-1 text-xs font-medium text-slate-600 dark:text-slate-300">
                    <li>
                        <a href="#" class="flex items-center gap-2.5 px-3 py-2 rounded-xl hover:bg-slate-50 dark:hover:bg-slate-700 hover:text-blue-600 dark:hover:text-sky-400 transition-colors">
                            <i class="ri-user-3-line text-base"></i>
                            <span>Edit Profil</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center gap-2.5 px-3 py-2 rounded-xl hover:bg-slate-50 dark:hover:bg-slate-700 hover:text-blue-600 dark:hover:text-sky-400 transition-colors">
                            <i class="ri-questionnaire-line text-base"></i>
                            <span>Bantuan</span>
                        </a>
                    </li>
                    <li class="border-t border-slate-100 dark:border-slate-700/60 pt-1">
                        <a href="<?= base_url('/logout') ?>" class="flex items-center gap-2.5 px-3 py-2 rounded-xl hover:bg-rose-50 dark:hover:bg-rose-950/30 text-rose-600 dark:text-rose-400 transition-colors">
                            <i class="ri-logout-box-r-line text-base"></i>
                            <span>Keluar</span>
                        </a>
                    </li>
                </ul>
            </div>
        </li>

    </ul>
</div>
<!-- menu bar end -->

<!-- title page start -->
<div class="bg-slate-50 dark:bg-slate-900/90 py-5 px-6 md:px-10 md:ml-72 sm:ml-0 flex flex-col sm:flex-row sm:items-center justify-between gap-2 border-b border-slate-200/60 dark:border-slate-800 transition-colors duration-300">
    <h2 class="text-lg font-bold text-slate-800 dark:text-white capitalize">
        <?= htmlspecialchars($subpage == false ? $page : $subpage) ?>
    </h2>
    
    <!-- Breadcrumb Navigation -->
    <nav class="flex items-center gap-1.5 text-xs text-slate-400">
        <a href="<?= base_url('/admin') ?>" class="hover:text-blue-600 dark:hover:text-sky-400 transition-colors">Home</a>
        <i class="ri-arrow-right-s-line text-sm"></i>
        <a href="#" class="<?= $subpage ? 'hover:text-blue-600 dark:hover:text-sky-400' : 'text-slate-700 dark:text-slate-200 font-semibold' ?> transition-colors">
            <?= htmlspecialchars($page) ?>
        </a>
        <?php if ($subpage): ?>
            <i class="ri-arrow-right-s-line text-sm"></i>
            <span class="text-slate-700 dark:text-slate-200 font-semibold">
                <?= htmlspecialchars($subpage) ?>
            </span>
        <?php endif; ?>
    </nav>
</div>
<!-- title page end -->