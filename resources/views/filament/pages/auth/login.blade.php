<x-filament-panels::page.simple>
    <!-- Back to Public Site Link -->
    <div class="mb-4 text-center">
        <a href="/" class="inline-flex items-center gap-1.5 text-xs font-semibold text-gray-500 hover:text-[#1B4332] dark:text-gray-400 dark:hover:text-emerald-400 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            <span>Kembali ke Website Publik Sukawarna</span>
        </a>
    </div>

    <!-- Quick Role Switcher Chips -->
    <div class="mb-5 p-4 rounded-2xl bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 space-y-2.5">
        <div class="flex items-center justify-between">
            <span class="text-[11px] font-bold uppercase tracking-wider text-slate-600 dark:text-slate-300">Pilih Akses Cepat Demo (Peran):</span>
            <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
        </div>
        <div class="grid grid-cols-2 gap-2 text-xs">
            <!-- 1. Lurah / Pimpinan -->
            <button type="button" 
                    wire:click="selectRole('lurah@kelurahan.test')" 
                    class="p-2.5 rounded-xl border border-amber-200 bg-amber-50/90 hover:bg-amber-100 dark:bg-amber-950/40 dark:border-amber-800 text-left transition-all hover:scale-[1.02] cursor-pointer">
                <span class="font-bold text-amber-900 dark:text-amber-200 block text-[11px] sm:text-xs">👑 Lurah / Pimpinan</span>
                <span class="text-[10px] text-amber-700 dark:text-amber-400 block truncate mt-0.5">lurah@kelurahan.test</span>
            </button>

            <!-- 2. Operator Kelurahan -->
            <button type="button" 
                    wire:click="selectRole('operator@kelurahan.test')" 
                    class="p-2.5 rounded-xl border border-sky-200 bg-sky-50/90 hover:bg-sky-100 dark:bg-sky-950/40 dark:border-sky-800 text-left transition-all hover:scale-[1.02] cursor-pointer">
                <span class="font-bold text-sky-900 dark:text-sky-200 block text-[11px] sm:text-xs">💼 Operator Loket</span>
                <span class="text-[10px] text-sky-700 dark:text-sky-400 block truncate mt-0.5">operator@kelurahan.test</span>
            </button>

            <!-- 3. Admin Wilayah -->
            <button type="button" 
                    wire:click="selectRole('admin@kelurahan.test')" 
                    class="p-2.5 rounded-xl border border-emerald-200 bg-emerald-50/90 hover:bg-emerald-100 dark:bg-emerald-950/40 dark:border-emerald-800 text-left transition-all hover:scale-[1.02] cursor-pointer">
                <span class="font-bold text-emerald-900 dark:text-emerald-200 block text-[11px] sm:text-xs">🏛️ Admin Wilayah</span>
                <span class="text-[10px] text-emerald-700 dark:text-emerald-400 block truncate mt-0.5">admin@kelurahan.test</span>
            </button>

            <!-- 4. Super Admin -->
            <button type="button" 
                    wire:click="selectRole('superadmin@kelurahan.test')" 
                    class="p-2.5 rounded-xl border border-purple-200 bg-purple-50/90 hover:bg-purple-100 dark:bg-purple-950/40 dark:border-purple-800 text-left transition-all hover:scale-[1.02] cursor-pointer">
                <span class="font-bold text-purple-900 dark:text-purple-200 block text-[11px] sm:text-xs">⚡ Super Admin</span>
                <span class="text-[10px] text-purple-700 dark:text-purple-400 block truncate mt-0.5">superadmin@kelurahan.test</span>
            </button>
        </div>
        <p class="text-[10px] text-slate-400 dark:text-slate-500 text-center">
            Pilih salah satu peran untuk otomatis mengisi akun login dan mencoba dashboard perannya.
        </p>
    </div>

    <!-- Login Form Render -->
    {{ $this->content }}

    <!-- Security & Audit Trail Disclaimer -->
    <div class="mt-6 pt-4 border-t border-slate-200 dark:border-slate-800 text-center space-y-1">
        <p class="text-[11px] text-slate-500 dark:text-slate-400 flex items-center justify-center gap-1.5 font-medium">
            <svg class="w-3.5 h-3.5 text-amber-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
            </svg>
            <span>Akses Terbatas Khusus Aparatur Resmi &bull; Audit Trail Aktif</span>
        </p>
        <p class="text-[10px] text-slate-400 dark:text-slate-500">
            Pemerintah Kota Bandung &bull; Kecamatan Sukasari &bull; Kelurahan Sukawarna
        </p>
    </div>
</x-filament-panels::page.simple>
