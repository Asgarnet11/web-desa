<x-layouts.app :title="'Layanan Administrasi - Kelurahan Sukawarna'">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 py-10 space-y-12">
        <!-- Page Header -->
        <div class="space-y-2">
            <span class="text-xs font-bold text-[#FFB703] uppercase tracking-wider block">Katalog Layanan Publik</span>
            <h1 class="font-serif font-black text-3xl sm:text-4xl text-[#1B4332] tracking-tight">
                Layanan Administrasi & Perizinan Warga
            </h1>
            <p class="text-xs sm:text-sm text-gray-600 max-w-2xl leading-relaxed">
                Panduan lengkap alur tahapan, persyaratan berkas, dan estimasi waktu penyelesaian layanan kependudukan di Kelurahan Sukawarna. Bebas biaya dan transparan.
            </p>
        </div>

        <!-- Timeline Stepper UI/UX Component (Reference Fidelity) -->
        <x-ui.timeline-stepper 
            :title="'ALUR TAHAPAN & ESTIMASI WAKTU PELAYANAN'"
        />

        <!-- Layanan Category Cards -->
        <div class="space-y-10 pt-4">
            @foreach($layananGrouped as $kategori => $daftarLayanan)
                <div class="space-y-4">
                    <div class="flex items-center gap-3">
                        <span class="w-3.5 h-3.5 rounded-full bg-[#FFB703]"></span>
                        <h2 class="font-serif font-bold text-2xl text-[#1B4332]">Layanan {{ $kategori }}</h2>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @foreach($daftarLayanan as $lay)
                            <div class="bg-white rounded-2xl p-6 border border-gray-200/90 shadow-sm hover:shadow-md transition-shadow space-y-4">
                                <div class="flex items-start justify-between gap-4">
                                    <div>
                                        <h3 class="font-serif font-bold text-lg text-[#1B4332]">{{ $lay->nama_layanan }}</h3>
                                        <div class="flex items-center gap-2 text-xs mt-1">
                                            <span class="px-2.5 py-0.5 rounded-full bg-[#0284C7]/15 text-[#0284C7] font-semibold">{{ $lay->waktu_penyelesaian }}</span>
                                            <span class="font-bold text-emerald-700">{{ $lay->biaya }}</span>
                                        </div>
                                    </div>
                                </div>

                                @if(!empty($lay->persyaratan))
                                    <div class="space-y-1.5 text-xs">
                                        <strong class="text-[#1B4332] block">Persyaratan Dokumen:</strong>
                                        <ul class="list-disc list-inside space-y-1 text-gray-600">
                                            @foreach($lay->persyaratan as $syarat)
                                                <li>{{ $syarat }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                @if($lay->alur_pelayanan)
                                    <div class="p-3.5 rounded-xl bg-sky-50/50 border border-sky-100 text-xs text-gray-700">
                                        <strong class="text-[#0369A1] block mb-1">Rincian Alur:</strong>
                                        <p>{{ $lay->alur_pelayanan }}</p>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-layouts.app>
