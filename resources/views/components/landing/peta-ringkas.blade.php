@props(['data'])

@php
    $wilayah = $data['wilayah'] ?? null;
    $kategoriList = $data['kategori_fasilitas'] ?? collect();
@endphp

<section id="peta" class="py-16 md:py-24 bg-white">
    <div class="max-w-7xl mx-auto px-6 space-y-8">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
            <div class="space-y-3">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-[#52B788]/20 text-[#1B4332] text-xs font-bold uppercase tracking-wider">
                    Sistem Pemetaan Spasial
                </div>
                <h2 class="font-display font-bold text-3xl sm:text-4xl text-[#1B4332]">
                    Peta Fasilitas & Batas Wilayah
                </h2>
                <p class="text-sm text-[#1F2D26]/75 max-w-xl">
                    Jelajahi sebaran titik fasilitas publik, kesehatan, pendidikan, dan pusat ekonomi di Kelurahan Sukawarna.
                </p>
            </div>

            <a href="{{ route('peta.index') }}" class="btn-organic inline-flex items-center gap-2 px-6 py-3 bg-[#FFB703] text-[#1B4332] font-bold text-sm shadow-sm hover:scale-[1.02] transition-transform self-start md:self-auto">
                <span>Buka Peta Lengkap</span>
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <line x1="7" y1="17" x2="17" y2="7"></line>
                    <polyline points="7 7 17 7 17 17"></polyline>
                </svg>
            </a>
        </div>

        <!-- Interactive Map Container -->
        <div class="relative rounded-[36px] overflow-hidden border-2 border-[#52B788]/30 shadow-soft bg-gray-50 h-[480px]">
            <div id="landing-map" 
                 class="w-full h-full z-10" 
                 data-lat="{{ $wilayah?->lat ?? -6.8872 }}" 
                 data-lng="{{ $wilayah?->lng ?? 107.5765 }}">
            </div>
            
            <!-- Quick Legend overlay -->
            <div class="absolute bottom-5 left-5 z-20 bg-white/90 backdrop-blur-md rounded-2xl p-3 shadow-md border border-[#52B788]/20 text-[11px] space-y-1">
                <div class="font-bold text-[#1B4332] mb-1">Keterangan Batas:</div>
                <div class="flex items-center gap-2">
                    <span class="w-3.5 h-3.5 rounded bg-[#52B788]/30 border-2 border-[#2D6A4F]"></span>
                    <span>Wilayah Kelurahan</span>
                </div>
            </div>
        </div>
    </div>
</section>
