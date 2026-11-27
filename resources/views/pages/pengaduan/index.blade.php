<x-layouts.app :title="'Layanan Pengaduan Warga - Kelurahan Konda'">
    <div class="max-w-4xl mx-auto px-6 py-10 space-y-8">
        <div>
            <span class="text-xs font-bold text-[#B3361A] uppercase tracking-wider">Kanal Aspirasi Publik</span>
            <h1 class="font-display font-bold text-3xl sm:text-4xl text-[#1B4332] mt-1">
                Formulir Pengaduan & Keluhan Warga
            </h1>
            <p class="text-xs sm:text-sm text-[#1F2D26]/75 mt-1">
                Sampaikan laporan kerusakan infrastruktur, kebersihan, atau pelayanan untuk ditindaklanjuti secara akuntabel.
            </p>
        </div>

        @if(session('success'))
            <div class="p-5 rounded-2xl bg-emerald-100 border border-emerald-300 text-emerald-900 text-sm font-bold">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-[36px] p-8 md:p-10 border border-[#52B788]/20 shadow-soft">
            <form action="{{ route('pengaduan.store') }}" method="POST" class="space-y-5">
                @csrf
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <label class="block text-xs font-bold text-[#1B4332]">Nama Lengkap Pelapor *</label>
                        <input type="text" name="nama_pelapor" required value="{{ old('nama_pelapor') }}" 
                               class="w-full px-4 py-2.5 rounded-2xl bg-[#FFF8E7]/50 border border-[#52B788]/40 focus:ring-2 focus:ring-[#52B788] text-xs outline-none"
                               placeholder="Nama sesuai KTP">
                    </div>
                    <div class="space-y-1.5">
                        <label class="block text-xs font-bold text-[#1B4332]">Nomor WhatsApp Aktif *</label>
                        <input type="text" name="telepon_pelapor" required value="{{ old('telepon_pelapor') }}" 
                               class="w-full px-4 py-2.5 rounded-2xl bg-[#FFF8E7]/50 border border-[#52B788]/40 focus:ring-2 focus:ring-[#52B788] text-xs outline-none"
                               placeholder="Contoh: 081234567890">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <label class="block text-xs font-bold text-[#1B4332]">Kategori Masalah *</label>
                        <select name="kategori" required class="w-full px-4 py-2.5 rounded-2xl bg-[#FFF8E7]/50 border border-[#52B788]/40 focus:ring-2 focus:ring-[#52B788] text-xs outline-none">
                            <option value="Infrastruktur">Infrastruktur (Jalan, PJU, Saluran Air)</option>
                            <option value="Kebersihan">Kebersihan & Sampah</option>
                            <option value="Ketertiban">Ketertiban & Ketenteraman</option>
                            <option value="Pelayanan">Pelayanan Administrasi Kelurahan</option>
                            <option value="Sosial">Bantuan Sosial & Kesejahteraan</option>
                        </select>
                    </div>
                    <div class="space-y-1.5">
                        <label class="block text-xs font-bold text-[#1B4332]">Lokasi Kejadian / RT / RW</label>
                        <input type="text" name="lokasi" value="{{ old('lokasi') }}" 
                               class="w-full px-4 py-2.5 rounded-2xl bg-[#FFF8E7]/50 border border-[#52B788]/40 focus:ring-2 focus:ring-[#52B788] text-xs outline-none"
                               placeholder="Contoh: Jl. Poros Kendari–Konda RW 02 RT 01">
                    </div>
                </div>

                <!-- Geo-Civic Reporting Map Picker Component -->
                <div class="space-y-2 p-4 rounded-2xl bg-slate-50 border border-[#52B788]/30">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2">
                        <div>
                            <span class="text-xs font-bold text-[#1B4332] block">Tandai Titik Lokasi pada Peta (Geo-Civic Reporting)</span>
                            <span id="coord-label" class="text-[11px] text-gray-500 block">Klik pada peta di bawah atau gunakan tombol GPS untuk akurasi tinggi.</span>
                        </div>
                        <button type="button" 
                                id="gps-detect-btn" 
                                class="inline-flex items-center justify-center gap-1.5 px-3 py-1.5 rounded-xl bg-white border border-[#52B788]/60 hover:bg-emerald-50 text-emerald-800 font-bold text-xs shadow-2xs transition-all">
                            <svg class="w-3.5 h-3.5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            <span>Deteksi Lokasi GPS Saya</span>
                        </button>
                    </div>

                    <div id="pengaduan-map" class="w-full h-52 rounded-xl border border-gray-300 overflow-hidden relative z-0"></div>

                    <!-- Hidden Coordinate Inputs -->
                    <input type="hidden" name="lat" id="pengaduan-lat" value="{{ old('lat') }}">
                    <input type="hidden" name="lng" id="pengaduan-lng" value="{{ old('lng') }}">
                </div>

                <div class="space-y-1.5">
                    <label class="block text-xs font-bold text-[#1B4332]">Judul Pengaduan *</label>
                    <input type="text" name="judul" required value="{{ old('judul') }}" 
                           class="w-full px-4 py-2.5 rounded-2xl bg-[#FFF8E7]/50 border border-[#52B788]/40 focus:ring-2 focus:ring-[#52B788] text-xs outline-none"
                           placeholder="Ringkasan kendala yang ingin dilaporkan">
                </div>

                <div class="space-y-1.5">
                    <label class="block text-xs font-bold text-[#1B4332]">Isi Pengaduan / Uraian Lengkap *</label>
                    <textarea name="isi" rows="5" required 
                              class="w-full px-4 py-2.5 rounded-2xl bg-[#FFF8E7]/50 border border-[#52B788]/40 focus:ring-2 focus:ring-[#52B788] text-xs outline-none"
                              placeholder="Jelaskan kendala, kronologi, dan harapan penanganan..."></textarea>
                </div>

                <div class="rounded-xl bg-[#F4F7F4] border border-[#1B4332]/15 px-4 py-3 text-[11px] text-gray-700 leading-relaxed">
                    <strong class="text-[#1B4332]">Jaminan Privasi Data (UU No. 27 Tahun 2022):</strong> Identitas pelapor dan nomor telepon digunakan khusus untuk verifikasi tindak lanjut petugas kelurahan serta tidak ditayangkan secara publik. <a href="{{ route('regulasi.index') }}" class="font-bold text-[#1B4332] underline">Lihat Dasar Hukum &amp; Pengelolaan Data</a>.
                </div>

                <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                    <button type="submit" class="btn-organic px-8 py-3 bg-[#FFB703] text-[#1B4332] font-bold text-xs shadow-sm hover:scale-[1.02] transition-transform">
                        Kirim Laporan Pengaduan
                    </button>

                    <a href="{{ route('pengaduan.cek') }}" class="text-xs font-bold text-[#17708A] hover:underline">
                        Lacak Status Tiket Pengaduan &rarr;
                    </a>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
    <script>
    document.addEventListener('DOMContentLoaded', () => {
        const defaultLat = -4.124444;
        const defaultLng = 122.440278;
        
        function loadLeafletAndInit() {
            if (typeof L === 'undefined') {
                const script = document.createElement('script');
                script.src = 'https://unpkg.com/leaflet@1.9.4/dist/leaflet.js';
                script.onload = initPicker;
                document.head.appendChild(script);

                const link = document.createElement('link');
                link.rel = 'stylesheet';
                link.href = 'https://unpkg.com/leaflet@1.9.4/dist/leaflet.css';
                document.head.appendChild(link);
            } else {
                initPicker();
            }
        }

        function initPicker() {
            const mapEl = document.getElementById('pengaduan-map');
            if (!mapEl) return;

            const map = L.map('pengaduan-map', {
                center: [defaultLat, defaultLng],
                zoom: 15,
                scrollWheelZoom: false
            });

            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
                maxZoom: 19
            }).addTo(map);

            let marker = null;
            const latInput = document.getElementById('pengaduan-lat');
            const lngInput = document.getElementById('pengaduan-lng');
            const coordLabel = document.getElementById('coord-label');
            const gpsBtn = document.getElementById('gps-detect-btn');

            function updateMarker(lat, lng) {
                latInput.value = Number(lat).toFixed(7);
                lngInput.value = Number(lng).toFixed(7);
                if (coordLabel) {
                    coordLabel.innerHTML = `📍 Titik Terpilih: <strong class="text-[#1B4332] font-mono">${Number(lat).toFixed(5)}, ${Number(lng).toFixed(5)}</strong>`;
                    coordLabel.classList.remove('text-gray-500');
                    coordLabel.classList.add('text-emerald-700', 'font-semibold');
                }

                if (!marker) {
                    marker = L.marker([lat, lng], { draggable: true }).addTo(map);
                    marker.on('dragend', (e) => {
                        const pos = e.target.getLatLng();
                        updateMarker(pos.lat, pos.lng);
                    });
                } else {
                    marker.setLatLng([lat, lng]);
                }
            }

            map.on('click', (e) => {
                updateMarker(e.latlng.lat, e.latlng.lng);
            });

            if (gpsBtn) {
                gpsBtn.addEventListener('click', () => {
                    if (!navigator.geolocation) {
                        alert('Browser Anda tidak mendukung deteksi lokasi otomatis.');
                        return;
                    }
                    gpsBtn.disabled = true;
                    gpsBtn.innerHTML = '<span>Mendeteksi GPS...</span>';

                    navigator.geolocation.getCurrentPosition(
                        (pos) => {
                            const lat = pos.coords.latitude;
                            const lng = pos.coords.longitude;
                            updateMarker(lat, lng);
                            map.setView([lat, lng], 17);
                            gpsBtn.disabled = false;
                            gpsBtn.innerHTML = '<span>✓ Lokasi Terdeteksi</span>';
                            gpsBtn.classList.add('bg-emerald-600', 'text-white');
                        },
                        (err) => {
                            gpsBtn.disabled = false;
                            gpsBtn.innerHTML = '<span>📍 Deteksi Lokasi GPS Saya</span>';
                            alert('Gagal mendeteksi lokasi GPS. Pastikan izin akses lokasi diizinkan di browser Anda.');
                        },
                        { enableHighAccuracy: true, timeout: 8000 }
                    );
                });
            }
        }

        loadLeafletAndInit();
    });
    </script>
    @endpush
</x-layouts.app>

