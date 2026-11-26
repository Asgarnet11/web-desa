<x-layouts.app :title="$berita->judul . ' - Kelurahan Sukawarna'">
    <div class="max-w-4xl mx-auto px-6 py-10 space-y-8">
        <div>
            <a href="{{ route('berita.index') }}" class="text-xs font-bold text-[#17708A] hover:underline inline-flex items-center gap-1 mb-4">
                &larr; Kembali ke Daftar Berita
            </a>
            <div class="flex items-center gap-2 mb-3">
                <span class="px-3 py-1 rounded-full bg-[#52B788]/20 text-[#1B4332] text-xs font-bold">{{ $berita->kategori }}</span>
                <span class="text-xs text-gray-500">{{ $berita->published_at?->translatedFormat('d F Y, H:i') }} WIB</span>
            </div>
            <h1 class="font-display font-bold text-3xl sm:text-4xl text-[#1B4332] leading-tight">
                {{ $berita->judul }}
            </h1>
        </div>

        @if($berita->foto)
            <div class="rounded-[32px] overflow-hidden border border-[#52B788]/30 shadow-soft">
                <img src="{{ $berita->foto }}" alt="{{ $berita->judul }}" class="w-full h-auto max-h-[460px] object-cover">
            </div>
        @endif

        <div class="prose max-w-none text-[#1F2D26]/90 text-sm sm:text-base leading-relaxed bg-white rounded-[32px] p-8 md:p-10 border border-[#52B788]/20 shadow-soft">
            {!! nl2br(e($berita->konten)) !!}
        </div>

        <!-- Social Share Capsule -->
        <div class="p-4 rounded-2xl bg-white border border-gray-200/90 shadow-2xs flex flex-col sm:flex-row items-center justify-between gap-3 text-xs">
            <span class="font-bold text-[#1B4332] flex items-center gap-1.5">
                <svg class="w-4 h-4 text-[#FFB703]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"/></svg>
                <span>Bagikan Warta Ini ke Warga Lainnya:</span>
            </span>

            <div class="flex items-center gap-2">
                <a href="https://api.whatsapp.com/send?text={{ urlencode($berita->judul . ' - ' . url()->current()) }}" 
                   target="_blank" 
                   rel="noopener noreferrer" 
                   class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs transition-colors">
                    <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/></svg>
                    <span>Grup WhatsApp</span>
                </a>

                <button type="button" 
                        onclick="navigator.clipboard.writeText(window.location.href); alert('Tautan berita berhasil disalin ke clipboard!');" 
                        class="inline-flex items-center gap-1 px-3 py-1.5 rounded-xl border border-gray-300 hover:bg-gray-50 text-gray-700 font-bold text-xs transition-colors">
                    <svg class="w-3.5 h-3.5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3"/></svg>
                    <span>Salin Tautan</span>
                </button>
            </div>
        </div>

        <!-- Berita Terkait -->
        @if($beritaTerkait->isNotEmpty())
            <div class="pt-8 border-t border-gray-200 space-y-4">
                <h3 class="font-display font-bold text-xl text-[#1B4332]">Kabar Terkait Lainnya</h3>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    @foreach($beritaTerkait as $bt)
                        <div class="bg-white rounded-2xl p-4 border border-[#52B788]/20 shadow-sm">
                            <span class="text-[10px] text-gray-400 block mb-1">{{ $bt->published_at?->translatedFormat('d M Y') }}</span>
                            <h4 class="font-display font-bold text-xs text-[#1B4332] line-clamp-2">
                                <a href="{{ route('berita.show', $bt->slug) }}" class="hover:underline">{{ $bt->judul }}</a>
                            </h4>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</x-layouts.app>

