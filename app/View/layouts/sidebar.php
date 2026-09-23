<?php
/**
 * @var array $data
 */
?>
<!-- sidebar start -->
<!-- 
$sidebar -> daftar menu sidebar
$page -> halaman aktif
$subpage -> subhalaman aktif
 -->
<aside 
    x-cloak
    :class="opensidebar ? 'translate-x-0' : '-translate-x-full md:translate-x-0'"
    class="bg-white dark:bg-slate-800 w-72 h-screen fixed top-0 left-0 p-4 z-50 border-r border-slate-200 dark:border-slate-700/80 overflow-y-auto transition-transform duration-300 ease-in-out flex flex-col justify-between">
    
    <div>
        <!-- Brand / Logo Header -->
        <div class="flex items-center justify-between pb-2 pt-0 px-2 border-b border-slate-100 dark:border-slate-700/60 mb-4">
            <a href="<?= base_url('/dashboard') ?>" class="flex items-center gap-3">
                <img src="<?= base_url('/assets/images/kemdikbud.png') ?>" alt="Logo Kemdikbud" class="w-9 h-9 rounded-xl object-contain">
                <div class="flex flex-col">
                    <span class="text-base font-extrabold text-slate-800 dark:text-white leading-tight">LMS Asesmen</span>
                    <span class="text-[10px] text-slate-400 font-medium">SMP N 1 Halbar</span>
                </div>
            </a>
            <!-- Mobile Close Button -->
            <button 
                type="button" 
                @click="opensidebar = false"
                class="md:hidden text-slate-400 hover:text-slate-600 dark:hover:text-slate-200 p-1.5 rounded-xl hover:bg-slate-100 dark:hover:bg-slate-700">
                <i class="ri-close-line text-xl"></i>
            </button>
        </div>

        <!-- Navigation Menu -->
        <nav class="space-y-1">
            <?php foreach ($data['sidebar'] as $sidebar): ?>
                
                <!-- Category Divider Label -->
                <?php if (isset($sidebar['CategoryLabel'])): ?>
                    <div class="pt-5 pb-2 px-3">
                        <p class="text-[11px] font-bold tracking-wider text-slate-400 dark:text-slate-500 uppercase">
                            <?= htmlspecialchars($sidebar['CategoryLabel']) ?>
                        </p>
                    </div>

                <!-- Menu Item with Submenu -->
                <?php elseif (!empty($sidebar['sublabel'])): ?>
                    <?php 
                        $isParentActive = ($sidebar['label'] == $data['page']);
                    ?>
                    <div x-data="{ submenuOpen: <?= $isParentActive ? 'true' : 'false' ?> }" class="mb-1">
                        <button 
                            type="button"
                            @click="submenuOpen = !submenuOpen"
                            class="w-full flex items-center justify-between py-2.5 px-3.5 rounded-2xl text-sm font-semibold transition-all cursor-pointer <?= $isParentActive ? 'text-blue-600 dark:text-sky-400 bg-blue-50/80 dark:bg-sky-950/40' : 'text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-700/60 hover:text-slate-900 dark:hover:text-white' ?>">
                            <div class="flex items-center gap-3">
                                <i class="<?= !empty($sidebar['icon']) ? $sidebar['icon'] : 'ri-folder-line' ?> text-lg"></i>
                                <span><?= htmlspecialchars($sidebar['label']) ?></span>
                            </div>
                            <i 
                                class="ri-arrow-right-s-line text-lg transition-transform duration-200"
                                :class="{ 'rotate-90': submenuOpen }"></i>
                        </button>

                        <!-- Submenu List -->
                        <div 
                            x-show="submenuOpen" 
                            x-collapse 
                            class="pl-9 pr-1 py-1 space-y-1 relative before:absolute before:left-5 before:top-2 before:bottom-2 before:w-px before:bg-slate-200 dark:before:bg-slate-700">
                            <?php foreach ($sidebar['sublabel'] as $sublabel): ?>
                                <?php $isSubActive = ($sublabel['label'] == $data['subpage']); ?>
                                <a 
                                    href="<?= base_url($sublabel['url']) ?>"
                                    class="block py-2 px-3 rounded-xl text-xs font-medium transition-all <?= $isSubActive ? 'bg-gradient-to-r from-blue-900 via-blue-700 to-sky-500 text-white font-semibold shadow-xs' : 'text-slate-500 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-700/50 hover:text-slate-800 dark:hover:text-slate-200' ?>">
                                    <?= htmlspecialchars($sublabel['label']) ?>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>

                <!-- Single Menu Item -->
                <?php else: ?>
                    <?php $isActive = ($sidebar['label'] == $data['page']); ?>
                    <a 
                        href="<?= base_url($sidebar['url']) ?>"
                        class="flex items-center gap-3 py-2.5 px-3.5 rounded-2xl text-sm font-semibold transition-all mb-1 <?= $isActive ? 'bg-gradient-to-r from-blue-900 via-blue-700 to-sky-500 text-white shadow-xs' : 'text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-700/60 hover:text-slate-900 dark:hover:text-white' ?>">
                        <i class="<?= !empty($sidebar['icon']) ? $sidebar['icon'] : 'ri-checkbox-blank-circle-line' ?> text-lg"></i>
                        <span><?= htmlspecialchars($sidebar['label']) ?></span>
                    </a>
                <?php endif; ?>

            <?php endforeach; ?>
        </nav>
    </div>

    <!-- Sidebar Footer / Status Info -->
    <div class="pt-4 border-t border-slate-100 dark:border-slate-700/60 px-2">
        <div class="bg-slate-50 dark:bg-slate-700/40 rounded-2xl p-3 flex items-center gap-3">
            <div class="w-2.5 h-2.5 rounded-full bg-emerald-500 animate-pulse"></div>
            <div class="flex flex-col">
                <span class="text-xs font-bold text-slate-700 dark:text-slate-300">Sistem Aktif</span>
                <span class="text-[10px] text-slate-400">Versi 1.0.0</span>
            </div>
        </div>
    </div>

</aside>
<!-- sidebar end -->

<!-- Overlay Backdrop untuk layar HP saat sidebar terbuka -->
<div 
    x-cloak 
    x-show="opensidebar" 
    @click="opensidebar = false"
    x-transition:enter="transition-opacity ease-linear duration-200"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition-opacity ease-linear duration-200"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    class="fixed inset-0 bg-black/40 backdrop-blur-xs z-40 md:hidden">
</div>