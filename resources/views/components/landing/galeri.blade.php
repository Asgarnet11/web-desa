@props(['data'])

@php
    $galeriItems = $data['galeri'] ?? collect();
    $defaultGaleri = [
        [
            'judul' => 'Kerja Bakti Massal Lingkungan RW 01',
            'keterangan' => 'Pembersihan saluran air dan penataan lingkungan asri menyambut musim penghujan.',
            'file_url' => 'https://images.unsplash.com/photo-1593113598332-cd288d649433?auto=format&fit=crop&w=600&q=80',
        ],
        [
            'judul' => 'Pemeriksaan Kesehatan Lansia & Posyandu',
            'keterangan' => 'Layanan cek tensi, gula darah, dan edukasi gizi balita gratis di Balai RW 02.',
            'file_url' => 'https://images.unsplash.com/photo-1576765608535-5f04d1e3f289?auto=format&fit=crop&w=600&q=80',
        ],
        [
            'judul' => 'Pelatihan Branding & Digital Marketing UMKM',
            'keterangan' => 'Peningkatan kapasitas wirausaha mandiri produk kuliner dan kerajinan warga.',
            'file_url' => 'https://images.unsplash.com/photo-1556761175-5973dc0f32e7?auto=format&fit=crop&w=600&q=80',
        ],
        [
            'judul' => 'Panen Sayur Hidroponik Pekarangan Lestari',
            'keterangan' => 'Ketahanan pangan keluarga hasil gotong royong pemanfaatan pekarangan rumah.',
            'file_url' => 'https://images.unsplash.com/photo-1466692476868-aef1dfb1e735?auto=format&fit=crop&w=600&q=80',
        ],
        [
            'judul' => 'Musrenbang Kelurahan Konda 2026',
            'keterangan' => 'Musyawarah perencanaan pembangunan wilayah bersama tokoh masyarakat dan RT/RW.',
            'file_url' => 'https://images.unsplash.com/photo-1577495508048-b635879837f1?auto=format&fit=crop&w=600&q=80',
        ],
    ];
@endphp

<section id="galeri" class="py-20 lg:py-28 bg-[#FDFDFC]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <!-- Section Header with Right Button (Reference Layout) -->
        <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-12">
            <div>
                <span class="text-xs font-bold tracking-[0.2em] text-[#FFB703] uppercase block mb-1">
                    DINAMIKA & KEGIATAN WARGA
                </span>
                <h2 class="font-serif font-black text-3xl sm:text-4xl text-[#1B4332] tracking-tight">
                    Potret Kebersamaan Konda
                </h2>
            </div>
            <a href="{{ route('berita.index') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded border border-gray-300 hover:border-[#1B4332] text-[#1B4332] hover:bg-gray-50 text-xs font-bold uppercase tracking-wider transition-colors self-start sm:self-auto">
                <span>LIHAT SEMUA DOKUMENTASI</span>
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                </svg>
            </a>
        </div>

        <!-- Horizontal Photo Strip / 5-Column Grid (Visual Reference Fidelity) -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">
            @php
                $itemsToDisplay = $galeriItems->count() >= 3 ? $galeriItems->take(5) : collect($defaultGaleri);
            @endphp

            @foreach($itemsToDisplay as $item)
                @php
                    $isObject = is_object($item);
                    $judul = $isObject ? $item->judul : $item['judul'];
                    $keterangan = $isObject ? $item->keterangan : $item['keterangan'];
                    $fotoUrl = $isObject ? ($item->file_url ?? 'https://images.unsplash.com/photo-1593113598332-cd288d649433?auto=format&fit=crop&w=600&q=80') : $item['file_url'];
                @endphp
                <div class="group relative rounded-2xl overflow-hidden shadow-sm border border-gray-200/80 bg-gray-100 aspect-[4/5] flex flex-col justify-end">
                    <img src="{{ $fotoUrl }}" 
                         alt="{{ $judul }}" 
                         class="absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    
                    <!-- Dark Gradient Overlay for Typography Readability -->
                    <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/30 to-transparent opacity-80 group-hover:opacity-95 transition-opacity"></div>

                    <!-- Caption Content -->
                    <div class="relative z-10 p-4 space-y-1 transform group-hover:-translate-y-1 transition-transform">
                        <span class="inline-block px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wider bg-[#FFB703] text-[#1B4332]">
                            Dokumentasi
                        </span>
                        <h4 class="font-serif font-bold text-sm text-white leading-snug line-clamp-2">
                            {{ $judul }}
                        </h4>
                        <p class="text-[11px] text-white/80 line-clamp-2 leading-relaxed font-light">
                            {{ $keterangan }}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
