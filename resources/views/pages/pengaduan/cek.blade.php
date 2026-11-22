<x-layouts.app :title="'Lacak Tiket Pengaduan - Kelurahan Sukawarna'">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 py-12 space-y-8">
        <div class="text-center space-y-2">
            <span class="text-xs font-bold text-[#FFB703] uppercase tracking-wider block">Tracking Resmi</span>
            <h1 class="font-serif font-black text-3xl sm:text-4xl text-[#1B4332] tracking-tight">
                Lacak Status Pengaduan Warga
            </h1>
            <p class="text-xs sm:text-sm text-gray-600 max-w-xl mx-auto leading-relaxed">
                Masukkan nomor tiket laporan pengaduan Anda untuk memeriksa tahapan proses penanganan dan tindak lanjut petugas di lapangan.
            </p>
        </div>

        <!-- Form Cari Tiket -->
        <div class="bg-white rounded-2xl p-6 border border-gray-200/90 shadow-sm max-w-xl mx-auto">
            <form action="{{ route('pengaduan.cek') }}" method="GET" class="flex gap-3">
                <input type="text" name="nomor_tiket" value="{{ $tiket }}" required 
                       placeholder="Contoh: PGD-202611-ABC12" 
                       class="flex-1 px-5 py-3 rounded-xl border border-gray-300 focus:border-[#0284C7] focus:ring-2 focus:ring-sky-100 text-xs font-mono uppercase outline-none">
                <button type="submit" class="px-6 py-3 bg-[#0284C7] hover:bg-[#0369A1] text-white font-bold text-xs uppercase tracking-wider rounded-xl shadow-sm transition-all hover:scale-105 active:scale-95">
                    Periksa
                </button>
            </form>
        </div>

        <!-- Result -->
        @if($tiket)
            @if($pengaduan)
                @php
                    $statusVal = $pengaduan->status->value;
                    $steps = [
                        ['title' => 'Laporan Terkirim', 'status' => 'completed', 'date' => $pengaduan->created_at->translatedFormat('d M Y')],
                        ['title' => 'Verifikasi Petugas', 'status' => in_array($statusVal, ['diproses', 'selesai']) ? 'completed' : ($statusVal === 'menunggu' ? 'active' : 'upcoming'), 'date' => 'Tahap 2'],
                        ['title' => 'Disposisi Seksi', 'status' => in_array($statusVal, ['diproses', 'selesai']) ? ($statusVal === 'diproses' ? 'active' : 'completed') : 'upcoming', 'date' => 'Tahap 3'],
                        ['title' => 'Tindak Lanjut Lapangan', 'status' => $statusVal === 'selesai' ? 'completed' : ($statusVal === 'diproses' ? 'active' : 'upcoming'), 'date' => 'Tahap 4'],
                        ['title' => 'Laporan Selesai', 'status' => $statusVal === 'selesai' ? 'completed' : 'upcoming', 'date' => $pengaduan->ditanggapi_pada ? $pengaduan->ditanggapi_pada->translatedFormat('d M Y') : 'Tahap Akhir'],
                    ];
                @endphp

                <!-- Reference-Styled Stepper Card for Complaint Progress -->
                <div class="bg-white rounded-3xl border-2 border-sky-200/80 shadow-md p-6 sm:p-8 space-y-6">
                    <div class="text-center">
                        <span class="text-xs font-bold text-[#0284C7] uppercase tracking-wider">STATUS PERJALANAN TIKET</span>
                        <h3 class="font-serif font-bold text-xl text-[#0F172A] mt-1">{{ $pengaduan->nomor_tiket }}</h3>
                        <div class="w-12 h-1 bg-[#0284C7] mx-auto mt-2 rounded-full"></div>
                    </div>

                    <!-- 5 Stepper Nodes Flow -->
                    <div class="grid grid-cols-2 sm:grid-cols-5 gap-4 items-start pt-4 relative">
                        @foreach($steps as $idx => $s)
                            <div class="flex flex-col items-center text-center relative group">
                                <div class="w-14 h-14 sm:w-16 sm:h-16 rounded-2xl border-2 {{ $s['status'] === 'completed' ? 'border-sky-300 bg-sky-50' : ($s['status'] === 'active' ? 'border-[#0284C7] bg-sky-100 ring-4 ring-sky-200' : 'border-slate-200 bg-slate-50') }} flex items-center justify-center relative shadow-sm">
                                    <div class="absolute -top-2 -right-2 w-5 h-5 rounded-full flex items-center justify-center border-2 border-white shadow-xs z-10
                                        {{ $s['status'] === 'completed' ? 'bg-emerald-500 text-white' : ($s['status'] === 'active' ? 'bg-[#0284C7] text-white animate-pulse' : 'bg-slate-300 text-white') }}">
                                        @if($s['status'] === 'completed')
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                                        @elseif($s['status'] === 'active')
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="12" r="9" stroke-width="2.5"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 6v6l4 2"/></svg>
                                        @else
                                            <svg class="w-2.5 h-2.5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="12" r="9" stroke-width="2"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 7v5l3 2"/></svg>
                                        @endif
                                    </div>
                                    <span class="text-sm font-black text-[#0284C7]">{{ $idx + 1 }}</span>
                                </div>
                                <h4 class="font-bold text-xs text-[#0369A1] mt-2 leading-tight">{{ $s['title'] }}</h4>
                                <span class="text-[10px] text-rose-600 font-semibold mt-0.5">{{ $s['date'] }}</span>

                                @if(!$loop->last)
                                    <div class="hidden sm:flex absolute top-5 -right-2 text-sky-300 pointer-events-none">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Detail Pengaduan Card -->
                <div class="bg-white rounded-2xl p-6 sm:p-8 border border-gray-200/90 shadow-sm space-y-5">
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
                            <h4 class="font-serif font-bold text-sm text-[#1B4332]">{{ $pengaduan->judul }}</h4>
                        </div>
                        <div>
                            <span class="text-gray-400 block">Isi Laporan:</span>
                            <p class="text-gray-700 leading-relaxed bg-[#FFF8E7] p-3.5 rounded-xl border border-amber-200/60">{{ $pengaduan->isi }}</p>
                        </div>

                        @if($pengaduan->tanggapan)
                            <div class="p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-900 space-y-1 mt-4">
                                <strong class="text-xs block">Tindak Lanjut Petugas Kelurahan:</strong>
                                <p class="text-xs leading-relaxed">{{ $pengaduan->tanggapan }}</p>
                                @if($pengaduan->ditanggapi_pada)
                                    <span class="text-[10px] text-emerald-700 block pt-1">
                                        Ditanggapi pada: {{ $pengaduan->ditanggapi_pada->translatedFormat('d F Y, H:i') }} WIB
                                    </span>
                                @endif
                            </div>
                        @else
                            <div class="p-4 rounded-xl bg-amber-50 border border-amber-200 text-amber-900 text-xs mt-4">
                                Laporan Anda telah tercatat dan sedang dalam antrean verifikasi oleh petugas kelurahan.
                            </div>
                        @endif
                    </div>
                </div>
            @else
                <div class="text-center py-10 bg-white rounded-2xl p-6 border border-gray-200 text-xs text-gray-500">
                    Nomor tiket <strong>{{ $tiket }}</strong> tidak ditemukan dalam sistem database. Silakan periksa kembali nomor tiket Anda.
                </div>
            @endif
        @endif
    </div>
</x-layouts.app>
