<x-layouts.app :title="'Kabar & Berita - Kelurahan Sukawarna'">
    <div class="max-w-7xl mx-auto px-6 py-10 space-y-8">
        <div>
            <span class="text-xs font-bold text-[#17708A] uppercase tracking-wider">Kabar Kelurahan</span>
            <h1 class="font-display font-bold text-3xl sm:text-4xl text-[#1B4332] mt-1">
                Warta, Pengumuman & Agenda Wilayah
            </h1>
            <p class="text-xs sm:text-sm text-[#1F2D26]/75 mt-1">
                Informasi resmi seputar pembangunan, surat edaran penting, dan kalender kegiatan masyarakat Sukawarna.
            </p>
        </div>

        <!-- Search Bar -->
        <div class="bg-white rounded-2xl p-4 border border-gray-200/80 shadow-xs">
            <form action="{{ route('berita.index') }}" method="GET" class="flex flex-col sm:flex-row gap-3 items-center justify-between">
                @if(request('kategori'))
                    <input type="hidden" name="kategori" value="{{ request('kategori') }}">
                @endif
                <div class="relative w-full sm:max-w-md">
                    <input type="text" 
                           name="q" 
                           value="{{ request('q') }}" 
                           placeholder="Cari berita, agenda kegiatan, atau pengumuman..." 
                           class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-gray-200 text-xs sm:text-sm focus:outline-none focus:ring-2 focus:ring-[#2D6A4F] focus:border-transparent">
                    <svg class="w-4 h-4 text-gray-400 absolute left-3.5 top-3.5 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
                <div class="flex items-center gap-2 w-full sm:w-auto">
                    <button type="submit" class="px-5 py-2.5 bg-[#1B4332] hover:bg-[#2D6A4F] text-[#FFB703] font-bold text-xs uppercase tracking-wider rounded-xl shadow-xs transition-colors flex-1 sm:flex-none text-center">
                        Cari Informasi
                    </button>
                    @if(request('q') || request('kategori'))
                        <a href="{{ route('berita.index') }}" class="px-4 py-2.5 border border-gray-200 text-gray-600 hover:text-gray-900 text-xs font-semibold rounded-xl hover:bg-gray-50 transition-colors">
                            Reset
                        </a>
                    @endif
                </div>
            </form>
        </div>

        <!-- Section Tabs: Berita vs Pengumuman vs Agenda -->
        <div class="flex items-center gap-2 border-b border-gray-200 pb-3">
            <button type="button" id="tab-berita-btn" onclick="switchWartaTab('berita')" class="warta-tab-btn px-4 py-2 rounded-xl text-xs font-bold transition-all bg-[#1B4332] text-[#FFB703] shadow-xs flex items-center gap-2">
                <span>📰 Berita Terkini</span>
                <span class="px-1.5 py-0.5 rounded-full bg-white/20 text-white text-[10px] font-mono">({{ $beritaList->total() }})</span>
            </button>
            <button type="button" id="tab-pengumuman-btn" onclick="switchWartaTab('pengumuman')" class="warta-tab-btn px-4 py-2 rounded-xl text-xs font-bold transition-all bg-gray-100 text-gray-700 hover:bg-gray-200 flex items-center gap-2">
                <span>📢 Pengumuman Resmi</span>
                <span class="px-1.5 py-0.5 rounded-full bg-gray-200 text-gray-700 text-[10px] font-mono">({{ $pengumumanList->count() }})</span>
            </button>
            <button type="button" id="tab-agenda-btn" onclick="switchWartaTab('agenda')" class="warta-tab-btn px-4 py-2 rounded-xl text-xs font-bold transition-all bg-gray-100 text-gray-700 hover:bg-gray-200 flex items-center gap-2">
                <span>📅 Agenda Kegiatan</span>
                <span class="px-1.5 py-0.5 rounded-full bg-gray-200 text-gray-700 text-[10px] font-mono">({{ $agendaList->count() }})</span>
            </button>
        </div>

        <!-- CONTENT 1: Berita Section -->
        <div id="warta-berita-content" class="space-y-8">
            <!-- Filter Kategori -->
            <div class="flex items-center gap-2 overflow-x-auto pb-1">
                <a href="{{ route('berita.index') }}" class="px-4 py-1.5 rounded-full text-xs font-bold {{ !request('kategori') ? 'bg-[#2D6A4F] text-white' : 'bg-white text-[#1B4332] border border-[#52B788]/30' }}">
                    Semua Kategori
                </a>
                @foreach($kategoriList as $kategori)
                    <a href="{{ route('berita.index', ['kategori' => $kategori]) }}" class="px-4 py-1.5 rounded-full text-xs font-bold {{ request('kategori') === $kategori ? 'bg-[#2D6A4F] text-white' : 'bg-white text-[#1B4332] border border-[#52B788]/30' }}">
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

        <!-- CONTENT 2: Pengumuman Section (Initially Hidden) -->
        <div id="warta-pengumuman-content" class="hidden space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @forelse($pengumumanList as $p)
                    <div class="bg-white rounded-3xl p-6 border border-amber-200/80 shadow-soft space-y-3">
                        <div class="flex items-center justify-between text-xs">
                            <span class="px-2.5 py-0.5 rounded-full bg-amber-100 text-amber-900 font-bold text-[10px] uppercase">
                                Pengumuman
                            </span>
                            <span class="text-gray-400 font-medium">{{ $p->published_at?->translatedFormat('d F Y') }}</span>
                        </div>
                        <h3 class="font-serif font-bold text-lg text-[#1B4332]">
                            {{ $p->judul }}
                        </h3>
                        <p class="text-xs text-gray-600 leading-relaxed">
                            {{ $p->isi }}
                        </p>
                    </div>
                @empty
                    <div class="col-span-2 text-center py-12 text-gray-400 text-xs">
                        Belum ada surat edaran atau pengumuman aktif saat ini.
                    </div>
                @endforelse
            </div>
        </div>

        <!-- CONTENT 3: Agenda Section (Initially Hidden) -->
        <div id="warta-agenda-content" class="hidden space-y-6">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                @forelse($agendaList as $a)
                    <div class="bg-white rounded-3xl p-6 border border-emerald-200/80 shadow-soft space-y-4">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-[#1B4332] flex flex-col items-center justify-center border border-emerald-200">
                                <span class="font-mono font-black text-sm leading-none">{{ $a->tanggal_mulai?->format('d') }}</span>
                                <span class="text-[9px] uppercase font-bold text-emerald-700 leading-none mt-0.5">{{ $a->tanggal_mulai?->translatedFormat('M') }}</span>
                            </div>
                            <div class="flex-1 min-w-0">
                                <span class="text-[10px] text-[#0284C7] font-bold block">{{ $a->kategori ?? 'Kegiatan Warga' }}</span>
                                <h4 class="font-serif font-bold text-sm text-[#1B4332] truncate">{{ $a->judul }}</h4>
                            </div>
                        </div>

                        <div class="space-y-1.5 text-xs text-gray-600">
                            @if($a->lokasi)
                                <p class="flex items-center gap-1.5 text-[11px]">
                                    <svg class="w-3.5 h-3.5 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
                                    <span>{{ $a->lokasi }}</span>
                                </p>
                            @endif
                            @if($a->deskripsi)
                                <p class="text-[11px] text-gray-500 line-clamp-2 pt-1 border-t border-gray-100">{{ $a->deskripsi }}</p>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-center py-12 text-gray-400 text-xs">
                        Tidak ada agenda kegiatan terjadwal dalam waktu dekat.
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
    function switchWartaTab(tab) {
        const tabs = ['berita', 'pengumuman', 'agenda'];
        tabs.forEach(t => {
            const btn = document.getElementById('tab-' + t + '-btn');
            const content = document.getElementById('warta-' + t + '-content');
            if (t === tab) {
                btn.classList.add('bg-[#1B4332]', 'text-[#FFB703]', 'shadow-xs');
                btn.classList.remove('bg-gray-100', 'text-gray-700');
                content.classList.remove('hidden');
            } else {
                btn.classList.remove('bg-[#1B4332]', 'text-[#FFB703]', 'shadow-xs');
                btn.classList.add('bg-gray-100', 'text-gray-700');
                content.classList.add('hidden');
            }
        });
    }
    </script>
    @endpush
    </div>
</x-layouts.app>

