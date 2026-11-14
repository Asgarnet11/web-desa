<x-layouts.app :title="'Lacak Tiket Pengaduan - Kelurahan Sukawarna'">
    <div class="max-w-2xl mx-auto px-6 py-12 space-y-8">
        <div class="text-center space-y-2">
            <span class="text-xs font-bold text-[#17708A] uppercase tracking-wider">Tracking Resmi</span>
            <h1 class="font-display font-bold text-3xl text-[#1B4332]">
                Lacak Status Pengaduan Warga
            </h1>
            <p class="text-xs sm:text-sm text-[#1F2D26]/75">
                Masukkan nomor tiket laporan pengaduan Anda untuk memeriksa proses penanganan.
            </p>
        </div>

        <!-- Form Cari Tiket -->
        <div class="bg-white rounded-[32px] p-7 border border-[#52B788]/20 shadow-soft">
            <form action="{{ route('pengaduan.cek') }}" method="GET" class="flex gap-3">
                <input type="text" name="nomor_tiket" value="{{ $tiket }}" required 
                       placeholder="Contoh: PGD-202611-ABC12" 
                       class="flex-1 px-5 py-3 rounded-full border border-[#52B788]/40 focus:ring-2 focus:ring-[#52B788] text-xs font-mono uppercase outline-none">
                <button type="submit" class="btn-organic px-7 py-3 bg-[#FFB703] text-[#1B4332] font-bold text-xs shadow-sm hover:scale-[1.02] transition-transform">
                    Periksa
                </button>
            </form>
        </div>

        <!-- Result -->
        @if($tiket)
            @if($pengaduan)
                <div class="bg-white rounded-[32px] p-8 border border-[#52B788]/20 shadow-soft space-y-5">
                    <div class="flex items-center justify-between pb-4 border-b border-gray-100">
                        <div>
                            <span class="text-[10px] text-gray-400 block font-mono">NOMOR TIKET</span>
                            <span class="font-mono font-bold text-base text-[#1B4332]">{{ $pengaduan->nomor_tiket }}</span>
                        </div>
                        <span class="px-3 py-1 rounded-full text-xs font-bold 
                            {{ $pengaduan->status->value === 'selesai' ? 'bg-emerald-100 text-emerald-800' : '' }}
                            {{ $pengaduan->status->value === 'diproses' ? 'bg-sky-100 text-sky-800' : '' }}
                            {{ $pengaduan->status->value === 'menunggu' ? 'bg-amber-100 text-amber-800' : '' }}
                            {{ $pengaduan->status->value === 'ditolak' ? 'bg-rose-100 text-rose-800' : '' }}">
                            {{ $pengaduan->status->label() }}
                        </span>
                    </div>

                    <div class="space-y-3 text-xs">
                        <div>
                            <span class="text-gray-400 block">Kategori & Lokasi:</span>
                            <span class="font-semibold text-[#1B4332]">{{ $pengaduan->kategori }} &bull; {{ $pengaduan->lokasi ?? 'Kelurahan Sukawarna' }}</span>
                        </div>
                        <div>
                            <span class="text-gray-400 block">Judul Laporan:</span>
                            <h4 class="font-display font-bold text-sm text-[#1B4332]">{{ $pengaduan->judul }}</h4>
                        </div>
                        <div>
                            <span class="text-gray-400 block">Isi Laporan:</span>
                            <p class="text-[#1F2D26]/80 leading-relaxed bg-[#FFF8E7] p-3.5 rounded-2xl border border-[#52B788]/20">{{ $pengaduan->isi }}</p>
                        </div>

                        @if($pengaduan->tanggapan)
                            <div class="p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-900 space-y-1 mt-4">
                                <strong class="text-xs block">Tindak Lanjut dari Petugas Kelurahan:</strong>
                                <p class="text-xs leading-relaxed">{{ $pengaduan->tanggapan }}</p>
                                @if($pengaduan->ditanggapi_pada)
                                    <span class="text-[10px] text-emerald-700 block pt-1">
                                        Ditanggapi pada: {{ $pengaduan->ditanggapi_pada->translatedFormat('d F Y, H:i') }} WIB
                                    </span>
                                @endif
                            </div>
                        @else
                            <div class="p-4 rounded-2xl bg-amber-50 border border-amber-200 text-amber-900 text-xs mt-4">
                                Laporan Anda telah tercatat dan sedang dalam antrean verifikasi oleh petugas kelurahan.
                            </div>
                        @endif
                    </div>
                </div>
            @else
                <div class="text-center py-10 bg-white rounded-[32px] p-6 border border-gray-200 text-xs text-gray-500">
                    Nomor tiket <strong>{{ $tiket }}</strong> tidak ditemukan dalam sistem database. Silakan periksa kembali nomor tiket Anda.
                </div>
            @endif
        @endif
    </div>
</x-layouts.app>
