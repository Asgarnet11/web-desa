<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Sistem Informasi & Profil Kelurahan' }}</title>
    <meta name="description" content="{{ $description ?? 'Portal Pemetaan dan Pusat Informasi Publik Kelurahan Sukawarna, Kota Bandung' }}">
    
    <!-- Open Graph -->
    <meta property="og:title" content="{{ $title ?? 'Sistem Informasi & Profil Kelurahan' }}">
    <meta property="og:description" content="{{ $description ?? 'Portal Pemetaan dan Pusat Informasi Publik Kelurahan Sukawarna' }}">
    <meta property="og:type" content="website">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="bg-[#FFF8E7] text-[#1F2D26] font-sans antialiased min-h-[100dvh] flex flex-col selection:bg-[#FFB703] selection:text-[#1B4332]">

    <!-- Floating Capsule Navbar -->
    <header class="fixed top-4 inset-x-0 z-50 flex justify-center px-4 pointer-events-none">
        <nav class="pointer-events-auto w-full max-w-5xl bg-white/80 backdrop-blur-md rounded-full px-4 py-2.5 shadow-soft border border-[#52B788]/20 flex items-center justify-between transition-all">
            <!-- Brand Logo -->
            <a href="{{ route('landing') }}" class="flex items-center gap-2.5 pl-2 group">
                <div class="w-9 h-9 rounded-full bg-[#2D6A4F] flex items-center justify-center text-[#FFF8E7] shadow-sm group-hover:scale-105 transition-transform">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                    </svg>
                </div>
                <div class="flex flex-col">
                    <span class="font-display font-bold text-sm text-[#1B4332] leading-tight">Kelurahan Sukawarna</span>
                    <span class="text-[10px] text-[#17708A] font-medium tracking-wide">Kec. Sukasari &bull; Kota Bandung</span>
                </div>
            </a>

            <!-- Navigation Links (Desktop) -->
            <div class="hidden md:flex items-center gap-1 text-sm font-semibold text-[#1F2D26]">
                <a href="{{ route('landing') }}#profil" class="px-3.5 py-1.5 rounded-full hover:bg-[#52B788]/15 hover:text-[#1B4332] transition-colors">Profil</a>
                <a href="{{ route('landing') }}#statistik" class="px-3.5 py-1.5 rounded-full hover:bg-[#52B788]/15 hover:text-[#1B4332] transition-colors">Statistik</a>
                <a href="{{ route('peta.index') }}" class="px-3.5 py-1.5 rounded-full hover:bg-[#52B788]/15 hover:text-[#1B4332] transition-colors">Peta Digital</a>
                <a href="{{ route('layanan.index') }}" class="px-3.5 py-1.5 rounded-full hover:bg-[#52B788]/15 hover:text-[#1B4332] transition-colors">Layanan</a>
                <a href="{{ route('umkm.index') }}" class="px-3.5 py-1.5 rounded-full hover:bg-[#52B788]/15 hover:text-[#1B4332] transition-colors">UMKM</a>
                <a href="{{ route('berita.index') }}" class="px-3.5 py-1.5 rounded-full hover:bg-[#52B788]/15 hover:text-[#1B4332] transition-colors">Kabar</a>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center gap-2">
                <a href="{{ route('pengaduan.index') }}" class="hidden sm:inline-flex items-center gap-1.5 px-4 py-2 rounded-full bg-[#2D6A4F] text-[#FFF8E7] text-xs font-bold hover:bg-[#1B4332] transition-colors shadow-sm">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                    </svg>
                    <span>Pengaduan</span>
                </a>
                <a href="/admin" class="p-2 rounded-full hover:bg-black/5 text-[#1B4332] transition-colors" title="Panel Operator">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                        <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                    </svg>
                </a>
                
                <!-- Mobile Menu Button -->
                <button id="mobile-menu-btn" class="md:hidden p-2 rounded-full hover:bg-black/5 text-[#1B4332]" aria-label="Buka Menu">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="3" y1="12" x2="21" y2="12"></line>
                        <line x1="3" y1="6" x2="21" y2="6"></line>
                        <line x1="3" y1="18" x2="21" y2="18"></line>
                    </svg>
                </button>
            </div>
        </nav>
    </header>

    <!-- Mobile Drawer Navigation -->
    <div id="mobile-menu" class="hidden md:hidden fixed inset-x-0 top-20 z-40 px-4">
        <div class="bg-white/95 backdrop-blur-lg rounded-[28px] p-5 shadow-xl border border-[#52B788]/30 flex flex-col gap-2">
            <a href="{{ route('landing') }}" class="px-4 py-2.5 rounded-xl font-semibold text-[#1F2D26] hover:bg-[#52B788]/20">Beranda</a>
            <a href="{{ route('landing') }}#profil" class="px-4 py-2.5 rounded-xl font-semibold text-[#1F2D26] hover:bg-[#52B788]/20">Profil & Sejarah</a>
            <a href="{{ route('peta.index') }}" class="px-4 py-2.5 rounded-xl font-semibold text-[#1F2D26] hover:bg-[#52B788]/20">Peta Fasilitas Wilayah</a>
            <a href="{{ route('layanan.index') }}" class="px-4 py-2.5 rounded-xl font-semibold text-[#1F2D26] hover:bg-[#52B788]/20">Layanan Administrasi</a>
            <a href="{{ route('umkm.index') }}" class="px-4 py-2.5 rounded-xl font-semibold text-[#1F2D26] hover:bg-[#52B788]/20">Direktori UMKM</a>
            <a href="{{ route('berita.index') }}" class="px-4 py-2.5 rounded-xl font-semibold text-[#1F2D26] hover:bg-[#52B788]/20">Berita & Informasi</a>
            <a href="{{ route('pengaduan.index') }}" class="mt-2 px-4 py-3 rounded-2xl bg-[#2D6A4F] text-[#FFF8E7] text-center font-bold">Layanan Pengaduan Warga</a>
        </div>
    </div>

    <!-- Main Content -->
    <main class="flex-1 pt-24">
        {{ $slot }}
    </main>

    <!-- Solarpunk Footer -->
    <footer class="bg-[#1B4332] text-[#FFF8E7] pt-16 pb-8 border-t border-[#2D6A4F]">
        <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-4 gap-10 pb-12 border-b border-white/10">
            <!-- Brand & Bio -->
            <div class="space-y-4 md:col-span-1">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-[#52B788] flex items-center justify-center text-[#1B4332] font-bold">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-display font-bold text-lg text-white">Sukawarna</h4>
                        <p class="text-xs text-[#8ECFEA]">Sistem Informasi Wilayah</p>
                    </div>
                </div>
                <p class="text-xs text-[#FFF8E7]/80 leading-relaxed">
                    Sistem pemetaan digital interaktif dan basis data terintegrasi untuk keterbukaan informasi dan pelayanan prima warga.
                </p>
            </div>

            <!-- Jam Pelayanan -->
            <div class="space-y-3">
                <h5 class="font-display font-bold text-sm text-[#FFB703]">Jam Pelayanan Kantor</h5>
                <ul class="text-xs space-y-1.5 text-[#FFF8E7]/80">
                    <li><strong class="text-white">Senin - Kamis:</strong> 08.00 - 15.30 WIB</li>
                    <li><strong class="text-white">Jumat:</strong> 08.00 - 14.30 WIB</li>
                    <li><strong class="text-white">Sabtu - Minggu:</strong> Libur</li>
                </ul>
            </div>

            <!-- Kontak Kantor -->
            <div class="space-y-3">
                <h5 class="font-display font-bold text-sm text-[#FFB703]">Kontak & Alamat</h5>
                <p class="text-xs text-[#FFF8E7]/80 leading-relaxed">
                    Jl. Sukawarna No. 12, Kec. Sukasari, Kota Bandung, Jawa Barat 40164
                </p>
                <div class="text-xs space-y-1 text-[#FFF8E7]/80">
                    <p>Telepon: (022) 2012345</p>
                    <p>WhatsApp: 0812-3456-7890</p>
                    <p>Email: kelurahan.sukawarna@bandung.go.id</p>
                </div>
            </div>

            <!-- Tautan Cepat -->
            <div class="space-y-3">
                <h5 class="font-display font-bold text-sm text-[#FFB703]">Tautan Publik</h5>
                <ul class="text-xs space-y-2">
                    <li><a href="{{ route('peta.index') }}" class="hover:text-[#FFB703] transition-colors">Peta Fasilitas Interaktif</a></li>
                    <li><a href="{{ route('layanan.index') }}" class="hover:text-[#FFB703] transition-colors">Persyaratan Layanan Surat</a></li>
                    <li><a href="{{ route('pengaduan.cek') }}" class="hover:text-[#FFB703] transition-colors">Lacak Status Pengaduan</a></li>
                    <li><a href="/admin" class="hover:text-[#FFB703] transition-colors">Panel Masuk Operator</a></li>
                </ul>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-6 pt-6 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs text-[#FFF8E7]/60">
            <p>&copy; {{ date('Y') }} Kelurahan Sukawarna. Mengusung konsep keterbukaan dan kelestarian Solarpunk.</p>
            <p>Didukung teknologi Laravel, Filament, dan OpenStreetMap.</p>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>

