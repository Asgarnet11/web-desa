@props(['data'])

@php
    $profil = $data['profil'] ?? null;
    $statistik = $data['statistik'] ?? [];
    $demografi = $statistik['demografi'] ?? [];
    $fasilitas = $statistik['fasilitas'] ?? [];
    $wilayah = $data['wilayah'] ?? null;
@endphp

<section class="relative overflow-hidden pt-8 pb-16 md:pt-14 md:pb-24 bg-gradient-to-b from-[#8ECFEA]/30 via-[#CDEBF5]/20 to-transparent">
    <!-- Subtle solar radial glow -->
    <div class="absolute -top-24 right-10 w-96 h-96 bg-[#FFB703]/20 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute top-40 -left-20 w-80 h-80 bg-[#52B788]/20 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-6">
        <!-- Hero Grid: Asymmetrical -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            <!-- Left: Text -->
            <div class="lg:col-span-7 space-y-6">
                <!-- Badge -->
                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-[#219EBC]/15 text-[#17708A] text-xs font-bold uppercase tracking-wider">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <circle cx="12" cy="12" r="10"></circle>
                        <path d="m9 12 2 2 4-4"></path>
                    </svg>
                    <span>Portal Resmi Kelurahan Sukawarna</span>
                </div>

                <!-- Display Headline with highlighted rotated word -->
                <h1 class="font-display font-bold text-4xl sm:text-5xl lg:text-6xl text-[#1B4332] leading-[1.15]">
                    Harmoni Warga, Basis Data 
                    <span class="inline-block relative px-3 py-1 bg-[#FFB703] text-[#1B4332] rounded-[16px] -rotate-2 shadow-sm">
                        Terpadu
                    </span>
                    & Peta Digital
                </h1>

                <!-- Subtitle -->
                <p class="text-base sm:text-lg text-[#1F2D26]/85 max-w-2xl leading-relaxed">
                    {{ $profil?->slogan ?? 'Mewujudkan tata kelola kelurahan yang transparan, asri, dan melayani dengan pemetaan fasilitas dan statistik wilayah berbasis digital.' }}
                </p>

                <!-- Action Buttons -->
                <div class="flex flex-wrap items-center gap-4 pt-2">
                    <a href="{{ route('peta.index') }}" class="btn-organic inline-flex items-center gap-2 px-7 py-3.5 bg-[#FFB703] text-[#1B4332] font-bold text-base shadow-sm hover:scale-[1.02] active:scale-[0.99] transition-all">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <polygon points="1 6 1 22 8 18 16 22 23 18 23 2 16 6 8 2 1 6"></polygon>
                            <line x1="8" y1="2" x2="8" y2="18"></line>
                            <line x1="16" y1="6" x2="16" y2="22"></line>
                        </svg>
                        <span>Jelajahi Peta Wilayah</span>
                    </a>

                    <a href="{{ route('layanan.index') }}" class="inline-flex items-center gap-2 px-6 py-3.5 rounded-full border-2 border-[#2D6A4F] text-[#2D6A4F] font-bold text-base hover:bg-[#2D6A4F]/10 transition-colors">
                        <span>Layanan Administrasi</span>
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                            <polyline points="12 5 19 12 12 19"></polyline>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Right: Asymmetric Framed Photo with Nature Motifs -->
            <div class="lg:col-span-5 relative flex justify-center">
                <div class="relative p-3 rounded-[32px] bg-white/90 border-2 border-[#52B788] shadow-soft max-w-md w-full">
                    <div class="overflow-hidden rounded-[24px] aspect-[4/3] bg-gray-100">
                        <img src="{{ $profil?->foto_kantor ?? 'https://images.unsplash.com/photo-1577495508048-b635879837f1?auto=format&fit=crop&w=800&q=80' }}" 
                             alt="Kantor Kelurahan Sukawarna" 
                             class="w-full h-full object-cover">
                    </div>
                    <!-- Small decorative badge over frame -->
                    <div class="absolute -bottom-4 -left-4 bg-[#1B4332] text-[#FFF8E7] px-4 py-2.5 rounded-2xl shadow-md flex items-center gap-2 border border-[#52B788]/40">
                        <div class="w-3 h-3 rounded-full bg-[#52B788] animate-pulse"></div>
                        <span class="text-xs font-bold">Pelayanan Aktif Hari Ini</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Four Key Statistics Cards -->
        <div class="mt-14 pt-10 border-t border-[#2D6A4F]/15 grid grid-cols-2 md:grid-cols-4 gap-5">
            <!-- Stat 1 -->
            <div class="bg-white rounded-[24px] p-5 border border-[#52B788]/20 shadow-soft">
                <div class="text-xs font-semibold text-[#17708A] uppercase tracking-wider mb-1">Total Penduduk</div>
                <div class="font-display font-bold text-3xl sm:text-4xl text-[#1B4332] tabular-nums" data-count-target="{{ $demografi['total_penduduk'] ?? 12450 }}">
                    0
                </div>
                <div class="text-xs text-[#1F2D26]/70 mt-1">Jiwa terdata agregat</div>
            </div>

            <!-- Stat 2 -->
            <div class="bg-white rounded-[24px] p-5 border border-[#52B788]/20 shadow-soft">
                <div class="text-xs font-semibold text-[#17708A] uppercase tracking-wider mb-1">Kepala Keluarga</div>
                <div class="font-display font-bold text-3xl sm:text-4xl text-[#1B4332] tabular-nums" data-count-target="{{ $demografi['total_kk'] ?? 3820 }}">
                    0
                </div>
                <div class="text-xs text-[#1F2D26]/70 mt-1">KK tersebar di 3 RW</div>
            </div>

            <!-- Stat 3 -->
            <div class="bg-white rounded-[24px] p-5 border border-[#52B788]/20 shadow-soft">
                <div class="text-xs font-semibold text-[#17708A] uppercase tracking-wider mb-1">Fasilitas Umum</div>
                <div class="font-display font-bold text-3xl sm:text-4xl text-[#1B4332] tabular-nums" data-count-target="{{ $fasilitas['total'] ?? 24 }}">
                    0
                </div>
                <div class="text-xs text-[#1F2D26]/70 mt-1">Titik terpeta digital</div>
            </div>

            <!-- Stat 4 -->
            <div class="bg-white rounded-[24px] p-5 border border-[#52B788]/20 shadow-soft">
                <div class="text-xs font-semibold text-[#17708A] uppercase tracking-wider mb-1">Luas Wilayah</div>
                <div class="font-display font-bold text-3xl sm:text-4xl text-[#1B4332] tabular-nums">
                    {{ $wilayah?->luas ?? '1.48' }}
                </div>
                <div class="text-xs text-[#1F2D26]/70 mt-1">Kilometer persegi (km&sup2;)</div>
            </div>
        </div>
    </div>
</section>
