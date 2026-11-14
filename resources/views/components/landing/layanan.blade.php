@props(['data'])

@php
    $layananList = $data['layanan'] ?? collect();
@endphp

<section id="layanan" class="py-16 md:py-24 bg-[#FFF8E7]">
    <div class="max-w-7xl mx-auto px-6 space-y-12">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
            <div class="space-y-3">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-[#219EBC]/15 text-[#17708A] text-xs font-bold uppercase tracking-wider">
                    Administrasi & Surat
                </div>
                <h2 class="font-display font-bold text-3xl sm:text-4xl text-[#1B4332]">
                    Layanan Publik Tanpa Biaya
                </h2>
                <p class="text-sm text-[#1F2D26]/75 max-w-xl">
                    Seluruh permohonan surat keterangan dan rekomendasi di Kelurahan Sukawarna diproses cepat, transparan, dan 100% gratis.
                </p>
            </div>

            <a href="{{ route('layanan.index') }}" class="inline-flex items-center gap-1.5 px-5 py-2.5 rounded-full border-2 border-[#2D6A4F] text-[#2D6A4F] font-bold text-xs hover:bg-[#2D6A4F]/10 transition-colors self-start md:self-auto">
                <span>Semua Daftar Layanan</span>
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                    <polyline points="12 5 19 12 12 19"></polyline>
                </svg>
            </a>
        </div>

        <!-- Service Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($layananList->take(4) as $lay)
                <div class="bg-white rounded-[28px] p-6 border border-[#52B788]/20 shadow-soft shadow-hover flex flex-col justify-between space-y-4">
                    <div class="space-y-3">
                        <div class="w-12 h-12 rounded-2xl bg-[#52B788]/15 text-[#2D6A4F] flex items-center justify-center">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                <polyline points="14 2 14 8 20 8"></polyline>
                                <line x1="16" y1="13" x2="8" y2="13"></line>
                                <line x1="16" y1="17" x2="8" y2="17"></line>
                                <polyline points="10 9 9 9 8 9"></polyline>
                            </svg>
                        </div>
                        <h3 class="font-display font-bold text-base text-[#1B4332] leading-snug">
                            {{ $lay->nama_layanan }}
                        </h3>
                        <div class="flex items-center gap-2 text-xs text-[#17708A]">
                            <span class="px-2.5 py-0.5 rounded-full bg-[#219EBC]/15 font-semibold">{{ $lay->waktu_penyelesaian }}</span>
                            <span class="font-bold text-emerald-700">{{ $lay->biaya }}</span>
                        </div>
                    </div>

                    <div class="pt-2 border-t border-gray-100">
                        <a href="{{ route('layanan.index') }}" class="inline-flex items-center gap-1 text-xs font-bold text-[#1B4332] hover:text-[#52B788] transition-colors">
                            <span>Lihat Persyaratan & Alur</span>
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                <polyline points="9 18 15 12 9 6"></polyline>
                            </svg>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

