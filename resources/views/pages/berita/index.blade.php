<x-layouts.app :title="'Kabar & Berita - Kelurahan Sukawarna'">
    <div class="max-w-7xl mx-auto px-6 py-10 space-y-8">
        <div>
            <span class="text-xs font-bold text-[#17708A] uppercase tracking-wider">Kabar Kelurahan</span>
            <h1 class="font-display font-bold text-3xl sm:text-4xl text-[#1B4332] mt-1">
                Berita & Publikasi Kegiatan
            </h1>
            <p class="text-xs sm:text-sm text-[#1F2D26]/75 mt-1">
                Daftar informasi terkini seputar pembangunan dan kegiatan masyarakat Sukawarna.
            </p>
        </div>

        <!-- Filter Kategori -->
        <div class="flex items-center gap-2 overflow-x-auto pb-2">
            <a href="{{ route('berita.index') }}" class="px-4 py-2 rounded-full text-xs font-bold {{ !request('kategori') ? 'bg-[#2D6A4F] text-white' : 'bg-white text-[#1B4332] border border-[#52B788]/30' }}">
                Semua Kategori
            </a>
            @foreach($kategoriList as $kategori)
                <a href="{{ route('berita.index', ['kategori' => $kategori]) }}" class="px-4 py-2 rounded-full text-xs font-bold {{ request('kategori') === $kategori ? 'bg-[#2D6A4F] text-white' : 'bg-white text-[#1B4332] border border-[#52B788]/30' }}">
                    {{ $kategori }}
                </a>
            @endforeach
        </div>

        <!-- Grid Berita -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @forelse($beritaList as $b)
                <div class="bg-white rounded-[28px] overflow-hidden border border-[#52B788]/20 shadow-soft shadow-hover flex flex-col justify-between">
                    <div>
                        <div class="aspect-[16/10] overflow-hidden bg-gray-100">
                            <img src="{{ $b->foto ?? 'https://images.unsplash.com/photo-1466692476868-aef1dfb1e735?auto=format&fit=crop&w=800&q=80' }}" alt="{{ $b->judul }}" class="w-full h-full object-cover">
                        </div>
                        <div class="p-6 space-y-2.5">
                            <div class="flex items-center gap-2 text-xs">
                                <span class="px-2.5 py-0.5 rounded-full bg-[#52B788]/20 text-[#1B4332] font-bold text-[10px]">{{ $b->kategori }}</span>
                                <span class="text-gray-400">{{ $b->published_at?->translatedFormat('d M Y') }}</span>
                            </div>
                            <h3 class="font-display font-bold text-lg text-[#1B4332] leading-snug">
                                <a href="{{ route('berita.show', $b->slug) }}" class="hover:text-[#52B788] transition-colors">
                                    {{ $b->judul }}
                                </a>
                            </h3>
                            <p class="text-xs text-[#1F2D26]/75 line-clamp-3 leading-relaxed">
                                {{ $b->ringkasan }}
                            </p>
                        </div>
                    </div>
                    <div class="p-6 pt-0">
                        <a href="{{ route('berita.show', $b->slug) }}" class="text-xs font-bold text-[#2D6A4F] hover:text-[#1B4332]">
                            Baca Selengkapnya &rarr;
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-3 text-center py-16 text-gray-500">
                    Belum ada berita pada kategori ini.
                </div>
            @endforelse
        </div>

        <div class="pt-6">
            {{ $beritaList->links() }}
        </div>
    </div>
</x-layouts.app>
