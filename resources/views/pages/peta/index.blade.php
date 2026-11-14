<x-layouts.app :title="'Peta Fasilitas & Batas Wilayah - Kelurahan Sukawarna'">
    <div class="max-w-7xl mx-auto px-6 py-6 space-y-6">
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <span class="text-xs font-bold text-[#17708A] uppercase tracking-wider">Sistem Informasi Geografis</span>
                <h1 class="font-display font-bold text-3xl sm:text-4xl text-[#1B4332] mt-1">
                    Peta Fasilitas & Batas Wilayah
                </h1>
                <p class="text-xs sm:text-sm text-[#1F2D26]/75 mt-1">
                    Klik marker untuk melihat detail fasilitas atau gunakan tombol filter di bawah untuk memilih kategori.
                </p>
            </div>

            <div class="flex items-center gap-2">
                <a href="{{ route('landing') }}" class="px-4 py-2 rounded-full border border-[#2D6A4F] text-[#2D6A4F] text-xs font-bold hover:bg-[#2D6A4F]/10">
                    &larr; Kembali ke Beranda
                </a>
            </div>
        </div>

        <!-- Category Filter Pills -->
        <div class="flex items-center gap-2 overflow-x-auto pb-2 scrollbar-none">
            <button data-category-filter="all" class="px-4 py-2 rounded-full text-xs font-bold bg-[#2D6A4F] text-white transition-all shadow-sm flex-shrink-0">
                Semua Fasilitas
            </button>
            @foreach($kategoriList as $kat)
                <button data-category-filter="{{ $kat->id }}" class="px-4 py-2 rounded-full text-xs font-bold bg-white text-[#1B4332] border border-[#52B788]/30 hover:bg-[#52B788]/15 transition-all shadow-sm flex-shrink-0 flex items-center gap-1.5">
                    <span class="w-2.5 h-2.5 rounded-full" style="background-color: {{ $kat->warna }};"></span>
                    <span>{{ $kat->nama }} ({{ $kat->fasilitas_count }})</span>
                </button>
            @endforeach
        </div>

        <!-- Full Map Canvas -->
        <div class="relative w-full h-[650px] rounded-[36px] overflow-hidden border-2 border-[#52B788]/30 shadow-soft bg-gray-100">
            <div id="map" 
                 class="w-full h-full z-10" 
                 data-lat="{{ $wilayah?->lat ?? -6.8872 }}" 
                 data-lng="{{ $wilayah?->lng ?? 107.5765 }}">
            </div>
        </div>
    </div>

    @push('scripts')
        @vite('resources/js/peta.js')
    @endpush
</x-layouts.app>
