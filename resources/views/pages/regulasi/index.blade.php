<x-layouts.app :title="'Dasar Hukum & Tata Kelola Data Warga - Kelurahan Sukawarna'">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 py-10 space-y-10">
        <!-- Header -->
        <div class="bg-white rounded-3xl p-6 sm:p-10 border border-gray-200/90 shadow-xs space-y-4">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-[#1B4332]/10 text-[#1B4332] text-xs font-bold uppercase tracking-wider">
                Transparansi Hukum & Pelindungan Data Pribadi
            </div>
            <h1 class="font-display font-bold text-3xl sm:text-4xl text-[#1B4332] leading-tight tracking-tight">
                Regulasi Acuan Pengambilan, Penyimpanan & Pemrosesan Data Warga
            </h1>
            <p class="text-sm text-gray-600 max-w-4xl leading-relaxed">
                Pemerintah Kelurahan Sukawarna menyelenggarakan pendataan kependudukan (datang, pindah, lahir, wafat), pemantauan kesehatan keluarga Posyandu, serta keterbukaan informasi publik berdasarkan lima regulasi resmi pemerintah Indonesia berikut agar tercipta kepastian hukum dan kejelasan perlindungan privasi bagi seluruh warga.
            </p>
            <div class="pt-2 flex flex-wrap gap-3">
                <a href="{{ route('dokumen.index', ['kategori' => 'Peraturan']) }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-[#1B4332] text-white text-xs font-bold hover:bg-[#2D6A4F] transition-colors">
                    <span>Unduh Naskah Pedoman di Repositori KIP</span>
                </a>
                <a href="{{ route('satu-data.index') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl border border-gray-200 text-gray-700 text-xs font-semibold hover:border-[#1B4332] hover:text-[#1B4332] transition-colors">
                    <span>Lihat Portal Satu Data Agregat</span>
                </a>
            </div>
        </div>

        <!-- 5 Core Regulations Cards -->
        <div class="space-y-4">
            <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-2">
                <div>
                    <h2 class="font-display font-bold text-2xl text-[#1B4332]">Lima Regulasi Acuan Resmi</h2>
                    <p class="text-xs text-gray-500 mt-0.5">Landasan hukum nasional dan kemendagri yang diterapkan langsung di sistem kelurahan.</p>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                @foreach ($regulasiList as $idx => $reg)
                    @php
                        $matchingDoc = $dokumenRegulasi->first(fn ($doc) => str_contains($doc->judul, $reg['kata_kunci_dokumen']));
                    @endphp
                    <article class="bg-white rounded-2xl p-6 border border-gray-200/90 flex flex-col justify-between space-y-4">
                        <div class="space-y-3">
                            <div class="flex items-start justify-between gap-3 border-b border-gray-100 pb-3">
                                <div>
                                    <span class="text-[11px] font-bold uppercase tracking-wider text-[#2D6A4F] block">
                                        Regulasi 0{{ $idx + 1 }} &middot; {{ $reg['fokus'] }}
                                    </span>
                                    <h3 class="font-display font-bold text-lg text-[#1B4332] mt-0.5">
                                        {{ $reg['kode'] }}
                                    </h3>
                                    <p class="text-xs font-medium text-gray-700 mt-0.5">
                                        {{ $reg['tentang'] }}
                                    </p>
                                </div>
                            </div>

                            <p class="text-xs text-gray-600 leading-relaxed">
                                {{ $reg['ringkasan'] }}
                            </p>

                            <div class="space-y-1.5 pt-1">
                                <span class="text-[11px] font-bold uppercase tracking-wider text-gray-500 block">
                                    Implementasi Nyata di Kelurahan Sukawarna:
                                </span>
                                <ul class="space-y-1.5 text-xs text-gray-700 list-disc list-inside">
                                    @foreach ($reg['penerapan'] as $poin)
                                        <li class="leading-relaxed">{{ $poin }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        <div class="pt-4 border-t border-gray-100 flex items-center justify-between gap-3 text-xs">
                            <span class="text-[11px] text-gray-500">{{ $reg['instansi'] }}</span>
                            @if ($matchingDoc)
                                <a href="{{ route('dokumen.download', $matchingDoc) }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-gray-100 hover:bg-[#1B4332] text-gray-800 hover:text-white font-semibold transition-colors shrink-0">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                                    <span>Unduh Pedoman</span>
                                </a>
                            @endif
                        </div>
                    </article>
                @endforeach
            </div>
        </div>

        <!-- Lifecycle Transparency Matrix -->
        <div class="bg-white rounded-3xl border border-gray-200/90 overflow-hidden">
            <div class="px-6 py-5 border-b border-gray-200 space-y-1">
                <h2 class="font-display font-bold text-xl text-[#1B4332]">
                    Matriks Siklus Pengambilan, Penyimpanan, Pemrosesan & Publikasi Data
                </h2>
                <p class="text-xs text-gray-500">
                    Menjelaskan secara terbuka perbedaan data privat yang dilindungi dan data agregat yang ditayangkan kepada publik.
                </p>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse text-xs">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-200 text-gray-600 font-semibold">
                            <th class="px-5 py-3.5 min-w-[200px]">Jenis Data</th>
                            <th class="px-5 py-3.5 min-w-[200px]">Pengambilan Data</th>
                            <th class="px-5 py-3.5 min-w-[200px]">Penyimpanan & Keamanan</th>
                            <th class="px-5 py-3.5 min-w-[200px]">Pemrosesan & Sinkronisasi</th>
                            <th class="px-5 py-3.5 min-w-[200px]">Aturan Publikasi Terbuka</th>
                            <th class="px-5 py-3.5 min-w-[160px]">Acuan Regulasi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($matriksData as $row)
                            <tr class="align-top hover:bg-gray-50/70">
                                <td class="px-5 py-4 font-bold text-[#1B4332]">{{ $row['kategori'] }}</td>
                                <td class="px-5 py-4 text-gray-600 leading-relaxed">{{ $row['pengambilan'] }}</td>
                                <td class="px-5 py-4 text-gray-600 leading-relaxed">{{ $row['penyimpanan'] }}</td>
                                <td class="px-5 py-4 text-gray-600 leading-relaxed">{{ $row['pemrosesan'] }}</td>
                                <td class="px-5 py-4 text-gray-700 font-medium leading-relaxed">{{ $row['publikasi'] }}</td>
                                <td class="px-5 py-4 font-mono text-[11px] text-[#1B4332]">{{ $row['acuan'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Citizen Rights Section under UU PDP -->
        <div class="bg-[#F4F7F4] rounded-3xl p-6 sm:p-8 border border-[#1B4332]/15 grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="md:col-span-2 space-y-2.5">
                <h2 class="font-display font-bold text-lg text-[#1B4332]">
                    Hak Warga Atas Data Pribadi (UU No. 27 Tahun 2022)
                </h2>
                <p class="text-xs text-gray-700 leading-relaxed">
                    Warga Kelurahan Sukawarna berhak memperoleh kejelasan tujuan pencatatan data, meminta pembaruan atau perbaikan ketidakakuratan data kependudukan (seperti perubahan anggota keluarga, domisili, atau status pekerjaan/pendidikan), serta melaporkan dugaan penyalahgunaan data kepada Petugas Pengelola Data Kelurahan melalui loket resmi atau kanal pengaduan.
                </p>
            </div>
            <div class="flex flex-col justify-center gap-2.5">
                <a href="{{ route('pengaduan.index') }}" class="inline-flex items-center justify-center px-4 py-2.5 rounded-xl bg-[#1B4332] text-white text-xs font-bold hover:bg-[#2D6A4F] transition-colors">
                    Ajukan Koreksi Data / Pengaduan
                </a>
                <a href="{{ route('layanan.index') }}" class="inline-flex items-center justify-center px-4 py-2.5 rounded-xl bg-white border border-gray-300 text-gray-800 text-xs font-semibold hover:border-[#1B4332] transition-colors">
                    Lihat Syarat Layanan Adminduk
                </a>
            </div>
        </div>
    </div>
</x-layouts.app>
