<x-layouts.app :title="'Satu Data & Transparansi Publik - Kelurahan Sukawarna'">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 py-10 space-y-12">
        <!-- Page Header -->
        <div class="space-y-2">
            <div class="flex items-center gap-2 text-xs font-bold text-[#FFB703] uppercase tracking-wider">
                <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 animate-pulse"></span>
                <span>PORTAL SATU DATA & KETERBUKAAN INFORMASI PUBLIK (KIP)</span>
            </div>
            <h1 class="font-serif font-black text-3xl sm:text-4xl text-[#1B4332] tracking-tight">
                Statistik Kewilayahan & Ekosistem Data Terbuka
            </h1>
            <p class="text-xs sm:text-sm text-gray-600 max-w-3xl leading-relaxed">
                Akses terbuka data agregat kependudukan, capaian pembangunan, sebaran infrastruktur publik, dan direktori ekonomi Kelurahan Sukawarna. Terbuka bagi masyarakat, perencana kota, dan akademisi.
            </p>
        </div>

        <!-- Section 1: Key Metric Highlight Cards -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 sm:gap-6">
            <!-- Penduduk -->
            <div class="bg-white rounded-3xl p-6 border border-gray-200/90 shadow-xs space-y-2">
                <div class="flex items-center justify-between text-gray-400">
                    <span class="text-[10px] font-bold uppercase tracking-wider">Total Penduduk</span>
                    <span class="text-lg">👥</span>
                </div>
                <h3 class="font-serif font-black text-2xl sm:text-3xl text-[#1B4332]">
                    {{ number_format($statistik['demografi']['total_penduduk'] ?? 14250, 0, ',', '.') }}
                </h3>
                <span class="text-[11px] text-gray-500 block">
                    {{ number_format($statistik['demografi']['total_kk'] ?? 4180, 0, ',', '.') }} Kepala Keluarga
                </span>
            </div>

            <!-- Wilayah & RW -->
            <div class="bg-white rounded-3xl p-6 border border-gray-200/90 shadow-xs space-y-2">
                <div class="flex items-center justify-between text-gray-400">
                    <span class="text-[10px] font-bold uppercase tracking-wider">Luas Wilayah</span>
                    <span class="text-lg">🗺️</span>
                </div>
                <h3 class="font-serif font-black text-2xl sm:text-3xl text-[#1B4332]">
                    {{ $wilayah?->luas ?? '1.45' }} <span class="text-base font-bold text-gray-500">km²</span>
                </h3>
                <span class="text-[11px] text-gray-500 block">
                    {{ $statistik['wilayah']['rw_count'] ?? 7 }} Rukun Warga (RW)
                </span>
            </div>

            <!-- Fasilitas Publik -->
            <div class="bg-white rounded-3xl p-6 border border-gray-200/90 shadow-xs space-y-2">
                <div class="flex items-center justify-between text-gray-400">
                    <span class="text-[10px] font-bold uppercase tracking-wider">Sarana Publik</span>
                    <span class="text-lg">🏥</span>
                </div>
                <h3 class="font-serif font-black text-2xl sm:text-3xl text-[#0284C7]">
                    {{ $statistik['fasilitas']['total'] ?? 7 }} <span class="text-base font-bold text-gray-500">Titik</span>
                </h3>
                <span class="text-[11px] text-emerald-700 font-bold block">
                    {{ $statistik['infrastruktur']['persentase_baik'] ?? 95 }}% Kondisi Baik
                </span>
            </div>

            <!-- Pengaduan Selesai -->
            <div class="bg-white rounded-3xl p-6 border border-gray-200/90 shadow-xs space-y-2">
                <div class="flex items-center justify-between text-gray-400">
                    <span class="text-[10px] font-bold uppercase tracking-wider">Respon Aduan Warga</span>
                    <span class="text-lg">✅</span>
                </div>
                <h3 class="font-serif font-black text-2xl sm:text-3xl text-emerald-700">
                    {{ $rasioSelesai }}%
                </h3>
                <span class="text-[11px] text-gray-500 block">
                    {{ $pengaduanSelesai }} dari {{ $totalPengaduan }} Tiket Selesai
                </span>
            </div>
        </div>

        <!-- Section 2: Demographic & Facilities Breakdown Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-start">
            <!-- Left: Demografi Gender & Usia -->
            <div class="bg-white rounded-3xl p-6 sm:p-8 border border-gray-200/90 shadow-xs space-y-6">
                <div class="flex items-center justify-between border-b border-gray-100 pb-3">
                    <h3 class="font-serif font-bold text-lg text-[#1B4332] flex items-center gap-2">
                        <span>Komposisi Penduduk Berdasarkan Jenis Kelamin</span>
                    </h3>
                    <span class="text-xs text-gray-400 font-mono">Tahun 2026</span>
                </div>

                @php
                    $lk = $statistik['demografi']['laki_laki'] ?? 7180;
                    $pr = $statistik['demografi']['perempuan'] ?? 7070;
                    $tot = $lk + $pr > 0 ? $lk + $pr : 1;
                    $pctLk = round(($lk / $tot) * 100, 1);
                    $pctPr = round(($pr / $tot) * 100, 1);
                @endphp

                <div class="space-y-4">
                    <div class="space-y-2">
                        <div class="flex items-center justify-between text-xs font-bold">
                            <span class="text-sky-800 flex items-center gap-1.5">
                                <span class="w-2.5 h-2.5 rounded-full bg-sky-500"></span>
                                <span>Laki-laki ({{ number_format($lk, 0, ',', '.') }} Jiwa)</span>
                            </span>
                            <span class="font-mono text-gray-600">{{ $pctLk }}%</span>
                        </div>
                        <div class="w-full h-3 rounded-full bg-gray-100 overflow-hidden">
                            <div class="h-full bg-sky-500" style="width: {{ $pctLk }}%"></div>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <div class="flex items-center justify-between text-xs font-bold">
                            <span class="text-rose-800 flex items-center gap-1.5">
                                <span class="w-2.5 h-2.5 rounded-full bg-rose-400"></span>
                                <span>Perempuan ({{ number_format($pr, 0, ',', '.') }} Jiwa)</span>
                            </span>
                            <span class="font-mono text-gray-600">{{ $pctPr }}%</span>
                        </div>
                        <div class="w-full h-3 rounded-full bg-gray-100 overflow-hidden">
                            <div class="h-full bg-rose-400" style="width: {{ $pctPr }}%"></div>
                        </div>
                    </div>
                </div>

                <div class="p-4 rounded-2xl bg-[#FFF8E7] border border-amber-200/60 text-xs text-gray-700 leading-relaxed space-y-1">
                    <strong class="text-[#1B4332] block">Kepadatan Penduduk:</strong>
                    <p>Rasio kepadatan berada pada kisaran <strong>9.827 Jiwa/km²</strong> yang tersebar di sepanjang 7 Rukun Warga (RW) dengan tingkat kohesi sosial dan ketahanan lingkungan yang tinggi.</p>
                </div>
            </div>

            <!-- Right: Sebaran Fasilitas Publik per Kategori -->
            <div class="bg-white rounded-3xl p-6 sm:p-8 border border-gray-200/90 shadow-xs space-y-6">
                <div class="flex items-center justify-between border-b border-gray-100 pb-3">
                    <h3 class="font-serif font-bold text-lg text-[#1B4332]">
                        Sebaran Sarana Publik Terverifikasi
                    </h3>
                    <a href="{{ route('peta.index') }}" class="text-xs font-bold text-[#0284C7] hover:underline">
                        Buka di Peta &rarr;
                    </a>
                </div>

                <div class="space-y-3">
                    @forelse($statistik['fasilitas']['per_kategori'] ?? [] as $kategoriNama => $count)
                        <div class="flex items-center justify-between p-3 rounded-2xl bg-gray-50 border border-gray-100 text-xs">
                            <div class="flex items-center gap-2.5">
                                <span class="w-2.5 h-2.5 rounded-full bg-[#1B4332]"></span>
                                <span class="font-semibold text-gray-800">{{ $kategoriNama }}</span>
                            </div>
                            <span class="font-mono font-bold px-2.5 py-0.5 rounded-full bg-white text-[#1B4332] border border-gray-200 shadow-2xs">
                                {{ $count }} Unit
                            </span>
                        </div>
                    @empty
                        <div class="text-center py-6 text-xs text-gray-400">
                            Data sebaran fasilitas publik sedang diperbarui.
                        </div>
                    @endforelse

                    <div class="flex items-center justify-between p-3 rounded-2xl bg-orange-50 border border-orange-100 text-xs">
                        <div class="flex items-center gap-2.5">
                            <span class="w-2.5 h-2.5 rounded-full bg-orange-500"></span>
                            <span class="font-semibold text-orange-900">UMKM & Sentra Usaha Binaan</span>
                        </div>
                        <span class="font-mono font-bold px-2.5 py-0.5 rounded-full bg-white text-orange-700 border border-orange-200 shadow-2xs">
                            {{ $totalUmkm }} Usaha
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section 3: Open Data Catalog (Download Center) -->
        <div class="space-y-6 pt-4">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="font-serif font-black text-2xl text-[#1B4332]">Katalog Unduh Data Terbuka (Open Data Hub)</h2>
                    <p class="text-xs sm:text-sm text-gray-600 mt-0.5">Unduh dataset resmi bebas royalti dalam format standar geospasial & tabular.</p>
                </div>
                <span class="px-3 py-1 rounded-full bg-emerald-100 text-emerald-800 text-xs font-bold uppercase">
                    Lisensi Terbuka (CC-BY 4.0)
                </span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- GeoJSON Batas -->
                <div class="bg-white rounded-3xl p-6 border border-gray-200 shadow-xs hover:border-[#1B4332] transition-colors flex flex-col justify-between space-y-4">
                    <div class="space-y-2">
                        <div class="w-10 h-10 rounded-2xl bg-emerald-50 text-emerald-700 flex items-center justify-center text-xl font-bold">
                            🗺️
                        </div>
                        <h4 class="font-serif font-bold text-base text-[#1B4332]">Batas Poligon Kelurahan</h4>
                        <p class="text-xs text-gray-500 leading-relaxed">
                            Geometri batas administratif batas wilayah Kelurahan Sukawarna format GeoJSON.
                        </p>
                    </div>
                    <a href="{{ route('api.geojson.batas') }}" target="_blank" 
                       class="w-full inline-flex items-center justify-center gap-2 py-2 px-3 rounded-xl bg-gray-100 hover:bg-[#1B4332] text-gray-800 hover:text-white font-bold text-xs transition-colors">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                        <span>Unduh .GeoJSON</span>
                    </a>
                </div>

                <!-- GeoJSON Fasilitas -->
                <div class="bg-white rounded-3xl p-6 border border-gray-200 shadow-xs hover:border-[#0284C7] transition-colors flex flex-col justify-between space-y-4">
                    <div class="space-y-2">
                        <div class="w-10 h-10 rounded-2xl bg-sky-50 text-sky-700 flex items-center justify-center text-xl font-bold">
                            📍
                        </div>
                        <h4 class="font-serif font-bold text-base text-[#1B4332]">Titik Sarana Publik</h4>
                        <p class="text-xs text-gray-500 leading-relaxed">
                            Sebaran koordinat sekolah, faskes, posko, dan sarana umum format GeoJSON.
                        </p>
                    </div>
                    <a href="{{ route('api.geojson.fasilitas') }}" target="_blank" 
                       class="w-full inline-flex items-center justify-center gap-2 py-2 px-3 rounded-xl bg-gray-100 hover:bg-[#0284C7] text-gray-800 hover:text-white font-bold text-xs transition-colors">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                        <span>Unduh .GeoJSON</span>
                    </a>
                </div>

                <!-- GeoJSON UMKM -->
                <div class="bg-white rounded-3xl p-6 border border-gray-200 shadow-xs hover:border-orange-500 transition-colors flex flex-col justify-between space-y-4">
                    <div class="space-y-2">
                        <div class="w-10 h-10 rounded-2xl bg-orange-50 text-orange-700 flex items-center justify-center text-xl font-bold">
                            🛍️
                        </div>
                        <h4 class="font-serif font-bold text-base text-[#1B4332]">Titik UMKM & Ekonomi</h4>
                        <p class="text-xs text-gray-500 leading-relaxed">
                            Geolokasi titik usaha binaan warga, kategori, dan kontak resmi WhatsApp.
                        </p>
                    </div>
                    <a href="{{ route('api.geojson.umkm') }}" target="_blank" 
                       class="w-full inline-flex items-center justify-center gap-2 py-2 px-3 rounded-xl bg-gray-100 hover:bg-orange-600 text-gray-800 hover:text-white font-bold text-xs transition-colors">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                        <span>Unduh .GeoJSON</span>
                    </a>
                </div>

                <!-- CSV Agregat -->
                <div class="bg-white rounded-3xl p-6 border border-gray-200 shadow-xs hover:border-[#FFB703] transition-colors flex flex-col justify-between space-y-4">
                    <div class="space-y-2">
                        <div class="w-10 h-10 rounded-2xl bg-amber-50 text-amber-700 flex items-center justify-center text-xl font-bold">
                            📊
                        </div>
                        <h4 class="font-serif font-bold text-base text-[#1B4332]">Dataset Agregat Wilayah</h4>
                        <p class="text-xs text-gray-500 leading-relaxed">
                            Tabel ringkasan demografi, rasio penduduk, jumlah RW, dan infrastruktur format CSV.
                        </p>
                    </div>
                    <a href="{{ route('satu-data.export-csv') }}" 
                       class="w-full inline-flex items-center justify-center gap-2 py-2 px-3 rounded-xl bg-[#FFB703] hover:bg-amber-400 text-[#1B4332] font-bold text-xs transition-colors shadow-2xs">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                        <span>Unduh .CSV</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
