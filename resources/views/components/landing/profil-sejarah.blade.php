@props(['data'])

@php
    $profil = $data['profil'] ?? null;
    $wilayah = $data['wilayah'] ?? null;
    $statistik = $data['statistik'] ?? [];
    $demografi = $statistik['demografi'] ?? [];
    $officePhoto = $profil?->foto_kantor ?? 'https://images.unsplash.com/photo-1577495508048-b635879837f1?auto=format&fit=crop&w=1000&q=80';
@endphp

<section id="profil" class="py-20 lg:py-28 bg-[#FDFDFC]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-center">
            <!-- Left Column: Framed Image (Visual Reference Fidelity) -->
            <div class="lg:col-span-6">
                <div class="relative group">
                    <!-- Subtle background decoration shadow -->
                    <div class="absolute -inset-2 bg-gradient-to-r from-[#2D6A4F]/20 to-[#FFB703]/20 rounded-3xl blur-lg opacity-70 group-hover:opacity-100 transition duration-500"></div>
                    
                    <div class="relative rounded-2xl overflow-hidden border border-gray-200/80 shadow-lg bg-gray-100 aspect-[4/3]">
                        <img src="{{ $officePhoto }}" 
                             alt="Kantor Kelurahan Konda dan Kebersamaan Warga" 
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                    </div>

                    <!-- Small floating badge at bottom left -->
                    <div class="absolute -bottom-5 left-6 bg-white/95 backdrop-blur-md px-4 py-2.5 rounded-xl border border-gray-200 shadow-md flex items-center gap-2.5">
                        <span class="w-3 h-3 rounded-full bg-emerald-500 animate-ping"></span>
                        <span class="text-xs font-bold text-[#1B4332]">Pelayanan Aktif &middot; Senin &ndash; Jumat</span>
                    </div>
                </div>
            </div>

            <!-- Right Column: Welcome Description & Key Stats -->
            <div class="lg:col-span-6 space-y-6">
                <!-- Golden Subtitle Badge -->
                <span class="text-xs font-bold tracking-[0.2em] text-[#FFB703] uppercase block">
                    SELAMAT DATANG DI
                </span>

                <!-- Section Heading -->
                <h2 class="font-serif font-black text-3xl sm:text-4xl text-[#1B4332] leading-tight tracking-tight">
                    Kelurahan Konda
                </h2>

                <!-- Descriptive Lead Paragraphs -->
                <p class="text-sm sm:text-base text-gray-600 leading-relaxed">
                    {{ $profil?->sejarah ?? 'Kelurahan Konda merupakan pusat pemerintahan Kecamatan Konda di Kabupaten Konawe Selatan, Sulawesi Tenggara, yang berdedikasi membangun masyarakat rukun dan mandiri. Kami memadukan keterbukaan data spasial dengan semangat gotong royong warga demi kemajuan wilayah yang berkelanjutan.' }}
                </p>

                <p class="text-xs sm:text-sm text-gray-500 leading-relaxed">
                    Dengan luas wilayah yang strategis dan keberagaman potensi lokal, kami senantiasa mengedepankan pelayanan prima berprinsip CERIA (Cepat, Efisien, Ramah, Ikhlas, dan Akuntabel) untuk seluruh lapisan masyarakat.
                </p>

                <!-- Key Metrics Row (4 Metrics in a Row with Icons) -->
                <div class="pt-4 grid grid-cols-2 sm:grid-cols-4 gap-4 border-t border-b border-gray-100 py-6">
                    <!-- Metric 1: Kode Kemendagri -->
                    <div class="space-y-1">
                        <div class="text-[#2D6A4F]">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                            </svg>
                        </div>
                        <div class="font-serif font-black text-lg text-[#1B4332]">74.05.07</div>
                        <div class="text-[11px] text-gray-500 leading-tight">Kode Wilayah</div>
                    </div>

                    <!-- Metric 2: Pamong Ratio -->
                    <div class="space-y-1">
                        <div class="text-[#2D6A4F]">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                            </svg>
                        </div>
                        <div class="font-serif font-black text-lg text-[#1B4332]">14 RT / 7 RW</div>
                        <div class="text-[11px] text-gray-500 leading-tight">Rasio Pamong Wilayah</div>
                    </div>

                    <!-- Metric 3: Pengabdian -->
                    <div class="space-y-1">
                        <div class="text-[#2D6A4F]">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div class="font-serif font-black text-lg text-[#1B4332]">40+ Tahun</div>
                        <div class="text-[11px] text-gray-500 leading-tight">Dedikasi Pengabdian</div>
                    </div>

                    <!-- Metric 4: Komitmen Pelayanan -->
                    <div class="space-y-1">
                        <div class="text-[#2D6A4F]">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div class="font-serif font-black text-lg text-[#1B4332]">100%</div>
                        <div class="text-[11px] text-gray-500 leading-tight">Layanan Bebas Biaya</div>
                    </div>
                </div>

                <!-- CTA Button (Deep Forest Green) -->
                <div class="pt-2">
                    <a href="#program" class="inline-flex items-center gap-2.5 px-6 py-3.5 bg-[#1B4332] hover:bg-[#2D6A4F] text-white font-extrabold text-xs uppercase tracking-wider rounded-md shadow-md transition-all hover:scale-[1.02]">
                        <span>BACA PROFIL LENGKAP</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
