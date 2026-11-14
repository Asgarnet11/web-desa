@props(['data'])

@php
    $statistik = $data['statistik'] ?? [];
    $demografi = $statistik['demografi'] ?? [];
    $rincian = $demografi['rincian'] ?? [];
    $usia = $rincian['usia'] ?? ['0-14' => 2650, '15-39' => 4890, '40-64' => 3720, '65+' => 1190];
    $pendidikan = $rincian['pendidikan'] ?? ['SD' => 1850, 'SMP' => 2420, 'SMA/SMK' => 5230, 'Diploma/Sarjana' => 2950];
@endphp

<section id="statistik" class="py-16 md:py-24 bg-[#FFF8E7]">
    <div class="max-w-7xl mx-auto px-6 space-y-12">
        <div class="max-w-2xl space-y-3">
            <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-[#219EBC]/15 text-[#17708A] text-xs font-bold uppercase tracking-wider">
                Data Statistik Agregat
            </div>
            <h2 class="font-display font-bold text-3xl sm:text-4xl text-[#1B4332]">
                Infografis Kependudukan & Kondisi Sosial
            </h2>
            <p class="text-sm text-[#1F2D26]/75">
                Data agregat kependudukan terverifikasi untuk mendukung transparansi dan ketepatan perencanaan program kerja.
            </p>
        </div>

        <!-- Gender & Age Composition Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            <!-- Gender Ratio Card -->
            <div class="lg:col-span-5 bg-white rounded-[32px] p-7 border border-[#52B788]/20 shadow-soft space-y-6">
                <h3 class="font-display font-bold text-lg text-[#1B4332]">Komposisi Jenis Kelamin</h3>
                
                <div class="grid grid-cols-2 gap-4">
                    <div class="p-4 rounded-2xl bg-[#8ECFEA]/15 border border-[#8ECFEA]/30">
                        <span class="text-xs font-bold text-[#17708A] uppercase">Laki-Laki</span>
                        <div class="font-display font-bold text-2xl sm:text-3xl text-[#1B4332] tabular-nums mt-1" data-count-target="{{ $demografi['laki_laki'] ?? 6180 }}">
                            0
                        </div>
                        <span class="text-[11px] text-[#1F2D26]/70">49.6% dari total</span>
                    </div>

                    <div class="p-4 rounded-2xl bg-[#52B788]/15 border border-[#52B788]/30">
                        <span class="text-xs font-bold text-[#2D6A4F] uppercase">Perempuan</span>
                        <div class="font-display font-bold text-2xl sm:text-3xl text-[#1B4332] tabular-nums mt-1" data-count-target="{{ $demografi['perempuan'] ?? 6270 }}">
                            0
                        </div>
                        <span class="text-[11px] text-[#1F2D26]/70">50.4% dari total</span>
                    </div>
                </div>

                <div class="space-y-3 pt-2">
                    <h4 class="font-display font-bold text-xs uppercase tracking-wider text-[#17708A]">Sebaran Kelompok Usia</h4>
                    <div class="space-y-2 text-xs">
                        @foreach($usia as $label => $jumlah)
                            <div>
                                <div class="flex justify-between font-semibold text-[#1F2D26] mb-1">
                                    <span>Usia {{ $label }} Tahun</span>
                                    <span>{{ number_format($jumlah, 0, ',', '.') }} Jiwa</span>
                                </div>
                                <div class="w-full h-2.5 rounded-full bg-gray-100 overflow-hidden">
                                    <div class="h-full bg-[#2D6A4F] rounded-full" style="width: {{ min(100, round(($jumlah / 12450) * 100 * 2.2)) }}%"></div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Education and Social Conditions -->
            <div class="lg:col-span-7 space-y-6">
                <!-- Education Card -->
                <div class="bg-white rounded-[32px] p-7 border border-[#52B788]/20 shadow-soft space-y-4">
                    <h3 class="font-display font-bold text-lg text-[#1B4332]">Tingkat Pendidikan Warga</h3>
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 text-center">
                        @foreach($pendidikan as $jenjang => $total)
                            <div class="p-4 rounded-2xl bg-[#FFF8E7] border border-[#52B788]/20">
                                <span class="text-[11px] font-bold text-[#17708A] uppercase">{{ $jenjang }}</span>
                                <div class="font-display font-bold text-xl text-[#1B4332] mt-1">
                                    {{ number_format($total, 0, ',', '.') }}
                                </div>
                                <span class="text-[10px] text-[#1F2D26]/70">Jiwa</span>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Social & Disaster Status -->
                <div class="bg-gradient-to-r from-[#1B4332] to-[#2D6A4F] text-[#FFF8E7] rounded-[32px] p-7 shadow-soft space-y-4">
                    <div class="flex items-center justify-between">
                        <h3 class="font-display font-bold text-lg text-white">Status Ketahanan Sosial & Bencana</h3>
                        <span class="px-3 py-1 rounded-full bg-[#52B788] text-[#1B4332] text-xs font-bold">Mandiri & Siaga</span>
                    </div>
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-4 pt-2 text-xs">
                        <div class="p-3.5 rounded-2xl bg-white/10 border border-white/10">
                            <span class="text-white/70 block">Penerima Bantuan PKH</span>
                            <strong class="text-base text-[#FFB703] font-display">340 KK</strong>
                        </div>
                        <div class="p-3.5 rounded-2xl bg-white/10 border border-white/10">
                            <span class="text-white/70 block">Bebas Stunting Balita</span>
                            <strong class="text-base text-[#FFB703] font-display">99.2%</strong>
                        </div>
                        <div class="p-3.5 rounded-2xl bg-white/10 border border-white/10">
                            <span class="text-white/70 block">Infrastruktur Baik</span>
                            <strong class="text-base text-[#FFB703] font-display">92.5%</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

