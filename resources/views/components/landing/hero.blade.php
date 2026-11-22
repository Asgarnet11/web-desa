@props(['data'])

@php
    $profil = $data['profil'] ?? null;
    $statistik = $data['statistik'] ?? [];
    $demografi = $statistik['demografi'] ?? [];
    $wilayah = $data['wilayah'] ?? null;
    $heroBg = $profil?->foto_kantor ?? 'https://images.unsplash.com/photo-1577495508048-b635879837f1?auto=format&fit=crop&w=1600&q=80';
@endphp

<div class="relative bg-white">
    <!-- Hero Banner with Background Image & Gradient Overlay -->
    <section class="relative min-h-[580px] lg:min-h-[640px] flex items-center overflow-hidden bg-[#1B4332]">
        <!-- Full-Width Background Photo -->
        <div class="absolute inset-0 z-0">
            <img src="{{ $heroBg }}" 
                 alt="Gedung Pelayanan Kelurahan Sukawarna" 
                 class="w-full h-full object-cover object-center filter brightness-[0.85] scale-105 transition-transform duration-1000">
            <!-- Deep Forest Green Gradient Overlay -->
            <div class="absolute inset-0 bg-gradient-to-r from-[#143527]/95 via-[#1B4332]/85 to-transparent"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-[#143527] via-transparent to-black/30"></div>
        </div>

        <!-- Slider Navigation Arrows (Visual Reference Fidelity) -->
        <button type="button" aria-label="Slide Sebelumnya" class="hidden sm:flex absolute left-4 lg:left-8 top-1/2 -translate-y-1/2 z-20 w-11 h-11 rounded-full bg-black/30 hover:bg-black/60 border border-white/20 text-white items-center justify-center transition-all backdrop-blur-sm">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
        </button>
        <button type="button" aria-label="Slide Selanjutnya" class="hidden sm:flex absolute right-4 lg:right-8 top-1/2 -translate-y-1/2 z-20 w-11 h-11 rounded-full bg-black/30 hover:bg-black/60 border border-white/20 text-white items-center justify-center transition-all backdrop-blur-sm">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
        </button>

        <!-- Hero Content (Left-Aligned as in Reference) -->
        <div class="relative z-10 max-w-7xl mx-auto px-6 py-20 lg:py-28 w-full pb-32 lg:pb-36">
            <div class="max-w-3xl space-y-6">
                <!-- Small Tagline Badge -->
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-white/10 backdrop-blur-md border border-white/20 text-[#FFB703] text-xs font-bold uppercase tracking-wider">
                    <span class="w-2 h-2 rounded-full bg-[#FFB703] animate-pulse"></span>
                    <span>Portal Resmi Kelurahan Sukawarna &bull; Kota Bandung</span>
                </div>

                <!-- Display Headline with Gold Highlight Word -->
                <h1 class="font-serif font-black text-4xl sm:text-5xl lg:text-6xl text-white leading-[1.12] tracking-tight">
                    Mewujudkan Sukawarna Asri, <br>
                    Membangun <span class="text-[#FFB703] font-serif italic">Masa Depan</span>
                </h1>

                <!-- Subtitle Description -->
                <p class="text-base sm:text-lg text-white/90 leading-relaxed font-normal max-w-2xl">
                    {{ $profil?->slogan ?? 'Di Kelurahan Sukawarna, kami menumbuhkan semangat kebersamaan warga melalui tata kelola digital terpadu, lingkungan lestari, dan pelayanan publik yang prima.' }}
                </p>

                <!-- Dual Action Buttons -->
                <div class="flex flex-wrap items-center gap-4 pt-4">
                    <!-- Primary Gold CTA Button -->
                    <a href="{{ route('layanan.index') }}" class="inline-flex items-center gap-2.5 px-7 py-3.5 bg-[#FFB703] hover:bg-[#e6a503] text-[#1B4332] font-extrabold text-xs sm:text-sm uppercase tracking-wider rounded-md shadow-lg transition-all hover:scale-[1.02] active:scale-[0.99]">
                        <span>LAYANAN WARGA</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </a>

                    <!-- Secondary Transparent / White Border Button -->
                    <a href="{{ route('peta.index') }}" class="inline-flex items-center gap-2.5 px-7 py-3.5 bg-black/25 hover:bg-black/40 border-2 border-white text-white font-extrabold text-xs sm:text-sm uppercase tracking-wider rounded-md backdrop-blur-sm transition-all hover:scale-[1.02]">
                        <span>JELAJAHI PETA WILAYAH</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Slider Pagination Dots -->
            <div class="flex items-center gap-2 pt-10">
                <span class="w-8 h-2 rounded-full bg-[#FFB703]"></span>
                <span class="w-2.5 h-2.5 rounded-full bg-white/40 hover:bg-white/70 transition-colors cursor-pointer"></span>
                <span class="w-2.5 h-2.5 rounded-full bg-white/40 hover:bg-white/70 transition-colors cursor-pointer"></span>
                <span class="w-2.5 h-2.5 rounded-full bg-white/40 hover:bg-white/70 transition-colors cursor-pointer"></span>
            </div>
        </div>
    </section>

    <!-- Signature Overlapping Floating Card Bar (5 Quick Highlights) -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 -mt-14 sm:-mt-16 lg:-mt-20 relative z-30">
        <div class="bg-white rounded-2xl shadow-xl border border-gray-100 p-6 lg:p-7 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-6 divide-y sm:divide-y-0 sm:divide-x divide-gray-100">
            <!-- Item 1: Pelayanan Digital -->
            <div class="flex items-center gap-4 sm:pl-2 pt-2 sm:pt-0">
                <div class="w-12 h-12 rounded-xl bg-[#2D6A4F]/10 text-[#2D6A4F] flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <rect x="2" y="3" width="20" height="14" rx="2" ry="2" stroke-width="2"/>
                        <line x1="8" y1="21" x2="16" y2="21" stroke-width="2"/>
                        <line x1="12" y1="17" x2="12" y2="21" stroke-width="2"/>
                    </svg>
                </div>
                <div>
                    <h4 class="font-bold text-sm text-[#1B4332] leading-tight">Pelayanan Digital</h4>
                    <p class="text-xs text-gray-500 mt-0.5">Surat & lacak mandiri</p>
                </div>
            </div>

            <!-- Item 2: Aparatur Berdedikasi -->
            <div class="flex items-center gap-4 sm:pl-6 pt-4 sm:pt-0">
                <div class="w-12 h-12 rounded-xl bg-[#2D6A4F]/10 text-[#2D6A4F] flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
                <div>
                    <h4 class="font-bold text-sm text-[#1B4332] leading-tight">Aparatur Berdedikasi</h4>
                    <p class="text-xs text-gray-500 mt-0.5">Siap melayani sepenuh hati</p>
                </div>
            </div>

            <!-- Item 3: Siaga Transportasi / Ambulans -->
            <div class="flex items-center gap-4 sm:pl-6 pt-4 sm:pt-0">
                <div class="w-12 h-12 rounded-xl bg-[#2D6A4F]/10 text-[#2D6A4F] flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h8m-8 4h8m-9 8h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM6 17h.01M18 17h.01"/>
                    </svg>
                </div>
                <div>
                    <h4 class="font-bold text-sm text-[#1B4332] leading-tight">Siaga Bencana & Warga</h4>
                    <p class="text-xs text-gray-500 mt-0.5">Tanggap darurat 24 jam</p>
                </div>
            </div>

            <!-- Item 4: Lingkungan Hijau (Buruan Sae) -->
            <div class="flex items-center gap-4 sm:pl-6 pt-4 sm:pt-0">
                <div class="w-12 h-12 rounded-xl bg-[#2D6A4F]/10 text-[#2D6A4F] flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                    </svg>
                </div>
                <div>
                    <h4 class="font-bold text-sm text-[#1B4332] leading-tight">Lingkungan Hijau</h4>
                    <p class="text-xs text-gray-500 mt-0.5">Buruan Sae & bank sampah</p>
                </div>
            </div>

            <!-- Item 5: Fasilitas Terpadu -->
            <div class="flex items-center gap-4 sm:pl-6 pt-4 sm:pt-0">
                <div class="w-12 h-12 rounded-xl bg-[#2D6A4F]/10 text-[#2D6A4F] flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                </div>
                <div>
                    <h4 class="font-bold text-sm text-[#1B4332] leading-tight">Fasilitas Lengkap</h4>
                    <p class="text-xs text-gray-500 mt-0.5">Posyandu & sarana warga</p>
                </div>
            </div>
        </div>
    </div>
</div>
