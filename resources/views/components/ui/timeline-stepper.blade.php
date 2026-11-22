@props([
    'title' => 'TIMELINE PENGADAAN & KEGIATAN WILAYAH',
    'categories' => [],
    'timelines' => [],
])

@php
    $defaultTimelines = [
        'pengadaan' => [
            'label' => 'Seleksi & Pengadaan Sarana Wilayah 2026',
            'sub' => 'Musrenbang & Pembangunan Fisik',
            'rows' => [
                // Row 1
                [
                    [
                        'id' => 1,
                        'title' => 'Rembug Warga & Usulan RT/RW',
                        'date' => '5 - 12 Jan 2026',
                        'status' => 'completed',
                        'icon' => 'form',
                        'link' => '#',
                    ],
                    [
                        'id' => 2,
                        'title' => 'Pendaftaran & Verifikasi Usulan',
                        'date' => '15 - 22 Jan 2026',
                        'status' => 'completed',
                        'icon' => 'check-doc',
                        'link' => '#',
                    ],
                    [
                        'id' => 3,
                        'title' => 'Pengumuman Hasil Seleksi Teknis',
                        'date' => '25 - 28 Jan 2026',
                        'status' => 'completed',
                        'icon' => 'desktop',
                        'link' => '#',
                    ],
                    [
                        'id' => 4,
                        'title' => 'Masa Sanggah Administrasi',
                        'date' => '30 Jan 2026',
                        'status' => 'completed',
                        'icon' => 'alert-doc',
                        'link' => null,
                    ],
                    [
                        'id' => 5,
                        'title' => 'Pengumuman Pasca Sanggah',
                        'date' => '2 - 3 Feb 2026',
                        'status' => 'completed',
                        'icon' => 'megaphone',
                        'link' => '#',
                    ],
                ],
                // Row 2
                [
                    [
                        'id' => 6,
                        'title' => 'Pengumuman Jadwal Tender/Fisik',
                        'date' => '8 - 12 Feb 2026',
                        'status' => 'completed',
                        'icon' => 'calendar-doc',
                        'link' => '#',
                    ],
                    [
                        'id' => 7,
                        'title' => 'Pelaksanaan Survei Titik Lokasi',
                        'date' => '15 - 22 Feb 2026',
                        'status' => 'completed',
                        'icon' => 'checklist',
                        'link' => null,
                    ],
                    [
                        'id' => 8,
                        'title' => 'Pengumuman Hasil Verifikasi',
                        'date' => '25 - 27 Feb 2026',
                        'status' => 'active',
                        'icon' => 'laptop-check',
                        'link' => '#',
                    ],
                    [
                        'id' => 9,
                        'title' => 'Jadwal Pengerjaan Drainase/Jalan',
                        'date' => '5 - 10 Mar 2026',
                        'status' => 'upcoming',
                        'icon' => 'calendar-time',
                        'link' => null,
                    ],
                    [
                        'id' => 10,
                        'title' => 'Pelaksanaan Konstruksi Fisik',
                        'date' => '15 Mar - 30 Apr 2026',
                        'status' => 'upcoming',
                        'icon' => 'construction',
                        'link' => null,
                    ],
                ],
                // Row 3
                [
                    [
                        'id' => 11,
                        'title' => 'Pengawasan & Uji Kelayakan',
                        'date' => '5 - 10 Mei 2026',
                        'status' => 'upcoming',
                        'icon' => 'megaphone-time',
                        'link' => null,
                    ],
                    [
                        'id' => 12,
                        'title' => 'Masa Pemeliharaan Prasarana',
                        'date' => '12 - 20 Mei 2026',
                        'status' => 'upcoming',
                        'icon' => 'file-time',
                        'link' => null,
                    ],
                    [
                        'id' => 13,
                        'title' => 'Berita Acara Serah Terima (BAST)',
                        'date' => '25 - 28 Mei 2026',
                        'status' => 'upcoming',
                        'icon' => 'megaphone-done',
                        'link' => null,
                    ],
                    [
                        'id' => 14,
                        'title' => 'Peresmian & Pemanfaatan Warga',
                        'date' => '1 - 10 Jun 2026',
                        'status' => 'upcoming',
                        'icon' => 'folder-box',
                        'link' => null,
                    ],
                ],
            ],
        ],
        'layanan' => [
            'label' => 'Alur Standar Pelayanan Surat Warga',
            'sub' => 'Layanan Kependudukan & Perizinan',
            'rows' => [
                [
                    [
                        'id' => 1,
                        'title' => 'Pengajuan Berkas Permohonan',
                        'date' => 'Tahap 1 (Hari ke-1)',
                        'status' => 'completed',
                        'icon' => 'form',
                        'link' => '#',
                    ],
                    [
                        'id' => 2,
                        'title' => 'Pemeriksaan Pengantar RT/RW',
                        'date' => 'Tahap 2 (Hari ke-1)',
                        'status' => 'completed',
                        'icon' => 'check-doc',
                        'link' => '#',
                    ],
                    [
                        'id' => 3,
                        'title' => 'Verifikasi Database SIAK / NIK',
                        'date' => 'Tahap 3 (Hari ke-1)',
                        'status' => 'completed',
                        'icon' => 'desktop',
                        'link' => '#',
                    ],
                    [
                        'id' => 4,
                        'title' => 'Penerbitan Lembar Draf Surat',
                        'date' => 'Tahap 4 (Hari ke-2)',
                        'status' => 'active',
                        'icon' => 'alert-doc',
                        'link' => null,
                    ],
                    [
                        'id' => 5,
                        'title' => 'Penelaahan Kasie Pemerintahan',
                        'date' => 'Tahap 5 (Hari ke-2)',
                        'status' => 'upcoming',
                        'icon' => 'megaphone',
                        'link' => null,
                    ],
                ],
                [
                    [
                        'id' => 6,
                        'title' => 'Penandatanganan Lurah (TTE)',
                        'date' => 'Tahap 6 (Hari ke-2)',
                        'status' => 'upcoming',
                        'icon' => 'calendar-doc',
                        'link' => null,
                    ],
                    [
                        'id' => 7,
                        'title' => 'Pembubuhan Stempel & Nomor Agenda',
                        'date' => 'Tahap 7 (Hari ke-3)',
                        'status' => 'upcoming',
                        'icon' => 'checklist',
                        'link' => null,
                    ],
                    [
                        'id' => 8,
                        'title' => 'Pengarsipan Digital & Notifikasi WA',
                        'date' => 'Tahap 8 (Hari ke-3)',
                        'status' => 'upcoming',
                        'icon' => 'laptop-check',
                        'link' => null,
                    ],
                    [
                        'id' => 9,
                        'title' => 'Penyerahan Dokumen Resmi ke Pemohon',
                        'date' => 'Tahap 9 (Hari ke-3)',
                        'status' => 'upcoming',
                        'icon' => 'folder-box',
                        'link' => '#',
                    ],
                ],
            ],
        ],
        'bantuan' => [
            'label' => 'Seleksi Bantuan Modal UMKM & Pertanian 2026',
            'sub' => 'Pemberdayaan Ekonomi Lokal',
            'rows' => [
                [
                    [
                        'id' => 1,
                        'title' => 'Pengumuman Kuota Bantuan Modal',
                        'date' => '1 - 10 Feb 2026',
                        'status' => 'completed',
                        'icon' => 'megaphone',
                        'link' => '#',
                    ],
                    [
                        'id' => 2,
                        'title' => 'Pendaftaran Usaha Mikro & NIB',
                        'date' => '12 - 25 Feb 2026',
                        'status' => 'completed',
                        'icon' => 'form',
                        'link' => '#',
                    ],
                    [
                        'id' => 3,
                        'title' => 'Kunjungan & Verifikasi Lapangan',
                        'date' => '1 - 10 Mar 2026',
                        'status' => 'completed',
                        'icon' => 'checklist',
                        'link' => '#',
                    ],
                    [
                        'id' => 4,
                        'title' => 'Pengumuman Nominasi Penerima',
                        'date' => '15 Mar 2026',
                        'status' => 'active',
                        'icon' => 'desktop',
                        'link' => '#',
                    ],
                    [
                        'id' => 5,
                        'title' => 'Pelatihan Pembukuan & Packaging',
                        'date' => '20 - 25 Mar 2026',
                        'status' => 'upcoming',
                        'icon' => 'laptop-check',
                        'link' => null,
                    ],
                ],
                [
                    [
                        'id' => 6,
                        'title' => 'Pencairan Dana Fasilitasi Tanpa Bunga',
                        'date' => '1 - 5 Apr 2026',
                        'status' => 'upcoming',
                        'icon' => 'folder-box',
                        'link' => null,
                    ],
                    [
                        'id' => 7,
                        'title' => 'Pendampingan Pemasaran Digital',
                        'date' => '10 Apr - 10 Mei 2026',
                        'status' => 'upcoming',
                        'icon' => 'calendar-doc',
                        'link' => null,
                    ],
                    [
                        'id' => 8,
                        'title' => 'Bazar Produk & Evaluasi Omzet',
                        'date' => '15 - 20 Mei 2026',
                        'status' => 'upcoming',
                        'icon' => 'construction',
                        'link' => null,
                    ],
                ],
            ],
        ],
    ];

    $allTimelines = !empty($timelines) ? $timelines : $defaultTimelines;
    $firstKey = array_key_first($allTimelines);
@endphp

<div class="w-full my-8" id="timeline-stepper-root">
    <!-- Section Title & Subtle Underline (Reference Fidelity) -->
    <div class="text-center mb-8">
        <h2 class="font-serif font-black text-2xl sm:text-3xl lg:text-4xl text-[#0F172A] tracking-wider uppercase">
            {{ $title }}
        </h2>
        <div class="w-20 h-1 bg-[#0284C7] mx-auto mt-2.5 rounded-full"></div>
    </div>

    <!-- Category Tabs Navigation (Reference Fidelity) -->
    <div class="flex flex-col items-center gap-3 mb-10">
        <!-- Capsule Switcher Container -->
        <div class="inline-flex flex-wrap items-center justify-center p-1.5 rounded-full bg-white border border-sky-100 shadow-sm gap-1 max-w-full">
            @foreach($allTimelines as $key => $tl)
                <button type="button" 
                        onclick="switchTimelineTab('{{ $key }}')" 
                        id="tab-btn-{{ $key }}"
                        class="timeline-tab-btn px-4 sm:px-6 py-2 rounded-full text-xs sm:text-sm font-semibold transition-all duration-300 {{ $loop->first ? 'bg-[#0284C7] text-white shadow-sm' : 'text-slate-600 hover:text-[#0284C7] hover:bg-sky-50/50' }}">
                    {{ $tl['label'] }}
                </button>
            @endforeach
        </div>

        <!-- Sub-filter / Secondary Pill Badge -->
        <div id="timeline-sub-badge" class="px-5 py-1 rounded-full bg-sky-100 text-[#0284C7] text-xs font-bold tracking-wide transition-all shadow-xs">
            {{ $allTimelines[$firstKey]['sub'] ?? 'Jadwal & Tahapan' }}
        </div>
    </div>

    <!-- Timeline Outer Frame Container (Card with rounded corners and border) -->
    <div class="bg-white rounded-[28px] sm:rounded-[36px] border-2 border-sky-200/80 shadow-xl shadow-sky-500/5 p-6 sm:p-8 lg:p-12 relative overflow-hidden">
        @foreach($allTimelines as $key => $tl)
            <div id="timeline-panel-{{ $key }}" class="timeline-panel space-y-12 sm:space-y-16 {{ $loop->first ? 'block' : 'hidden' }}">
                @php $rowCount = count($tl['rows']); @endphp
                @foreach($tl['rows'] as $rowIndex => $nodes)
                    <div class="relative">
                        <!-- Horizontal Nodes Row (Grid 5-col on desktop) -->
                        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-y-10 gap-x-4 items-start relative z-10">
                            @foreach($nodes as $nodeIndex => $node)
                                <div class="flex flex-col items-center text-center relative group">
                                    <!-- Node Icon Box Container -->
                                    <div class="w-16 h-16 sm:w-20 sm:h-20 rounded-2xl border-2 {{ $node['status'] === 'completed' ? 'border-sky-300 bg-sky-50/60' : ($node['status'] === 'active' ? 'border-[#0284C7] bg-sky-100/70 ring-4 ring-sky-200/50' : 'border-slate-200 bg-slate-50/70') }} flex items-center justify-center relative shadow-sm group-hover:scale-105 transition-all duration-300">
                                        <!-- Floating Status Badge on Top Right -->
                                        <div class="absolute -top-2.5 -right-2.5 w-6 h-6 rounded-full flex items-center justify-center border-2 border-white shadow-md z-20 
                                            {{ $node['status'] === 'completed' ? 'bg-emerald-500 text-white' : ($node['status'] === 'active' ? 'bg-[#0284C7] text-white animate-pulse' : 'bg-slate-300 text-white') }}">
                                            @if($node['status'] === 'completed')
                                                <!-- Checkmark -->
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                                                </svg>
                                            @elseif($node['status'] === 'active')
                                                <!-- Clock / In-Progress -->
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <circle cx="12" cy="12" r="10" stroke-width="2.5"/>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 6v6l4 2"/>
                                                </svg>
                                            @else
                                                <!-- Upcoming / Muted Clock -->
                                                <svg class="w-3 h-3 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <circle cx="12" cy="12" r="9" stroke-width="2"/>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 7v5l3 2"/>
                                                </svg>
                                            @endif
                                        </div>

                                        <!-- Inside SVG Icon (Reference Fidelity) -->
                                        <div class="{{ $node['status'] === 'completed' || $node['status'] === 'active' ? 'text-[#0284C7]' : 'text-slate-400' }}">
                                            @if($node['icon'] === 'form')
                                                <svg class="w-8 h-8 sm:w-10 sm:h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                                </svg>
                                            @elseif($node['icon'] === 'check-doc')
                                                <svg class="w-8 h-8 sm:w-10 sm:h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                                                </svg>
                                            @elseif($node['icon'] === 'desktop')
                                                <svg class="w-8 h-8 sm:w-10 sm:h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <rect x="2" y="3" width="20" height="14" rx="2" stroke-width="1.8"/>
                                                    <line x1="8" y1="21" x2="16" y2="21" stroke-width="1.8"/>
                                                    <line x1="12" y1="17" x2="12" y2="21" stroke-width="1.8"/>
                                                </svg>
                                            @elseif($node['icon'] === 'alert-doc')
                                                <svg class="w-8 h-8 sm:w-10 sm:h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                                    <circle cx="12" cy="9" r="1" fill="currentColor"/>
                                                </svg>
                                            @elseif($node['icon'] === 'megaphone' || $node['icon'] === 'megaphone-done' || $node['icon'] === 'megaphone-time')
                                                <svg class="w-8 h-8 sm:w-10 sm:h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
                                                </svg>
                                            @elseif($node['icon'] === 'calendar-doc' || $node['icon'] === 'calendar-time')
                                                <svg class="w-8 h-8 sm:w-10 sm:h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <rect x="3" y="4" width="18" height="18" rx="2" stroke-width="1.8"/>
                                                    <line x1="16" y1="2" x2="16" y2="6" stroke-width="1.8"/>
                                                    <line x1="8" y1="2" x2="8" y2="6" stroke-width="1.8"/>
                                                    <line x1="3" y1="10" x2="21" y2="10" stroke-width="1.8"/>
                                                </svg>
                                            @elseif($node['icon'] === 'checklist')
                                                <svg class="w-8 h-8 sm:w-10 sm:h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                                                </svg>
                                            @elseif($node['icon'] === 'laptop-check')
                                                <svg class="w-8 h-8 sm:w-10 sm:h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <rect x="3" y="4" width="18" height="12" rx="2" stroke-width="1.8"/>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M2 20h20M9 10l2 2 4-4"/>
                                                </svg>
                                            @elseif($node['icon'] === 'construction')
                                                <svg class="w-8 h-8 sm:w-10 sm:h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                                </svg>
                                            @else
                                                <svg class="w-8 h-8 sm:w-10 sm:h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/>
                                                </svg>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Step Title -->
                                    <h4 class="font-sans font-bold text-xs sm:text-[13px] text-[#0369A1] text-center leading-snug mt-3 px-1 max-w-[140px]">
                                        {{ $node['title'] }}
                                    </h4>

                                    <!-- Date Range / Subtitle -->
                                    <p class="text-[11px] font-semibold text-rose-600 text-center mt-1">
                                        {{ $node['date'] }}
                                    </p>

                                    <!-- Selengkapnya Button (if link present) -->
                                    @if($node['link'])
                                        <button type="button" 
                                                onclick="openTimelineModal('{{ $node['title'] }}', '{{ $node['date'] }}', '{{ $node['status'] }}')"
                                                class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-md bg-[#0284C7] hover:bg-[#0369A1] text-white text-[10px] font-bold mt-2 shadow-xs transition-colors">
                                            <span>Selengkapnya</span>
                                            <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                            </svg>
                                        </button>
                                    @endif

                                    <!-- Chevron Arrow Connector between nodes in same row (Desktop) -->
                                    @if(!$loop->last)
                                        <div class="hidden lg:flex absolute top-7 -right-4 translate-x-1/2 text-sky-300 z-0 pointer-events-none">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>

                        <!-- Serpentine Connector Loop from Right of this Row to Left of Next Row (Desktop) -->
                        @if(!$loop->last)
                            <div class="hidden lg:block absolute -bottom-10 right-10 w-24 h-16 pointer-events-none z-0">
                                <svg class="w-full h-full text-sky-200" viewBox="0 0 100 60" fill="none" stroke="currentColor" stroke-width="2.5">
                                    <path d="M 0 0 C 80 0, 80 60, 0 60" stroke-linecap="round"/>
                                    <polyline points="10,55 0,60 10,65" stroke-width="2.5"/>
                                </svg>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
</div>

<!-- Modal Detail Timeline Stage (Interactive UI) -->
<div id="timeline-detail-modal" class="fixed inset-0 z-50 hidden bg-black/50 backdrop-blur-sm flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl max-w-md w-full p-6 shadow-2xl border border-sky-200 space-y-4 animate-in fade-in zoom-in duration-200">
        <div class="flex items-start justify-between">
            <div class="flex items-center gap-2">
                <span id="modal-status-badge" class="px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase bg-emerald-100 text-emerald-800">
                    Selesai
                </span>
                <span id="modal-date" class="text-xs font-semibold text-rose-600">8 - 15 Okt 2026</span>
            </div>
            <button type="button" onclick="closeTimelineModal()" class="text-gray-400 hover:text-gray-600 p-1">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        <div>
            <h3 id="modal-title" class="font-serif font-bold text-lg text-[#0F172A] leading-snug">
                Judul Tahapan
            </h3>
            <p id="modal-desc" class="text-xs text-gray-600 mt-2 leading-relaxed">
                Tahapan ini merupakan proses resmi dari jadwal pengadaan sarana dan alur pelayanan masyarakat di Kelurahan Sukawarna. Seluruh berkas dan hasil telaah dapat diakses secara transparan oleh warga.
            </p>
        </div>

        <div class="pt-3 border-t border-gray-100 flex items-center justify-between">
            <span class="text-[11px] text-gray-400">Kelurahan Sukawarna &bull; Kota Bandung</span>
            <button type="button" onclick="closeTimelineModal()" class="px-4 py-2 bg-[#0284C7] text-white text-xs font-bold rounded-lg hover:bg-[#0369A1] transition-colors">
                Tutup
            </button>
        </div>
    </div>
</div>

<script>
    function switchTimelineTab(tabKey) {
        // Toggle tab button states
        document.querySelectorAll('.timeline-tab-btn').forEach(btn => {
            btn.classList.remove('bg-[#0284C7]', 'text-white', 'shadow-sm');
            btn.classList.add('text-slate-600');
        });
        const activeBtn = document.getElementById('tab-btn-' + tabKey);
        if (activeBtn) {
            activeBtn.classList.add('bg-[#0284C7]', 'text-white', 'shadow-sm');
            activeBtn.classList.remove('text-slate-600');
        }

        // Toggle panels
        document.querySelectorAll('.timeline-panel').forEach(panel => {
            panel.classList.add('hidden');
        });
        const activePanel = document.getElementById('timeline-panel-' + tabKey);
        if (activePanel) {
            activePanel.classList.remove('hidden');
        }

        // Update sub-badge label if mapped
        const subBadge = document.getElementById('timeline-sub-badge');
        if (subBadge) {
            if (tabKey === 'pengadaan') subBadge.textContent = 'Musrenbang & Pembangunan Fisik';
            else if (tabKey === 'layanan') subBadge.textContent = 'Layanan Kependudukan & Perizinan';
            else if (tabKey === 'bantuan') subBadge.textContent = 'Pemberdayaan Ekonomi Lokal';
        }
    }

    function openTimelineModal(title, date, status) {
        const modal = document.getElementById('timeline-detail-modal');
        const modalTitle = document.getElementById('modal-title');
        const modalDate = document.getElementById('modal-date');
        const modalStatus = document.getElementById('modal-status-badge');

        if (modalTitle) modalTitle.textContent = title;
        if (modalDate) modalDate.textContent = date;
        if (modalStatus) {
            if (status === 'completed') {
                modalStatus.textContent = 'Selesai Dilaksanakan';
                modalStatus.className = 'px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase bg-emerald-100 text-emerald-800';
            } else if (status === 'active') {
                modalStatus.textContent = 'Sedang Berlangsung';
                modalStatus.className = 'px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase bg-sky-100 text-sky-800 animate-pulse';
            } else {
                modalStatus.textContent = 'Tahapan Mendatang';
                modalStatus.className = 'px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase bg-slate-100 text-slate-700';
            }
        }
        if (modal) modal.classList.remove('hidden');
    }

    function closeTimelineModal() {
        const modal = document.getElementById('timeline-detail-modal');
        if (modal) modal.classList.add('hidden');
    }
</script>
