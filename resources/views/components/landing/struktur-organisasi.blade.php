@props(['data'])

@php
    $perangkatList = $data['perangkat'] ?? collect();
    $profil = $data['profil'] ?? null;
    $officeWatermark = $profil?->foto_kantor ?? 'https://images.unsplash.com/photo-1577495508048-b635879837f1?auto=format&fit=crop&w=1200&q=80';

    $divisiList = [
        [
            'header' => 'Pemerintahan',
            'deskripsi' => 'Pengurusan administrasi kependudukan, KTP, KK, dan perizinan dasar.',
            'kasi' => [
                'role' => 'Kasi Pemerintahan',
                'nama' => 'Budi Santoso, S.Sos',
                'sub' => 'NIP: 19800620 200604 1 012',
                'foto' => 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?auto=format&fit=crop&w=400&q=80',
            ],
            'anggota' => [
                'role' => 'Staf Pelaksana',
                'nama' => 'Abdullah Zubair, S.Ag',
                'sub' => 'Pelayanan Kependudukan',
                'foto' => 'https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?auto=format&fit=crop&w=400&q=80',
            ]
        ],
        [
            'header' => 'Ekonomi & Bang',
            'deskripsi' => 'Pengawasan infrastruktur jalan, drainase, dan fasilitasi izin usaha lokal.',
            'kasi' => [
                'role' => 'Kasi Ekbang',
                'nama' => 'Ahmad Fauzi, S.T',
                'sub' => 'NIP: 19881105 201101 1 003',
                'foto' => 'https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?auto=format&fit=crop&w=400&q=80',
            ],
            'anggota' => [
                'role' => 'Staf Pengawas',
                'nama' => 'Taufik Kurrahman, S.H',
                'sub' => 'Pengawas Pembangunan',
                'foto' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=400&q=80',
            ]
        ],
        [
            'header' => 'Sosial & Kesra',
            'deskripsi' => 'Penyaluran bantuan sosial, jaminan kesehatan, dan pembinaan keagamaan.',
            'kasi' => [
                'role' => 'Kasi Kesos',
                'nama' => 'Dewi Sartika, S.Pd',
                'sub' => 'NIP: 19860925 201001 2 005',
                'foto' => 'https://images.unsplash.com/photo-1580489944761-15a19d654956?auto=format&fit=crop&w=400&q=80',
            ],
            'anggota' => [
                'role' => 'Staf Bantuan',
                'nama' => 'Lalu Yasin, S.H',
                'sub' => 'Penyaluran PKH & Lansia',
                'foto' => 'https://images.unsplash.com/photo-1522075469751-3a6694fb2f61?auto=format&fit=crop&w=400&q=80',
            ]
        ],
        [
            'header' => 'Trantib & Linmas',
            'deskripsi' => 'Ketertiban umum, penanggulangan bencana, dan koordinasi keamanan 24 jam.',
            'kasi' => [
                'role' => 'Kasi Trantib',
                'nama' => 'Hendra Gunawan',
                'sub' => 'NIP: 19780315 200201 1 009',
                'foto' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=400&q=80',
            ],
            'anggota' => [
                'role' => 'Komandan Regu',
                'nama' => 'Adam Lubis, S.Ag',
                'sub' => 'Ketertiban Lingkungan',
                'foto' => 'https://images.unsplash.com/photo-1492562080023-ab3db95bfbce?auto=format&fit=crop&w=400&q=80',
            ]
        ],
        [
            'header' => 'IT & Data Spasial',
            'deskripsi' => 'Pengelolaan portal peta digital kelurahan, sistem pengaduan, dan data GIS.',
            'kasi' => [
                'role' => 'Koordinator IT',
                'nama' => 'Abdil Mahfuzi, S.Ag',
                'sub' => 'NIP: 19910617 201601 1 003',
                'foto' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=400&q=80',
            ],
            'anggota' => [
                'role' => 'Operator SIAK',
                'nama' => 'Hasan Ali, S.H',
                'sub' => 'Pemetaan & Portal Digital',
                'foto' => 'https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?auto=format&fit=crop&w=400&q=80',
            ]
        ],
        [
            'header' => 'Lingkungan Hidup',
            'deskripsi' => 'Program Pekarangan Pangan Lestari, ketahanan pangan rumah tangga, dan tata kelola bank sampah.',
            'kasi' => [
                'role' => 'Koordinator LH',
                'nama' => 'Hj. Wa Ode Hasnah',
                'sub' => 'Lingkungan & Pangan Lestari',
                'foto' => 'https://images.unsplash.com/photo-1544005313-94ddf0286df2?auto=format&fit=crop&w=400&q=80',
            ],
            'anggota' => [
                'role' => 'Bank Sampah',
                'nama' => 'Rohman N., S.Ag',
                'sub' => 'Pengelolaan Sampah',
                'foto' => 'https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?auto=format&fit=crop&w=400&q=80',
            ]
        ],
        [
            'header' => 'Karang Taruna',
            'deskripsi' => 'Wadah kreativitas pemuda, pengembangan olahraga, dan komunikasi media sosial.',
            'kasi' => [
                'role' => 'Ketua Pemuda',
                'nama' => 'Reza Pratama, S.Kom',
                'sub' => 'Kepemudaan Wilayah',
                'foto' => 'https://images.unsplash.com/photo-1522075469751-3a6694fb2f61?auto=format&fit=crop&w=400&q=80',
            ],
            'anggota' => [
                'role' => 'Staf Kreatif',
                'nama' => 'Damu Azrial, S.Kom',
                'sub' => 'Kreativitas & Humas',
                'foto' => 'https://images.unsplash.com/photo-1492562080023-ab3db95bfbce?auto=format&fit=crop&w=400&q=80',
            ]
        ],
    ];
@endphp

<section id="struktur" class="py-20 lg:py-28 bg-[#F4F6F8] overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 space-y-8">
        <!-- Section Title Header -->
        <div class="text-center max-w-3xl mx-auto space-y-2">
            <span class="text-xs font-bold tracking-[0.2em] text-[#FFB703] uppercase block">
                STRUKTUR PEMERINTAHAN WILAYAH
            </span>
            <h2 class="font-serif font-black text-3xl sm:text-4xl text-[#1B4332] tracking-tight">
                Bagan Kepengurusan Kelurahan Konda
            </h2>
            <p class="text-xs sm:text-sm text-gray-600 leading-relaxed">
                Struktur organisasi, pembagian seksi pelayanan, serta tata kerja aparatur sipil negara dan staf kelurahan periode 2025/2026.
            </p>
        </div>

        <!-- Mode Toggle Pill Bar (Seamless Responsive Experience) -->
        <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
            <!-- View Mode Switcher -->
            <div class="inline-flex items-center p-1 rounded-full bg-white border border-gray-200 shadow-xs">
                <button type="button" 
                        onclick="switchStrukturMode('poster')" 
                        id="btn-mode-poster"
                        class="px-4 sm:px-5 py-2 rounded-full text-xs font-bold transition-all duration-200 bg-[#0284C7] text-white shadow-xs">
                    Bagan Pohon Poster (Desktop)
                </button>
                <button type="button" 
                        onclick="switchStrukturMode('card')" 
                        id="btn-mode-card"
                        class="px-4 sm:px-5 py-2 rounded-full text-xs font-bold transition-all duration-200 text-gray-600 hover:text-[#0284C7]">
                    Daftar Kartu Responsif (Ponsel)
                </button>
            </div>

            <!-- Hint on Poster View -->
            <div id="poster-scroll-hint" class="flex items-center gap-2 text-xs text-amber-800 bg-amber-50 px-3.5 py-1.5 rounded-full border border-amber-200">
                <svg class="w-4 h-4 text-amber-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <span>Geser ke samping untuk melihat bagan horizontal secara menyeluruh</span>
            </div>
        </div>

        <!-- 1. POSTER VIEW: Wide Organizational Tree Chart (Reference Image Fidelity) -->
        <div id="struktur-poster-container" class="overflow-x-auto pb-6 pt-2 rounded-3xl shadow-xl border border-gray-200/90 bg-white">
            <div class="relative min-w-[1150px] p-8 lg:p-12 bg-white rounded-3xl overflow-hidden">
                <!-- Faint Watermark Background of Office Building -->
                <div class="absolute inset-0 z-0 pointer-events-none flex items-center justify-center opacity-[0.06]">
                    <img src="{{ $officeWatermark }}" alt="Watermark Kantor Kelurahan" class="w-full h-full object-cover">
                </div>

                <!-- Diagonal Corner Graphic Accents -->
                <div class="absolute bottom-0 right-0 w-36 h-36 bg-gradient-to-tl from-amber-400/20 via-orange-400/10 to-transparent pointer-events-none"></div>
                <div class="absolute top-0 left-0 w-36 h-36 bg-gradient-to-br from-emerald-500/10 via-teal-400/5 to-transparent pointer-events-none"></div>

                <style>
                    @keyframes orgFlowStream {
                        from {
                            stroke-dashoffset: 68;
                        }
                        to {
                            stroke-dashoffset: 0;
                        }
                    }

                    @keyframes orgFlowAdvisory {
                        from {
                            stroke-dashoffset: 36;
                        }
                        to {
                            stroke-dashoffset: 0;
                        }
                    }

                    @keyframes orgNodePulse {
                        0%, 100% {
                            transform: scale(1);
                            opacity: 0.85;
                        }
                        50% {
                            transform: scale(1.35);
                            opacity: 0.35;
                        }
                    }

                    .org-rail-solid {
                        fill: none;
                        stroke: #cbd5e1;
                        stroke-width: 2.5;
                        stroke-linecap: round;
                        stroke-linejoin: round;
                    }

                    .org-flow-stream {
                        fill: none;
                        stroke: url(#orgStreamGrad);
                        stroke-width: 2.5;
                        stroke-linecap: round;
                        stroke-linejoin: round;
                        stroke-dasharray: 14 20;
                        animation: orgFlowStream 2s linear infinite;
                    }

                    .org-rail-advisory {
                        fill: none;
                        stroke: #fbbf24;
                        stroke-opacity: 0.45;
                        stroke-width: 2;
                        stroke-dasharray: 6 6;
                        stroke-linecap: round;
                        stroke-linejoin: round;
                    }

                    .org-flow-advisory {
                        fill: none;
                        stroke: #f59e0b;
                        stroke-width: 2;
                        stroke-dasharray: 6 12;
                        stroke-linecap: round;
                        stroke-linejoin: round;
                        animation: orgFlowAdvisory 2.2s linear infinite;
                    }

                    .org-flow-branch.is-highlighted {
                        stroke: #0284c7;
                        stroke-width: 3.25;
                        filter: drop-shadow(0 0 4px rgba(2, 132, 199, 0.45));
                    }

                    .org-junction-halo {
                        transform-box: fill-box;
                        transform-origin: center;
                        animation: orgNodePulse 2.4s ease-in-out infinite;
                    }

                    @media (prefers-reduced-motion: reduce) {
                        .org-flow-stream,
                        .org-flow-advisory,
                        .org-junction-halo {
                            animation: none !important;
                        }
                    }
                </style>

                <div id="org-tree-canvas" class="relative z-10">
                    <!-- Continuous Animated SVG Connector Layer -->
                    <svg id="org-tree-svg" class="absolute inset-0 w-full h-full pointer-events-none z-0 overflow-visible" aria-hidden="true">
                        <defs>
                            <linearGradient id="orgStreamGrad" gradientUnits="userSpaceOnUse" x1="0" y1="0" x2="0" y2="900">
                                <stop offset="0%" stop-color="#0284C7" />
                                <stop offset="55%" stop-color="#059669" />
                                <stop offset="100%" stop-color="#D97706" />
                            </linearGradient>
                        </defs>
                        <g id="org-tree-paths"></g>
                    </svg>

                    <!-- Top Bar: Banner Header + Advisory Board Boxes + Crest Logo -->
                    <div class="relative z-10 flex items-start justify-between gap-6">
                        <!-- Top Left: Advisory / Pembina & Pengawas Boxes -->
                        <div data-org-anchor="advisory" class="w-64 space-y-2.5">
                            <div class="rounded-xl overflow-hidden border border-amber-300 shadow-sm bg-white">
                                <div class="bg-gradient-to-r from-amber-500 to-orange-500 text-white font-bold text-[10px] uppercase tracking-wider py-1 px-3 text-center">
                                    PEMBINA WILAYAH (CAMAT)
                                </div>
                                <div class="py-2 px-3 text-center bg-amber-50/40">
                                    <div class="font-bold text-xs text-[#0F172A]">Drs. H. Abdul Hakim, M.Si</div>
                                    <span class="text-[9px] text-gray-500 block">Camat Konda &bull; Kab. Konawe Selatan</span>
                                </div>
                            </div>

                            <div class="rounded-xl overflow-hidden border border-amber-300 shadow-sm bg-white">
                                <div class="bg-gradient-to-r from-amber-500 to-orange-500 text-white font-bold text-[10px] uppercase tracking-wider py-1 px-3 text-center">
                                    LEMBAGA PEMBERDAYAAN (LPM)
                                </div>
                                <div class="py-2 px-3 text-center bg-amber-50/40">
                                    <div class="font-bold text-xs text-[#0F172A]">H. La Ode Bakri</div>
                                    <span class="text-[9px] text-gray-500 block">Ketua LPM Kelurahan Konda</span>
                                </div>
                            </div>
                        </div>

                        <!-- Top Center: Main Orange Gradient Header Banner -->
                        <div class="flex-1 max-w-2xl text-center">
                            <div class="inline-block w-full py-3.5 px-8 rounded-2xl bg-gradient-to-r from-orange-500 via-amber-500 to-orange-600 text-white shadow-md border border-amber-300">
                                <h3 class="font-serif font-black text-lg sm:text-xl lg:text-2xl tracking-wider uppercase drop-shadow-sm">
                                    STRUKTUR KEPENGURUSAN KELURAHAN KONDA
                                </h3>
                                <p class="text-xs font-bold text-amber-100 tracking-widest mt-0.5">
                                    KECAMATAN KONDA &bull; KAB. KONAWE SELATAN &bull; TAHUN 2025/2026
                                </p>
                            </div>
                        </div>

                        <!-- Top Right: Kelurahan Logo & Social Handles -->
                        <div class="w-64 flex flex-col items-end text-right space-y-1.5">
                            <div class="flex items-center gap-2.5">
                                <div>
                                    <span class="font-black text-xs text-[#1B4332] block leading-none">KELURAHAN</span>
                                    <span class="font-serif font-black text-sm text-[#FFB703] leading-none">KONDA</span>
                                </div>
                                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-[#1B4332] to-[#2D6A4F] flex items-center justify-center text-[#FFB703] shadow-md border border-[#FFB703]/40">
                                    <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                                        <path d="M12 8v8"/>
                                        <path d="M8 12l4-4 4 4"/>
                                    </svg>
                                </div>
                            </div>
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-gray-100 text-[10px] text-gray-600 font-semibold border border-gray-200">
                                <span>@kelurahankonda</span>
                            </span>
                        </div>
                    </div>

                    <!-- TIER 1: Leadership (Lurah Konda & Sekretaris Kelurahan) -->
                    <div class="relative z-10 flex items-start justify-center gap-32 pt-10">
                        <!-- 1. Lurah Konda (Pimpinan Utama) -->
                        <div class="relative z-10 flex flex-col items-center">
                            <div class="px-3.5 py-0.5 rounded-full bg-orange-500 text-white font-bold text-[10px] uppercase tracking-wider mb-2 shadow-sm">
                                Lurah
                            </div>

                            <div class="relative" data-org-anchor="lurah">
                                <div class="w-24 h-24 rounded-full border-4 border-amber-400 p-1 bg-white shadow-lg overflow-hidden">
                                    <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=400&q=80" 
                                         alt="H. La Ode Muhammad Nasir, S.Sos, M.Si" 
                                         class="w-full h-full object-cover rounded-full">
                                </div>
                                <div class="absolute -bottom-2.5 left-1/2 -translate-x-1/2 bg-[#0284C7] text-white font-serif font-bold text-[11px] uppercase tracking-wide px-3.5 py-0.5 rounded-full shadow-md border-2 border-white whitespace-nowrap">
                                    Lurah Konda
                                </div>
                            </div>

                            <div class="mt-4 text-center bg-white rounded-xl border border-sky-200 p-2 shadow-sm min-w-[200px]">
                                <h4 class="font-serif font-black text-xs text-[#0F172A] leading-tight">
                                    H. La Ode Muhammad Nasir, S.Sos, M.Si
                                </h4>
                                <span class="text-[10px] text-gray-500 font-mono block mt-0.5">NIP: 19750812 200003 1 004</span>
                            </div>
                        </div>

                        <!-- 2. Sekretaris Kelurahan -->
                        <div class="relative z-10 flex flex-col items-center">
                            <div class="px-3.5 py-0.5 rounded-full bg-orange-500 text-white font-bold text-[10px] uppercase tracking-wider mb-2 shadow-sm">
                                Seklur
                            </div>

                            <div class="relative" data-org-anchor="seklur">
                                <div class="w-24 h-24 rounded-full border-4 border-amber-400 p-1 bg-white shadow-lg overflow-hidden">
                                    <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=400&q=80" 
                                         alt="Siti Nurhaliza, S.STP, M.AP" 
                                         class="w-full h-full object-cover rounded-full">
                                </div>
                                <div class="absolute -bottom-2.5 left-1/2 -translate-x-1/2 bg-[#0284C7] text-white font-serif font-bold text-[11px] uppercase tracking-wide px-3.5 py-0.5 rounded-full shadow-md border-2 border-white whitespace-nowrap">
                                    Sekretaris Kelurahan
                                </div>
                            </div>

                            <div class="mt-4 text-center bg-white rounded-xl border border-sky-200 p-2 shadow-sm min-w-[200px]">
                                <h4 class="font-serif font-black text-xs text-[#0F172A] leading-tight">
                                    Siti Nurhaliza, S.STP, M.AP
                                </h4>
                                <span class="text-[10px] text-gray-500 font-mono block mt-0.5">NIP: 19840315 200801 2 006</span>
                            </div>
                        </div>
                    </div>

                    <!-- TIER 2: Sekretariat & Staf Pelaksana Administrasi -->
                    <div class="relative z-10 flex items-center justify-center gap-12 pt-12">
                        <!-- Staf Umum 1 (Left Circular Avatar) -->
                        <div class="relative z-10 w-24 flex flex-col items-center" data-org-anchor="staf1">
                            <div class="w-16 h-16 rounded-full border-2 border-amber-400 p-0.5 bg-white shadow-md overflow-hidden">
                                <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=400&q=80" 
                                     alt="Kafa Birrasyid, S.Ag" 
                                     class="w-full h-full object-cover rounded-full">
                            </div>
                            <span class="text-[10px] font-bold text-gray-700 mt-1 text-center">Staf Pelaksana</span>
                        </div>

                        <!-- Center Box 1: Sekretariat 1 -->
                        <div data-org-anchor="sek1" class="relative z-10 bg-white rounded-xl border border-sky-300 shadow-sm overflow-hidden w-[185px]">
                            <div class="bg-amber-400 text-amber-950 font-bold text-[9px] uppercase tracking-wider py-0.5 px-3 text-center">
                                SEKRETARIAT 1
                            </div>
                            <div class="p-2 bg-[#0284C7] text-white text-center">
                                <div class="font-bold text-xs leading-snug">Kafa Birrasyid, S.Ag</div>
                                <span class="text-[9px] text-sky-100 block">Staf Umum & Kepegawaian</span>
                            </div>
                        </div>

                        <!-- Center Box 2: Sekretariat 2 -->
                        <div data-org-anchor="sek2" class="relative z-10 bg-white rounded-xl border border-sky-300 shadow-sm overflow-hidden w-[185px]">
                            <div class="bg-amber-400 text-amber-950 font-bold text-[9px] uppercase tracking-wider py-0.5 px-3 text-center">
                                SEKRETARIAT 2
                            </div>
                            <div class="p-2 bg-[#0284C7] text-white text-center">
                                <div class="font-bold text-xs leading-snug">Luthfi Abdul Karim, S.Ag</div>
                                <span class="text-[9px] text-sky-100 block">Pengadministrasi Keuangan</span>
                            </div>
                        </div>

                        <!-- Staf Umum 2 (Right Circular Avatar) -->
                        <div class="relative z-10 w-24 flex flex-col items-center" data-org-anchor="staf2">
                            <div class="w-16 h-16 rounded-full border-2 border-amber-400 p-0.5 bg-white shadow-md overflow-hidden">
                                <img src="https://images.unsplash.com/photo-1492562080023-ab3db95bfbce?auto=format&fit=crop&w=400&q=80" 
                                     alt="Luthfi Abdul Karim, S.Ag" 
                                     class="w-full h-full object-cover rounded-full">
                            </div>
                            <span class="text-[10px] font-bold text-gray-700 mt-1 text-center">Staf Pelaksana</span>
                        </div>
                    </div>

                    <!-- TIER 3: The 7 Seksi Divisions -->
                    <div class="relative z-10 pt-14">
                        <div class="grid grid-cols-7 gap-3 relative z-10">
                            @foreach($divisiList as $divIdx => $div)
                                <div class="org-col-group flex flex-col items-center gap-6" data-branch-col="{{ $divIdx }}">
                                    <!-- Orange Division Header Tag -->
                                    <div data-org-anchor="div-{{ $divIdx }}" class="w-full py-1.5 px-1 rounded-lg bg-gradient-to-r from-amber-500 to-orange-500 text-white font-bold text-[10px] text-center uppercase tracking-wider shadow-sm border border-amber-300 transition-transform duration-200 group-hover:scale-[1.03]">
                                        {{ $div['header'] }}
                                    </div>

                                    <!-- Upper Node: Kepala Seksi / Koordinator -->
                                    <div data-org-card="kasi-{{ $divIdx }}" class="flex flex-col items-center text-center w-full">
                                        <div class="relative" data-org-anchor="kasi-{{ $divIdx }}">
                                            <div class="w-16 h-16 rounded-full border-3 border-amber-400 p-0.5 bg-white shadow-md overflow-hidden">
                                                <img src="{{ $div['kasi']['foto'] }}" 
                                                     alt="{{ $div['kasi']['nama'] }}" 
                                                     class="w-full h-full object-cover rounded-full">
                                            </div>
                                            <div class="absolute -bottom-2 left-1/2 -translate-x-1/2 bg-[#0284C7] text-white font-bold text-[9px] uppercase px-2.5 py-0.5 rounded-full border border-white whitespace-nowrap shadow-xs">
                                                Ketua / Kasi
                                            </div>
                                        </div>

                                        <div class="mt-3.5 w-full bg-white rounded-lg border border-sky-200 p-1.5 shadow-xs">
                                            <div class="font-bold text-[11px] text-[#0F172A] leading-tight">
                                                {{ $div['kasi']['nama'] }}
                                            </div>
                                            <span class="text-[9px] text-gray-500 block leading-tight mt-0.5">
                                                {{ $div['kasi']['sub'] }}
                                            </span>
                                        </div>
                                    </div>

                                    <!-- Lower Node: Staf Pelaksana / Anggota -->
                                    <div class="flex flex-col items-center text-center w-full">
                                        <div class="relative" data-org-anchor="anggota-{{ $divIdx }}">
                                            <div class="w-16 h-16 rounded-full border-3 border-amber-400 p-0.5 bg-white shadow-md overflow-hidden">
                                                <img src="{{ $div['anggota']['foto'] }}" 
                                                     alt="{{ $div['anggota']['nama'] }}" 
                                                     class="w-full h-full object-cover rounded-full">
                                            </div>
                                            <div class="absolute -bottom-2 left-1/2 -translate-x-1/2 bg-[#0284C7] text-white font-bold text-[9px] uppercase px-2.5 py-0.5 rounded-full border border-white whitespace-nowrap shadow-xs">
                                                Anggota / Staf
                                            </div>
                                        </div>

                                        <div class="mt-3.5 w-full bg-white rounded-lg border border-sky-200 p-1.5 shadow-xs">
                                            <div class="font-bold text-[11px] text-[#0F172A] leading-tight">
                                                {{ $div['anggota']['nama'] }}
                                            </div>
                                            <span class="text-[9px] text-gray-500 block leading-tight mt-0.5">
                                                {{ $div['anggota']['sub'] }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- 2. MOBILE CARD VIEW: Dedicated Responsive Hierarchy List (Zero Horizontal Pan Required) -->
        <div id="struktur-card-container" class="hidden space-y-8">
            <!-- Level 1: Pimpinan Kelurahan -->
            <div class="bg-white rounded-2xl p-6 border border-gray-200 shadow-sm space-y-4">
                <div class="border-b border-gray-100 pb-3 flex items-center justify-between">
                    <span class="text-xs font-black uppercase tracking-wider text-[#0284C7]">Pimpinan Utama Kelurahan</span>
                    <span class="text-[10px] bg-sky-100 text-[#0284C7] px-2 py-0.5 rounded-full font-bold">Tingkat 1</span>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <!-- Lurah Card -->
                    <div class="flex items-center gap-4 p-4 rounded-xl bg-sky-50/50 border border-sky-100">
                        <div class="relative flex-shrink-0">
                            <div class="w-16 h-16 rounded-full border-2 border-amber-400 p-0.5 bg-white shadow-sm overflow-hidden">
                                <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=400&q=80" 
                                     alt="H. La Ode Muhammad Nasir, S.Sos, M.Si" 
                                     class="w-full h-full object-cover rounded-full">
                            </div>
                            <span class="absolute -bottom-1 left-1/2 -translate-x-1/2 bg-[#0284C7] text-white text-[8px] font-bold uppercase px-2 py-0.5 rounded-full shadow-xs whitespace-nowrap">Lurah</span>
                        </div>
                        <div>
                            <h4 class="font-serif font-black text-sm text-[#0F172A]">H. La Ode Muhammad Nasir, S.Sos, M.Si</h4>
                            <p class="text-[10px] text-gray-500 font-mono mt-0.5">NIP: 19750812 200003 1 004</p>
                            <span class="inline-block mt-1 text-[10px] font-semibold text-[#1B4332] bg-emerald-100/80 px-2 py-0.5 rounded">Kepala Wilayah Kelurahan</span>
                        </div>
                    </div>

                    <!-- Seklur Card -->
                    <div class="flex items-center gap-4 p-4 rounded-xl bg-sky-50/50 border border-sky-100">
                        <div class="relative flex-shrink-0">
                            <div class="w-16 h-16 rounded-full border-2 border-amber-400 p-0.5 bg-white shadow-sm overflow-hidden">
                                <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=400&q=80" 
                                     alt="Siti Nurhaliza, S.STP, M.AP" 
                                     class="w-full h-full object-cover rounded-full">
                            </div>
                            <span class="absolute -bottom-1 left-1/2 -translate-x-1/2 bg-[#0284C7] text-white text-[8px] font-bold uppercase px-2 py-0.5 rounded-full shadow-xs whitespace-nowrap">Seklur</span>
                        </div>
                        <div>
                            <h4 class="font-serif font-black text-sm text-[#0F172A]">Siti Nurhaliza, S.STP, M.AP</h4>
                            <p class="text-[10px] text-gray-500 font-mono mt-0.5">NIP: 19840315 200801 2 006</p>
                            <span class="inline-block mt-1 text-[10px] font-semibold text-[#1B4332] bg-emerald-100/80 px-2 py-0.5 rounded">Sekretaris Kelurahan</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Level 2: Sekretariat & Administrasi -->
            <div class="bg-white rounded-2xl p-6 border border-gray-200 shadow-sm space-y-4">
                <div class="border-b border-gray-100 pb-3 flex items-center justify-between">
                    <span class="text-xs font-black uppercase tracking-wider text-amber-600">Sekretariat & Staf Administrasi</span>
                    <span class="text-[10px] bg-amber-100 text-amber-800 px-2 py-0.5 rounded-full font-bold">Tingkat 2</span>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="flex items-center gap-3.5 p-3 rounded-xl bg-gray-50 border border-gray-100">
                        <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=400&q=80" 
                             alt="Kafa Birrasyid, S.Ag" 
                             class="w-12 h-12 rounded-full border-2 border-amber-400 object-cover flex-shrink-0">
                        <div>
                            <h5 class="font-bold text-xs text-[#0F172A]">Kafa Birrasyid, S.Ag</h5>
                            <p class="text-[10px] text-gray-500">Staf Umum & Kepegawaian</p>
                            <span class="text-[9px] text-[#0284C7] font-semibold">Sekretariat 1</span>
                        </div>
                    </div>

                    <div class="flex items-center gap-3.5 p-3 rounded-xl bg-gray-50 border border-gray-100">
                        <img src="https://images.unsplash.com/photo-1492562080023-ab3db95bfbce?auto=format&fit=crop&w=400&q=80" 
                             alt="Luthfi Abdul Karim, S.Ag" 
                             class="w-12 h-12 rounded-full border-2 border-amber-400 object-cover flex-shrink-0">
                        <div>
                            <h5 class="font-bold text-xs text-[#0F172A]">Luthfi Abdul Karim, S.Ag</h5>
                            <p class="text-[10px] text-gray-500">Pengadministrasi Keuangan</p>
                            <span class="text-[9px] text-[#0284C7] font-semibold">Sekretariat 2</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Level 3: 7 Seksi Pelayanan Warga -->
            <div class="space-y-4">
                <div class="flex items-center justify-between">
                    <h3 class="font-serif font-black text-lg text-[#1B4332]">Seksi Pelayanan & Bidang Kerja (7 Divisi)</h3>
                    <span class="text-xs text-gray-500">Tingkat 3</span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($divisiList as $div)
                        <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden shadow-xs hover:shadow-md transition-shadow">
                            <!-- Division Orange Header Bar -->
                            <div class="bg-gradient-to-r from-amber-500 to-orange-500 px-4 py-2 text-white flex items-center justify-between">
                                <span class="font-black text-xs uppercase tracking-wider">{{ $div['header'] }}</span>
                                <span class="text-[9px] bg-white/20 px-2 py-0.5 rounded-full font-bold">2 Petugas</span>
                            </div>

                            <div class="p-4 space-y-4">
                                <p class="text-[11px] text-gray-600 leading-relaxed border-b border-gray-100 pb-2.5">
                                    {{ $div['deskripsi'] }}
                                </p>

                                <!-- Kasi Item -->
                                <div class="flex items-center gap-3">
                                    <div class="relative flex-shrink-0">
                                        <img src="{{ $div['kasi']['foto'] }}" alt="{{ $div['kasi']['nama'] }}" class="w-11 h-11 rounded-full border-2 border-amber-400 object-cover">
                                        <span class="absolute -bottom-1 -right-1 w-4 h-4 bg-[#0284C7] text-white rounded-full flex items-center justify-center text-[8px] font-bold">K</span>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <span class="text-[10px] font-bold text-[#0284C7] uppercase block">{{ $div['kasi']['role'] }}</span>
                                        <h5 class="font-bold text-xs text-[#0F172A] truncate">{{ $div['kasi']['nama'] }}</h5>
                                        <p class="text-[10px] text-gray-500 font-mono">{{ $div['kasi']['sub'] }}</p>
                                    </div>
                                </div>

                                <!-- Anggota Item -->
                                <div class="flex items-center gap-3 pt-2 border-t border-gray-100/80">
                                    <div class="relative flex-shrink-0">
                                        <img src="{{ $div['anggota']['foto'] }}" alt="{{ $div['anggota']['nama'] }}" class="w-11 h-11 rounded-full border-2 border-sky-300 object-cover">
                                        <span class="absolute -bottom-1 -right-1 w-4 h-4 bg-emerald-600 text-white rounded-full flex items-center justify-center text-[8px] font-bold">A</span>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <span class="text-[10px] font-bold text-emerald-700 uppercase block">{{ $div['anggota']['role'] }}</span>
                                        <h5 class="font-bold text-xs text-[#0F172A] truncate">{{ $div['anggota']['nama'] }}</h5>
                                        <p class="text-[10px] text-gray-500">{{ $div['anggota']['sub'] }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    function drawOrgTreeConnectors() {
        const canvas = document.getElementById('org-tree-canvas');
        const svg = document.getElementById('org-tree-svg');
        const pathsGroup = document.getElementById('org-tree-paths');
        if (!canvas || !svg || !pathsGroup) return;

        const canvasRect = canvas.getBoundingClientRect();
        if (canvasRect.width === 0 || canvasRect.height === 0) return;

        svg.setAttribute('viewBox', `0 0 ${canvasRect.width} ${canvasRect.height}`);

        const measure = (selector) => {
            const el = canvas.querySelector(selector);
            if (!el) return null;
            const r = el.getBoundingClientRect();
            return {
                left: r.left - canvasRect.left,
                right: r.right - canvasRect.left,
                top: r.top - canvasRect.top,
                bottom: r.bottom - canvasRect.top,
                cx: (r.left + r.right) / 2 - canvasRect.left,
                cy: (r.top + r.bottom) / 2 - canvasRect.top,
                w: r.width,
                h: r.height,
            };
        };

        const advisory = measure('[data-org-anchor="advisory"]');
        const lurah = measure('[data-org-anchor="lurah"]');
        const seklur = measure('[data-org-anchor="seklur"]');
        const staf1 = measure('[data-org-anchor="staf1"]');
        const sek1 = measure('[data-org-anchor="sek1"]');
        const sek2 = measure('[data-org-anchor="sek2"]');
        const staf2 = measure('[data-org-anchor="staf2"]');

        if (!lurah || !seklur || !sek1 || !sek2) return;

        const ns = 'http://www.w3.org/2000/svg';
        pathsGroup.innerHTML = '';

        const addPath = (d, railClass, flowClass, branchId = null) => {
            const rail = document.createElementNS(ns, 'path');
            rail.setAttribute('d', d);
            rail.setAttribute('class', railClass);
            pathsGroup.appendChild(rail);

            const flow = document.createElementNS(ns, 'path');
            flow.setAttribute('d', d);
            flow.setAttribute('class', flowClass);
            if (branchId !== null) {
                flow.dataset.branch = String(branchId);
            }
            pathsGroup.appendChild(flow);
        };

        const addJunction = (x, y, color = '#0284C7') => {
            const halo = document.createElementNS(ns, 'circle');
            halo.setAttribute('cx', x);
            halo.setAttribute('cy', y);
            halo.setAttribute('r', '6');
            halo.setAttribute('fill', color);
            halo.setAttribute('fill-opacity', '0.22');
            halo.setAttribute('class', 'org-junction-halo');
            pathsGroup.appendChild(halo);

            const dot = document.createElementNS(ns, 'circle');
            dot.setAttribute('cx', x);
            dot.setAttribute('cy', y);
            dot.setAttribute('r', '3.5');
            dot.setAttribute('fill', color);
            dot.setAttribute('stroke', '#FFFFFF');
            dot.setAttribute('stroke-width', '1.5');
            pathsGroup.appendChild(dot);
        };

        const roundedElbow = (x1, y1, x2, y2, r = 10) => {
            const dx = x2 - x1;
            const dy = y2 - y1;
            const sx = dx >= 0 ? 1 : -1;
            const sy = dy >= 0 ? 1 : -1;
            const cr = Math.min(r, Math.abs(dx) / 2, Math.abs(dy) / 2);
            if (cr <= 0) {
                return `M ${x1} ${y1} L ${x2} ${y1} L ${x2} ${y2}`;
            }
            return `M ${x1} ${y1} L ${x2 - sx * cr} ${y1} Q ${x2} ${y1} ${x2} ${y1 + sy * cr} L ${x2} ${y2}`;
        };

        const tier1Y = (lurah.cy + seklur.cy) / 2;
        const commandMidX = (lurah.cx + seklur.cx) / 2;

        // 0. Advisory (Camat & LPM) dashed coordination path to Tier 1 Command Axis
        if (advisory) {
            const elbowY = Math.min(advisory.bottom + 18, lurah.top - 18);
            const advD = `M ${advisory.cx} ${advisory.bottom} L ${advisory.cx} ${elbowY - 10} Q ${advisory.cx} ${elbowY} ${advisory.cx + 10} ${elbowY} L ${commandMidX - 10} ${elbowY} Q ${commandMidX} ${elbowY} ${commandMidX} ${elbowY + 10} L ${commandMidX} ${tier1Y}`;
            addPath(advD, 'org-rail-advisory', 'org-flow-advisory');
            addJunction(advisory.cx, advisory.bottom, '#F59E0B');
        }

        // 1. Tier 1 Coordination Line (Lurah <-> Seklur)
        addPath(`M ${lurah.cx} ${tier1Y} L ${seklur.cx} ${tier1Y}`, 'org-rail-solid', 'org-flow-stream');

        // 2. Central Trunk from Tier 1 Junction down through Tier 2 to Tier 3 Distribution Bus
        const tier2BusY = Math.min(sek1.top, sek2.top) - 22;
        const tier2RowY = (sek1.cy + sek2.cy) / 2;
        const divNodes = [];
        for (let i = 0; i < 7; i++) {
            const dNode = measure(`[data-org-anchor="div-${i}"]`);
            const kAvatar = measure(`[data-org-anchor="kasi-${i}"]`);
            const kCard = measure(`[data-org-card="kasi-${i}"]`);
            const aAvatar = measure(`[data-org-anchor="anggota-${i}"]`);
            if (dNode && kAvatar && kCard && aAvatar) {
                divNodes.push({ i, dNode, kAvatar, kCard, aAvatar });
            }
        }

        const tier3BusY = divNodes.length ? divNodes[0].dNode.top - 26 : tier2RowY + 70;

        // Continuous central vertical command spine
        addPath(`M ${commandMidX} ${tier1Y} L ${commandMidX} ${tier3BusY}`, 'org-rail-solid', 'org-flow-stream');
        addJunction(commandMidX, tier1Y, '#0284C7');

        // Tier 2 branching to Sekretariat 1 & 2 + Horizontal link to Staf Pelaksana
        addPath(roundedElbow(commandMidX, tier2BusY, sek1.cx, sek1.top, 8), 'org-rail-solid', 'org-flow-stream');
        addPath(roundedElbow(commandMidX, tier2BusY, sek2.cx, sek2.top, 8), 'org-rail-solid', 'org-flow-stream');
        addJunction(commandMidX, tier2BusY, '#059669');

        if (staf1 && staf2) {
            addPath(`M ${sek1.left} ${tier2RowY} L ${staf1.cx} ${tier2RowY}`, 'org-rail-solid', 'org-flow-stream');
            addPath(`M ${sek2.right} ${tier2RowY} L ${staf2.cx} ${tier2RowY}`, 'org-rail-solid', 'org-flow-stream');
        }

        // 3. Tier 3 Distribution Bus -> 7 Seksi Columns & Continuous Column Stems
        if (divNodes.length) {
            addJunction(commandMidX, tier3BusY, '#F59E0B');

            divNodes.forEach(({ i, dNode, kAvatar, kCard, aAvatar }) => {
                // Distribution branch from center spine to Division header top
                const distD = Math.abs(dNode.cx - commandMidX) < 2
                    ? `M ${commandMidX} ${tier3BusY} L ${dNode.cx} ${dNode.top}`
                    : roundedElbow(commandMidX, tier3BusY, dNode.cx, dNode.top, 9);
                addPath(distD, 'org-rail-solid', 'org-flow-stream org-flow-branch', i);

                // Vertical stem: Division Header bottom -> Kasi Avatar center
                addPath(`M ${dNode.cx} ${dNode.bottom} L ${kAvatar.cx} ${kAvatar.cy}`, 'org-rail-solid', 'org-flow-stream org-flow-branch', i);

                // Vertical stem: Kasi Card bottom -> Anggota Avatar center
                addPath(`M ${kCard.cx} ${kCard.bottom} L ${aAvatar.cx} ${aAvatar.cy}`, 'org-rail-solid', 'org-flow-stream org-flow-branch', i);
            });
        }
    }

    function switchStrukturMode(mode) {
        const posterContainer = document.getElementById('struktur-poster-container');
        const cardContainer = document.getElementById('struktur-card-container');
        const btnPoster = document.getElementById('btn-mode-poster');
        const btnCard = document.getElementById('btn-mode-card');
        const scrollHint = document.getElementById('poster-scroll-hint');

        if (mode === 'poster') {
            if (posterContainer) posterContainer.classList.remove('hidden');
            if (cardContainer) cardContainer.classList.add('hidden');
            if (scrollHint) scrollHint.classList.remove('hidden');

            if (btnPoster) {
                btnPoster.classList.add('bg-[#0284C7]', 'text-white', 'shadow-xs');
                btnPoster.classList.remove('text-gray-600');
            }
            if (btnCard) {
                btnCard.classList.remove('bg-[#0284C7]', 'text-white', 'shadow-xs');
                btnCard.classList.add('text-gray-600');
            }

            requestAnimationFrame(() => drawOrgTreeConnectors());
        } else {
            if (posterContainer) posterContainer.classList.add('hidden');
            if (cardContainer) cardContainer.classList.remove('hidden');
            if (scrollHint) scrollHint.classList.add('hidden');

            if (btnCard) {
                btnCard.classList.add('bg-[#0284C7]', 'text-white', 'shadow-xs');
                btnCard.classList.remove('text-gray-600');
            }
            if (btnPoster) {
                btnPoster.classList.remove('bg-[#0284C7]', 'text-white', 'shadow-xs');
                btnPoster.classList.add('text-gray-600');
            }
        }
    }

    // Auto-detect mobile screen on load & redraw SVG connectors smoothly
    document.addEventListener('DOMContentLoaded', () => {
        if (window.innerWidth < 1024) {
            switchStrukturMode('card');
        } else {
            switchStrukturMode('poster');
        }

        const canvas = document.getElementById('org-tree-canvas');
        if (canvas && typeof ResizeObserver !== 'undefined') {
            new ResizeObserver(() => requestAnimationFrame(drawOrgTreeConnectors)).observe(canvas);
        }

        if (document.fonts && document.fonts.ready) {
            document.fonts.ready.then(() => requestAnimationFrame(drawOrgTreeConnectors));
        }

        document.querySelectorAll('.org-col-group').forEach((col) => {
            const branchId = col.dataset.branchCol;
            col.addEventListener('mouseenter', () => {
                document.querySelectorAll(`.org-flow-branch[data-branch="${branchId}"]`).forEach((p) => p.classList.add('is-highlighted'));
            });
            col.addEventListener('mouseleave', () => {
                document.querySelectorAll(`.org-flow-branch[data-branch="${branchId}"]`).forEach((p) => p.classList.remove('is-highlighted'));
            });
        });

        window.addEventListener('resize', () => requestAnimationFrame(drawOrgTreeConnectors));
    });
</script>
