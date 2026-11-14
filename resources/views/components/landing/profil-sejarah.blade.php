@props(['data'])

@php
    $profil = $data['profil'] ?? null;
    $wilayah = $data['wilayah'] ?? null;
@endphp

<section id="profil" class="py-16 md:py-24 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            <!-- Left Column: Story & History -->
            <div class="lg:col-span-7 space-y-6">
                <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-[#52B788]/20 text-[#1B4332] text-xs font-bold uppercase tracking-wider">
                    Profil Kelurahan
                </div>

                <h2 class="font-display font-bold text-3xl sm:text-4xl text-[#1B4332] leading-tight">
                    Mengenal Lebih Dekat Wilayah Sukawarna
                </h2>

                <p class="text-base text-[#1F2D26]/85 leading-relaxed">
                    {{ $profil?->sejarah ?? 'Kelurahan Sukawarna terbentuk dengan semangat gotong royong dan kemandirian masyarakatnya dalam merawat lingkungan yang asri dan berdaya.' }}
                </p>

                <div class="p-5 rounded-[24px] bg-[#FFF8E7] border border-[#52B788]/20 space-y-2">
                    <h4 class="font-display font-bold text-sm text-[#1B4332]">Makna Lambang</h4>
                    <p class="text-xs text-[#1F2D26]/80 leading-relaxed">
                        {{ $profil?->makna_lambang ?? 'Pohon Hayat berakar kuat melambangkan solidaritas warga; mentari emas melambangkan kemandirian energi dan optimisme masa depan.' }}
                    </p>
                </div>

                <!-- Boundaries Grid -->
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 pt-2">
                    <div class="p-3.5 rounded-2xl bg-gray-50 border border-gray-100">
                        <span class="text-[10px] font-bold text-[#17708A] uppercase">Batas Utara</span>
                        <p class="text-xs font-semibold text-[#1B4332] mt-0.5">{{ $profil?->batas_utara ?? 'Sarijadi' }}</p>
                    </div>
                    <div class="p-3.5 rounded-2xl bg-gray-50 border border-gray-100">
                        <span class="text-[10px] font-bold text-[#17708A] uppercase">Batas Selatan</span>
                        <p class="text-xs font-semibold text-[#1B4332] mt-0.5">{{ $profil?->batas_selatan ?? 'Cicendo' }}</p>
                    </div>
                    <div class="p-3.5 rounded-2xl bg-gray-50 border border-gray-100">
                        <span class="text-[10px] font-bold text-[#17708A] uppercase">Batas Timur</span>
                        <p class="text-xs font-semibold text-[#1B4332] mt-0.5">{{ $profil?->batas_timur ?? 'Gegerkalong' }}</p>
                    </div>
                    <div class="p-3.5 rounded-2xl bg-gray-50 border border-gray-100">
                        <span class="text-[10px] font-bold text-[#17708A] uppercase">Batas Barat</span>
                        <p class="text-xs font-semibold text-[#1B4332] mt-0.5">{{ $profil?->batas_barat ?? 'Kota Cimahi' }}</p>
                    </div>
                </div>
            </div>

            <!-- Right Column: Visual Card -->
            <div class="lg:col-span-5">
                <div class="bg-[#1B4332] text-[#FFF8E7] rounded-[36px] p-8 space-y-6 shadow-soft relative overflow-hidden">
                    <div class="absolute -right-10 -bottom-10 w-44 h-44 rounded-full bg-[#52B788]/20 blur-2xl"></div>
                    
                    <div class="space-y-2">
                        <span class="text-xs font-bold text-[#FFB703] uppercase tracking-wider">Identitas Wilayah</span>
                        <h3 class="font-display font-bold text-2xl text-white">Kelurahan Sukawarna</h3>
                        <p class="text-xs text-[#8ECFEA]">Kecamatan Sukasari &bull; Kota Bandung</p>
                    </div>

                    <div class="divide-y divide-white/10 text-xs">
                        <div class="py-2.5 flex justify-between">
                            <span class="text-white/70">Kode Wilayah</span>
                            <span class="font-mono font-bold text-[#FFB703]">{{ $wilayah?->kode ?? '32.73.01.1001' }}</span>
                        </div>
                        <div class="py-2.5 flex justify-between">
                            <span class="text-white/70">Tahun Terbentuk</span>
                            <span class="font-bold text-white">{{ $profil?->tahun_terbentuk ?? '1982' }}</span>
                        </div>
                        <div class="py-2.5 flex justify-between">
                            <span class="text-white/70">Motto Pelayanan</span>
                            <span class="font-bold text-white">{{ $profil?->motto_pelayanan ?? 'CERIA' }}</span>
                        </div>
                        <div class="py-2.5 flex justify-between">
                            <span class="text-white/70">Jumlah Rukun Warga</span>
                            <span class="font-bold text-white">3 RW (18 RT)</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

