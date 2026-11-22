<x-filament::section>
    <x-slot name="heading">
        <div class="flex items-center gap-2">
            <span class="w-2.5 h-2.5 rounded-full bg-[#2D6A4F]"></span>
            <span class="font-bold text-sm tracking-wide text-gray-900 dark:text-white uppercase">Akses Cepat & Navigasi Operasional</span>
        </div>
    </x-slot>

    <x-slot name="description">
        Pintasan langsung bagi aparatur kelurahan untuk menindaklanjuti aspirasi warga, mengelola peta spasial, dan memperbarui informasi publik.
    </x-slot>

    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-3 pt-2">
        <!-- 1. Buka Peta Spasial Digital -->
        <a href="/peta" target="_blank" rel="noopener noreferrer" 
           class="group flex flex-col items-center p-3.5 rounded-2xl bg-sky-50/70 hover:bg-sky-100/90 dark:bg-sky-950/40 dark:hover:bg-sky-900/60 border border-sky-200 dark:border-sky-800 transition-all text-center">
            <div class="w-10 h-10 rounded-xl bg-[#0284C7] text-white flex items-center justify-center shadow-sm group-hover:scale-110 transition-transform mb-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/></svg>
            </div>
            <span class="font-bold text-xs text-sky-950 dark:text-sky-100">Peta Spasial Digital</span>
            <span class="text-[10px] text-sky-700 dark:text-sky-300 mt-0.5">Buka GIS Publik &rarr;</span>
        </a>

        <!-- 2. Portal Publik Warga -->
        <a href="/" target="_blank" rel="noopener noreferrer" 
           class="group flex flex-col items-center p-3.5 rounded-2xl bg-emerald-50/70 hover:bg-emerald-100/90 dark:bg-emerald-950/40 dark:hover:bg-emerald-900/60 border border-emerald-200 dark:border-emerald-800 transition-all text-center">
            <div class="w-10 h-10 rounded-xl bg-[#2D6A4F] text-white flex items-center justify-center shadow-sm group-hover:scale-110 transition-transform mb-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
            </div>
            <span class="font-bold text-xs text-emerald-950 dark:text-emerald-100">Portal Warga</span>
            <span class="text-[10px] text-emerald-700 dark:text-emerald-300 mt-0.5">Lihat Beranda &rarr;</span>
        </a>

        <!-- 3. Tindak Lanjut Pengaduan -->
        <a href="/admin/pengaduans" 
           class="group flex flex-col items-center p-3.5 rounded-2xl bg-amber-50/70 hover:bg-amber-100/90 dark:bg-amber-950/40 dark:hover:bg-amber-900/60 border border-amber-200 dark:border-amber-800 transition-all text-center">
            <div class="w-10 h-10 rounded-xl bg-[#D97706] text-white flex items-center justify-center shadow-sm group-hover:scale-110 transition-transform mb-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
            </div>
            <span class="font-bold text-xs text-amber-950 dark:text-amber-100">Aspirasi Warga</span>
            <span class="text-[10px] text-amber-700 dark:text-amber-300 mt-0.5">Verifikasi Keluhan</span>
        </a>

        <!-- 4. Titik Fasilitas Publik -->
        <a href="/admin/fasilitas" 
           class="group flex flex-col items-center p-3.5 rounded-2xl bg-teal-50/70 hover:bg-teal-100/90 dark:bg-teal-950/40 dark:hover:bg-teal-900/60 border border-teal-200 dark:border-teal-800 transition-all text-center">
            <div class="w-10 h-10 rounded-xl bg-[#0D9488] text-white flex items-center justify-center shadow-sm group-hover:scale-110 transition-transform mb-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            </div>
            <span class="font-bold text-xs text-teal-950 dark:text-teal-100">Fasilitas Publik</span>
            <span class="text-[10px] text-teal-700 dark:text-teal-300 mt-0.5">Kelola Titik Peta</span>
        </a>

        <!-- 5. Tulis Berita & Warta -->
        <a href="/admin/beritas/create" 
           class="group flex flex-col items-center p-3.5 rounded-2xl bg-indigo-50/70 hover:bg-indigo-100/90 dark:bg-indigo-950/40 dark:hover:bg-indigo-900/60 border border-indigo-200 dark:border-indigo-800 transition-all text-center">
            <div class="w-10 h-10 rounded-xl bg-[#4F46E5] text-white flex items-center justify-center shadow-sm group-hover:scale-110 transition-transform mb-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
            </div>
            <span class="font-bold text-xs text-indigo-950 dark:text-indigo-100">Tulis Berita</span>
            <span class="text-[10px] text-indigo-700 dark:text-indigo-300 mt-0.5">Rilis Informasi Baru</span>
        </a>

        <!-- 6. Profil & Struktur Wilayah -->
        <a href="/admin/profil-kelurahans" 
           class="group flex flex-col items-center p-3.5 rounded-2xl bg-purple-50/70 hover:bg-purple-100/90 dark:bg-purple-950/40 dark:hover:bg-purple-900/60 border border-purple-200 dark:border-purple-800 transition-all text-center">
            <div class="w-10 h-10 rounded-xl bg-[#7C3AED] text-white flex items-center justify-center shadow-sm group-hover:scale-110 transition-transform mb-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
            </div>
            <span class="font-bold text-xs text-purple-950 dark:text-purple-100">Bagan Organisasi</span>
            <span class="text-[10px] text-purple-700 dark:text-purple-300 mt-0.5">Susunan Aparatur</span>
        </a>
    </div>
</x-filament::section>
