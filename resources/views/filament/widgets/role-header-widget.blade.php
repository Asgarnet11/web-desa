<div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-[#143527] via-[#1B4332] to-[#2D6A4F] text-white p-6 sm:p-7 shadow-xl border border-white/10 mb-4">
    <!-- Subtle Background Radial Pattern -->
    <div class="absolute -right-10 -bottom-10 w-64 h-64 rounded-full bg-[#FFB703]/10 blur-3xl pointer-events-none"></div>

    <div class="relative z-10 flex flex-col lg:flex-row lg:items-center justify-between gap-6">
        <!-- User & Role Profile Greeting -->
        <div class="space-y-3 max-w-3xl">
            <div class="flex flex-wrap items-center gap-2.5">
                <!-- Role Tag Badge -->
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold border backdrop-blur-md {{ $roleBadge['bg'] }}">
                    <span>{{ $roleBadge['icon'] }}</span>
                    <span>{{ $roleBadge['label'] }}</span>
                </span>

                <span class="text-white/40">&bull;</span>
                <span class="text-xs text-white/80 font-medium">
                    Pemerintah Kelurahan Sukawarna &bull; Kota Bandung
                </span>
            </div>

            <div>
                <h1 class="font-serif font-black text-xl sm:text-2xl lg:text-3xl tracking-tight text-white leading-tight">
                    Selamat Bertugas, <span class="text-[#FFB703]">{{ $user->name }}</span>
                </h1>
                <p class="text-xs sm:text-sm text-white/85 leading-relaxed mt-1.5">
                    {{ $roleDescription }}
                </p>
            </div>

            <!-- Operational Alerts / Attention Counters for Operator & Pimpinan -->
            @if($user->isOperator() || $user->isPimpinan())
                <div class="flex flex-wrap items-center gap-2 pt-1">
                    @if($pendingPengaduan > 0)
                        <a href="/admin/pengaduans" class="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg bg-amber-500/20 text-amber-300 border border-amber-400/40 text-xs font-bold hover:bg-amber-500/30 transition-colors">
                            <span class="w-2 h-2 rounded-full bg-amber-400 animate-ping"></span>
                            <span>{{ $pendingPengaduan }} Tiket Pengaduan Butuh Verifikasi</span>
                            <span class="text-[10px]">&rarr;</span>
                        </a>
                    @else
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-lg bg-emerald-500/20 text-emerald-300 border border-emerald-400/30 text-xs font-medium">
                            <span>✓ Semua Tiket Pengaduan Tertangani</span>
                        </span>
                    @endif

                    @if($pendingUmkm > 0)
                        <a href="/admin/umkms" class="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg bg-sky-500/20 text-sky-300 border border-sky-400/40 text-xs font-bold hover:bg-sky-500/30 transition-colors">
                            <span>🛍️ {{ $pendingUmkm }} UMKM Menunggu Kurasi</span>
                            <span class="text-[10px]">&rarr;</span>
                        </a>
                    @endif
                </div>
            @endif
        </div>

        <!-- Date & Quick Shortcuts Capsule -->
        <div class="flex flex-col sm:flex-row lg:flex-col items-start lg:items-end justify-between gap-3 flex-shrink-0 border-t lg:border-t-0 lg:border-l border-white/15 pt-4 lg:pt-0 lg:pl-6">
            <div class="text-left lg:text-right">
                <span class="text-[11px] text-white/60 uppercase tracking-wider block font-bold">Waktu Operasional:</span>
                <span class="text-xs sm:text-sm font-bold text-white block mt-0.5">
                    {{ now()->translatedFormat('l, d F Y') }}
                </span>
                <span class="text-[11px] text-emerald-300 font-medium inline-flex items-center gap-1 mt-0.5">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                    <span>Sistem Siaga Melayani</span>
                </span>
            </div>

            <div class="flex items-center gap-2">
                <a href="/peta" target="_blank" rel="noopener noreferrer" 
                   class="px-3 py-1.5 rounded-xl bg-white/10 hover:bg-white/20 border border-white/20 text-white text-xs font-bold backdrop-blur-md transition-all flex items-center gap-1.5">
                    <svg class="w-3.5 h-3.5 text-[#FFB703]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/></svg>
                    <span>Peta GIS</span>
                </a>
                <a href="/" target="_blank" rel="noopener noreferrer" 
                   class="px-3 py-1.5 rounded-xl bg-[#FFB703] hover:bg-[#e5a502] text-[#1B4332] text-xs font-black uppercase tracking-wider transition-all flex items-center gap-1.5 shadow-md">
                    <span>Portal Publik</span>
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </a>
            </div>
        </div>
    </div>
</div>
