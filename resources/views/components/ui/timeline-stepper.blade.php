@props([
    'title' => 'TIMELINE PENGADAAN & ALUR KEGIATAN WILAYAH 2026',
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

<div class="w-full my-6 sm:my-8" id="timeline-stepper-root">
    <!-- Section Title & Subtle Underline (Reference Fidelity) -->
    <div class="text-center mb-6 sm:mb-8">
        <h2 class="font-serif font-black text-2xl sm:text-3xl lg:text-4xl text-[#0F172A] tracking-wider uppercase">
            {{ $title }}
        </h2>
        <div class="w-20 h-1 bg-[#0284C7] mx-auto mt-2.5 rounded-full"></div>
    </div>

    <!-- Category Tabs Navigation (Reference Fidelity) -->
    <div class="flex flex-col items-center gap-3 mb-8 sm:mb-10">
        <!-- Capsule Switcher Container (Smooth scrolling on mobile) -->
        <div class="w-full sm:w-auto overflow-x-auto pb-1 sm:pb-0 flex justify-center">
            <div class="inline-flex items-center p-1.5 rounded-full bg-white border border-sky-100 shadow-sm gap-1 flex-nowrap sm:flex-wrap">
                @foreach($allTimelines as $key => $tl)
                    <button type="button" 
                            onclick="switchTimelineTab('{{ $key }}')" 
                            id="tab-btn-{{ $key }}"
                            class="timeline-tab-btn px-4 sm:px-6 py-2 rounded-full text-xs sm:text-sm font-semibold whitespace-nowrap transition-all duration-300 {{ $loop->first ? 'bg-[#0284C7] text-white shadow-sm' : 'text-slate-600 hover:text-[#0284C7] hover:bg-sky-50/50' }}">
                        {{ $tl['label'] }}
                    </button>
                @endforeach
            </div>
        </div>

        <!-- Sub-filter / Secondary Pill Badge -->
        <div id="timeline-sub-badge" class="px-5 py-1 rounded-full bg-sky-100 text-[#0284C7] text-xs font-bold tracking-wide transition-all shadow-xs">
            {{ $allTimelines[$firstKey]['sub'] ?? 'Jadwal & Tahapan' }}
        </div>
    </div>

    <!-- Timeline Outer Frame Container (Card with rounded corners and border) -->
    <div class="bg-white rounded-2xl sm:rounded-[36px] border-2 border-sky-200/80 shadow-xl shadow-sky-500/5 p-5 sm:p-8 lg:p-12 relative overflow-hidden">
        @foreach($allTimelines as $key => $tl)
            @php
                // Flatten all nodes for clean mobile vertical stepper
                $flatNodes = collect($tl['rows'])->flatten(1);
            @endphp

            <div id="timeline-panel-{{ $key }}" class="timeline-panel {{ $loop->first ? 'block' : 'hidden' }}">
                
                <!-- 1. DESKTOP VIEW: Continuous Animated Serpentine Stepper -->
                <div class="hidden lg:block space-y-20 relative lg:px-6" data-tl-canvas="{{ $key }}">
                    <svg class="tl-tree-svg absolute inset-0 w-full h-full pointer-events-none z-0 overflow-visible" aria-hidden="true">
                        <g class="tl-tree-paths"></g>
                    </svg>
                    @foreach($tl['rows'] as $rowIndex => $nodes)
                        <div class="relative z-10" data-tl-row="{{ $rowIndex }}">
                            <!-- Horizontal Nodes Row (5-col grid) -->
                            <div class="grid grid-cols-5 gap-x-4 items-start relative z-10">
                                @foreach($nodes as $nodeIndex => $node)
                                    <div class="flex flex-col items-center text-center relative group" data-tl-col="{{ $nodeIndex }}">
                                        <!-- Node Icon Box Container -->
                                        <div data-tl-node="{{ $node['id'] }}"
                                             data-tl-status="{{ $node['status'] }}"
                                             class="w-20 h-20 rounded-2xl border-2 {{ $node['status'] === 'completed' ? 'border-sky-300 bg-sky-50/60' : ($node['status'] === 'active' ? 'border-[#0284C7] bg-sky-100/70 ring-4 ring-sky-200/50' : 'border-slate-200 bg-slate-50/70') }} flex items-center justify-center relative shadow-sm group-hover:scale-105 transition-all duration-300">
                                            <!-- Floating Status Badge on Top Right -->
                                            <div class="absolute -top-2.5 -right-2.5 w-6 h-6 rounded-full flex items-center justify-center border-2 border-white shadow-md z-20 
                                                {{ $node['status'] === 'completed' ? 'bg-emerald-500 text-white' : ($node['status'] === 'active' ? 'bg-[#0284C7] text-white animate-pulse' : 'bg-slate-300 text-white') }}">
                                                @if($node['status'] === 'completed')
                                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                                                @elseif($node['status'] === 'active')
                                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10" stroke-width="2.5"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 6v6l4 2"/></svg>
                                                @else
                                                    <svg class="w-3 h-3 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="12" r="9" stroke-width="2"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 7v5l3 2"/></svg>
                                                @endif
                                            </div>

                                            <!-- Inside SVG Icon -->
                                            <div class="{{ $node['status'] === 'completed' || $node['status'] === 'active' ? 'text-[#0284C7]' : 'text-slate-400' }}">
                                                <svg class="w-9 h-9" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                                </svg>
                                            </div>
                                        </div>

                                        <!-- Step Title -->
                                        <h4 class="font-sans font-bold text-[13px] text-[#0369A1] text-center leading-snug mt-3 px-1 max-w-[145px]">
                                            {{ $node['title'] }}
                                        </h4>

                                        <!-- Date Range / Subtitle -->
                                        <p class="text-[11px] font-semibold text-rose-600 text-center mt-1">
                                            {{ $node['date'] }}
                                        </p>

                                        <!-- Selengkapnya Button -->
                                        @if($node['link'])
                                            <button type="button" 
                                                    onclick="openTimelineModal('{{ $node['title'] }}', '{{ $node['date'] }}', '{{ $node['status'] }}')"
                                                    class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-md bg-[#0284C7] hover:bg-[#0369A1] text-white text-[10px] font-bold mt-2 shadow-xs transition-colors">
                                                <span>Selengkapnya</span>
                                                <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                                            </button>
                                        @endif

                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- 2. MOBILE & TABLET VIEW: Dedicated Smooth Vertical Stepper (100% Fluid & Readable) -->
                <div class="block lg:hidden">
                    <div class="relative pl-8 sm:pl-10 space-y-6 before:absolute before:left-4 sm:before:left-5 before:top-4 before:bottom-4 before:w-0.5 before:bg-sky-200">
                        @foreach($flatNodes as $node)
                            <div class="relative flex items-start gap-4 p-3.5 sm:p-4 rounded-xl bg-gray-50/80 border border-gray-100 shadow-xs">
                                <!-- Status Node Badge on the Vertical Track -->
                                <div class="absolute -left-8 sm:-left-10 top-4 w-7 h-7 sm:w-8 sm:h-8 rounded-full border-2 border-white shadow-md flex items-center justify-center z-10
                                    {{ $node['status'] === 'completed' ? 'bg-emerald-500 text-white' : ($node['status'] === 'active' ? 'bg-[#0284C7] text-white animate-pulse' : 'bg-slate-300 text-white') }}">
                                    @if($node['status'] === 'completed')
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                                    @elseif($node['status'] === 'active')
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="12" r="9" stroke-width="2.5"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 6v6l4 2"/></svg>
                                    @else
                                        <svg class="w-3.5 h-3.5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="12" r="9" stroke-width="2"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 7v5l3 2"/></svg>
                                    @endif
                                </div>

                                <!-- Node Content -->
                                <div class="flex-1 space-y-1">
                                    <div class="flex flex-wrap items-center justify-between gap-1">
                                        <span class="text-[10px] font-bold uppercase tracking-wider px-2 py-0.5 rounded-full 
                                            {{ $node['status'] === 'completed' ? 'bg-emerald-100 text-emerald-800' : ($node['status'] === 'active' ? 'bg-sky-100 text-sky-800' : 'bg-slate-200 text-slate-700') }}">
                                            {{ $node['status'] === 'completed' ? 'Selesai' : ($node['status'] === 'active' ? 'Sedang Berlangsung' : 'Mendatang') }}
                                        </span>
                                        <span class="text-xs font-semibold text-rose-600">
                                            {{ $node['date'] }}
                                        </span>
                                    </div>

                                    <h4 class="font-bold text-xs sm:text-sm text-[#0369A1] leading-snug">
                                        {{ $node['title'] }}
                                    </h4>

                                    @if($node['link'])
                                        <button type="button" 
                                                onclick="openTimelineModal('{{ $node['title'] }}', '{{ $node['date'] }}', '{{ $node['status'] }}')"
                                                class="inline-flex items-center gap-1 text-[11px] font-bold text-[#0284C7] hover:underline pt-1">
                                            <span>Lihat Rincian Tahapan &rarr;</span>
                                        </button>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<!-- Modal Detail Timeline Stage -->
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
                Tahapan ini merupakan proses resmi dari jadwal pengadaan sarana dan alur pelayanan masyarakat di Kelurahan Konda. Seluruh berkas dan hasil telaah dapat diakses secara transparan oleh warga.
            </p>
        </div>

        <div class="pt-4 border-t border-gray-100 flex items-center justify-between gap-2">
            <a href="{{ route('dokumen.index') }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg border border-[#0284C7] text-[#0284C7] hover:bg-sky-50 text-[11px] font-bold transition-colors">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                <span>Unduh Dokumen KIP</span>
            </a>
            <button type="button" onclick="closeTimelineModal()" class="px-4 py-2 bg-[#0284C7] text-white text-xs font-bold rounded-lg hover:bg-[#0369A1] transition-colors">
                Tutup
            </button>
        </div>
    </div>
</div>

<style id="timeline-stepper-connector-styles">
    @keyframes tlFlowForward {
        from { stroke-dashoffset: 0; }
        to { stroke-dashoffset: -36; }
    }
    @keyframes tlFlowSlow {
        from { stroke-dashoffset: 0; }
        to { stroke-dashoffset: -40; }
    }
    @keyframes tlPulseNode {
        0%, 100% { transform: scale(1); opacity: 0.95; }
        50% { transform: scale(1.45); opacity: 0.35; }
    }
    .tl-rail-done {
        stroke: #bae6fd;
        stroke-width: 2.5;
        stroke-linecap: round;
        stroke-linejoin: round;
    }
    .tl-flow-done {
        stroke: #0ea5e9;
        stroke-width: 2.5;
        stroke-linecap: round;
        stroke-linejoin: round;
        stroke-dasharray: 8 10;
        animation: tlFlowForward 1.15s linear infinite;
    }
    .tl-rail-active {
        stroke: #7dd3fc;
        stroke-width: 3;
        stroke-linecap: round;
        stroke-linejoin: round;
    }
    .tl-flow-active {
        stroke: #0284c7;
        stroke-width: 3;
        stroke-linecap: round;
        stroke-linejoin: round;
        stroke-dasharray: 10 8;
        animation: tlFlowForward 0.85s linear infinite;
    }
    .tl-rail-upcoming {
        stroke: #e2e8f0;
        stroke-width: 2;
        stroke-linecap: round;
        stroke-linejoin: round;
        stroke-dasharray: 5 5;
    }
    .tl-flow-upcoming {
        stroke: #94a3b8;
        stroke-width: 2;
        stroke-linecap: round;
        stroke-linejoin: round;
        stroke-dasharray: 6 14;
        opacity: 0.72;
        animation: tlFlowSlow 2.4s linear infinite;
    }
    .tl-pulse-ring {
        transform-box: fill-box;
        transform-origin: center;
        animation: tlPulseNode 1.8s ease-in-out infinite;
    }
    @media (prefers-reduced-motion: reduce) {
        .tl-flow-done,
        .tl-flow-active,
        .tl-flow-upcoming,
        .tl-pulse-ring {
            animation: none !important;
        }
    }
</style>

<script>
    function switchTimelineTab(tabKey) {
        document.querySelectorAll('.timeline-tab-btn').forEach(btn => {
            btn.classList.remove('bg-[#0284C7]', 'text-white', 'shadow-sm');
            btn.classList.add('text-slate-600');
        });
        const activeBtn = document.getElementById('tab-btn-' + tabKey);
        if (activeBtn) {
            activeBtn.classList.add('bg-[#0284C7]', 'text-white', 'shadow-sm');
            activeBtn.classList.remove('text-slate-600');
        }

        document.querySelectorAll('.timeline-panel').forEach(panel => {
            panel.classList.add('hidden');
        });
        const activePanel = document.getElementById('timeline-panel-' + tabKey);
        if (activePanel) {
            activePanel.classList.remove('hidden');
        }

        const subBadge = document.getElementById('timeline-sub-badge');
        if (subBadge) {
            if (tabKey === 'pengadaan') subBadge.textContent = 'Musrenbang & Pembangunan Fisik';
            else if (tabKey === 'layanan') subBadge.textContent = 'Layanan Kependudukan & Perizinan';
            else if (tabKey === 'bantuan') subBadge.textContent = 'Pemberdayaan Ekonomi Lokal';
        }

        requestAnimationFrame(drawTimelineConnectors);
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

    function buildRoundedOrthogonalPath(points, radius) {
        if (points.length < 2) return '';
        let d = `M ${points[0][0].toFixed(1)} ${points[0][1].toFixed(1)}`;
        for (let i = 1; i < points.length - 1; i++) {
            const [px, py] = points[i - 1];
            const [cx, cy] = points[i];
            const [nx, ny] = points[i + 1];
            const dx1 = cx - px;
            const dy1 = cy - py;
            const dx2 = nx - cx;
            const dy2 = ny - cy;
            const len1 = Math.hypot(dx1, dy1);
            const len2 = Math.hypot(dx2, dy2);
            if (len1 === 0 || len2 === 0) continue;
            const r = Math.min(radius, len1 / 2, len2 / 2);
            const inX = cx - (dx1 / len1) * r;
            const inY = cy - (dy1 / len1) * r;
            const outX = cx + (dx2 / len2) * r;
            const outY = cy + (dy2 / len2) * r;
            d += ` L ${inX.toFixed(1)} ${inY.toFixed(1)} Q ${cx.toFixed(1)} ${cy.toFixed(1)} ${outX.toFixed(1)} ${outY.toFixed(1)}`;
        }
        const last = points[points.length - 1];
        d += ` L ${last[0].toFixed(1)} ${last[1].toFixed(1)}`;
        return d;
    }

    function resolveTimelineSegmentVariant(srcStatus, dstStatus) {
        if (dstStatus === 'active' || (srcStatus === 'active' && dstStatus === 'completed')) {
            return 'active';
        }
        if (srcStatus === 'completed' && dstStatus === 'completed') {
            return 'done';
        }
        return 'upcoming';
    }

    function drawTimelineConnectors() {
        const SVG_NS = 'http://www.w3.org/2000/svg';
        const palette = {
            done: { accent: '#0ea5e9', arrow: '#0284c7' },
            active: { accent: '#0284c7', arrow: '#0369a1' },
            upcoming: { accent: '#94a3b8', arrow: '#94a3b8' },
        };

        const createSvgEl = (tag, attrs) => {
            const el = document.createElementNS(SVG_NS, tag);
            Object.entries(attrs).forEach(([k, v]) => el.setAttribute(k, String(v)));
            return el;
        };

        const appendConnector = (group, d, startPt, arrowPt, variant, bridgeMid) => {
            const colors = palette[variant];
            group.appendChild(createSvgEl('path', {
                d,
                fill: 'none',
                class: `tl-rail-${variant}`,
            }));
            group.appendChild(createSvgEl('path', {
                d,
                fill: 'none',
                class: `tl-flow-${variant}`,
            }));

            group.appendChild(createSvgEl('circle', {
                cx: startPt[0].toFixed(1),
                cy: startPt[1].toFixed(1),
                r: variant === 'upcoming' ? 2.5 : 3,
                fill: colors.accent,
            }));

            if (bridgeMid) {
                const [bx, by] = bridgeMid;
                group.appendChild(createSvgEl('circle', {
                    cx: bx.toFixed(1),
                    cy: by.toFixed(1),
                    r: 8,
                    fill: '#ffffff',
                }));
                group.appendChild(createSvgEl('path', {
                    d: `M ${(bx + 3).toFixed(1)} ${(by - 4).toFixed(1)} L ${(bx - 3).toFixed(1)} ${by.toFixed(1)} L ${(bx + 3).toFixed(1)} ${(by + 4).toFixed(1)}`,
                    fill: 'none',
                    stroke: colors.arrow,
                    'stroke-width': 2.2,
                    'stroke-linecap': 'round',
                    'stroke-linejoin': 'round',
                }));
            }

            const [ax, ay] = arrowPt;
            group.appendChild(createSvgEl('path', {
                d: `M ${(ax - 7).toFixed(1)} ${(ay - 4.5).toFixed(1)} L ${ax.toFixed(1)} ${ay.toFixed(1)} L ${(ax - 7).toFixed(1)} ${(ay + 4.5).toFixed(1)} Z`,
                fill: colors.arrow,
            }));

            if (variant === 'active') {
                group.appendChild(createSvgEl('circle', {
                    cx: ax.toFixed(1),
                    cy: ay.toFixed(1),
                    r: 4,
                    fill: '#0284c7',
                    class: 'tl-pulse-ring',
                }));
            }
        };

        document.querySelectorAll('[data-tl-canvas]').forEach((canvas) => {
            const cRect = canvas.getBoundingClientRect();
            const svg = canvas.querySelector('.tl-tree-svg');
            const group = canvas.querySelector('.tl-tree-paths');
            if (!svg || !group || cRect.width === 0 || cRect.height === 0) {
                return;
            }

            svg.setAttribute('viewBox', `0 0 ${cRect.width.toFixed(1)} ${cRect.height.toFixed(1)}`);
            group.innerHTML = '';

            const rows = Array.from(canvas.querySelectorAll('[data-tl-row]')).map((rowEl) => {
                const nodes = Array.from(rowEl.querySelectorAll('[data-tl-col]')).map((colEl) => {
                    const boxEl = colEl.querySelector('[data-tl-node]');
                    if (!boxEl) return null;
                    const bRect = boxEl.getBoundingClientRect();
                    const colRect = colEl.getBoundingClientRect();
                    return {
                        status: boxEl.dataset.tlStatus || 'upcoming',
                        left: bRect.left - cRect.left,
                        right: bRect.right - cRect.left,
                        top: bRect.top - cRect.top,
                        cy: bRect.top - cRect.top + bRect.height / 2,
                        colLeft: colRect.left - cRect.left,
                        colRight: colRect.right - cRect.left,
                        colBottom: colRect.bottom - cRect.top,
                    };
                }).filter(Boolean);
                return { nodes };
            }).filter((r) => r.nodes.length > 0);

            rows.forEach((row, rIdx) => {
                for (let i = 0; i < row.nodes.length - 1; i++) {
                    const src = row.nodes[i];
                    const dst = row.nodes[i + 1];
                    const y = (src.cy + dst.cy) / 2;
                    const startX = src.right;
                    const arrowTipX = dst.left - 1.5;
                    const lineEndX = Math.max(startX + 4, arrowTipX - 4);
                    const variant = resolveTimelineSegmentVariant(src.status, dst.status);
                    const d = `M ${startX.toFixed(1)} ${y.toFixed(1)} L ${lineEndX.toFixed(1)} ${y.toFixed(1)}`;
                    appendConnector(group, d, [startX, y], [arrowTipX, y], variant, null);
                }

                if (rIdx < rows.length - 1) {
                    const nextRow = rows[rIdx + 1];
                    const src = row.nodes[row.nodes.length - 1];
                    const dst = nextRow.nodes[0];
                    const variant = resolveTimelineSegmentVariant(src.status, dst.status);

                    const startX = src.right;
                    const startY = src.cy;
                    const arrowTipX = dst.left - 1.5;
                    const lineEndX = arrowTipX - 4;
                    const endY = dst.cy;

                    const outX = Math.min(cRect.width - 8, Math.max(startX + 36, src.colRight + 10));
                    const inX = Math.max(8, Math.min(arrowTipX - 36, dst.colLeft - 10));

                    const rowBottom = Math.max(...row.nodes.map((n) => n.colBottom));
                    const nextBadgeTop = dst.top - 14;
                    const laneY = Math.round((rowBottom + nextBadgeTop) / 2);

                    const d = buildRoundedOrthogonalPath([
                        [startX, startY],
                        [outX, startY],
                        [outX, laneY],
                        [inX, laneY],
                        [inX, endY],
                        [lineEndX, endY],
                    ], 16);

                    appendConnector(group, d, [startX, startY], [arrowTipX, endY], variant, [(outX + inX) / 2, laneY]);
                }
            });
        });
    }

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') closeTimelineModal();
    });

    document.addEventListener('DOMContentLoaded', () => {
        const modal = document.getElementById('timeline-detail-modal');
        if (modal) {
            modal.addEventListener('click', (e) => {
                if (e.target === modal) closeTimelineModal();
            });
        }

        drawTimelineConnectors();
        requestAnimationFrame(drawTimelineConnectors);
        if (document.fonts && document.fonts.ready) {
            document.fonts.ready.then(drawTimelineConnectors);
        }

        let resizeTimer;
        window.addEventListener('resize', () => {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(drawTimelineConnectors, 80);
        });

        if (typeof ResizeObserver !== 'undefined') {
            const ro = new ResizeObserver(() => requestAnimationFrame(drawTimelineConnectors));
            document.querySelectorAll('[data-tl-canvas]').forEach((el) => ro.observe(el));
        }
    });
</script>
