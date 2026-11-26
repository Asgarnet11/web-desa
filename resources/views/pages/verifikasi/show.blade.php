<x-layouts.app :title="'Verifikasi Keaslian Dokumen - Kelurahan Konda'">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 py-12 space-y-8">
        <div class="text-center space-y-1.5">
            <span class="text-xs font-bold text-[#FFB703] uppercase tracking-wider block">Sistem Validasi Resmi</span>
            <h1 class="font-serif font-black text-2xl sm:text-3xl text-[#1B4332] tracking-tight">
                Verifikasi Keaslian Dokumen Kelurahan
            </h1>
            <p class="text-xs text-gray-500">
                Layanan validasi integritas surat keterangan dan dokumen pelayanan publik berbasis QR-Code.
            </p>
        </div>

        @if($isValid && $dokumenInfo)
            <!-- Verified Document Card -->
            <div class="bg-white rounded-3xl border-2 border-emerald-500/50 shadow-xl overflow-hidden p-6 sm:p-8 space-y-6 relative">
                <div class="absolute -right-12 -top-12 w-36 h-36 bg-emerald-100/50 rounded-full blur-2xl pointer-events-none"></div>

                <!-- Status Banner -->
                <div class="flex items-center gap-3 p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-900">
                    <div class="w-10 h-10 rounded-xl bg-emerald-600 text-white flex items-center justify-center text-xl font-bold flex-shrink-0">
                        ✓
                    </div>
                    <div>
                        <strong class="text-sm font-bold block text-emerald-950">DOKUMEN RESMI TERDAFTAR & SAH</strong>
                        <span class="text-xs text-emerald-700 block">Tercatat secara sah dalam sistem administrasi Kelurahan Konda.</span>
                    </div>
                </div>

                <!-- Detail Metadata Table -->
                <div class="space-y-3.5 text-xs">
                    <div class="flex items-center justify-between pb-2 border-b border-gray-100">
                        <span class="text-gray-500">Nomor / Kode Registrasi:</span>
                        <strong class="font-mono text-sm text-[#1B4332]">{{ $dokumenInfo['kode'] }}</strong>
                    </div>

                    <div class="flex items-start justify-between pb-2 border-b border-gray-100">
                        <span class="text-gray-500">Jenis Dokumen:</span>
                        <strong class="text-right text-[#1B4332] max-w-xs">{{ $dokumenInfo['tipe'] }}</strong>
                    </div>

                    <div class="flex items-start justify-between pb-2 border-b border-gray-100">
                        <span class="text-gray-500">Instansi Penerbit:</span>
                        <strong class="text-right text-[#1B4332] max-w-xs">{{ $dokumenInfo['penerbit'] }}</strong>
                    </div>

                    <div class="flex items-center justify-between pb-2 border-b border-gray-100">
                        <span class="text-gray-500">Pengesahan Pejabat:</span>
                        <strong class="text-[#1B4332]">{{ $dokumenInfo['pejabat'] }}</strong>
                    </div>

                    <div class="flex items-center justify-between pb-2 border-b border-gray-100">
                        <span class="text-gray-500">Waktu Validasi Sistem:</span>
                        <span class="text-gray-700 font-semibold">{{ $dokumenInfo['tanggal_terbit'] }}</span>
                    </div>

                    <div class="flex items-center justify-between">
                        <span class="text-gray-500">Protokol Keamanan:</span>
                        <span class="px-2.5 py-0.5 rounded-full bg-slate-100 text-slate-700 font-mono text-[10px] font-bold">
                            {{ $dokumenInfo['keamanan'] }}
                        </span>
                    </div>
                </div>

                <!-- Footer Assurance Note -->
                <div class="pt-4 border-t border-gray-100 text-center">
                    <p class="text-[11px] text-gray-400 leading-relaxed">
                        Dokumen ini diterbitkan secara sah dan dilindungi oleh Undang-Undang ITE serta regulasi keterbukaan informasi Pemerintah Kabupaten Konawe Selatan.
                    </p>
                </div>
            </div>
        @else
            <!-- Invalid / Not Found Card -->
            <div class="bg-white rounded-3xl border-2 border-rose-300 shadow-xl p-8 text-center space-y-4">
                <div class="w-14 h-14 rounded-full bg-rose-100 text-rose-600 flex items-center justify-center text-2xl mx-auto font-bold">
                    ✕
                </div>
                <div class="space-y-1">
                    <h3 class="font-serif font-black text-xl text-rose-900">Kode Dokumen Tidak Ditemukan</h3>
                    <p class="text-xs text-gray-500 max-w-md mx-auto leading-relaxed">
                        Kode <strong>{{ $cleanKode }}</strong> tidak terdaftar dalam basis data kelurahan atau format kode tidak sesuai standar resmi.
                    </p>
                </div>
                <div class="pt-2">
                    <a href="{{ route('verifikasi.index') }}" class="inline-flex items-center gap-1.5 px-5 py-2.5 rounded-xl bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold text-xs transition-colors">
                        <span>Coba Cari Kode Lain</span>
                    </a>
                </div>
            </div>
        @endif
    </div>
</x-layouts.app>
