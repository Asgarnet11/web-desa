<x-layouts.app title="Repositori Dokumen & Formulir Publik - Kelurahan Konda">
    <!-- Hero Section -->
    <section class="bg-gradient-to-b from-[#1B4332] to-[#143527] text-white pt-12 pb-20 relative overflow-hidden">
        <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#FFB703_1px,transparent_1px)] [background-size:16px_16px]"></div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 relative z-10">
            <div class="max-w-3xl space-y-4">
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-white/10 border border-white/20 text-[#FFB703] text-xs font-bold uppercase tracking-wider">
                    <span class="w-2 h-2 rounded-full bg-[#FFB703] animate-pulse"></span>
                    <span>Keterbukaan Informasi Publik (KIP) &bull; UU No. 14/2008</span>
                </div>
                <h1 class="font-serif font-black text-3xl sm:text-4xl md:text-5xl leading-tight">
                    Repositori Dokumen & <span class="text-[#FFB703]">Blangko Mandiri</span>
                </h1>
                <p class="text-white/80 text-sm sm:text-base leading-relaxed">
                    Akses transparan seluruh dokumen resmi Pemerintah Kelurahan Konda, mencakup formulir blangko permohonan surat warga, Standar Operasional Prosedur (SOP), laporan akuntabilitas kinerja, serta regulasi kelurahan.
                </p>
            </div>

            <!-- KPI Metric Badges -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-8 pt-6 border-t border-white/10">
                <div class="bg-white/10 backdrop-blur-md rounded-2xl p-4 border border-white/10">
                    <span class="text-[11px] text-white/70 block uppercase font-bold tracking-wider">Total Dokumen</span>
                    <span class="font-display font-black text-2xl sm:text-3xl text-[#FFB703]">{{ number_format($totalDokumen) }}</span>
                    <span class="text-[10px] text-white/60 block mt-0.5">Berkas Terpublikasi</span>
                </div>
                <div class="bg-white/10 backdrop-blur-md rounded-2xl p-4 border border-white/10">
                    <span class="text-[11px] text-white/70 block uppercase font-bold tracking-wider">Total Unduhan</span>
                    <span class="font-display font-black text-2xl sm:text-3xl text-emerald-300">{{ number_format($totalDownload) }}</span>
                    <span class="text-[10px] text-white/60 block mt-0.5">Akses Masyarakat</span>
                </div>
                <div class="bg-white/10 backdrop-blur-md rounded-2xl p-4 border border-white/10">
                    <span class="text-[11px] text-white/70 block uppercase font-bold tracking-wider">Format Standar</span>
                    <span class="font-display font-black text-2xl sm:text-3xl text-sky-300">PDF & DOCX</span>
                    <span class="text-[10px] text-white/60 block mt-0.5">Siap Cetak & Isi</span>
                </div>
                <div class="bg-white/10 backdrop-blur-md rounded-2xl p-4 border border-white/10">
                    <span class="text-[11px] text-white/70 block uppercase font-bold tracking-wider">Status Akses</span>
                    <span class="font-display font-black text-2xl sm:text-3xl text-white">100% Bebas</span>
                    <span class="text-[10px] text-white/60 block mt-0.5">Tanpa Biaya Retribusi</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Content & Filter Section -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 py-10 -mt-8 relative z-20">
        <!-- Search & Filter Card -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-4 sm:p-6 mb-8">
            <form action="{{ route('dokumen.index') }}" method="GET" class="flex flex-col md:flex-row gap-4 items-center justify-between">
                <!-- Search Input -->
                <div class="relative w-full md:max-w-md">
                    <input type="text" 
                           name="q" 
                           value="{{ request('q') }}" 
                           placeholder="Cari nama dokumen atau blangko surat..." 
                           class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-[#2D6A4F] focus:border-transparent">
                    <svg class="w-4 h-4 text-gray-400 absolute left-3.5 top-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>

                <!-- Category Tabs -->
                <div class="flex flex-wrap items-center gap-2 w-full md:w-auto">
                    <a href="{{ route('dokumen.index', ['q' => request('q')]) }}" 
                       class="px-3.5 py-2 rounded-xl text-xs font-bold transition-colors {{ !request('kategori') || request('kategori') === 'semua' ? 'bg-[#1B4332] text-white shadow-sm' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                        Semua Kategori
                    </a>
                    @foreach(['Formulir', 'SOP', 'Laporan', 'Peraturan'] as $kat)
                        <a href="{{ route('dokumen.index', ['kategori' => $kat, 'q' => request('q')]) }}" 
                           class="px-3.5 py-2 rounded-xl text-xs font-bold transition-colors {{ request('kategori') === $kat ? 'bg-[#1B4332] text-white shadow-sm' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                            {{ $kat }}
                        </a>
                    @endforeach
                    <button type="submit" class="px-4 py-2 bg-[#FFB703] text-[#1B4332] font-black text-xs uppercase tracking-wider rounded-xl shadow-sm hover:bg-[#e6a503] transition-colors ml-auto md:ml-0">
                        Cari
                    </button>
                </div>
            </form>
        </div>

        <!-- Regulatory Basis Summary Banner -->
        <div class="mb-8 rounded-2xl border border-[#1B4332]/20 bg-[#F4F7F4] p-5 flex flex-col lg:flex-row lg:items-center justify-between gap-4">
            <div class="space-y-1">
                <span class="text-[11px] font-bold uppercase tracking-wider text-[#2D6A4F] block">
                    Payung Hukum Pengambilan, Penyimpanan & Pemrosesan Data Warga
                </span>
                <p class="text-xs text-gray-700 leading-relaxed max-w-4xl">
                    Seluruh pendataan kependudukan (lahir, mati, datang, pindah), Posyandu/ibu hamil, dan publikasi Satu Data mengacu resmi pada <strong>UU No. 24 Tahun 2013</strong>, <strong>Permendagri No. 47 Tahun 2016</strong>, <strong>Perpres No. 39 Tahun 2019</strong>, <strong>Permendagri No. 13 Tahun 2024</strong>, dan <strong>UU No. 27 Tahun 2022 (UU PDP)</strong>.
                </p>
            </div>
            <a href="{{ route('regulasi.index') }}" class="inline-flex items-center gap-1.5 px-4 py-2.5 rounded-xl bg-[#1B4332] text-white text-xs font-bold hover:bg-[#2D6A4F] transition-colors shrink-0">
                <span>Baca Penjelasan Lengkap &amp; Matriks Data &rarr;</span>
            </a>
        </div>

        <!-- Document Grid -->
        @if($dokumenList->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($dokumenList as $dokumen)
                    @php
                        $badgeBg = match(strtolower($dokumen->kategori)) {
                            'formulir' => 'bg-emerald-50 text-emerald-800 border-emerald-200',
                            'sop' => 'bg-sky-50 text-sky-800 border-sky-200',
                            'laporan' => 'bg-amber-50 text-amber-800 border-amber-200',
                            'peraturan' => 'bg-purple-50 text-purple-800 border-purple-200',
                            default => 'bg-gray-100 text-gray-800 border-gray-200',
                        };
                    @endphp
                    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition-all p-6 flex flex-col justify-between group">
                        <div class="space-y-3">
                            <div class="flex items-center justify-between gap-2">
                                <span class="px-2.5 py-1 rounded-full text-[11px] font-bold border {{ $badgeBg }}">
                                    {{ $dokumen->kategori }}
                                </span>
                                <span class="text-[11px] text-gray-400 flex items-center gap-1 font-mono">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                    </svg>
                                    {{ number_format($dokumen->download_count) }}x
                                </span>
                            </div>

                            <div class="flex items-start gap-3 pt-1">
                                <div class="w-10 h-10 rounded-xl bg-red-50 text-red-600 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-bold text-sm sm:text-base text-[#1B4332] leading-snug line-clamp-2 group-hover:text-[#2D6A4F] transition-colors">
                                        {{ $dokumen->judul }}
                                    </h3>
                                    <p class="text-xs text-gray-500 mt-1">
                                        Ukuran: <span class="font-medium text-gray-700">{{ $dokumen->ukuran_file ?? 'PDF Resmi' }}</span> &bull; 
                                        {{ $dokumen->created_at?->translatedFormat('d M Y') ?? 'Tersedia' }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="pt-5 mt-4 border-t border-gray-100 flex items-center justify-between gap-3">
                            <span class="text-[11px] text-gray-400">Pemerintah Kelurahan</span>
                            <a href="{{ route('dokumen.download', $dokumen) }}" 
                               class="inline-flex items-center gap-1.5 px-3.5 py-2 bg-gradient-to-r from-[#1B4332] to-[#2D6A4F] text-white hover:from-[#2D6A4F] hover:to-[#1B4332] text-xs font-bold rounded-xl shadow-xs transition-all">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                </svg>
                                <span>Unduh Berkas</span>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-8">
                {{ $dokumenList->links() }}
            </div>
        @else
            <div class="bg-white rounded-3xl p-12 text-center border border-gray-100 shadow-sm max-w-lg mx-auto space-y-4">
                <div class="w-16 h-16 rounded-full bg-emerald-50 text-[#1B4332] flex items-center justify-center mx-auto text-2xl">
                    📂
                </div>
                <h3 class="font-bold text-lg text-gray-800">Tidak ada dokumen yang ditemukan</h3>
                <p class="text-xs text-gray-500">
                    Coba ubah kata kunci pencarian atau pilih kategori lain untuk menemukan dokumen yang Anda cari.
                </p>
                <a href="{{ route('dokumen.index') }}" class="inline-block px-5 py-2.5 bg-[#1B4332] text-white text-xs font-bold rounded-xl hover:bg-[#2D6A4F] transition-colors">
                    Reset Pencarian
                </a>
            </div>
        @endif
    </section>
</x-layouts.app>
