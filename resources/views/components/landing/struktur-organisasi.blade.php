@props(['data'])

@php
    $perangkatList = $data['perangkat'] ?? collect();
    $profil = $data['profil'] ?? null;
    $officeWatermark = $profil?->foto_kantor ?? 'https://images.unsplash.com/photo-1577495508048-b635879837f1?auto=format&fit=crop&w=1200&q=80';
@endphp

<section id="struktur" class="py-20 lg:py-28 bg-[#F4F6F8] overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 space-y-8">
        <!-- Section Title Header -->
        <div class="text-center max-w-3xl mx-auto space-y-2">
            <span class="text-xs font-bold tracking-[0.2em] text-[#FFB703] uppercase block">
                STRUKTUR PEMERINTAHAN WILAYAH
            </span>
            <h2 class="font-serif font-black text-3xl sm:text-4xl text-[#1B4332] tracking-tight">
                Bagan Kepengurusan Kelurahan Sukawarna
            </h2>
            <p class="text-xs sm:text-sm text-gray-600 leading-relaxed">
                Struktur organisasi, pembagian seksi pelayanan, serta tata kerja aparatur sipil negara dan staf kelurahan periode 2025/2026.
            </p>
        </div>

        <!-- Mode Toggle & Scroll Hint (UX Friendly) -->
        <div class="flex items-center justify-between gap-4 text-xs">
            <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-amber-50 border border-amber-200 text-amber-900 font-medium">
                <svg class="w-4 h-4 text-amber-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <span>Geser horizontal untuk menjelajahi bagan lengkap bagan kepengurusan</span>
            </div>

            <button type="button" 
                    onclick="document.getElementById('org-chart-wrapper').scrollLeft += 250" 
                    class="hidden sm:inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg border border-gray-300 bg-white hover:bg-gray-50 text-gray-700 font-bold shadow-xs">
                <span>Geser Bagan</span>
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </button>
        </div>

        <!-- Poster-Style Organizational Chart Frame (Matching Reference Image) -->
        <div id="org-chart-wrapper" class="overflow-x-auto pb-6 pt-2 rounded-3xl shadow-xl border border-gray-200/90 bg-white">
            <div class="relative min-w-[1150px] p-8 lg:p-12 bg-white rounded-3xl overflow-hidden">
                <!-- Faint Watermark Background of Office Building (Reference Fidelity) -->
                <div class="absolute inset-0 z-0 pointer-events-none flex items-center justify-center opacity-[0.07]">
                    <img src="{{ $officeWatermark }}" alt="Watermark Kantor Kelurahan" class="w-full h-full object-cover">
                </div>

                <!-- Diagonal Corner Graphic Accents (Bottom Right / Left Reference Motifs) -->
                <div class="absolute bottom-0 right-0 w-36 h-36 bg-gradient-to-tl from-amber-400/20 via-orange-400/10 to-transparent pointer-events-none"></div>
                <div class="absolute top-0 left-0 w-36 h-36 bg-gradient-to-br from-emerald-500/10 via-teal-400/5 to-transparent pointer-events-none"></div>

                <div class="relative z-10 space-y-12">
                    <!-- Top Bar: Banner Header + Advisory Board Boxes + Crest Logo -->
                    <div class="flex items-start justify-between gap-6">
                        <!-- Top Left: Advisory / Pembina & Pengawas Boxes -->
                        <div class="w-64 space-y-2.5">
                            <!-- Box 1: Camat Sukasari (Pembina) -->
                            <div class="rounded-xl overflow-hidden border border-amber-300 shadow-sm bg-white">
                                <div class="bg-gradient-to-r from-amber-500 to-orange-500 text-white font-bold text-[10px] uppercase tracking-wider py-1 px-3 text-center">
                                    PEMBINA WILAYAH (CAMAT)
                                </div>
                                <div class="py-2 px-3 text-center bg-amber-50/40">
                                    <div class="font-bold text-xs text-[#0F172A]">Drs. H. Mamat Rachmat, M.Si</div>
                                    <span class="text-[9px] text-gray-500 block">Camat Sukasari &bull; Kota Bandung</span>
                                </div>
                            </div>

                            <!-- Box 2: Ketua LPM (Mitra Pengawas) -->
                            <div class="rounded-xl overflow-hidden border border-amber-300 shadow-sm bg-white">
                                <div class="bg-gradient-to-r from-amber-500 to-orange-500 text-white font-bold text-[10px] uppercase tracking-wider py-1 px-3 text-center">
                                    LEMBAGA PEMBERDAYAAN (LPM)
                                </div>
                                <div class="py-2 px-3 text-center bg-amber-50/40">
                                    <div class="font-bold text-xs text-[#0F172A]">H. Dadang Koswara, S.Pd</div>
                                    <span class="text-[9px] text-gray-500 block">Ketua LPM Kelurahan Sukawarna</span>
                                </div>
                            </div>
                        </div>

                        <!-- Top Center: Main Orange Gradient Header Banner -->
                        <div class="flex-1 max-w-2xl text-center">
                            <div class="inline-block w-full py-3.5 px-8 rounded-2xl bg-gradient-to-r from-orange-500 via-amber-500 to-orange-600 text-white shadow-md border border-amber-300">
                                <h3 class="font-serif font-black text-lg sm:text-xl lg:text-2xl tracking-wider uppercase drop-shadow-sm">
                                    STRUKTUR KEPENGURUSAN KELURAHAN SUKAWARNA
                                </h3>
                                <p class="text-xs font-bold text-amber-100 tracking-widest mt-0.5">
                                    KECAMATAN SUKASARI &bull; KOTA BANDUNG &bull; TAHUN 2025/2026
                                </p>
                            </div>
                        </div>

                        <!-- Top Right: Kelurahan Logo & Social Handles -->
                        <div class="w-64 flex flex-col items-end text-right space-y-1.5">
                            <div class="flex items-center gap-2.5">
                                <div>
                                    <span class="font-black text-xs text-[#1B4332] block leading-none">KELURAHAN</span>
                                    <span class="font-serif font-black text-sm text-[#FFB703] leading-none">SUKAWARNA</span>
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
                                <span>@kelurahansukawarna</span>
                            </span>
                        </div>
                    </div>

                    <!-- Connective Dotted Line from Advisory Boxes to Leadership Line -->
                    <div class="relative h-6">
                        <div class="absolute left-32 top-0 w-0.5 h-6 border-l-2 border-dashed border-gray-400"></div>
                        <div class="absolute left-32 top-6 w-[260px] h-0.5 border-t-2 border-dashed border-gray-400"></div>
                    </div>

                    <!-- TIER 1: Leadership (Lurah Sukawarna & Sekretaris Kelurahan) -->
                    <div class="relative flex items-center justify-center gap-32">
                        <!-- Connecting Solid Horizontal Tree Bar between Lurah & Seklur -->
                        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-64 h-1 bg-gray-700 -z-0"></div>

                        <!-- 1. Lurah Sukawarna (Pimpinan Utama) -->
                        <div class="relative z-10 flex flex-col items-center">
                            <!-- Small Orange Tag -->
                            <div class="px-3.5 py-0.5 rounded-full bg-orange-500 text-white font-bold text-[10px] uppercase tracking-wider mb-2 shadow-sm">
                                Lurah
                            </div>

                            <!-- Dual-Ring Avatar (Gold Ring + Crescent Dark Blue Ribbon) -->
                            <div class="relative">
                                <div class="w-24 h-24 rounded-full border-4 border-amber-400 p-1 bg-white shadow-lg overflow-hidden">
                                    <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=400&q=80" 
                                         alt="Drs. H. Rahmat Hidayat, M.Si" 
                                         class="w-full h-full object-cover rounded-full">
                                </div>
                                <!-- Overlapping Crescent Ribbon Badge -->
                                <div class="absolute -bottom-2.5 left-1/2 -translate-x-1/2 bg-[#0284C7] text-white font-serif font-bold text-[11px] uppercase tracking-wide px-3.5 py-0.5 rounded-full shadow-md border-2 border-white whitespace-nowrap">
                                    Lurah Sukawarna
                                </div>
                            </div>

                            <!-- Name Pill Card -->
                            <div class="mt-4 text-center bg-white rounded-xl border border-sky-200 p-2 shadow-sm min-w-[200px]">
                                <h4 class="font-serif font-black text-xs text-[#0F172A] leading-tight">
                                    Drs. H. Rahmat Hidayat, M.Si
                                </h4>
                                <span class="text-[10px] text-gray-500 font-mono block mt-0.5">NIP: 19750812 200003 1 004</span>
                            </div>
                        </div>

                        <!-- 2. Sekretaris Kelurahan -->
                        <div class="relative z-10 flex flex-col items-center">
                            <!-- Small Orange Tag -->
                            <div class="px-3.5 py-0.5 rounded-full bg-orange-500 text-white font-bold text-[10px] uppercase tracking-wider mb-2 shadow-sm">
                                Seklur
                            </div>

                            <!-- Dual-Ring Avatar -->
                            <div class="relative">
                                <div class="w-24 h-24 rounded-full border-4 border-amber-400 p-1 bg-white shadow-lg overflow-hidden">
                                    <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=400&q=80" 
                                         alt="Siti Nurhaliza, S.STP, M.AP" 
                                         class="w-full h-full object-cover rounded-full">
                                </div>
                                <!-- Overlapping Crescent Ribbon Badge -->
                                <div class="absolute -bottom-2.5 left-1/2 -translate-x-1/2 bg-[#0284C7] text-white font-serif font-bold text-[11px] uppercase tracking-wide px-3.5 py-0.5 rounded-full shadow-md border-2 border-white whitespace-nowrap">
                                    Sekretaris Kelurahan
                                </div>
                            </div>

                            <!-- Name Pill Card -->
                            <div class="mt-4 text-center bg-white rounded-xl border border-sky-200 p-2 shadow-sm min-w-[200px]">
                                <h4 class="font-serif font-black text-xs text-[#0F172A] leading-tight">
                                    Siti Nurhaliza, S.STP, M.AP
                                </h4>
                                <span class="text-[10px] text-gray-500 font-mono block mt-0.5">NIP: 19840315 200801 2 006</span>
                            </div>
                        </div>
                    </div>

                    <!-- Vertical Tree Trunk from Leadership down to Sekretariat -->
                    <div class="flex justify-center -my-3">
                        <div class="w-1 h-8 bg-gray-700"></div>
                    </div>

                    <!-- TIER 2: Sekretariat & Staf Pelaksana Administrasi -->
                    <div class="relative flex items-center justify-center gap-12">
                        <!-- Horizontal connector for Sekretariat row -->
                        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[520px] h-1 bg-gray-700 -z-0"></div>

                        <!-- Staf Umum 1 (Left Circular Avatar) -->
                        <div class="relative z-10 flex flex-col items-center">
                            <div class="w-16 h-16 rounded-full border-2 border-amber-400 p-0.5 bg-white shadow-md overflow-hidden">
                                <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=400&q=80" 
                                     alt="Kafa Birrasyid, S.Ag" 
                                     class="w-full h-full object-cover rounded-full">
                            </div>
                            <span class="text-[10px] font-bold text-gray-700 mt-1">Staf Pelaksana</span>
                        </div>

                        <!-- Center Box 1: Sekretaris 1 -->
                        <div class="relative z-10 bg-white rounded-xl border border-sky-300 shadow-sm overflow-hidden min-w-[170px]">
                            <div class="bg-amber-400 text-amber-950 font-bold text-[9px] uppercase tracking-wider py-0.5 px-3 text-center">
                                SEKRETARIAT 1
                            </div>
                            <div class="p-2 bg-[#0284C7] text-white text-center">
                                <div class="font-bold text-xs leading-snug">Kafa Birrasyid, S.Ag</div>
                                <span class="text-[9px] text-sky-100 block">Staf Umum & Kepegawaian</span>
                            </div>
                        </div>

                        <!-- Center Box 2: Sekretaris 2 -->
                        <div class="relative z-10 bg-white rounded-xl border border-sky-300 shadow-sm overflow-hidden min-w-[170px]">
                            <div class="bg-amber-400 text-amber-950 font-bold text-[9px] uppercase tracking-wider py-0.5 px-3 text-center">
                                SEKRETARIAT 2
                            </div>
                            <div class="p-2 bg-[#0284C7] text-white text-center">
                                <div class="font-bold text-xs leading-snug">Luthfi Abdul Karim, S.Ag</div>
                                <span class="text-[9px] text-sky-100 block">Pengadministrasi Keuangan</span>
                            </div>
                        </div>

                        <!-- Staf Umum 2 (Right Circular Avatar) -->
                        <div class="relative z-10 flex flex-col items-center">
                            <div class="w-16 h-16 rounded-full border-2 border-amber-400 p-0.5 bg-white shadow-md overflow-hidden">
                                <img src="https://images.unsplash.com/photo-1492562080023-ab3db95bfbce?auto=format&fit=crop&w=400&q=80" 
                                     alt="Luthfi Abdul Karim, S.Ag" 
                                     class="w-full h-full object-cover rounded-full">
                            </div>
                            <span class="text-[10px] font-bold text-gray-700 mt-1">Staf Pelaksana</span>
                        </div>
                    </div>

                    <!-- Vertical Tree Trunk from Sekretariat to 7 Division Columns -->
                    <div class="flex justify-center -my-3">
                        <div class="w-1 h-8 bg-gray-700"></div>
                    </div>

                    <!-- TIER 3: The 7 Seksi Divisions (Horizontal Spanning Bar & Two-Tier Cards) -->
                    <div class="relative">
                        <!-- Horizontal Branch Bar Spanning all 7 Divisions (Reference Line) -->
                        <div class="absolute top-4 left-10 right-10 h-1 bg-gray-700 -z-0"></div>

                        <!-- 7 Columns Grid -->
                        <div class="grid grid-cols-7 gap-3 pt-0 relative z-10">
                            @php
                                $divisiList = [
                                    [
                                        'header' => 'Pemerintahan',
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
                                        'kasi' => [
                                            'role' => 'Koordinator LH',
                                            'nama' => 'Hj. Enok Wartini',
                                            'sub' => 'Buruan Sae & Asri',
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

                            @foreach($divisiList as $div)
                                <div class="flex flex-col items-center space-y-6">
                                    <!-- Orange Division Header Tag (Top of Column) -->
                                    <div class="w-full py-1.5 px-1 rounded-lg bg-gradient-to-r from-amber-500 to-orange-500 text-white font-bold text-[10px] text-center uppercase tracking-wider shadow-sm border border-amber-300">
                                        {{ $div['header'] }}
                                    </div>

                                    <!-- Vertical Line from Header to Kasi -->
                                    <div class="w-0.5 h-3 bg-gray-600 -my-3"></div>

                                    <!-- Upper Node: Kepala Seksi / Koordinator -->
                                    <div class="flex flex-col items-center text-center">
                                        <div class="relative">
                                            <div class="w-16 h-16 rounded-full border-3 border-amber-400 p-0.5 bg-white shadow-md overflow-hidden">
                                                <img src="{{ $div['kasi']['foto'] }}" 
                                                     alt="{{ $div['kasi']['nama'] }}" 
                                                     class="w-full h-full object-cover rounded-full">
                                            </div>
                                            <!-- Ribbon under avatar -->
                                            <div class="absolute -bottom-2 left-1/2 -translate-x-1/2 bg-[#0284C7] text-white font-bold text-[9px] uppercase px-2.5 py-0.5 rounded-full border border-white whitespace-nowrap shadow-xs">
                                                Ketua / Kasi
                                            </div>
                                        </div>

                                        <!-- Name Box -->
                                        <div class="mt-3.5 w-full bg-white rounded-lg border border-sky-200 p-1.5 shadow-xs">
                                            <div class="font-bold text-[11px] text-[#0F172A] leading-tight">
                                                {{ $div['kasi']['nama'] }}
                                            </div>
                                            <span class="text-[9px] text-gray-500 block leading-tight mt-0.5">
                                                {{ $div['kasi']['sub'] }}
                                            </span>
                                        </div>
                                    </div>

                                    <!-- Vertical Connecting Line between Kasi & Anggota -->
                                    <div class="w-0.5 h-6 bg-gray-600 -my-2"></div>

                                    <!-- Lower Node: Staf Pelaksana / Anggota -->
                                    <div class="flex flex-col items-center text-center">
                                        <div class="relative">
                                            <div class="w-16 h-16 rounded-full border-3 border-amber-400 p-0.5 bg-white shadow-md overflow-hidden">
                                                <img src="{{ $div['anggota']['foto'] }}" 
                                                     alt="{{ $div['anggota']['nama'] }}" 
                                                     class="w-full h-full object-cover rounded-full">
                                            </div>
                                            <!-- Ribbon under avatar -->
                                            <div class="absolute -bottom-2 left-1/2 -translate-x-1/2 bg-[#0284C7] text-white font-bold text-[9px] uppercase px-2.5 py-0.5 rounded-full border border-white whitespace-nowrap shadow-xs">
                                                Anggota / Staf
                                            </div>
                                        </div>

                                        <!-- Name Box -->
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
    </div>
</section>
