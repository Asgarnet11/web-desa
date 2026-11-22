@props(['data'])

@php
    $wilayah = $data['wilayah'] ?? null;
    $kategoriList = $data['kategori_fasilitas'] ?? collect();
@endphp

<section id="peta" class="py-20 lg:py-28 bg-[#F4F6F4]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 space-y-8">
        <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4">
            <div>
                <span class="text-xs font-bold tracking-[0.2em] text-[#FFB703] uppercase block mb-1">
                    SISTEM PEMETAAN SPASIAL
                </span>
                <h2 class="font-serif font-black text-3xl sm:text-4xl text-[#1B4332] tracking-tight">
                    Peta Fasilitas & Batas Wilayah
                </h2>
                <p class="text-xs sm:text-sm text-gray-600 max-w-xl mt-1 leading-relaxed">
                    Jelajahi sebaran titik fasilitas publik, kesehatan, pendidikan, dan pusat ekonomi di Kelurahan Sukawarna.
                </p>
            </div>

            <a href="{{ route('peta.index') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded border border-gray-300 hover:border-[#1B4332] text-[#1B4332] hover:bg-gray-50 text-xs font-bold uppercase tracking-wider transition-colors self-start sm:self-auto shadow-sm">
                <span>BUKA PETA LENGKAP</span>
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                </svg>
            </a>
        </div>

        <!-- Interactive Map Container -->
        <div class="relative rounded-2xl overflow-hidden border border-gray-200 shadow-lg bg-gray-50 h-[480px]">
            <div id="landing-map" 
                 class="w-full h-full z-10" 
                 data-lat="{{ $wilayah?->lat ?? -6.8872 }}" 
                 data-lng="{{ $wilayah?->lng ?? 107.5765 }}">
            </div>
            
            <!-- Quick Legend overlay -->
            <div class="absolute bottom-5 left-5 z-20 bg-white/95 backdrop-blur-md rounded-xl p-3.5 shadow-md border border-gray-200 text-xs space-y-1.5">
                <div class="font-bold text-[#1B4332]">Keterangan Spasial:</div>
                <div class="flex items-center gap-2 text-gray-600">
                    <span class="w-3.5 h-3.5 rounded bg-[#2D6A4F]/30 border-2 border-[#1B4332]"></span>
                    <span>Batas Kelurahan Sukawarna</span>
                </div>
            </div>
        </div>
    </div>
</section>
