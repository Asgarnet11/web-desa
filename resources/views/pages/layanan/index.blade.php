<x-layouts.app :title="'Layanan Administrasi - Kelurahan Sukawarna'">
    <div class="max-w-7xl mx-auto px-6 py-10 space-y-10">
        <div>
            <span class="text-xs font-bold text-[#17708A] uppercase tracking-wider">Katalog Layanan Publik</span>
            <h1 class="font-display font-bold text-3xl sm:text-4xl text-[#1B4332] mt-1">
                Layanan Administrasi & Perizinan Warga
            </h1>
            <p class="text-xs sm:text-sm text-[#1F2D26]/75 mt-1">
                Panduan lengkap alur, persyaratan dokumen, dan estimasi waktu penyelesaian layanan.
            </p>
        </div>

        @foreach($layananGrouped as $kategori => $daftarLayanan)
            <div class="space-y-4">
                <div class="flex items-center gap-3">
                    <span class="w-3.5 h-3.5 rounded-full bg-[#FFB703]"></span>
                    <h2 class="font-display font-bold text-2xl text-[#1B4332]">Layanan {{ $kategori }}</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach($daftarLayanan as $lay)
                        <div class="bg-white rounded-[28px] p-6 border border-[#52B788]/20 shadow-soft space-y-4">
                            <div class="flex items-start justify-between gap-4">
                                <div>
                                    <h3 class="font-display font-bold text-lg text-[#1B4332]">{{ $lay->nama_layanan }}</h3>
                                    <div class="flex items-center gap-2 text-xs mt-1">
                                        <span class="px-2.5 py-0.5 rounded-full bg-[#219EBC]/15 text-[#17708A] font-semibold">{{ $lay->waktu_penyelesaian }}</span>
                                        <span class="font-bold text-emerald-700">{{ $lay->biaya }}</span>
                                    </div>
                                </div>
                            </div>

                            @if(!empty($lay->persyaratan))
                                <div class="space-y-1.5 text-xs">
                                    <strong class="text-[#1B4332] block">Persyaratan Berkas:</strong>
                                    <ul class="list-disc list-inside space-y-1 text-[#1F2D26]/80">
                                        @foreach($lay->persyaratan as $syarat)
                                            <li>{{ $syarat }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            @if($lay->alur_pelayanan)
                                <div class="p-3.5 rounded-2xl bg-[#FFF8E7] border border-[#52B788]/20 text-xs text-[#1F2D26]/85">
                                    <strong class="text-[#1B4332] block mb-1">Alur Proses:</strong>
                                    <p>{{ $lay->alur_pelayanan }}</p>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
</x-layouts.app>

