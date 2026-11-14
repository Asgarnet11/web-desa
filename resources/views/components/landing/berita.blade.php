@props(['data'])

@php
    $beritaList = $data['berita'] ?? collect();
    $beritaUtama = $beritaList->first();
    $beritaLain = $beritaList->slice(1, 2);
    $agendaList = $data['agenda'] ?? collect();
@endphp

<section id="berita" class="py-16 md:py-24 bg-[#FFF8E7]">
    <div class="max-w-7xl mx-auto px-6 space-y-12">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
            <div class="space-y-3">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-[#52B788]/20 text-[#1B4332] text-xs font-bold uppercase tracking-wider">
                    Kabar Kelurahan & Agenda
                </div>
                <h2 class="font-display font-bold text-3xl sm:text-4xl text-[#1B4332]">
                    Berita Terkini & Agenda Kegiatan Warga
                </h2>
            </div>

            <a href="{{ route('berita.index') }}" class="inline-flex items-center gap-1.5 px-5 py-2.5 rounded-full border-2 border-[#2D6A4F] text-[#2D6A4F] font-bold text-xs hover:bg-[#2D6A4F]/10 transition-colors self-start md:self-auto">
                <span>Arsip Berita Lengkap</span>
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                    <polyline points="12 5 19 12 12 19"></polyline>
                </svg>
            </a>
        </div>

        <!-- 3 Asymmetrical Columns -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            <!-- 1. Berita Utama (Featured Large Card) -->
            @if($beritaUtama)
                <div class="lg:col-span-5 bg-white rounded-[32px] overflow-hidden border border-[#52B788]/20 shadow-soft shadow-hover flex flex-col justify-between">
                    <div>
                        <div class="aspect-[16/10] overflow-hidden bg-gray-100">
                            <img src="{{ $beritaUtama->foto ?? 'https://images.unsplash.com/photo-1466692476868-aef1dfb1e735?auto=format&fit=crop&w=800&q=80' }}" 
                                 alt="{{ $beritaUtama->judul }}" 
                                 class="w-full h-full object-cover">
                        </div>
                        <div class="p-7 space-y-3">
                            <div class="flex items-center gap-2">
                                <span class="px-2.5 py-0.5 rounded-full bg-[#52B788]/20 text-[#1B4332] text-[10px] font-bold">
                                    {{ $beritaUtama->kategori }}
                                </span>
                                <span class="text-xs text-gray-500">
                                    {{ $beritaUtama->published_at?->translatedFormat('d F Y') }}
                                </span>
                            </div>
                            <h3 class="font-display font-bold text-xl text-[#1B4332] leading-snug">
                                <a href="{{ route('berita.show', $beritaUtama->slug) }}" class="hover:text-[#52B788] transition-colors">
                                    {{ $beritaUtama->judul }}
                                </a>
                            </h3>
                            <p class="text-xs text-[#1F2D26]/75 line-clamp-3 leading-relaxed">
                                {{ $beritaUtama->ringkasan }}
                            </p>
                        </div>
                    </div>
                    <div class="p-7 pt-0">
                        <a href="{{ route('berita.show', $beritaUtama->slug) }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-[#2D6A4F] hover:text-[#1B4332]">
                            <span>Baca Selengkapnya</span>
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                <polyline points="9 18 15 12 9 6"></polyline>
                            </svg>
                        </a>
                    </div>
                </div>
            @endif

            <!-- 2. Berita Sekunder (Middle Stack) -->
            <div class="lg:col-span-4 space-y-6">
                @foreach($beritaLain as $b)
                    <div class="bg-white rounded-[28px] p-5 border border-[#52B788]/20 shadow-soft shadow-hover space-y-3">
                        <div class="flex items-center gap-2">
                            <span class="px-2 py-0.5 rounded-full bg-[#219EBC]/15 text-[#17708A] text-[10px] font-bold">
                                {{ $b->kategori }}
                            </span>
                            <span class="text-[11px] text-gray-500">
                                {{ $b->published_at?->translatedFormat('d M Y') }}
                            </span>
                        </div>
                        <h4 class="font-display font-bold text-base text-[#1B4332] leading-snug">
                            <a href="{{ route('berita.show', $b->slug) }}" class="hover:text-[#52B788] transition-colors">
                                {{ $b->judul }}
                            </a>
                        </h4>
                        <p class="text-xs text-[#1F2D26]/70 line-clamp-2 leading-relaxed">
                            {{ $b->ringkasan }}
                        </p>
                    </div>
                @endforeach
            </div>

            <!-- 3. Agenda Mendatang (Right Column List) -->
            <div class="lg:col-span-3 bg-white rounded-[32px] p-6 border border-[#52B788]/20 shadow-soft space-y-5">
                <div class="flex items-center justify-between pb-3 border-b border-gray-100">
                    <h3 class="font-display font-bold text-base text-[#1B4332]">Agenda Warga</h3>
                    <span class="w-2.5 h-2.5 rounded-full bg-[#FFB703]"></span>
                </div>

                <div class="space-y-4">
                    @forelse($agendaList as $agenda)
                        <div class="flex items-start gap-3.5 p-3 rounded-2xl bg-[#FFF8E7]/60 border border-[#52B788]/15">
                            <div class="w-12 h-12 rounded-2xl bg-[#1B4332] text-[#FFF8E7] flex-shrink-0 flex flex-col items-center justify-center text-center">
                                <span class="text-xs font-bold uppercase leading-none">{{ $agenda->tanggal_mulai->format('M') }}</span>
                                <span class="font-display font-bold text-sm leading-none mt-0.5">{{ $agenda->tanggal_mulai->format('d') }}</span>
                            </div>
                            <div class="space-y-1">
                                <h5 class="font-display font-bold text-xs text-[#1B4332] leading-tight">
                                    {{ $agenda->judul }}
                                </h5>
                                <p class="text-[11px] text-[#17708A]">{{ $agenda->lokasi }}</p>
                            </div>
                        </div>
                    @empty
                        <p class="text-xs text-gray-400">Belum ada agenda terdekat.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</section>
