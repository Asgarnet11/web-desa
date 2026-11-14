@props(['data'])

@php
    $umkmList = $data['umkm'] ?? collect();
@endphp

<section id="umkm" class="py-16 md:py-24 bg-white">
    <div class="max-w-7xl mx-auto px-6 space-y-12">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
            <div class="space-y-3">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-[#FFB703]/25 text-[#1B4332] text-xs font-bold uppercase tracking-wider">
                    Pemberdayaan Ekonomi
                </div>
                <h2 class="font-display font-bold text-3xl sm:text-4xl text-[#1B4332]">
                    Sentra UMKM & Potensi Lokal
                </h2>
                <p class="text-sm text-[#1F2D26]/75 max-w-xl">
                    Dukung produk unggulan hasil karya warga Sukawarna mulai dari kuliner organik, kerajinan tangan ramah lingkungan, hingga pertanian perkotaan.
                </p>
            </div>

            <a href="{{ route('umkm.index') }}" class="inline-flex items-center gap-1.5 px-5 py-2.5 rounded-full border-2 border-[#2D6A4F] text-[#2D6A4F] font-bold text-xs hover:bg-[#2D6A4F]/10 transition-colors self-start md:self-auto">
                <span>Katalog Semua Produk</span>
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                    <polyline points="12 5 19 12 12 19"></polyline>
                </svg>
            </a>
        </div>

        <!-- UMKM Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($umkmList as $u)
                <div class="bg-white rounded-[32px] overflow-hidden border border-[#52B788]/20 shadow-soft shadow-hover flex flex-col justify-between">
                    <div>
                        <!-- Photo -->
                        <div class="aspect-[16/10] overflow-hidden bg-gray-100 relative">
                            <img src="{{ $u->foto ?? 'https://images.unsplash.com/photo-1501339847302-ac426a4a7cbb?auto=format&fit=crop&w=600&q=80' }}" 
                                 alt="{{ $u->nama_usaha }}" 
                                 class="w-full h-full object-cover">
                            <span class="absolute top-4 left-4 px-3 py-1 rounded-full bg-white/90 backdrop-blur-sm text-[#1B4332] text-xs font-bold shadow-sm">
                                {{ $u->kategori }}
                            </span>
                        </div>

                        <!-- Content -->
                        <div class="p-6 space-y-2">
                            <h3 class="font-display font-bold text-lg text-[#1B4332]">{{ $u->nama_usaha }}</h3>
                            <p class="text-xs text-[#17708A] font-semibold">Pemilik: {{ $u->nama_pemilik ?? 'Warga Sukawarna' }}</p>
                            <p class="text-xs text-[#1F2D26]/80 line-clamp-3 leading-relaxed">
                                {{ $u->deskripsi }}
                            </p>
                        </div>
                    </div>

                    <!-- Footer / WA Action -->
                    <div class="p-6 pt-0">
                        @if($u->kontak_wa)
                            <a href="https://wa.me/62{{ ltrim($u->kontak_wa, '0') }}" 
                               target="_blank" 
                               rel="noopener noreferrer"
                               class="w-full inline-flex items-center justify-center gap-2 py-3 rounded-full bg-[#2D6A4F] text-[#FFF8E7] text-xs font-bold hover:bg-[#1B4332] transition-colors shadow-sm">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                                </svg>
                                <span>Hubungi Usaha via WhatsApp</span>
                            </a>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

