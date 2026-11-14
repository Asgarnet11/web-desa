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

