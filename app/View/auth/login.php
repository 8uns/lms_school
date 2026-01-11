<?php if ($error = get_flash('errorlogin')): ?>
    <p style="color: red;"><?= $error ?></p>
<?php endif; ?>


<div class="bg-gradient-to-r  from-orange-700 to-yellow-500  h-screen flex items-center justify-center">
    <div class="bg-white p-10 shadow shadow-black1/2 rounded-2xl">
        <h2 class="text-center p-4 font-bold text-2xl mb-8">
            <i class="ri-lock-2-fill"></i>
            Login LMS
        </h2>
        <div class="">
            <form action="<?= base_url() ?>/login" method="POST">
                <div class="mb-5 relative">
                    <label class="block text-sm">Username</label>
                    <i class="ri-account-circle-line absolute left-3 top-6 text-gray-400"></i>
                    <input class="border-gray-300 border text-sm rounded-2xl py-2 pl-9 pr-6" type="text" name="username" required placeholder="username...">
                </div>
                <div class="mb-5 relative">
                    <label class="block text-sm">Password</label>
                    <i class="ri-lock-password-line absolute left-3 top-6 text-gray-400"></i>
                    <input class="border-gray-300 border text-sm rounded-2xl py-2 pl-9 pr-6" type="password" name="password" required placeholder="password...">
                </div>Sanana
                <button type="submit" class="bg-gradient-to-r from-orange-700 to-yellow-500 w-full rounded-2xl text-white py-2">Login</button>
            </form>
        </div>
    </div>
</div>