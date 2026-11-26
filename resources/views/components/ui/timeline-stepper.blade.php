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
                
                <!-- 1. DESKTOP VIEW: The Exact 5-Column Serpentine S-Curve Stepper (Reference Fidelity) -->
                <div class="hidden lg:block space-y-16">
                    @foreach($tl['rows'] as $rowIndex => $nodes)
                        <div class="relative">
                            <!-- Horizontal Nodes Row (5-col grid) -->
                            <div class="grid grid-cols-5 gap-x-4 items-start relative z-10">
                                @foreach($nodes as $nodeIndex => $node)
                                    <div class="flex flex-col items-center text-center relative group">
                                        <!-- Node Icon Box Container -->
                                        <div class="w-20 h-20 rounded-2xl border-2 {{ $node['status'] === 'completed' ? 'border-sky-300 bg-sky-50/60' : ($node['status'] === 'active' ? 'border-[#0284C7] bg-sky-100/70 ring-4 ring-sky-200/50' : 'border-slate-200 bg-slate-50/70') }} flex items-center justify-center relative shadow-sm group-hover:scale-105 transition-all duration-300">
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

                                        <!-- Chevron Arrow between nodes -->
                                        @if(!$loop->last)
                                            <div class="absolute top-7 -right-4 translate-x-1/2 text-sky-300 z-0 pointer-events-none">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
                                                </svg>
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>

                            <!-- Serpentine Looping Connector Line from Right of Row to Left of Next Row -->
                            @if(!$loop->last)
                                <div class="absolute -bottom-10 right-10 w-24 h-16 pointer-events-none z-0">
                                    <svg class="w-full h-full text-sky-200" viewBox="0 0 100 60" fill="none" stroke="currentColor" stroke-width="2.5">
                                        <path d="M 0 0 C 80 0, 80 60, 0 60" stroke-linecap="round"/>
                                        <polyline points="10,55 0,60 10,65" stroke-width="2.5"/>
                                    </svg>
                                </div>
                            @endif
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
    });
</script>
