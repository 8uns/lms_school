<!-- menu bar start-->
<div x-data="{ open: false }"
    @click.away="open = false"
    class="py-2 px-6 bg-white flex items-center border-b border-gray-300 h-18 md:ml-72 sm:ml-0 z-50 relative">
    <button type="button" class="text-lg text-gray-600">
        <i class="ri-menu-line"></i>
    </button>

    <ul class="ml-auto flex items-center">
        <li class="mr-1 text-gray-400 group nav-item">
            <button type="button"
                @click="open = (open === 'search' ? false : 'search')"
                class="w-8 h-8 rounded flex items-center justify-center hover:bg-gray-50 hover:text-gray-600">
                <i class="ri-search-2-line"></i>
            </button>
            <div
                x-show="open === 'search'"
                class="absolute p-4 max-w-xs w-full right-3 top-19 bg-white rounded-md border border-gray-100 shadow shadow-black1/2">
                <form action="" class="border-b border-b-gray-100">
                    <input type="text" placeholder="search..."
                        class="py-2 pr-4 pl-10 bg-gray-50 w-full border border-gray-100 rounded-md text-sm focus:border-blue-500">
                    <i class="ri-search-eye-line absolute top-1/2 left-6 -translate-y-1/2 text-gray-400"></i>
                </form>
            </div>
        </li>

        <li class="mr-1 text-gray-400 group nav-item">
            <button type="button"
                @click="open = (open === 'notification' ? false : 'notification')"
                class="w-8 h-8 rounded flex items-center justify-center hover:bg-gray-50 hover:text-gray-600">
                <i class="ri-notification-3-line"></i>
            </button>

            <div
                x-show="open === 'notification'"
                class="absolute p-4 max-w-xs w-full right-3 top-19 bg-white rounded-md border border-gray-100 shadow shadow-black1/2">
                <h6 class="text-gray-600 font-bold text-sm px-4 py-2">Notifikasi</h6>
                <ul>
                    <li class="border-t border-b-gray-50">
                        <a href="#"
                            class="text-sm flex items-center hover:bg-gray-300 hover:text-gray-800 rounded py-2 px-4 my-2">
                            <i class="ri-user-2-fill mr-3 text-sm"></i>
                            <span>Lorem ipsum dolor sit amet, consectetur adipisicing elit...</span>
                        </a>
                    </li>
                    <li class="border-t border-b-gray-50">
                        <a href="#"
                            class="text-sm flex items-center hover:bg-gray-300 hover:text-gray-800 rounded py-2 px-4 my-2">
                            <i class="ri-user-2-fill mr-3 text-sm"></i>
                            <span>Lorem ipsum dolor sit amet, consectetur adipisicing elit...</span>
                        </a>
                    </li>
                    <li class="border-t border-b-gray-50">
                        <a href="#"
                            class="text-sm flex items-center hover:bg-gray-300 hover:text-gray-800 rounded py-2 px-4 my-2">
                            <i class="ri-user-2-fill mr-3 text-sm"></i>
                            <span>Lorem ipsum dolor sit amet, consectetur adipisicing elit...</span>
                        </a>
                    </li>
                    <li class="border-t border-b-gray-50">
                        <a href="#"
                            class="text-sm flex items-center hover:bg-gray-300 hover:text-gray-800 rounded py-2 px-4 my-2">
                            <i class="ri-user-2-fill mr-3 text-sm"></i>
                            <span>Lorem ipsum dolor sit amet, consectetur adipisicing elit...</span>
                        </a>
                    </li>
                </ul>
            </div>
        </li>

        <li class="mr-1 text-gray-400 group nav-item">
            <button type="button"
                @click="open = (open === 'profile' ? false : 'profile')"
                class="w-8 h-8 rounded flex items-center justify-center hover:bg-gray-50 hover:text-gray-600">
                <!-- <img src="https://placehold.co/20x20" alt="" class="w-7 h-7 rounded-full object-cover"> -->
                <i class="ri-account-circle-fill w-7 h-7 rounded-full text-3xl flex justify-center items-center"></i>
            </button>

            <div
                x-show="open === 'profile'"
                class="absolute p-4 max-w-xs w-full right-3 top-19 bg-white rounded-md shadow shadow-black1/2">
                <h5 class="text-gray-500 font-bold text-sm"><?= $full_name ?></h5>
                <h6 class="text-gray-400 text-sm"><?= $role ?></h6>

                <ul>
                    <li class="">
                        <a href="#"
                            class="text-sm flex items-center hover:bg-gray-300 hover:text-gray-800 rounded py-2 px-4 my-2">
                            <i class="ri-account-circle-line mr-3"></i>
                            <span>Edit Profil</span>
                        </a>
                    </li>

                    <li class="">
                        <a href="#"
                            class="text-sm flex items-center hover:bg-gray-300 hover:text-gray-800 rounded py-2 px-4 my-2">
                            <i class="ri-questionnaire-line mr-3"></i>
                            <span>Bantuan</span>
                        </a>
                    </li>

                    <li class="border-t border-b-gray-50">
                        <a href="<?= base_url('/logout') ?>"
                            class="text-sm flex items-center hover:bg-gray-300 hover:text-gray-800 rounded py-2 px-4 my-2">
                            <i class="ri-logout-box-r-line mr-3"></i>
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
<div class="bg-gray-100 py-7 px-15 md:ml-72 sm:ml-0 flex items-center justify-between">
    <h2 class="text-xl font-bold text-gray-700"><?= $subpage == false ? $page : $subpage ?></h2>
    <ul class="flex items-center ml-4 text-sm">
        <li class="text-gray-400 mr-2">Home</h6>
        <li class="text-gray-400 mr-2">
            <i class="ri-arrow-right-s-line"></i>
        </li>
        <li class="mr-2">
            <a href="#" class="text-gray-400"><?= $subpage == false ? $page : $subpage ?></a>
        </li>
</div>
<!-- title page end -->