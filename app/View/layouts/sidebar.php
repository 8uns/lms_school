<!-- sidebar start -->
<!-- 
$sidebar -> daftar menu sidebar
$page -> halaman aktif
$subpage -> subhalaman aktif
 -->
<div class="bg-white md:fixed hidden w-72 h-full p-4 hidden md:block z-50 border-r border-gray-300">
    <a href="#" class="flex items-center pb-4 mt-5">
        <img src="https://placehold.co/32x32" alt="" class="w-10 h-10 rounded-2xl object-cover">
        <span class="text-2xl ml-3 font-bold ">Logo</span>
    </a>
    <ul class="text-gray-600 mt-4" x-data="{ activeMenu: false }">
        <?php foreach ($data['sidebar'] as $sidebar): ?>
            <?php if ($sidebar['sublabel']): ?>
                <li class="mb-1 group" x-data="{ submenu: false }">
                    <a href="#"
                        @click="submenu = !submenu"
                        x-data="{ activeMenu: <?= $sidebar['label'] == $data['page'] ? true : false ?> }"
                        x-bind:class="activeMenu ? 'bg-gray-300 text-gray-700' : ''"
                        class="flex items-center py-2 px-4 hover:bg-g ray-300 hover:text-gray-800 rounded-2xl">
                        <i class="ri-group-3-fill mr-3 text-lg"></i>
                        <span class="text-sm font-bold"><?= $sidebar['label'] ?></span>
                        <i class="ri-arrow-drop-right-line ml-auto text-xl group-[.active]:rotate-90"></i>
                    </a>
                    <ul class="pl-8 mt-2">
                        <?php foreach ($sidebar['sublabel'] as $sublabel): ?>
                            <li class="mb-3 group"
                                x-data="{ submenu: <?= $sidebar['label'] == $data['page'] ? true : false ?> }"
                                x-show="submenu">
                                <a href="<?= base_url($sublabel['url']) ?>"
                                    class="text-sm flex items-center hover:bg-gray-300 hover:text-gray-800 rounded-2xl py-2 px-4 <?= $sublabel['label'] == $data['subpage'] ? 'bg-gray-300 text-gray-700' : '' ?>">
                                    <span class="text-sm font-bold"><?= $sublabel['label']  ?></span>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </li>
            <?php else: ?>
                <li class="mb-1 group">
                    <a href="<?= base_url($sidebar['url']) ?>"
                        x-data="{ activeMenu: <?= $sidebar['label'] == $data['page'] ? true : false ?> }"
                        x-bind:class="activeMenu ? 'bg-gray-300 text-gray-700' : ''"
                        class="flex items-center py-2 px-4 hover:bg-gray-300 hover:text-gray-800 rounded-2xl ">
                        <i class="<?= $sidebar['icon'] ?> mr-3 text-lg"></i>
                        <span class="text-sm font-bold"><?= $sidebar['label'] ?></span>
                    </a>
                </li>
            <?php endif; ?>
        <?php endforeach; ?>
    </ul>


</div>
<!-- sidebar end -->