@props(['data'])

@php
    $wilayah = $data['wilayah'] ?? null;
    $kategoriList = $data['kategori_fasilitas'] ?? collect();
    $fasilitasCount = $data['fasilitas']?->count() ?? 0;
@endphp

<section id="peta" class="py-20 lg:py-28 bg-[#F4F6F4]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 space-y-6">
        <!-- Section Title Header -->
        <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4">
            <div>
                <span class="text-xs font-bold tracking-[0.2em] text-[#FFB703] uppercase block mb-1">
                    SISTEM PEMETAAN SPASIAL
                </span>
                <h2 class="font-serif font-black text-3xl sm:text-4xl text-[#1B4332] tracking-tight">
                    Peta Fasilitas & Batas Wilayah
                </h2>
                <p class="text-xs sm:text-sm text-gray-600 max-w-xl mt-1 leading-relaxed">
                    Jelajahi sebaran titik fasilitas publik, kesehatan, pendidikan, tempat ibadah, dan sarana umum di Kelurahan Konda.
                </p>
            </div>

            <a href="{{ route('peta.index') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-[#1B4332] hover:bg-[#2D6A4F] text-[#FFB703] text-xs font-bold uppercase tracking-wider transition-colors self-start sm:self-auto shadow-md">
                <span>BUKA PETA INTERAKTIF LENGKAP</span>
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                </svg>
            </a>
        </div>

        <!-- Quick Filter Pills on Landing Page -->
        <div class="flex items-center gap-1.5 overflow-x-auto pb-1 scrollbar-none text-xs">
            <button type="button" 
                    data-landing-category="all" 
                    class="landing-cat-btn px-4 py-1.5 rounded-full font-bold whitespace-nowrap transition-all bg-[#0284C7] text-white shadow-xs">
                Semua Kategori
            </button>
            @foreach($kategoriList as $kat)
                <button type="button" 
                        data-landing-category="{{ $kat->id }}" 
                        class="landing-cat-btn px-3.5 py-1.5 rounded-full font-semibold whitespace-nowrap transition-all bg-white hover:bg-gray-50 text-gray-700 border border-gray-200 flex items-center gap-1.5">
                    <span class="w-2 h-2 rounded-full" style="background-color: {{ $kat->warna }};"></span>
                    <span>{{ $kat->nama }}</span>
                </button>
            @endforeach
        </div>

        <!-- Interactive Map Container -->
        <div class="relative rounded-3xl overflow-hidden border border-gray-200/90 shadow-xl bg-gray-100 h-[520px]">
            <!-- Leaflet Map Div -->
            <div id="landing-map" 
                 class="w-full h-full z-10" 
                 data-lat="{{ $wilayah?->lat ?? -4.124444 }}" 
                 data-lng="{{ $wilayah?->lng ?? 122.440278 }}">
            </div>
            
            <!-- Floating Basemap & Re-center Tools (Top Right) -->
            <div class="absolute top-4 right-4 z-20 flex items-center gap-1.5 bg-white/95 backdrop-blur-md p-1.5 rounded-2xl border border-gray-200/90 shadow-md">
                <button type="button" 
                        id="landing-basemap-streets" 
                        class="px-3 py-1 rounded-xl text-xs font-bold bg-[#0284C7] text-white transition-colors"
                        title="Peta Jalan">
                    Jalan
                </button>
                <button type="button" 
                        id="landing-basemap-satellite" 
                        class="px-3 py-1 rounded-xl text-xs font-bold text-gray-600 hover:bg-gray-100 transition-colors"
                        title="Citra Satelit">
                    Satelit
                </button>
                <div class="w-px h-4 bg-gray-200"></div>
                <button type="button" 
                        id="landing-fit-bounds-btn" 
                        class="p-1.5 rounded-xl text-gray-600 hover:bg-gray-100 transition-colors"
                        title="Fokuskan Ulang Wilayah">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"/></svg>
                </button>
            </div>

            <!-- Quick Legend overlay (Bottom Left) -->
            <div class="absolute bottom-5 left-5 z-20 bg-white/95 backdrop-blur-md rounded-2xl p-3.5 shadow-lg border border-gray-200 text-xs space-y-1.5 max-w-xs">
                <div class="font-bold text-[#1B4332] flex items-center justify-between gap-4">
                    <span>Keterangan Spasial</span>
                    <a href="{{ route('peta.index') }}" class="text-[10px] text-[#0284C7] hover:underline">Detail &rarr;</a>
                </div>
                <div class="flex items-center gap-2 text-gray-600 text-[11px]">
                    <span class="w-3.5 h-1 border-t-2 border-dashed border-[#1B4332]"></span>
                    <span>Batas Administrasi Kelurahan Konda</span>
                </div>
                <div class="flex items-center gap-2 text-gray-600 text-[11px]">
                    <span class="w-2.5 h-2.5 rounded-full bg-[#0284C7]"></span>
                    <span>Titik Lokasi Fasilitas Publik</span>
                </div>
            </div>
        </div>
    </div>
</section>
