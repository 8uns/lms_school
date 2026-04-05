<!-- sidebar start -->
<!-- 
$sidebar -> daftar menu sidebar
$page -> halaman aktif
$subpage -> subhalaman aktif
 -->
<div class="bg-white md:block md:fixed w-72 h-full md:p-4 py-20 z-50 border-r border-gray-300 overflow-y-auto absolute" x-show="opensidebar">
    <a href="#" class="items-center pb-4 mt-5 hidden md:flex">
        <img src="<?= base_url('/assets/images/kemdikbud.png') ?>" alt="" class="w-10 h-10 rounded-2xl object-cover">
        <span class="text-2xl ml-3 font-bold ">LMS Asesmen</span>
    </a>
    <ul class="text-gray-600 mt-4">
        <?php foreach ($data['sidebar'] as $sidebar): ?>
            <?php if (isset($sidebar['CategoryLabel'])): ?>
                <li class="mt-6 mb-2 relative">
                    <span class="text-xs text-gray-400 uppercase whitespace-nowrap bg-white ml-3 px-3 inline-block z-10 
                    before:content-[''] before:inline-block before:w-full before:h-px before:bg-gray-300 before:mr-4 before:align-middle before:absolute before:left-0 before:top-1/2 before:z-[-1]
                    "><?= $sidebar['CategoryLabel'] ?></span>
                </li>
            <?php else: ?>
                <?php if ($sidebar['sublabel']): ?>
                    <li class="mb-1 group" x-data="{ submenu: false }">
                        <a href="#"
                            @click="submenu = !submenu"
                            class="flex items-center py-2 px-4 hover:bg-gray-300 hover:text-gray-800 rounded-2xl <?= $sidebar['label'] == $data['page'] ? 'bg-gray-300 text-gray-700' : '' ?>">
                            <i class="ri-group-3-fill mr-3 text-lg"></i>
                            <span class="text-sm font-bold"><?= $sidebar['label'] ?></span>
                            <i class="ri-arrow-drop-right-line ml-auto text-xl group-[.active]:rotate-90"></i>
                        </a>
                        <ul class="pl-8 mt-2">
                            <?php foreach ($sidebar['sublabel'] as $sublabel): ?>
                                <li class="mb-3 group"
                                    x-data="{ submenu: <?= $sidebar['label'] == $data['page'] ? true : false ?> }"
                                    x-cloak x-show="submenu">
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
                            class="flex items-center py-2 px-4 hover:bg-gray-300 hover:text-gray-800 rounded-2xl <?= $sidebar['label'] == $data['page'] ? 'bg-gray-300 text-gray-700' : '' ?>">
                            <i class="<?= $sidebar['icon'] ?> mr-3 text-lg"></i>
                            <span class="text-sm font-bold"><?= $sidebar['label'] ?></span>
                        </a>
                    </li>
                <?php endif; ?>
            <?php endif; ?>
        <?php endforeach; ?>
    </ul>


</div>
<!-- sidebar end -->