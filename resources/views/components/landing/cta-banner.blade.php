@props(['data'])

<section class="py-8 bg-transparent">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <!-- Full-Width Dark Forest Green Banner (Reference Fidelity) -->
        <div class="bg-[#143527] rounded-2xl p-6 sm:p-8 lg:p-10 shadow-xl border border-[#2D6A4F] flex flex-col lg:flex-row items-center justify-between gap-6 lg:gap-8">
            <!-- Left: Gold Crest Icon + Headline -->
            <div class="flex items-center gap-5 sm:gap-6 w-full lg:w-auto">
                <div class="w-14 h-14 sm:w-16 sm:h-16 rounded-xl bg-white/10 border border-white/20 flex items-center justify-center text-[#FFB703] flex-shrink-0 shadow-inner">
                    <svg class="w-8 h-8 sm:w-10 sm:h-10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                        <path d="M12 8v8"/>
                        <path d="M8 12l4-4 4 4"/>
                    </svg>
                </div>
                <div>
                    <span class="text-xs font-extrabold uppercase tracking-widest text-[#FFB703] block mb-0.5">
                        LAYANAN RESPON CEPAT
                    </span>
                    <h3 class="font-serif font-black text-xl sm:text-2xl lg:text-3xl text-white leading-tight">
                        Pusat Aspirasi & Pengaduan Warga 2026
                    </h3>
                </div>
            </div>

            <!-- Middle Text (Separated by Divider on Desktop) -->
            <div class="lg:border-l lg:border-white/20 lg:pl-8 text-xs sm:text-sm text-white/80 leading-relaxed max-w-md w-full lg:w-auto">
                Laporkan kendala fasilitas umum, drainase, kebersihan lingkungan, atau permohonan layanan publik. Tim kelurahan siap menindaklanjuti dengan nomor tracking resmi.
            </div>

            <!-- Right: Prominent Gold Action Button -->
            <div class="w-full sm:w-auto flex-shrink-0">
                <a href="{{ route('pengaduan.index') }}" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-8 py-4 bg-[#FFB703] hover:bg-[#e6a503] text-[#1B4332] font-black text-xs uppercase tracking-wider rounded-lg shadow-lg hover:scale-105 active:scale-95 transition-all">
                    <span>SAMPAIKAN LAPORAN</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</section>
