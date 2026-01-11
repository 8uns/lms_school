<!-- main start -->
<div class="ml-0 md:ml-64 bg-gray-50 min-h-screen">
    <!-- menu bar start-->
    <div class="py-2 px-6 bg-white flex items-center shadow shadow-black1/2 h-18">
        <button type="button" class="text-lg text-gray-600">
            <i class="ri-menu-line"></i>
        </button>
        <ul class="flex items-center ml-4 text-sm">
            <li class="mr-2">
                <a href="#" class="text-gray-400">Dashboard</a>
            </li>
            <li class="text-gray-400 mr-2">/</li>
            <li class="text-gray-600 mr-2">Jumlah Siswa</li>
        </ul>

        <ul class="ml-auto flex items-center">
            <li class="mr-1 text-gray-400 group nav-item">
                <button type="button"
                    class="dropdown-menu-toggle w-8 h-8 rounded flex items-center justify-center hover:bg-gray-50 hover:text-gray-600">
                    <i class="ri-search-2-line"></i>
                </button>
                <div
                    class="dropdown-menu absolute p-4 max-w-xs w-full right-3 top-19 bg-white rounded-md border border-gray-100 hidden group-[.selected]:block shadow shadow-black1/2">
                    <form action="" class="border-b border-b-gray-100">
                        <input type="text" placeholder="search..."
                            class="py-2 pr-4 pl-10 bg-gray-50 w-full border border-gray-100 rounded-md text-sm focus:border-blue-500">
                        <i class="ri-search-eye-line absolute top-1/2 left-6 -translate-y-1/2 text-gray-400"></i>
                    </form>
                </div>
            </li>

            <li class="mr-1 text-gray-400 group nav-item">
                <button type="button"
                    class="dropdown-menu-toggle w-8 h-8 rounded flex items-center justify-center hover:bg-gray-50 hover:text-gray-600">
                    <i class="ri-notification-3-line"></i>
                </button>

                <div
                    class="dropdown-menu absolute p-4 max-w-xs w-full right-3 top-19 bg-white rounded-md border border-gray-100 hidden group-[.selected]:block shadow shadow-black1/2">
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
                    class="dropdown-menu-toggle w-8 h-8 rounded flex items-center justify-center hover:bg-gray-50 hover:text-gray-600">
                    <img src="https://placehold.co/20x20" alt="" class="w-7 h-7 rounded-full object-cover">

                </button>

                <div
                    class="dropdown-menu absolute p-4 max-w-xs w-full right-3 top-19 bg-white rounded-md hidden group-[.selected]:block shadow shadow-black1/2">
                    <h5 class="text-gray-500 font-bold text-sm">Nama User</h5>
                    <h6 class="text-gray-400 text-sm">Level User</h6>

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

    <div class="p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="bg-white rounded-md border border-gray-100 p-6">
                <div class="flex justify-between">
                    <div>
                        <h1 class="text-2xl font-semibold mb-1">10</h1>
                        <h6 class="text-sm font-medium text-gray-400">Active Orders</h6>
                    </div>
                    <div class="dropdown">
                        <button type="button" class="dropdown-toggle">
                            <i class="ri-more-fill "></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>