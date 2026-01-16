<!-- main start -->
<div class="ml-0 md:ml-72 sm:ml-0 bg-gray-100 min-h-screen">
    <div class="p-15">
        <div class="grid grid-cols-1 gap-6">
            <div class="bg-white rounded-2xl border border-gray-100">
                <div class="">

                    <div class="font-bold py-10 px-10 border-b border-gray-200">
                        Data User
                    </div>

                    <div class="px-10 py-5 ">

                        <div class="overflow-x-auto bg-white border border-gray-400 mt-3 rounded-2xl text-gray-600">
                            <table class="w-full text-center">
                                <thead>
                                    <tr class="h-20">
                                        <th class="">No</th>
                                        <th class="">Nama Lengkap</th>
                                        <th class="">Email</th>
                                        <th class="">Role</th>
                                        <th class="">Aksi</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach ($data['user'] as $user): ?>
                                        <tr class="h-15 border-b border-t border-gray-300">

                                            <td class="px-4 py-2"><?= $no++; ?></td>
                                            <td class="px-4 py-2"><?= $user['full_name']; ?></td>
                                            <td class="px-4 py-2"><?= $user['username']; ?></td>
                                            <td class="px-4 py-2"><?= $user['role']; ?></td>
                                            <td class="px-4 py-2">
                                                <button type="button"
                                                    class="bg-blue-500 text-white px-3 py-1 rounded-md hover:bg-blue-600">Edit</button>
                                                <button type="button"
                                                    class="bg-red-500 text-white px-3 py-1 rounded-md hover:bg-red-600"
                                                    onclick="return confirm('Are you sure you want to delete this user?')">Delete</button>
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

</div>