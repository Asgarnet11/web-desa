<x-layouts.app :title="'Direktori UMKM & Potensi - Kelurahan Sukawarna'">
    <div class="max-w-7xl mx-auto px-6 py-10 space-y-8">
        <div>
            <span class="text-xs font-bold text-[#FFB703] uppercase tracking-wider">Pemberdayaan Warga</span>
            <h1 class="font-display font-bold text-3xl sm:text-4xl text-[#1B4332] mt-1">
                Direktori UMKM & Produk Unggulan
            </h1>
            <p class="text-xs sm:text-sm text-[#1F2D26]/75 mt-1">
                Temukan dan dukung produk usaha mikro, kecil, dan menengah binaan warga Sukawarna.
            </p>
        </div>

        <!-- Search & Filter Bar -->
        <div class="bg-white rounded-[28px] p-5 border border-[#52B788]/20 shadow-soft flex flex-col sm:flex-row gap-4 justify-between items-center">
            <form action="{{ route('umkm.index') }}" method="GET" class="w-full sm:w-80">
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari usaha atau produk..." 
                       class="w-full px-4 py-2.5 rounded-full border border-[#52B788]/40 text-xs focus:ring-2 focus:ring-[#52B788] outline-none">
            </form>

            <div class="flex items-center gap-2 overflow-x-auto w-full sm:w-auto pb-1">
                <a href="{{ route('umkm.index') }}" class="px-3.5 py-1.5 rounded-full text-xs font-bold {{ !request('kategori') ? 'bg-[#2D6A4F] text-white' : 'bg-gray-100 text-gray-700' }}">
                    Semua
                </a>
                @foreach($kategoriList as $kategori)
                    <a href="{{ route('umkm.index', ['kategori' => $kategori]) }}" class="px-3.5 py-1.5 rounded-full text-xs font-bold {{ request('kategori') === $kategori ? 'bg-[#2D6A4F] text-white' : 'bg-gray-100 text-gray-700' }}">
                        {{ $kategori }}
                    </a>
                @endforeach
            </div>
        </div>

        <!-- Grid UMKM -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @forelse($umkmList as $u)
                <div class="bg-white rounded-[28px] overflow-hidden border border-[#52B788]/20 shadow-soft shadow-hover flex flex-col justify-between">
                    <div>
                        <div class="aspect-[16/10] overflow-hidden bg-gray-100 relative">
                            <img src="{{ $u->foto ?? 'https://images.unsplash.com/photo-1501339847302-ac426a4a7cbb?auto=format&fit=crop&w=600&q=80' }}" alt="{{ $u->nama_usaha }}" class="w-full h-full object-cover">
                            <span class="absolute top-3 left-3 px-2.5 py-0.5 rounded-full bg-white/90 text-xs font-bold text-[#1B4332]">
                                {{ $u->kategori }}
                            </span>
                        </div>
                        <div class="p-6 space-y-2">
                            <h3 class="font-display font-bold text-lg text-[#1B4332]">{{ $u->nama_usaha }}</h3>
                            <p class="text-xs text-[#17708A] font-medium">Pemilik: {{ $u->nama_pemilik ?? 'Warga Sukawarna' }}</p>
                            <p class="text-xs text-[#1F2D26]/75 line-clamp-3">{{ $u->deskripsi }}</p>
                            @if($u->alamat)
                                <p class="text-[11px] text-gray-400 pt-1">{{ $u->alamat }}</p>
                            @endif
                        </div>
                    </div>
                    <div class="p-6 pt-0">
                        @if($u->kontak_wa)
                            <a href="https://wa.me/62{{ ltrim($u->kontak_wa, '0') }}" target="_blank" 
                               class="w-full inline-flex items-center justify-center gap-2 py-2.5 rounded-full bg-[#2D6A4F] text-white text-xs font-bold hover:bg-[#1B4332]">
                                <span>Hubungi WhatsApp</span>
                            </a>
                        @endif
                    </div>
                </div>
            @empty
                <div class="col-span-3 text-center py-16 text-gray-400">
                    Tidak ditemukan UMKM sesuai pencarian.
                </div>
            @endforelse
        </div>

        <div class="pt-6">
            {{ $umkmList->links() }}
        </div>
    </div>
</x-layouts.app>
