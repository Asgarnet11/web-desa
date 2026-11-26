@props(['data'])

@php
    $profil = $data['profil'] ?? null;
    $communityPhoto = 'https://images.unsplash.com/photo-1529156069898-49953e39b3ac?auto=format&fit=crop&w=800&q=80';
@endphp

<section id="program" class="py-20 lg:py-28 bg-[#F4F6F4]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <!-- Section Header -->
        <div class="mb-14">
            <span class="text-xs font-bold tracking-[0.2em] text-[#FFB703] uppercase block mb-1">
                PROGRAM PRIORITAS & NILAI UTAMA
            </span>
            <h2 class="font-serif font-black text-3xl sm:text-4xl text-[#1B4332] tracking-tight">
                Gotong Royong. Mandiri. Lestari.
            </h2>
        </div>

        <!-- Asymmetrical Grid: 4 Cards on Left, Organic Framed Photo on Right -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-12 items-center">
            <!-- Left Side: 4 Structured Cards (2x2 Grid) -->
            <div class="lg:col-span-7 grid grid-cols-1 sm:grid-cols-2 gap-5">
                <!-- Card 1: Edukasi & Literasi -->
                <div class="bg-white rounded-2xl p-6 border border-gray-200/80 shadow-sm hover:shadow-md transition-shadow flex flex-col justify-between text-center sm:text-left">
                    <div class="space-y-4">
                        <div class="w-12 h-12 rounded-xl bg-[#2D6A4F]/10 text-[#2D6A4F] flex items-center justify-center mx-auto sm:mx-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                        </div>
                        <h3 class="font-serif font-bold text-base text-[#1B4332]">
                            Edukasi & Literasi Warga
                        </h3>
                        <p class="text-xs text-gray-500 leading-relaxed">
                            Pojok baca digital, bimbingan belajar komunitas, dan pelatihan keterampilan pemuda untuk generasi berdaya.
                        </p>
                    </div>
                </div>

                <!-- Card 2: Pelayanan Prima -->
                <div class="bg-white rounded-2xl p-6 border border-gray-200/80 shadow-sm hover:shadow-md transition-shadow flex flex-col justify-between text-center sm:text-left">
                    <div class="space-y-4">
                        <div class="w-12 h-12 rounded-xl bg-[#2D6A4F]/10 text-[#2D6A4F] flex items-center justify-center mx-auto sm:mx-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                        <h3 class="font-serif font-bold text-base text-[#1B4332]">
                            Pelayanan Prima & Ramah
                        </h3>
                        <p class="text-xs text-gray-500 leading-relaxed">
                            Pengurusan dokumen kependudukan cepat, layanan jemput bola bagi lansia dan disabilitas, serta bebas pungutan.
                        </p>
                    </div>
                </div>

                <!-- Card 3: Inovasi Lingkungan Hijau -->
                <div class="bg-white rounded-2xl p-6 border border-gray-200/80 shadow-sm hover:shadow-md transition-shadow flex flex-col justify-between text-center sm:text-left">
                    <div class="space-y-4">
                        <div class="w-12 h-12 rounded-xl bg-[#2D6A4F]/10 text-[#2D6A4F] flex items-center justify-center mx-auto sm:mx-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                            </svg>
                        </div>
                        <h3 class="font-serif font-bold text-base text-[#1B4332]">
                            Inovasi Lingkungan Hijau
                        </h3>
                        <p class="text-xs text-gray-500 leading-relaxed">
                            Pekarangan Pangan Lestari di tiap RW, pengelolaan bank sampah terpadu, dan penjagaan drainase bebas sumbatan.
                        </p>
                    </div>
                </div>

                <!-- Card 4: UMKM & Ekonomi Mandiri -->
                <div class="bg-white rounded-2xl p-6 border border-gray-200/80 shadow-sm hover:shadow-md transition-shadow flex flex-col justify-between text-center sm:text-left">
                    <div class="space-y-4">
                        <div class="w-12 h-12 rounded-xl bg-[#2D6A4F]/10 text-[#2D6A4F] flex items-center justify-center mx-auto sm:mx-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <h3 class="font-serif font-bold text-base text-[#1B4332]">
                            Pemberdayaan UMKM Lokal
                        </h3>
                        <p class="text-xs text-gray-500 leading-relaxed">
                            Dukungan legalitas NIB, pelatihan pemasaran online, kemasan produk higienis, dan bazar ekonomi kreatif warga.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Right Side: Organic Framed Photo with Badge Ribbon (Fidelity to Reference) -->
            <div class="lg:col-span-5 flex flex-col items-center">
                <div class="relative w-full max-w-sm">
                    <!-- Photo Container with Organic Curved Frame -->
                    <div class="rounded-3xl overflow-hidden border-4 border-white shadow-xl aspect-square bg-gray-100">
                        <img src="{{ $communityPhoto }}" 
                             alt="Kebersamaan dan Harmoni Warga Konda" 
                             class="w-full h-full object-cover">
                    </div>

                    <!-- Attached Dark Green Ribbon / Badge Bar -->
                    <div class="bg-[#143527] text-white text-center py-4 px-6 rounded-2xl -mt-8 relative z-10 shadow-lg border-2 border-white/80">
                        <h4 class="font-serif font-bold text-base text-[#FFB703]">
                            Harmoni Komunitas Warga
                        </h4>
                        <p class="text-xs text-white/80 mt-0.5 font-medium">
                            Gotong Royong &bull; Guyub &bull; Berkelanjutan
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
