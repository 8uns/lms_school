<div 
    x-data="{ 
        darkMode: localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches),
        toggleTheme() {
            this.darkMode = !this.darkMode;
            localStorage.setItem('theme', this.darkMode ? 'dark' : 'light');
        }
    }"
    :class="{ 'dark': darkMode }"
>
    <div class="bg-slate-100 dark:bg-slate-900 min-h-screen flex items-center justify-center p-4 transition-colors duration-300 relative">
        
        <!-- Tombol Manual Toggle Theme -->
        <button 
            @click="toggleTheme()" 
            type="button" 
            title="Ganti Tema"
            class="absolute top-5 right-5 cursor-pointer bg-white dark:bg-slate-800 text-slate-600 dark:text-slate-300 hover:text-blue-600 dark:hover:text-sky-400 p-3 rounded-2xl shadow-md border border-slate-200 dark:border-slate-700 transition-all duration-300 active:scale-95 flex items-center gap-2 text-sm font-semibold">
            <template x-if="!darkMode">
                <div class="flex items-center gap-2">
                    <i class="ri-moon-line text-lg"></i>
                    <span class="hidden sm:inline">Dark Mode</span>
                </div>
            </template>
            <template x-if="darkMode">
                <div class="flex items-center gap-2">
                    <i class="ri-sun-line text-lg text-amber-400"></i>
                    <span class="hidden sm:inline">Light Mode</span>
                </div>
            </template>
        </button>

        <!-- Card Login -->
        <div class="bg-white dark:bg-slate-800 p-8 sm:p-10 shadow-xl dark:shadow-black/50 rounded-2xl w-full max-w-md border border-slate-100 dark:border-slate-700/60 transition-colors duration-300">
            
            <!-- Header -->
            <div class="text-center mb-8">
                <div class="w-14 h-14 bg-gradient-to-tr from-blue-900 via-blue-700 to-sky-500 text-white rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg shadow-blue-500/20">
                    <i class="ri-lock-2-fill text-2xl"></i>
                </div>
                <h2 class="font-bold text-2xl text-slate-800 dark:text-white transition-colors">Login LMS SMPN 1 HALBAR</h2>
                <p class="text-xs text-slate-500 dark:text-slate-400 mt-1 transition-colors">Masukkan akun untuk mengakses sistem</p>
            </div>

            <!-- Form -->
            <div>
                <form action="<?= base_url('/login') ?>" method="POST" class="space-y-5">
                    
                    <!-- Input Username -->
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2 transition-colors">Username</label>
                        <div class="relative">
                            <i class="ri-account-circle-line absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 dark:text-slate-500 text-lg"></i>
                            <input 
                                required 
                                type="text" 
                                name="username" 
                                placeholder="Masukkan username..." 
                                class="w-full h-11 pl-10 pr-4 bg-slate-50 dark:bg-slate-700/50 border border-slate-300 dark:border-slate-600 rounded-2xl text-sm text-slate-800 dark:text-slate-100 placeholder-slate-400 dark:placeholder-slate-500 focus:outline-none focus:bg-white dark:focus:bg-slate-700 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-600 dark:focus:border-sky-400 transition-all font-normal"
                            >
                        </div>
                    </div>

                    <!-- Input Password -->
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2 transition-colors">Password</label>
                        <div class="relative">
                            <i class="ri-lock-password-line absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 dark:text-slate-500 text-lg"></i>
                            <input 
                                required 
                                type="password" 
                                name="password" 
                                placeholder="••••••••" 
                                class="w-full h-11 pl-10 pr-4 bg-slate-50 dark:bg-slate-700/50 border border-slate-300 dark:border-slate-600 rounded-2xl text-sm text-slate-800 dark:text-slate-100 placeholder-slate-400 dark:placeholder-slate-500 focus:outline-none focus:bg-white dark:focus:bg-slate-700 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-600 dark:focus:border-sky-400 transition-all font-normal"
                            >
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <button 
                        type="submit" 
                        class="cursor-pointer bg-gradient-to-r from-blue-900 via-blue-700 to-sky-500 hover:from-blue-950 hover:via-blue-800 hover:to-sky-600 w-full rounded-2xl text-white font-bold text-sm h-12 mt-2 transition-all duration-300 shadow-md shadow-blue-600/20 hover:shadow-lg active:scale-[0.98] flex items-center justify-center gap-2">
                        <span>Sign In</span>
                        <i class="ri-arrow-right-line text-lg"></i>
                    </button>

                </form>
            </div>

        </div>
    </div>
</div>