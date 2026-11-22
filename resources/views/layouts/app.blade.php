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
<body class="bg-[#F8F9FA] text-[#1F2D26] font-sans antialiased min-h-[100dvh] flex flex-col selection:bg-[#FFB703] selection:text-[#1B4332] overflow-x-hidden">

    <!-- Top Header Bar (Dark Forest Green - Single Clean Non-Wrapping Line) -->
    <div class="bg-[#1B4332] text-[#FFF8E7] text-[11px] font-medium border-b border-[#2D6A4F]/60">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 h-10 flex items-center justify-between gap-3">
            <!-- Left Info (Phone, Email, Address - Responsive with whitespace-nowrap) -->
            <div class="flex items-center gap-3 sm:gap-5 text-white/90 overflow-hidden">
                <a href="tel:0222012345" class="inline-flex items-center gap-1.5 hover:text-[#FFB703] transition-colors whitespace-nowrap flex-shrink-0">
                    <svg class="w-3.5 h-3.5 text-[#FFB703] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                    </svg>
                    <span>+62 (022) 2012345</span>
                </a>

                <span class="hidden md:inline text-white/30">&bull;</span>
                <a href="mailto:kelurahan.sukawarna@bandung.go.id" class="hidden md:inline-flex items-center gap-1.5 hover:text-[#FFB703] transition-colors whitespace-nowrap flex-shrink-0">
                    <svg class="w-3.5 h-3.5 text-[#FFB703] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    <span>kelurahan.sukawarna@bandung.go.id</span>
                </a>

                <span class="hidden xl:inline text-white/30">&bull;</span>
                <span class="hidden xl:inline-flex items-center gap-1.5 text-white/80 whitespace-nowrap truncate max-w-sm">
                    <svg class="w-3.5 h-3.5 text-[#FFB703] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    <span>Jl. Sukawarna No. 12, Kec. Sukasari, Kota Bandung</span>
                </span>
            </div>

            <!-- Right Links & CTA Button (Non-wrapping) -->
            <div class="flex items-center gap-2.5 sm:gap-4 flex-shrink-0">
                <a href="{{ route('pengaduan.cek') }}" class="hidden sm:inline-block hover:text-[#FFB703] transition-colors whitespace-nowrap font-medium">
                    Lacak Pengaduan
                </a>
                <span class="hidden sm:inline text-white/30">&bull;</span>
                <a href="{{ route('berita.index') }}" class="hidden lg:inline-block hover:text-[#FFB703] transition-colors whitespace-nowrap font-medium">
                    Kabar Wilayah
                </a>
                <span class="hidden lg:inline text-white/30">&bull;</span>
                <a href="/admin" class="hidden md:inline-flex items-center gap-1 hover:text-[#FFB703] transition-colors whitespace-nowrap font-medium">
                    <svg class="w-3 h-3 text-[#FFB703]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    <span>Portal Petugas</span>
                </a>

                <!-- Gold CTA Button -->
                <a href="{{ route('pengaduan.index') }}" class="inline-flex items-center px-3 sm:px-4 py-1.5 bg-[#FFB703] hover:bg-[#e5a502] text-[#1B4332] font-black text-[10px] sm:text-[11px] uppercase tracking-wider rounded transition-colors shadow-xs whitespace-nowrap">
                    <span>Layanan Pengaduan</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Main Navigation Bar (Clean White - Grouped Items & Mobile Drawer) -->
    <header class="bg-white sticky top-0 z-40 border-b border-gray-200 shadow-sm transition-all">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">
            <div class="flex items-center justify-between h-20">
                <!-- Brand / Official Crest -->
                <a href="{{ route('landing') }}" class="flex items-center gap-3 group flex-shrink-0">
                    <div class="w-11 h-11 sm:w-12 sm:h-12 rounded-xl bg-gradient-to-br from-[#1B4332] to-[#2D6A4F] flex items-center justify-center text-[#FFB703] shadow-md border-2 border-[#FFB703]/30 group-hover:scale-105 transition-transform flex-shrink-0">
                        <svg class="w-6 h-6 sm:w-7 sm:h-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                            <path d="M12 8v8"/>
                            <path d="M8 12l4-4 4 4"/>
                        </svg>
                    </div>
                    <div class="flex flex-col">
                        <span class="font-serif font-black text-xs sm:text-sm tracking-[0.2em] text-[#1B4332] uppercase leading-tight">KELURAHAN</span>
                        <span class="font-display font-extrabold text-lg sm:text-xl text-[#1B4332] tracking-wider leading-none">SUKAWARNA</span>
                        <span class="text-[9px] text-[#2D6A4F] font-bold tracking-widest uppercase mt-0.5">KOTA BANDUNG</span>
                    </div>
                </a>

                <!-- Desktop Navigation Links (Clean Grouped Nav with Dropdowns) -->
                <nav class="hidden xl:flex items-center gap-1 text-[13px] font-bold tracking-wide uppercase text-[#1B4332]">
                    <a href="{{ route('landing') }}" class="px-3 py-2 rounded-md hover:text-[#2D6A4F] hover:bg-gray-50 transition-colors {{ request()->routeIs('landing') ? 'text-[#2D6A4F] font-black' : '' }}">
                        Beranda
                    </a>

                    <!-- Dropdown: Profil -->
                    <div class="relative group/menu">
                        <a href="{{ route('landing') }}#profil" class="px-3 py-2 rounded-md hover:text-[#2D6A4F] hover:bg-gray-50 transition-colors inline-flex items-center gap-1">
                            <span>Profil</span>
                            <svg class="w-3 h-3 text-gray-400 group-hover/menu:text-[#2D6A4F] transition-transform group-hover/menu:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/></svg>
                        </a>
                        <div class="absolute left-0 top-full pt-1 hidden group-hover/menu:block z-50">
                            <div class="bg-white rounded-xl shadow-xl border border-gray-100 p-2 min-w-[200px] space-y-1">
                                <a href="{{ route('landing') }}#profil" class="block px-3 py-2 rounded-lg text-xs font-semibold text-gray-700 hover:bg-emerald-50 hover:text-[#1B4332]">Tentang Kami & Sejarah</a>
                                <a href="{{ route('landing') }}#program" class="block px-3 py-2 rounded-lg text-xs font-semibold text-gray-700 hover:bg-emerald-50 hover:text-[#1B4332]">Visi & Misi</a>
                                <a href="{{ route('landing') }}#struktur" class="block px-3 py-2 rounded-lg text-xs font-semibold text-gray-700 hover:bg-emerald-50 hover:text-[#1B4332]">Bagan Kepengurusan</a>
                            </div>
                        </div>
                    </div>

                    <!-- Dropdown: Program & Timeline -->
                    <div class="relative group/menu">
                        <a href="{{ route('landing') }}#timeline" class="px-3 py-2 rounded-md hover:text-[#2D6A4F] hover:bg-gray-50 transition-colors inline-flex items-center gap-1">
                            <span>Program & Timeline</span>
                            <svg class="w-3 h-3 text-gray-400 group-hover/menu:text-[#2D6A4F] transition-transform group-hover/menu:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/></svg>
                        </a>
                        <div class="absolute left-0 top-full pt-1 hidden group-hover/menu:block z-50">
                            <div class="bg-white rounded-xl shadow-xl border border-gray-100 p-2 min-w-[220px] space-y-1">
                                <a href="{{ route('landing') }}#program" class="block px-3 py-2 rounded-lg text-xs font-semibold text-gray-700 hover:bg-emerald-50 hover:text-[#1B4332]">Program Prioritas Warga</a>
                                <a href="{{ route('landing') }}#timeline" class="block px-3 py-2 rounded-lg text-xs font-semibold text-gray-700 hover:bg-emerald-50 hover:text-[#1B4332]">Timeline Pengadaan & Seleksi</a>
                                <a href="{{ route('landing') }}#statistik" class="block px-3 py-2 rounded-lg text-xs font-semibold text-gray-700 hover:bg-emerald-50 hover:text-[#1B4332]">Data Statistik Wilayah</a>
                            </div>
                        </div>
                    </div>

                    <!-- Dropdown: Fasilitas & Peta -->
                    <div class="relative group/menu">
                        <a href="{{ route('peta.index') }}" class="px-3 py-2 rounded-md hover:text-[#2D6A4F] hover:bg-gray-50 transition-colors inline-flex items-center gap-1 {{ request()->routeIs('peta.*') ? 'text-[#2D6A4F] font-black' : '' }}">
                            <span>Fasilitas & Peta</span>
                            <svg class="w-3 h-3 text-gray-400 group-hover/menu:text-[#2D6A4F] transition-transform group-hover/menu:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/></svg>
                        </a>
                        <div class="absolute left-0 top-full pt-1 hidden group-hover/menu:block z-50">
                            <div class="bg-white rounded-xl shadow-xl border border-gray-100 p-2 min-w-[200px] space-y-1">
                                <a href="{{ route('landing') }}#fasilitas" class="block px-3 py-2 rounded-lg text-xs font-semibold text-gray-700 hover:bg-emerald-50 hover:text-[#1B4332]">Direktori Fasilitas Publik</a>
                                <a href="{{ route('peta.index') }}" class="block px-3 py-2 rounded-lg text-xs font-semibold text-gray-700 hover:bg-emerald-50 hover:text-[#1B4332]">Peta Spasial Digital</a>
                            </div>
                        </div>
                    </div>

                    <a href="{{ route('layanan.index') }}" class="px-3 py-2 rounded-md hover:text-[#2D6A4F] hover:bg-gray-50 transition-colors {{ request()->routeIs('layanan.*') ? 'text-[#2D6A4F] font-black' : '' }}">
                        Layanan
                    </a>

                    <a href="{{ route('umkm.index') }}" class="px-3 py-2 rounded-md hover:text-[#2D6A4F] hover:bg-gray-50 transition-colors {{ request()->routeIs('umkm.*') ? 'text-[#2D6A4F] font-black' : '' }}">
                        UMKM
                    </a>

                    <a href="{{ route('berita.index') }}" class="px-3 py-2 rounded-md hover:text-[#2D6A4F] hover:bg-gray-50 transition-colors {{ request()->routeIs('berita.*') ? 'text-[#2D6A4F] font-black' : '' }}">
                        Kabar
                    </a>

                    <a href="{{ route('landing') }}#galeri" class="px-3 py-2 rounded-md hover:text-[#2D6A4F] hover:bg-gray-50 transition-colors">
                        Galeri
                    </a>

                    <a href="{{ route('landing') }}#kontak" class="px-3 py-2 rounded-md hover:text-[#2D6A4F] hover:bg-gray-50 transition-colors">
                        Kontak
                    </a>
                </nav>

                <!-- Search Button & Mobile Hamburger Toggle -->
                <div class="flex items-center gap-2 sm:gap-3">
                    <a href="{{ route('peta.index') }}" class="w-10 h-10 rounded-full border border-gray-200 text-[#1B4332] hover:bg-gray-50 flex items-center justify-center transition-colors shadow-xs" title="Pencarian Fasilitas & Peta">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </a>

                    <!-- Mobile Menu Hamburger Button -->
                    <button id="mobile-menu-btn" type="button" class="xl:hidden p-2.5 rounded-lg border border-gray-200 text-[#1B4332] hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-[#2D6A4F]" aria-label="Buka Menu Navigasi">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Drawer Navigation Menu (Touch-Friendly & Non-Conflicting) -->
        <div id="mobile-menu" class="hidden xl:hidden bg-white border-t border-gray-200 px-4 sm:px-6 py-5 shadow-2xl space-y-4">
            <div class="grid grid-cols-2 gap-2 text-xs font-bold uppercase text-[#1B4332]">
                <a href="{{ route('landing') }}" class="px-3.5 py-3 rounded-xl bg-gray-50 hover:bg-emerald-50 hover:text-[#1B4332] flex items-center gap-2 border border-gray-100">
                    <span class="w-2 h-2 rounded-full bg-[#2D6A4F]"></span>
                    <span>Beranda</span>
                </a>
                <a href="{{ route('landing') }}#profil" class="px-3.5 py-3 rounded-xl bg-gray-50 hover:bg-emerald-50 hover:text-[#1B4332] flex items-center gap-2 border border-gray-100">
                    <span class="w-2 h-2 rounded-full bg-[#2D6A4F]"></span>
                    <span>Profil</span>
                </a>
                <a href="{{ route('landing') }}#program" class="px-3.5 py-3 rounded-xl bg-gray-50 hover:bg-emerald-50 hover:text-[#1B4332] flex items-center gap-2 border border-gray-100">
                    <span class="w-2 h-2 rounded-full bg-[#2D6A4F]"></span>
                    <span>Program</span>
                </a>
                <a href="{{ route('landing') }}#timeline" class="px-3.5 py-3 rounded-xl bg-gray-50 hover:bg-emerald-50 hover:text-[#1B4332] flex items-center gap-2 border border-gray-100">
                    <span class="w-2 h-2 rounded-full bg-[#2D6A4F]"></span>
                    <span>Timeline</span>
                </a>
                <a href="{{ route('landing') }}#struktur" class="px-3.5 py-3 rounded-xl bg-gray-50 hover:bg-emerald-50 hover:text-[#1B4332] flex items-center gap-2 border border-gray-100">
                    <span class="w-2 h-2 rounded-full bg-[#2D6A4F]"></span>
                    <span>Kepengurusan</span>
                </a>
                <a href="{{ route('landing') }}#fasilitas" class="px-3.5 py-3 rounded-xl bg-gray-50 hover:bg-emerald-50 hover:text-[#1B4332] flex items-center gap-2 border border-gray-100">
                    <span class="w-2 h-2 rounded-full bg-[#2D6A4F]"></span>
                    <span>Fasilitas</span>
                </a>
                <a href="{{ route('layanan.index') }}" class="px-3.5 py-3 rounded-xl bg-gray-50 hover:bg-emerald-50 hover:text-[#1B4332] flex items-center gap-2 border border-gray-100">
                    <span class="w-2 h-2 rounded-full bg-[#2D6A4F]"></span>
                    <span>Layanan</span>
                </a>
                <a href="{{ route('peta.index') }}" class="px-3.5 py-3 rounded-xl bg-gray-50 hover:bg-emerald-50 hover:text-[#1B4332] flex items-center gap-2 border border-gray-100">
                    <span class="w-2 h-2 rounded-full bg-[#2D6A4F]"></span>
                    <span>Peta Spasial</span>
                </a>
                <a href="{{ route('umkm.index') }}" class="px-3.5 py-3 rounded-xl bg-gray-50 hover:bg-emerald-50 hover:text-[#1B4332] flex items-center gap-2 border border-gray-100">
                    <span class="w-2 h-2 rounded-full bg-[#2D6A4F]"></span>
                    <span>UMKM</span>
                </a>
                <a href="{{ route('berita.index') }}" class="px-3.5 py-3 rounded-xl bg-gray-50 hover:bg-emerald-50 hover:text-[#1B4332] flex items-center gap-2 border border-gray-100">
                    <span class="w-2 h-2 rounded-full bg-[#2D6A4F]"></span>
                    <span>Kabar</span>
                </a>
                <a href="{{ route('landing') }}#galeri" class="px-3.5 py-3 rounded-xl bg-gray-50 hover:bg-emerald-50 hover:text-[#1B4332] flex items-center gap-2 border border-gray-100">
                    <span class="w-2 h-2 rounded-full bg-[#2D6A4F]"></span>
                    <span>Galeri</span>
                </a>
                <a href="{{ route('landing') }}#kontak" class="px-3.5 py-3 rounded-xl bg-gray-50 hover:bg-emerald-50 hover:text-[#1B4332] flex items-center gap-2 border border-gray-100">
                    <span class="w-2 h-2 rounded-full bg-[#2D6A4F]"></span>
                    <span>Kontak</span>
                </a>
            </div>
            <div class="pt-2 border-t border-gray-100 flex flex-col gap-2.5">
                <a href="{{ route('pengaduan.index') }}" class="w-full py-3 bg-[#FFB703] hover:bg-[#e5a502] text-[#1B4332] text-center font-bold text-xs uppercase tracking-wider rounded-xl shadow-sm transition-colors">
                    Layanan Pengaduan Warga
                </a>
                <a href="/admin" class="w-full py-2.5 border border-gray-300 text-gray-700 text-center font-semibold text-xs rounded-xl hover:bg-gray-50 transition-colors">
                    Masuk Panel Petugas
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
        <div class="max-w-7xl mx-auto px-4 sm:px-6">
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
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M9 8H6v4h3v12h5V12h3.642L18 8h-4V6.333C14 5.374 14.5 5 15.5 5H18V0h-3.808C10.597 0 9 1.582 9 4.615V8z"/></svg>
                        </a>
                        <a href="https://instagram.com/kelurahansukawarna" target="_blank" class="w-8 h-8 rounded-full bg-white/10 hover:bg-[#FFB703] hover:text-[#1B4332] flex items-center justify-center transition-colors">
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                        </a>
                        <a href="https://youtube.com/@kelurahansukawarna" target="_blank" class="w-8 h-8 rounded-full bg-white/10 hover:bg-[#FFB703] hover:text-[#1B4332] flex items-center justify-center transition-colors">
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                        </a>
                    </div>
                </div>

                <!-- Col 2: Quick Links -->
                <div class="space-y-3">
                    <h5 class="font-display font-bold text-sm text-[#FFB703] uppercase tracking-wider">Tautan Utama</h5>
                    <ul class="space-y-2 text-white/80">
                        <li><a href="{{ route('landing') }}" class="hover:text-white transition-colors">Beranda Utama</a></li>
                        <li><a href="{{ route('landing') }}#profil" class="hover:text-white transition-colors">Profil Wilayah & Sejarah</a></li>
                        <li><a href="{{ route('landing') }}#program" class="hover:text-white transition-colors">Program Prioritas Warga</a></li>
                        <li><a href="{{ route('landing') }}#struktur" class="hover:text-white transition-colors">Struktur Organisasi Kelurahan</a></li>
                        <li><a href="{{ route('landing') }}#timeline" class="hover:text-white transition-colors">Timeline Musrenbang & Pengadaan</a></li>
                        <li><a href="{{ route('landing') }}#galeri" class="hover:text-white transition-colors">Galeri Dokumentasi Wilayah</a></li>
                    </ul>
                </div>

                <!-- Col 3: Public Services -->
                <div class="space-y-3">
                    <h5 class="font-display font-bold text-sm text-[#FFB703] uppercase tracking-wider">Layanan Warga</h5>
                    <ul class="space-y-2 text-white/80">
                        <li><a href="{{ route('layanan.index') }}" class="hover:text-white transition-colors">Permohonan Surat Keterangan</a></li>
                        <li><a href="{{ route('peta.index') }}" class="hover:text-white transition-colors">Peta Fasilitas Spasial Interaktif</a></li>
                        <li><a href="{{ route('pengaduan.index') }}" class="hover:text-white transition-colors">Layanan Pengaduan & Aspirasi</a></li>
                        <li><a href="{{ route('pengaduan.cek') }}" class="hover:text-white transition-colors">Cek Status Tiket Pengaduan</a></li>
                        <li><a href="{{ route('umkm.index') }}" class="hover:text-white transition-colors">Direktori UMKM & Ekonomi Kreatif</a></li>
                        <li><a href="{{ route('berita.index') }}" class="hover:text-white transition-colors">Warta & Kabar Terkini Sukawarna</a></li>
                    </ul>
                </div>

                <!-- Col 4: Contact & Office -->
                <div class="space-y-3">
                    <h5 class="font-display font-bold text-sm text-[#FFB703] uppercase tracking-wider">Kontak Pelayanan</h5>
                    <div class="space-y-2.5 text-white/80">
                        <p class="flex items-start gap-2">
                            <svg class="w-4 h-4 text-[#FFB703] flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            <span>Jl. Sukawarna No. 12, Kec. Sukasari, Kota Bandung, Jawa Barat 40164</span>
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
