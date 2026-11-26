@props(['data'])

@php
    $fasilitasItems = $data['fasilitas'] ?? collect();
    // Default facilities if fewer than 4 exist
    $defaultFasilitas = [
        [
            'nama' => 'Puskesmas Konda',
            'kategori' => 'Kesehatan',
            'foto' => 'https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?auto=format&fit=crop&w=600&q=80',
            'deskripsi' => 'Pusat pelayanan kesehatan dasar, posyandu terintegrasi, dan pemeriksaan berkala gratis bagi warga.',
            'kondisi' => 'Baik',
        ],
        [
            'nama' => 'Kantor Pelayanan Terpadu',
            'kategori' => 'Pemerintahan',
            'foto' => 'https://images.unsplash.com/photo-1577495508048-b635879837f1?auto=format&fit=crop&w=600&q=80',
            'deskripsi' => 'Ruang pelayanan publik modern dan ramah warga untuk pengurusan dokumen administrasi kependudukan.',
            'kondisi' => 'Sangat Baik',
        ],
        [
            'nama' => 'SD Negeri 1 Konda & SMPN 1 Konasel',
            'kategori' => 'Pendidikan',
            'foto' => 'https://images.unsplash.com/photo-1580582932707-520aed937b7b?auto=format&fit=crop&w=600&q=80',
            'deskripsi' => 'Sarana pendidikan dasar berakreditasi baik dengan fasilitas ruang kelas nyaman dan perpustakaan warga.',
            'kondisi' => 'Baik',
        ],
        [
            'nama' => 'Mobil Siaga & Posko Tanggap Bencana',
            'kategori' => 'Transportasi & Darurat',
            'foto' => 'https://images.unsplash.com/photo-1544620347-c4fd4a3d5957?auto=format&fit=crop&w=600&q=80',
            'deskripsi' => 'Armada transportasi siaga warga untuk rujukan medis darurat dan respon cepat kebencanaan wilayah.',
            'kondisi' => 'Siaga 24 Jam',
        ],
    ];
@endphp

<section id="fasilitas" class="py-20 lg:py-28 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <!-- Section Header with Right Button (Reference Fidelity) -->
        <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-14">
            <div>
                <span class="text-xs font-bold tracking-[0.2em] text-[#FFB703] uppercase block mb-1">
                    FASILITAS PUBLIK
                </span>
                <h2 class="font-serif font-black text-3xl sm:text-4xl text-[#1B4332] tracking-tight">
                    Sarana & Prasarana Wilayah Terpadu
                </h2>
            </div>
            <a href="{{ route('peta.index') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded border border-gray-300 hover:border-[#1B4332] text-[#1B4332] hover:bg-gray-50 text-xs font-bold uppercase tracking-wider transition-colors self-start sm:self-auto">
                <span>LIHAT SEMUA FASILITAS</span>
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                </svg>
            </a>
        </div>

        <!-- 4-Column Card Grid (Visual Reference Layout) -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @forelse($fasilitasItems->take(4) as $item)
                @php
                    $foto = $item->foto ?? 'https://images.unsplash.com/photo-1577495508048-b635879837f1?auto=format&fit=crop&w=600&q=80';
                    $kategoriNama = $item->kategori?->nama ?? 'Fasilitas Umum';
                @endphp
                <div class="bg-white rounded-2xl overflow-hidden border border-gray-200/90 shadow-sm hover:shadow-lg transition-all group flex flex-col justify-between">
                    <div>
                        <!-- Facility Photo -->
                        <div class="aspect-[16/10] overflow-hidden bg-gray-100 relative">
                            <img src="{{ $foto }}" 
                                 alt="{{ $item->nama }}" 
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        </div>

                        <!-- Overlapping Circular Category Icon Badge -->
                        <div class="w-12 h-12 rounded-full bg-[#1B4332] text-white flex items-center justify-center -mt-6 ml-5 relative z-10 border-2 border-white shadow-md">
                            @if(str_contains(strtolower($kategoriNama), 'sehat'))
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                            @elseif(str_contains(strtolower($kategoriNama), 'didik'))
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                            @elseif(str_contains(strtolower($kategoriNama), 'ibadah'))
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z"/></svg>
                            @else
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                            @endif
                        </div>

                        <!-- Card Content -->
                        <div class="p-5 pt-3 space-y-2">
                            <span class="text-[11px] font-bold uppercase tracking-wider text-[#2D6A4F] block">
                                {{ $kategoriNama }}
                            </span>
                            <h3 class="font-serif font-bold text-base text-[#1B4332] group-hover:text-[#2D6A4F] transition-colors leading-snug">
                                {{ $item->nama }}
                            </h3>
                            <p class="text-xs text-gray-500 leading-relaxed line-clamp-3">
                                {{ $item->alamat ?? 'Fasilitas publik yang senantiasa dirawat untuk kenyamanan dan kebutuhan warga Kelurahan Konda.' }}
                            </p>
                        </div>
                    </div>

                    <!-- Card Bottom Status Link -->
                    <div class="px-5 pb-5 pt-2 border-t border-gray-100 flex items-center justify-between text-xs">
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-emerald-50 text-emerald-700 font-semibold text-[11px]">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                            <span>Kondisi {{ $item->kondisi?->value ?? 'Baik' }}</span>
                        </span>
                        <a href="{{ route('peta.index') }}" class="font-bold text-[#1B4332] hover:text-[#2D6A4F] inline-flex items-center gap-1">
                            <span>Lihat di Peta</span>
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </a>
                    </div>
                </div>
            @empty
                @foreach($defaultFasilitas as $def)
                    <div class="bg-white rounded-2xl overflow-hidden border border-gray-200/90 shadow-sm hover:shadow-lg transition-all group flex flex-col justify-between">
                        <div>
                            <div class="aspect-[16/10] overflow-hidden bg-gray-100 relative">
                                <img src="{{ $def['foto'] }}" 
                                     alt="{{ $def['nama'] }}" 
                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            </div>
                            <div class="w-12 h-12 rounded-full bg-[#1B4332] text-white flex items-center justify-center -mt-6 ml-5 relative z-10 border-2 border-white shadow-md">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                            </div>
                            <div class="p-5 pt-3 space-y-2">
                                <span class="text-[11px] font-bold uppercase tracking-wider text-[#2D6A4F] block">
                                    {{ $def['kategori'] }}
                                </span>
                                <h3 class="font-serif font-bold text-base text-[#1B4332] group-hover:text-[#2D6A4F] transition-colors leading-snug">
                                    {{ $def['nama'] }}
                                </h3>
                                <p class="text-xs text-gray-500 leading-relaxed">
                                    {{ $def['deskripsi'] }}
                                </p>
                            </div>
                        </div>
                        <div class="px-5 pb-5 pt-2 border-t border-gray-100 flex items-center justify-between text-xs">
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-emerald-50 text-emerald-700 font-semibold text-[11px]">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                <span>{{ $def['kondisi'] }}</span>
                            </span>
                            <a href="{{ route('peta.index') }}" class="font-bold text-[#1B4332] hover:text-[#2D6A4F] inline-flex items-center gap-1">
                                <span>Lihat di Peta</span>
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                            </a>
                        </div>
                    </div>
                @endforeach
            @endforelse
        </div>
    </div>
</section>
