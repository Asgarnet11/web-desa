<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Sistem Informasi & Profil Kelurahan Sukawarna' }}</title>
    <meta name="description" content="{{ $description ?? 'Portal Pemetaan dan Pusat Informasi Publik Kelurahan Sukawarna, Kota Bandung' }}">
    
    <!-- Open Graph -->
    <meta property="og:title" content="{{ $title ?? 'Sistem Informasi & Profil Kelurahan Sukawarna' }}">
    <meta property="og:description" content="{{ $description ?? 'Portal Pemetaan dan Pusat Informasi Publik Kelurahan Sukawarna' }}">
    <meta property="og:type" content="website">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="bg-[#F8F9FA] text-[#1F2D26] font-sans antialiased min-h-[100dvh] flex flex-col selection:bg-[#FFB703] selection:text-[#1B4332]">

    <!-- Top Header Bar (Dark Forest Green) -->
    <div class="bg-[#1B4332] text-[#FFF8E7] text-xs py-2 px-4 sm:px-6 border-b border-[#2D6A4F]/60">
        <div class="max-w-7xl mx-auto flex flex-col lg:flex-row items-center justify-between gap-2.5">
            <!-- Left Info (Phone, Email, Address) -->
            <div class="flex flex-wrap items-center justify-center lg:justify-start gap-x-5 gap-y-1 text-white/90">
                <a href="tel:0222012345" class="inline-flex items-center gap-1.5 hover:text-[#FFB703] transition-colors">
                    <svg class="w-3.5 h-3.5 text-[#FFB703]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                    </svg>
                    <span>+62 (022) 2012345</span>
                </a>
                <span class="hidden sm:inline text-white/40">&bull;</span>
                <a href="mailto:kelurahan.sukawarna@bandung.go.id" class="inline-flex items-center gap-1.5 hover:text-[#FFB703] transition-colors">
                    <svg class="w-3.5 h-3.5 text-[#FFB703]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    <span>kelurahan.sukawarna@bandung.go.id</span>
                </a>
                <span class="hidden md:inline text-white/40">&bull;</span>
                <span class="hidden md:inline-flex items-center gap-1.5 text-white/80">
                    <svg class="w-3.5 h-3.5 text-[#FFB703]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    <span>Jl. Sukawarna No. 12, Kec. Sukasari, Kota Bandung</span>
                </span>
            </div>

            <!-- Right Links & CTA Button -->
            <div class="flex items-center gap-3 sm:gap-4 text-xs">
                <a href="{{ route('pengaduan.cek') }}" class="hover:text-[#FFB703] transition-colors font-medium">Lacak Pengaduan</a>
                <span class="text-white/40">&bull;</span>
                <a href="{{ route('berita.index') }}" class="hover:text-[#FFB703] transition-colors font-medium">Kabar Wilayah</a>
                <span class="text-white/40">&bull;</span>
                <a href="/admin" class="hover:text-[#FFB703] transition-colors font-medium flex items-center gap-1">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    <span>Masuk Petugas</span>
                </a>

                <a href="{{ route('pengaduan.index') }}" class="ml-2 inline-flex items-center gap-1 px-3.5 py-1 bg-[#FFB703] text-[#1B4332] font-bold text-xs uppercase tracking-wide rounded hover:bg-[#e6a503] transition-colors shadow-sm">
                    <span>Layanan Pengaduan</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Main Navigation Bar (Clean White) -->
    <header class="bg-white sticky top-0 z-40 border-b border-gray-200 shadow-sm transition-all">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">
            <div class="flex items-center justify-between h-20">
                <!-- Brand / Official Crest -->
                <a href="{{ route('landing') }}" class="flex items-center gap-3.5 group">
                    <!-- Institutional Crest Emblem -->
                    <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-[#1B4332] to-[#2D6A4F] flex items-center justify-center text-[#FFB703] shadow-md border-2 border-[#FFB703]/30 group-hover:scale-105 transition-transform">
                        <svg class="w-7 h-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                            <path d="M12 8v8"/>
                            <path d="M8 12l4-4 4 4"/>
                        </svg>
                    </div>
                    <div class="flex flex-col">
                        <span class="font-serif font-black text-sm tracking-[0.2em] text-[#1B4332] uppercase leading-tight">KELURAHAN</span>
                        <span class="font-display font-extrabold text-xl text-[#1B4332] tracking-wider leading-none">SUKAWARNA</span>
                        <span class="text-[10px] text-[#2D6A4F] font-bold tracking-widest uppercase mt-0.5">KOTA BANDUNG</span>
                    </div>
                </a>

                <!-- Desktop Navigation Links -->
                <nav class="hidden lg:flex items-center gap-1 xl:gap-2 text-[13px] font-bold tracking-wide uppercase text-[#1B4332]">
                    <a href="{{ route('landing') }}" class="px-3 py-2 rounded-md hover:text-[#2D6A4F] hover:bg-gray-50 transition-colors {{ request()->routeIs('landing') ? 'text-[#2D6A4F] border-b-2 border-[#2D6A4F]' : '' }}">
                        Beranda
                    </a>
                    <a href="{{ route('landing') }}#profil" class="px-3 py-2 rounded-md hover:text-[#2D6A4F] hover:bg-gray-50 transition-colors">
                        Tentang Kami
                    </a>
                    <a href="{{ route('landing') }}#program" class="px-3 py-2 rounded-md hover:text-[#2D6A4F] hover:bg-gray-50 transition-colors">
                        Program
                    </a>
                    <a href="{{ route('landing') }}#timeline" class="px-3 py-2 rounded-md hover:text-[#2D6A4F] hover:bg-gray-50 transition-colors">
                        Timeline
                    </a>
                    <a href="{{ route('landing') }}#fasilitas" class="px-3 py-2 rounded-md hover:text-[#2D6A4F] hover:bg-gray-50 transition-colors">
                        Fasilitas
                    </a>
                    <a href="{{ route('layanan.index') }}" class="px-3 py-2 rounded-md hover:text-[#2D6A4F] hover:bg-gray-50 transition-colors {{ request()->routeIs('layanan.*') ? 'text-[#2D6A4F] border-b-2 border-[#2D6A4F]' : '' }}">
                        Layanan
                    </a>
                    <a href="{{ route('peta.index') }}" class="px-3 py-2 rounded-md hover:text-[#2D6A4F] hover:bg-gray-50 transition-colors {{ request()->routeIs('peta.*') ? 'text-[#2D6A4F] border-b-2 border-[#2D6A4F]' : '' }}">
                        Peta Digital
                    </a>
                    <a href="{{ route('umkm.index') }}" class="px-3 py-2 rounded-md hover:text-[#2D6A4F] hover:bg-gray-50 transition-colors {{ request()->routeIs('umkm.*') ? 'text-[#2D6A4F] border-b-2 border-[#2D6A4F]' : '' }}">
                        UMKM
                    </a>
                    <a href="{{ route('landing') }}#galeri" class="px-3 py-2 rounded-md hover:text-[#2D6A4F] hover:bg-gray-50 transition-colors">
                        Galeri
                    </a>
                    <a href="{{ route('landing') }}#kontak" class="px-3 py-2 rounded-md hover:text-[#2D6A4F] hover:bg-gray-50 transition-colors">
                        Kontak
                    </a>
                </nav>

                <!-- Search / Action & Mobile Toggle -->
                <div class="flex items-center gap-3">
                    <a href="{{ route('peta.index') }}" class="hidden sm:flex items-center justify-center w-10 h-10 rounded-full border border-gray-200 text-[#1B4332] hover:bg-gray-50 transition-colors" title="Pencarian Fasilitas & Peta">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </a>

                    <!-- Mobile Menu Button -->
                    <button id="mobile-menu-btn" class="lg:hidden p-2.5 rounded-lg border border-gray-200 text-[#1B4332] hover:bg-gray-50" aria-label="Buka Menu Navigasi">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Drawer Menu -->
        <div id="mobile-menu" class="hidden lg:hidden bg-white border-t border-gray-200 px-6 py-5 shadow-lg space-y-3">
            <div class="grid grid-cols-2 gap-2 text-xs font-bold uppercase text-[#1B4332]">
                <a href="{{ route('landing') }}" class="px-3 py-2 rounded-lg bg-gray-50 hover:bg-gray-100">Beranda</a>
                <a href="{{ route('landing') }}#profil" class="px-3 py-2 rounded-lg bg-gray-50 hover:bg-gray-100">Tentang Kami</a>
                <a href="{{ route('landing') }}#program" class="px-3 py-2 rounded-lg bg-gray-50 hover:bg-gray-100">Program</a>
                <a href="{{ route('landing') }}#timeline" class="px-3 py-2 rounded-lg bg-gray-50 hover:bg-gray-100">Timeline</a>
                <a href="{{ route('landing') }}#fasilitas" class="px-3 py-2 rounded-lg bg-gray-50 hover:bg-gray-100">Fasilitas</a>
                <a href="{{ route('layanan.index') }}" class="px-3 py-2 rounded-lg bg-gray-50 hover:bg-gray-100">Layanan</a>
                <a href="{{ route('peta.index') }}" class="px-3 py-2 rounded-lg bg-gray-50 hover:bg-gray-100">Peta Digital</a>
                <a href="{{ route('umkm.index') }}" class="px-3 py-2 rounded-lg bg-gray-50 hover:bg-gray-100">Direktori UMKM</a>
                <a href="{{ route('berita.index') }}" class="px-3 py-2 rounded-lg bg-gray-50 hover:bg-gray-100">Kabar & Agenda</a>
                <a href="{{ route('landing') }}#galeri" class="px-3 py-2 rounded-lg bg-gray-50 hover:bg-gray-100">Galeri Warga</a>
                <a href="{{ route('landing') }}#kontak" class="px-3 py-2 rounded-lg bg-gray-50 hover:bg-gray-100">Kontak & Alamat</a>
            </div>
            <div class="pt-2 border-t border-gray-100 flex flex-col gap-2">
                <a href="{{ route('pengaduan.index') }}" class="w-full py-2.5 bg-[#FFB703] text-[#1B4332] text-center font-bold text-xs uppercase tracking-wider rounded-lg">
                    Layanan Pengaduan Warga
                </a>
                <a href="/admin" class="w-full py-2 border border-gray-300 text-gray-700 text-center font-semibold text-xs rounded-lg">
                    Panel Petugas Kelurahan
                </a>
            </div>
        </div>
    </header>

    <!-- Main Content Area -->
    <main class="flex-1">
        {{ $slot }}
    </main>

    <!-- Institutional Rich Footer (Deep Forest Green) -->
    <footer class="bg-[#143527] text-white pt-16 pb-8 border-t border-[#2D6A4F]">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-10 pb-12 border-b border-white/10 text-xs">
                <!-- Col 1: Brand & Profile -->
                <div class="lg:col-span-1 space-y-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-lg bg-[#2D6A4F] flex items-center justify-center text-[#FFB703] font-bold shadow-md">
                            <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                                <path d="M12 8v8"/>
                                <path d="M8 12l4-4 4 4"/>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-serif font-black text-sm tracking-wider uppercase text-white">KELURAHAN</h4>
                            <p class="font-display font-extrabold text-base text-[#FFB703] leading-none">SUKAWARNA</p>
                        </div>
                    </div>
                    <p class="text-white/70 leading-relaxed">
                        Sistem Informasi Profil Wilayah, Pemetaan Spasial Interaktif, dan Pusat Pelayanan Administrasi Publik Kelurahan Sukawarna, Kecamatan Sukasari, Kota Bandung.
                    </p>
                    <!-- Social Media Links -->
                    <div class="flex items-center gap-3 pt-1 text-white/80">
                        <a href="https://facebook.com/KelurahanSukawarnaResmi" target="_blank" class="w-8 h-8 rounded-full bg-white/10 hover:bg-[#FFB703] hover:text-[#1B4332] flex items-center justify-center transition-colors">
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M9 8H6v4h3v12h5V12h3.642L18 8h-4V6.333C14 5.374 14.5 5 15.667 5H18V0h-3.808C10.592 0 9 1.592 9 4.889V8z"/></svg>
                        </a>
                        <a href="https://instagram.com/kelurahansukawarna" target="_blank" class="w-8 h-8 rounded-full bg-white/10 hover:bg-[#FFB703] hover:text-[#1B4332] flex items-center justify-center transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>
                        </a>
                        <a href="https://youtube.com/SukawarnaTV" target="_blank" class="w-8 h-8 rounded-full bg-white/10 hover:bg-[#FFB703] hover:text-[#1B4332] flex items-center justify-center transition-colors">
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 00-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 00.502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 002.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 002.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                        </a>
                        <a href="https://wa.me/6281234567890" target="_blank" class="w-8 h-8 rounded-full bg-white/10 hover:bg-[#FFB703] hover:text-[#1B4332] flex items-center justify-center transition-colors">
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/></svg>
                        </a>
                    </div>
                </div>

                <!-- Col 2: Tautan Cepat -->
                <div class="space-y-3">
                    <h5 class="font-display font-bold text-sm text-[#FFB703] uppercase tracking-wider">Tautan Cepat</h5>
                    <ul class="space-y-2 text-white/80">
                        <li><a href="{{ route('landing') }}" class="hover:text-[#FFB703] transition-colors">Beranda Utama</a></li>
                        <li><a href="{{ route('landing') }}#profil" class="hover:text-[#FFB703] transition-colors">Profil Wilayah</a></li>
                        <li><a href="{{ route('landing') }}#program" class="hover:text-[#FFB703] transition-colors">Program Prioritas</a></li>
                        <li><a href="{{ route('landing') }}#fasilitas" class="hover:text-[#FFB703] transition-colors">Direktori Fasilitas</a></li>
                        <li><a href="{{ route('peta.index') }}" class="hover:text-[#FFB703] transition-colors">Peta Interaktif Spasial</a></li>
                        <li><a href="{{ route('umkm.index') }}" class="hover:text-[#FFB703] transition-colors">Direktori UMKM Warga</a></li>
                    </ul>
                </div>

                <!-- Col 3: Informasi Publik -->
                <div class="space-y-3">
                    <h5 class="font-display font-bold text-sm text-[#FFB703] uppercase tracking-wider">Informasi Publik</h5>
                    <ul class="space-y-2 text-white/80">
                        <li><a href="{{ route('layanan.index') }}" class="hover:text-[#FFB703] transition-colors">Standar Pelayanan Surat</a></li>
                        <li><a href="{{ route('berita.index') }}" class="hover:text-[#FFB703] transition-colors">Kabar & Pengumuman</a></li>
                        <li><a href="{{ route('pengaduan.index') }}" class="hover:text-[#FFB703] transition-colors">Pengaduan Masyarakat</a></li>
                        <li><a href="{{ route('pengaduan.cek') }}" class="hover:text-[#FFB703] transition-colors">Lacak Status Tiket</a></li>
                        <li><a href="{{ route('landing') }}#galeri" class="hover:text-[#FFB703] transition-colors">Galeri Dokumentasi</a></li>
                        <li><a href="/admin" class="hover:text-[#FFB703] transition-colors">Login Operator</a></li>
                    </ul>
                </div>

                <!-- Col 4: Kontak & Jam Layanan -->
                <div class="space-y-3">
                    <h5 class="font-display font-bold text-sm text-[#FFB703] uppercase tracking-wider">Kontak & Pelayanan</h5>
                    <div class="space-y-2 text-white/80 leading-relaxed">
                        <p class="flex items-start gap-2">
                            <svg class="w-4 h-4 text-[#FFB703] flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            <span>Jl. Sukawarna No. 12, Kec. Sukasari, Kota Bandung, 40164</span>
                        </p>
                        <p class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-[#FFB703] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            <span>(022) 2012345</span>
                        </p>
                        <p class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-[#FFB703] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            <span>kelurahan.sukawarna@bandung.go.id</span>
                        </p>
                        <div class="pt-2 text-[11px] text-white/70">
                            <p class="font-bold text-white">Jam Operasional:</p>
                            <p>Senin &ndash; Kamis: 08.00 &ndash; 15.30 WIB</p>
                            <p>Jumat: 08.00 &ndash; 14.30 WIB</p>
                        </div>
                    </div>
                </div>

                <!-- Col 5: Newsletter / Warta Warga -->
                <div class="space-y-3">
                    <h5 class="font-display font-bold text-sm text-[#FFB703] uppercase tracking-wider">Warta Wilayah</h5>
                    <p class="text-white/70 leading-relaxed text-xs">
                        Dapatkan informasi pengumuman program bantuan, jadwal pelayanan keliling, dan kegiatan warga langsung ke email Anda.
                    </p>
                    <form onsubmit="event.preventDefault(); alert('Terima kasih, Anda telah terdaftar dalam warta berkala Kelurahan Sukawarna!');" class="space-y-2">
                        <div class="flex items-center rounded-lg overflow-hidden bg-white/10 border border-white/20 focus-within:border-[#FFB703]">
                            <input type="email" placeholder="Masukkan alamat email" required 
                                   class="w-full px-3 py-2 text-xs text-white placeholder-white/50 bg-transparent outline-none">
                            <button type="submit" class="px-3 py-2 bg-[#FFB703] text-[#1B4332] font-bold hover:bg-[#e6a503] transition-colors" title="Kirim">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                                </svg>
                            </button>
                        </div>
                        <span class="text-[10px] text-white/50 block">Privasi Anda terjaga. Bebas dari spam.</span>
                    </form>
                </div>
            </div>

            <!-- Bottom Copyright Bar -->
            <div class="pt-8 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-white/60">
                <p>&copy; {{ date('Y') }} Kelurahan Sukawarna, Kota Bandung. Seluruh Hak Cipta Dilindungi.</p>
                <div class="flex items-center gap-4 text-xs">
                    <a href="{{ route('landing') }}#profil" class="hover:text-white transition-colors">Kebijakan Privasi</a>
                    <span>&bull;</span>
                    <a href="{{ route('landing') }}#kontak" class="hover:text-white transition-colors">Syarat & Ketentuan</a>
                </div>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>