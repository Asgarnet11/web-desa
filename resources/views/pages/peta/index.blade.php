<x-layouts.app :title="'Peta Fasilitas & Batas Wilayah - Kelurahan Sukawarna'">
    <div class="max-w-[1600px] mx-auto px-4 sm:px-6 py-6 space-y-5">
        <!-- Breadcrumb & Top Bar -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 bg-white p-5 rounded-2xl border border-gray-200 shadow-xs">
            <div>
                <div class="flex items-center gap-2 text-xs font-bold text-[#FFB703] uppercase tracking-wider mb-1">
                    <span class="w-2 h-2 rounded-full bg-[#2D6A4F] animate-pulse"></span>
                    <span>SISTEM INFORMASI GEOGRAFIS (SIG) SPASIAL</span>
                </div>
                <h1 class="font-serif font-black text-2xl sm:text-3xl text-[#1B4332] tracking-tight">
                    Peta Fasilitas Publik & Batas Wilayah
                </h1>
                <p class="text-xs sm:text-sm text-gray-500 mt-1 max-w-2xl leading-relaxed">
                    Eksplorasi persebaran titik sarana pendidikan, kesehatan, peribadatan, posko darurat, dan fasilitas publik di Kelurahan Sukawarna, Kecamatan Sukasari, Kota Bandung.
                </p>
            </div>

            <!-- Top Actions -->
            <div class="flex items-center gap-2.5 flex-shrink-0">
                <a href="{{ route('landing') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl border border-gray-300 hover:border-[#1B4332] text-gray-700 hover:bg-gray-50 text-xs font-bold transition-colors shadow-xs">
                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                    <span>Beranda</span>
                </a>
                <a href="{{ route('pengaduan.index') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-[#FFB703] hover:bg-[#e5a502] text-[#1B4332] text-xs font-black uppercase tracking-wider transition-colors shadow-xs">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                    <span>Lapor Fasilitas</span>
                </a>
            </div>
        </div>

        <!-- Main 2-Panel Split Workspace (Sidebar + Interactive Map) -->
        <div class="relative grid grid-cols-1 lg:grid-cols-12 gap-5 items-start">
            
            <!-- LEFT PANEL: Search, Category Filters, and Facility List (Col 4 on Desktop, Drawer on Mobile) -->
            <div id="facility-sidebar" 
                 class="lg:col-span-4 bg-white rounded-3xl border border-gray-200 shadow-sm flex flex-col h-[720px] lg:h-[calc(100vh-210px)] overflow-hidden transition-all duration-300">
                
                <!-- Tab Switcher (Fasilitas vs UMKM) -->
                <div class="flex items-center border-b border-gray-200 bg-gray-50/70 p-1.5 gap-1.5">
                    <button type="button" 
                            id="tab-fasilitas-btn" 
                            class="sidebar-tab-btn flex-1 py-2 px-3 rounded-xl text-xs font-bold transition-all bg-[#0284C7] text-white shadow-xs flex items-center justify-center gap-1.5">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                        <span>Fasilitas ({{ $fasilitasList->count() }})</span>
                    </button>
                    <button type="button" 
                            id="tab-umkm-btn" 
                            class="sidebar-tab-btn flex-1 py-2 px-3 rounded-xl text-xs font-bold transition-all text-gray-600 hover:bg-orange-50 hover:text-orange-600 flex items-center justify-center gap-1.5">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                        <span>UMKM Warga ({{ $umkmList->count() }})</span>
                    </button>
                </div>

                <!-- Panel Header & Search Input -->
                <div class="p-4 sm:p-5 border-b border-gray-100 space-y-3 bg-gradient-to-b from-gray-50/70 to-white">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <span class="w-2.5 h-2.5 rounded-full bg-[#0284C7]"></span>
                            <h2 class="font-bold text-xs sm:text-sm text-[#0F172A] uppercase tracking-wider">Direktori Fasilitas</h2>
                        </div>
                        <span id="facility-count-badge" class="px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-sky-100 text-[#0284C7]">
                            {{ $fasilitasList->count() }} Fasilitas
                        </span>
                    </div>

                    <!-- Search Input with Clear Button -->
                    <div class="relative">
                        <input id="facility-search-input" 
                               type="text" 
                               placeholder="Cari fasilitas (Puskesmas, Sekolah, Masjid...)" 
                               class="w-full pl-9 pr-8 py-2.5 text-xs bg-white border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#0284C7] focus:border-transparent transition-all placeholder:text-gray-400">
                        <svg class="w-4 h-4 text-gray-400 absolute left-3 top-3 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        <button id="clear-search-btn" type="button" class="hidden absolute right-2.5 top-2.5 text-gray-400 hover:text-gray-600 p-0.5 rounded-full" title="Hapus pencarian">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                    </div>

                    <!-- Category Pills (Horizontal Scrollable) -->
                    <div class="flex items-center gap-1.5 overflow-x-auto pb-1 pt-0.5 scrollbar-thin">
                        <button type="button" 
                                data-category-filter="all" 
                                class="category-filter-btn px-3 py-1.5 rounded-lg text-[11px] font-bold whitespace-nowrap transition-all bg-[#0284C7] text-white shadow-xs">
                            Semua
                        </button>
                        @foreach($kategoriList as $kat)
                            <button type="button" 
                                    data-category-filter="{{ $kat->id }}" 
                                    class="category-filter-btn px-3 py-1.5 rounded-lg text-[11px] font-semibold whitespace-nowrap transition-all bg-gray-100 hover:bg-gray-200 text-gray-700 flex items-center gap-1.5">
                                <span class="w-2 h-2 rounded-full" style="background-color: {{ $kat->warna }};"></span>
                                <span>{{ $kat->nama }}</span>
                                <span class="text-[9px] text-gray-500 font-mono">({{ $kat->fasilitas_count }})</span>
                            </button>
                        @endforeach
                    </div>
                </div>

                <!-- Scrollable List of Facility Cards -->
                <div id="facility-list-container" class="flex-1 overflow-y-auto p-4 space-y-2.5 scrollbar-thin divide-y divide-gray-50">
                    @forelse($fasilitasList as $f)
                        <div class="facility-card p-3 rounded-2xl border border-gray-100 hover:border-sky-300 hover:shadow-md transition-all duration-200 bg-white group cursor-pointer"
                             data-facility-id="{{ $f->id }}"
                             data-category-id="{{ $f->kategori_id }}"
                             data-name="{{ strtolower($f->nama) }}"
                             data-address="{{ strtolower($f->alamat) }}"
                             data-lat="{{ $f->lat }}"
                             data-lng="{{ $f->lng }}">
                            <div class="flex items-start gap-3">
                                <!-- Thumbnail / Category Avatar -->
                                <div class="w-12 h-12 rounded-xl overflow-hidden bg-slate-100 flex-shrink-0 border border-gray-200">
                                    @if($f->foto)
                                        <img src="{{ $f->foto }}" alt="{{ $f->nama }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center" style="background-color: {{ $f->kategori?->warna }}20; color: {{ $f->kategori?->warna }};">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
                                        </div>
                                    @endif
                                </div>

                                <!-- Card Content -->
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center justify-between gap-1">
                                        <span class="text-[10px] font-bold uppercase tracking-wider px-2 py-0.5 rounded-full" style="background-color: {{ $f->kategori?->warna }}18; color: {{ $f->kategori?->warna }};">
                                            {{ $f->kategori?->nama }}
                                        </span>
                                        <span class="text-[9px] font-bold px-1.5 py-0.5 rounded bg-emerald-50 text-emerald-800">
                                            ● {{ $f->kondisi?->label() ?? 'Baik' }}
                                        </span>
                                    </div>

                                    <h3 class="font-serif font-black text-xs sm:text-sm text-[#0F172A] group-hover:text-[#0284C7] transition-colors truncate mt-1">
                                        {{ $f->nama }}
                                    </h3>

                                    <p class="text-[11px] text-gray-500 truncate flex items-center gap-1 mt-0.5">
                                        <svg class="w-3 h-3 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
                                        <span>{{ $f->alamat }}</span>
                                    </p>

                                    <!-- Quick Card Action Links -->
                                    <div class="flex items-center gap-3 pt-2 mt-1 border-t border-gray-100 text-[10px] font-bold">
                                        <button type="button" class="focus-marker-btn text-[#0284C7] hover:underline flex items-center gap-1">
                                            <span>Lihat di Peta</span>
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                        </button>
                                        <a href="https://www.google.com/maps/dir/?api=1&destination={{ $f->lat }},{{ $f->lng }}" 
                                           target="_blank" 
                                           rel="noopener noreferrer" 
                                           onclick="event.stopPropagation()"
                                           class="text-gray-500 hover:text-gray-800 flex items-center gap-1">
                                            <span>Petunjuk Arah</span>
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-12 text-gray-400 text-xs">
                            Belum ada data fasilitas publik.
                        </div>
                    @endforelse

                    <!-- Empty State for Search Filter -->
                    <div id="facility-empty-state" class="hidden text-center py-12 px-4 space-y-3">
                        <div class="w-12 h-12 rounded-full bg-gray-100 text-gray-400 mx-auto flex items-center justify-center">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        </div>
                        <p class="text-xs text-gray-500 font-medium">Tidak ada fasilitas yang cocok dengan pencarian Anda.</p>
                        <button type="button" id="reset-filter-btn" class="px-3.5 py-1.5 rounded-lg bg-[#0284C7] text-white text-xs font-bold hover:bg-[#0369A1]">
                            Tampilkan Semua Fasilitas
                        </button>
                    </div>
                </div>

                <!-- Scrollable List of UMKM Cards (Initially Hidden, Shown on Tab Click) -->
                <div id="umkm-list-container" class="hidden flex-1 overflow-y-auto p-4 space-y-2.5 scrollbar-thin divide-y divide-gray-50">
                    @forelse($umkmList as $u)
                        <div class="umkm-card p-3 rounded-2xl border border-gray-100 hover:border-orange-300 hover:shadow-md transition-all duration-200 bg-white group cursor-pointer"
                             data-umkm-id="{{ $u->id }}"
                             data-name="{{ strtolower($u->nama_usaha) }}"
                             data-category="{{ strtolower($u->kategori) }}"
                             data-address="{{ strtolower($u->alamat) }}"
                             data-lat="{{ $u->lat }}"
                             data-lng="{{ $u->lng }}">
                            <div class="flex items-start gap-3">
                                <div class="w-12 h-12 rounded-xl overflow-hidden bg-orange-50 flex-shrink-0 border border-orange-200">
                                    @if($u->foto)
                                        <img src="{{ $u->foto }}" alt="{{ $u->nama_usaha }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-orange-600">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                                        </div>
                                    @endif
                                </div>

                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center justify-between gap-1">
                                        <span class="text-[10px] font-bold uppercase tracking-wider px-2 py-0.5 rounded-full bg-orange-100 text-orange-700">
                                            {{ $u->kategori }}
                                        </span>
                                        @if($u->is_unggulan)
                                            <span class="text-[9px] font-bold px-1.5 py-0.5 rounded bg-amber-50 text-amber-800 border border-amber-200">
                                                ⭐ Unggulan
                                            </span>
                                        @endif
                                    </div>

                                    <h3 class="font-serif font-black text-xs sm:text-sm text-[#0F172A] group-hover:text-orange-600 transition-colors truncate mt-1">
                                        {{ $u->nama_usaha }}
                                    </h3>

                                    @if($u->nama_pemilik)
                                        <p class="text-[10px] text-gray-500 font-medium truncate">Pemilik: {{ $u->nama_pemilik }}</p>
                                    @endif

                                    <p class="text-[11px] text-gray-500 truncate flex items-center gap-1 mt-0.5">
                                        <svg class="w-3 h-3 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
                                        <span>{{ $u->alamat ?? 'Kelurahan Sukawarna' }}</span>
                                    </p>

                                    <!-- Quick Card Action Links -->
                                    <div class="flex items-center gap-3 pt-2 mt-1 border-t border-gray-100 text-[10px] font-bold">
                                        <button type="button" class="focus-marker-btn text-orange-600 hover:underline flex items-center gap-1">
                                            <span>Lihat di Peta</span>
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                        </button>
                                        @if($u->lat && $u->lng)
                                            <a href="https://www.google.com/maps/dir/?api=1&destination={{ $u->lat }},{{ $u->lng }}" 
                                               target="_blank" 
                                               rel="noopener noreferrer" 
                                               onclick="event.stopPropagation()"
                                               class="text-gray-500 hover:text-gray-800 flex items-center gap-1">
                                                <span>Arah</span>
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                                            </a>
                                        @endif
                                        @if($u->kontak_wa)
                                            <a href="https://wa.me/62{{ ltrim($u->kontak_wa, '0') }}" 
                                               target="_blank" 
                                               rel="noopener noreferrer" 
                                               onclick="event.stopPropagation()"
                                               class="text-emerald-700 hover:underline flex items-center gap-1">
                                                <span>WhatsApp</span>
                                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/></svg>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-12 text-gray-400 text-xs">
                            Belum ada data UMKM dengan koordinat lokasi.
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- RIGHT PANEL: Full Interactive GIS Map Canvas (Col 8 on Desktop) -->
            <div class="lg:col-span-8 relative rounded-3xl overflow-hidden border border-gray-200 shadow-xl bg-slate-100 h-[640px] sm:h-[700px] lg:h-[calc(100vh-210px)]" id="map-container-frame">
                
                <!-- Map Div Element -->
                <div id="map" 
                     class="w-full h-full z-10" 
                     data-lat="{{ $wilayah?->lat ?? -6.8872 }}" 
                     data-lng="{{ $wilayah?->lng ?? 107.5765 }}">
                </div>

                <!-- FLOATING CONTROL BAR (Top Right Overlay) -->
                <div class="absolute top-4 right-4 z-20 flex flex-col items-end gap-2">
                    
                    <!-- Basemap Switcher Capsule -->
                    <div class="inline-flex items-center p-1 rounded-2xl bg-white/95 backdrop-blur-md border border-gray-200/90 shadow-lg text-[11px] font-bold text-gray-700">
                        <button type="button" data-basemap="streets" class="basemap-btn px-3 py-1.5 rounded-xl transition-all bg-[#0284C7] text-white shadow-xs">
                            Peta Jalan
                        </button>
                        <button type="button" data-basemap="satellite" class="basemap-btn px-3 py-1.5 rounded-xl transition-all hover:bg-gray-100 text-gray-600">
                            Satelit
                        </button>
                        <button type="button" data-basemap="topo" class="basemap-btn px-3 py-1.5 rounded-xl transition-all hover:bg-gray-100 text-gray-600">
                            Topografi
                        </button>
                    </div>

                    <!-- Quick Tools Capsule (Boundary Toggle, GPS, Nearby Filter, Reset Fit Bounds, Fullscreen) -->
                    <div class="flex items-center gap-1.5 bg-white/95 backdrop-blur-md p-1.5 rounded-2xl border border-gray-200/90 shadow-lg">
                        <!-- Nearby Radius Filter Button -->
                        <button type="button" 
                                id="nearby-filter-btn" 
                                class="px-2.5 py-1.5 rounded-xl text-emerald-800 bg-emerald-50 hover:bg-emerald-100 border border-emerald-200 transition-colors flex items-center gap-1.5 text-xs font-bold" 
                                title="Cari Fasilitas Terdekat dari Posisi Saya">
                            <span class="w-2 h-2 rounded-full bg-emerald-600 animate-ping"></span>
                            <span>🎯 Sekitar Saya</span>
                        </button>

                        <!-- Toggle UMKM Layer -->
                        <button type="button" 
                                id="toggle-umkm-btn" 
                                class="px-2.5 py-1.5 rounded-xl text-orange-700 bg-orange-50 hover:bg-orange-100 border border-orange-200 transition-colors flex items-center gap-1.5 text-xs font-bold" 
                                title="Aktifkan/Nonaktifkan Layer UMKM Warga">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                            <span class="hidden sm:inline">UMKM ({{ $umkmList->count() }})</span>
                        </button>

                        <!-- Toggle Boundary Layer -->
                        <button type="button" 
                                id="toggle-boundary-btn" 
                                class="p-2 rounded-xl text-emerald-800 bg-emerald-50 hover:bg-emerald-100 transition-colors" 
                                title="Aktifkan/Nonaktifkan Garis Batas Kelurahan">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/></svg>
                        </button>

                        <!-- Locate User GPS -->
                        <button type="button" 
                                id="locate-me-btn" 
                                class="p-2 rounded-xl text-sky-800 bg-sky-50 hover:bg-sky-100 transition-colors" 
                                title="Deteksi Lokasi Saya (GPS)">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        </button>

                        <!-- Fit Bounds / Re-center Sukawarna -->
                        <button type="button" 
                                id="fit-bounds-btn" 
                                class="p-2 rounded-xl text-gray-700 hover:bg-gray-100 transition-colors" 
                                title="Fokuskan ke Wilayah Sukawarna">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"/></svg>
                        </button>

                        <!-- Fullscreen Toggle -->
                        <button type="button" 
                                id="fullscreen-map-btn" 
                                class="p-2 rounded-xl text-gray-700 hover:bg-gray-100 transition-colors" 
                                title="Buka Peta Layar Penuh">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 3H6a3 3 0 00-3 3v4m18 0V6a3 3 0 00-3-3h-4m0 18h4a3 3 0 003-3v-4M3 14v4a3 3 0 003 3h4"/></svg>
                        </button>
                    </div>

                    <!-- Nearby Radius Selector (Initially Hidden, appears when Nearby Filter is Active) -->
                    <div id="nearby-radius-bar" class="hidden items-center gap-1.5 bg-emerald-950/90 text-white backdrop-blur-md px-3 py-1.5 rounded-2xl border border-emerald-500/30 shadow-lg text-[11px] font-bold">
                        <span class="text-emerald-300">Radius:</span>
                        <button type="button" data-radius="500" class="nearby-radius-option px-2 py-0.5 rounded-lg bg-emerald-800 text-white hover:bg-emerald-700">500 m</button>
                        <button type="button" data-radius="1000" class="nearby-radius-option px-2 py-0.5 rounded-lg bg-emerald-500 text-white font-black shadow-xs">1 km</button>
                        <button type="button" data-radius="2000" class="nearby-radius-option px-2 py-0.5 rounded-lg bg-emerald-800 text-white hover:bg-emerald-700">2 km</button>
                        <button type="button" id="close-nearby-btn" class="ml-1 text-emerald-300 hover:text-white p-0.5 text-sm" title="Tutup Filter Jarak">&times;</button>
                    </div>
                </div>

                <!-- FLOATING LEGEND CARD (Bottom Left Overlay) -->
                <div class="absolute bottom-6 left-4 z-20 max-w-xs">
                    <div class="bg-white/95 backdrop-blur-md rounded-2xl p-3 sm:p-3.5 shadow-xl border border-gray-200/90 text-xs space-y-2">
                        <div class="flex items-center justify-between pb-1.5 border-b border-gray-100">
                            <span class="font-bold text-[#1B4332] text-[11px] uppercase tracking-wider">Legenda Peta</span>
                            <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                        </div>
                        <div class="grid grid-cols-2 gap-x-3 gap-y-1 text-[10px] text-gray-600">
                            <div class="flex items-center gap-1.5">
                                <span class="w-2.5 h-2.5 rounded-full bg-[#219EBC]"></span>
                                <span>Pendidikan</span>
                            </div>
                            <div class="flex items-center gap-1.5">
                                <span class="w-2.5 h-2.5 rounded-full bg-[#B3361A]"></span>
                                <span>Kesehatan</span>
                            </div>
                            <div class="flex items-center gap-1.5">
                                <span class="w-2.5 h-2.5 rounded-full bg-[#2D6A4F]"></span>
                                <span>Tempat Ibadah</span>
                            </div>
                            <div class="flex items-center gap-1.5">
                                <span class="w-2.5 h-2.5 rounded-full bg-[#1B4332]"></span>
                                <span>Pemerintahan</span>
                            </div>
                            <div class="flex items-center gap-1.5">
                                <span class="w-2.5 h-2.5 rounded-full bg-[#D97706]"></span>
                                <span>Ekonomi/Pasar</span>
                            </div>
                            <div class="flex items-center gap-1.5">
                                <span class="w-2.5 h-2.5 rounded-full bg-[#78350F]"></span>
                                <span>Infrastruktur</span>
                            </div>
                            <div class="flex items-center gap-1.5">
                                <span class="w-2.5 h-2.5 rounded-full bg-[#059669]"></span>
                                <span>Sosial/Olahraga</span>
                            </div>
                            <div class="flex items-center gap-1.5">
                                <span class="w-2.5 h-2.5 rounded-full bg-[#EA580C]"></span>
                                <span>UMKM Warga</span>
                            </div>
                            <div class="flex items-center gap-1.5">
                                <span class="w-3.5 h-1 border-t-2 border-dashed border-[#1B4332]"></span>
                                <span>Batas Kelurahan</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Floating Mobile Toggle Button (Bottom Center on Mobile Screens) -->
                <div class="lg:hidden absolute bottom-4 left-1/2 -translate-x-1/2 z-30">
                    <button type="button" 
                            id="mobile-drawer-toggle-btn"
                            class="px-5 py-2.5 rounded-full bg-[#1B4332] text-[#FFB703] font-bold text-xs uppercase tracking-wider shadow-2xl flex items-center gap-2 border border-[#FFB703]/30">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                        <span>Daftar Fasilitas ({{ $fasilitasList->count() }})</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        @vite('resources/js/peta.js')
    @endpush
</x-layouts.app>
