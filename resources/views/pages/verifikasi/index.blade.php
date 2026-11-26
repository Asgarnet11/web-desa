<x-layouts.app :title="'Pencarian Verifikasi Dokumen - Kelurahan Sukawarna'">
    <div class="max-w-xl mx-auto px-4 sm:px-6 py-16 space-y-8">
        <div class="text-center space-y-2">
            <span class="text-xs font-bold text-[#FFB703] uppercase tracking-wider block">Validasi Dokumen Digital</span>
            <h1 class="font-serif font-black text-2xl sm:text-3xl text-[#1B4332] tracking-tight">
                Pemeriksaan Keaslian Dokumen
            </h1>
            <p class="text-xs sm:text-sm text-gray-500 max-w-md mx-auto leading-relaxed">
                Masukkan kode verifikasi dokumen resmi atau nomor pra-validasi loket yang tertera pada lembar dokumen Anda.
            </p>
        </div>

        <div class="bg-white rounded-3xl p-6 sm:p-8 border border-gray-200/90 shadow-md space-y-4">
            <form action="{{ route('verifikasi.index') }}" method="GET" class="space-y-4">
                <div class="space-y-1.5">
                    <label class="block text-xs font-bold text-[#1B4332]">Nomor / Kode Dokumen *</label>
                    <input type="text" 
                           name="kode" 
                           required 
                           placeholder="Contoh: FAST-SKW-2026-98213 atau SK-SKW-2026-..." 
                           class="w-full px-4 py-3 rounded-2xl border border-gray-300 focus:border-[#2D6A4F] focus:ring-2 focus:ring-emerald-100 text-xs font-mono uppercase outline-none">
                </div>

                <button type="submit" class="w-full py-3 bg-[#1B4332] hover:bg-[#2D6A4F] text-[#FFB703] font-bold text-xs uppercase tracking-wider rounded-2xl shadow-sm transition-transform hover:scale-[1.01] active:scale-[0.99]">
                    Periksa Keaslian Dokumen
                </button>
            </form>

            <div class="p-3.5 rounded-2xl bg-[#FFF8E7] border border-amber-200/60 text-[11px] text-gray-600 space-y-1">
                <strong class="text-[#1B4332] block">Petunjuk Verifikasi:</strong>
                <p>Kode dokumen dapat ditemukan tepat di bawah QR-Code resmi atau pada kolom KODE VALIDASI lembar surat kelurahan.</p>
            </div>
        </div>
    </div>
</x-layouts.app>
