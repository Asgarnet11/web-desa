<x-layouts.app :title="'Direktori UMKM & Potensi - Kelurahan Sukawarna'">
    <div class="max-w-7xl mx-auto px-6 py-10 space-y-8">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <span class="text-xs font-bold text-[#FFB703] uppercase tracking-wider">Pemberdayaan Warga</span>
                <h1 class="font-display font-bold text-3xl sm:text-4xl text-[#1B4332] mt-1">
                    Direktori UMKM & Produk Unggulan
                </h1>
                <p class="text-xs sm:text-sm text-[#1F2D26]/75 mt-1">
                    Temukan dan dukung produk usaha mikro, kecil, dan menengah binaan warga Sukawarna.
                </p>
            </div>

            <!-- Tombol Daftarkan Usaha Warga -->
            <button type="button" 
                    onclick="document.getElementById('daftar-umkm-modal').classList.remove('hidden')"
                    class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full bg-[#1B4332] hover:bg-[#2D6A4F] text-[#FFB703] font-bold text-xs uppercase tracking-wider shadow-sm transition-all flex-shrink-0">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                <span>Daftarkan Usaha Anda</span>
            </button>
        </div>

        @if(session('success'))
            <div class="p-4 rounded-2xl bg-emerald-100 border border-emerald-300 text-emerald-900 text-xs font-bold flex items-center gap-2">
                <span class="text-base">✓</span>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <!-- Search & Filter Bar -->
        <div class="bg-white rounded-[28px] p-5 border border-[#52B788]/20 shadow-soft flex flex-col sm:flex-row gap-4 justify-between items-center">
            <form action="{{ route('umkm.index') }}" method="GET" class="w-full sm:w-80">
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari usaha atau produk..." 
                       class="w-full px-4 py-2.5 rounded-full border border-[#52B788]/40 text-xs focus:ring-2 focus:ring-[#52B788] outline-none">
            </form>

            <div class="flex items-center gap-2 overflow-x-auto w-full sm:w-auto pb-1">
                <a href="{{ route('umkm.index') }}" class="px-3.5 py-1.5 rounded-full text-xs font-bold {{ !request('kategori') ? 'bg-[#2D6A4F] text-white' : 'bg-gray-100 text-gray-700' }}">
                    Semua
                </a>
                @foreach($kategoriList as $kategori)
                    <a href="{{ route('umkm.index', ['kategori' => $kategori]) }}" class="px-3.5 py-1.5 rounded-full text-xs font-bold {{ request('kategori') === $kategori ? 'bg-[#2D6A4F] text-white' : 'bg-gray-100 text-gray-700' }}">
                        {{ $kategori }}
                    </a>
                @endforeach
            </div>
        </div>

        <!-- Grid UMKM -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @forelse($umkmList as $u)
                <div class="bg-white rounded-[28px] overflow-hidden border border-[#52B788]/20 shadow-soft shadow-hover flex flex-col justify-between">
                    <div>
                        <div class="aspect-[16/10] overflow-hidden bg-gray-100 relative">
                            <img src="{{ $u->foto ?? 'https://images.unsplash.com/photo-1501339847302-ac426a4a7cbb?auto=format&fit=crop&w=600&q=80' }}" alt="{{ $u->nama_usaha }}" class="w-full h-full object-cover">
                            <span class="absolute top-3 left-3 px-2.5 py-0.5 rounded-full bg-white/90 text-xs font-bold text-[#1B4332]">
                                {{ $u->kategori }}
                            </span>
                        </div>
                        <div class="p-6 space-y-2">
                            <h3 class="font-display font-bold text-lg text-[#1B4332]">{{ $u->nama_usaha }}</h3>
                            <p class="text-xs text-[#17708A] font-medium">Pemilik: {{ $u->nama_pemilik ?? 'Warga Sukawarna' }}</p>
                            <p class="text-xs text-[#1F2D26]/75 line-clamp-3">{{ $u->deskripsi }}</p>
                            @if($u->alamat)
                                <p class="text-[11px] text-gray-400 pt-1">{{ $u->alamat }}</p>
                            @endif
                        </div>
                    </div>
                    <div class="p-6 pt-0">
                        @if($u->kontak_wa)
                            <a href="https://wa.me/62{{ ltrim($u->kontak_wa, '0') }}" target="_blank" 
                               class="w-full inline-flex items-center justify-center gap-2 py-2.5 rounded-full bg-[#2D6A4F] text-white text-xs font-bold hover:bg-[#1B4332]">
                                <span>Hubungi WhatsApp</span>
                            </a>
                        @endif
                    </div>
                </div>
            @empty
                <div class="col-span-3 text-center py-16 text-gray-400">
                    Tidak ditemukan UMKM sesuai pencarian.
                </div>
            @endforelse
        </div>

        <div class="pt-6">
            {{ $umkmList->links() }}
        </div>
    </div>

    <!-- Modal Pendaftaran UMKM Mandiri Warga -->
    <div id="daftar-umkm-modal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-xs">
        <div class="bg-white rounded-3xl max-w-lg w-full p-6 sm:p-8 space-y-5 shadow-2xl border border-gray-100 max-h-[90vh] overflow-y-auto">
            <div class="flex items-start justify-between gap-4 pb-3 border-b border-gray-100">
                <div>
                    <span class="text-[10px] font-bold uppercase tracking-wider text-[#FFB703] block">Pemberdayaan Ekonomi Warga</span>
                    <h3 class="font-serif font-black text-xl text-[#1B4332]">Formulir Pendaftaran UMKM</h3>
                    <p class="text-xs text-gray-500 mt-0.5">Daftarkan usaha Anda agar terpetakan di direktori & peta spasial Sukawarna.</p>
                </div>
                <button type="button" onclick="document.getElementById('daftar-umkm-modal').classList.add('hidden')" class="text-gray-400 hover:text-gray-700 p-1 rounded-full text-xl leading-none">
                    &times;
                </button>
            </div>

            <form action="{{ route('umkm.store') }}" method="POST" class="space-y-4">
                @csrf
                <div class="space-y-1">
                    <label class="block text-xs font-bold text-[#1B4332]">Nama Usaha / Toko *</label>
                    <input type="text" name="nama_usaha" required placeholder="Contoh: Kopi Kebun Sukawarna" 
                           class="w-full px-4 py-2 text-xs rounded-xl border border-gray-300 focus:border-[#2D6A4F] focus:ring-1 focus:ring-[#2D6A4F] outline-none">
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div class="space-y-1">
                        <label class="block text-xs font-bold text-[#1B4332]">Nama Pemilik Usaha *</label>
                        <input type="text" name="nama_pemilik" required placeholder="Nama Anda" 
                               class="w-full px-4 py-2 text-xs rounded-xl border border-gray-300 focus:border-[#2D6A4F] focus:ring-1 focus:ring-[#2D6A4F] outline-none">
                    </div>
                    <div class="space-y-1">
                        <label class="block text-xs font-bold text-[#1B4332]">Kategori Usaha *</label>
                        <select name="kategori" required class="w-full px-4 py-2 text-xs rounded-xl border border-gray-300 focus:border-[#2D6A4F] focus:ring-1 focus:ring-[#2D6A4F] outline-none">
                            <option value="Kuliner">Kuliner & Minuman</option>
                            <option value="Fashion">Fashion & Pakaian</option>
                            <option value="Kerajinan">Kerajinan Tangan</option>
                            <option value="Pertanian">Pertanian & Hidroponik</option>
                            <option value="Jasa">Jasa & Servis</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div class="space-y-1">
                        <label class="block text-xs font-bold text-[#1B4332]">Nomor WhatsApp Bisnis *</label>
                        <input type="text" name="kontak_wa" required placeholder="081234567890" 
                               class="w-full px-4 py-2 text-xs rounded-xl border border-gray-300 focus:border-[#2D6A4F] focus:ring-1 focus:ring-[#2D6A4F] outline-none">
                    </div>
                    <div class="space-y-1">
                        <label class="block text-xs font-bold text-[#1B4332]">Alamat Lengkap (RT/RW) *</label>
                        <input type="text" name="alamat" required placeholder="Jl. Sukagalih RW 02" 
                               class="w-full px-4 py-2 text-xs rounded-xl border border-gray-300 focus:border-[#2D6A4F] focus:ring-1 focus:ring-[#2D6A4F] outline-none">
                    </div>
                </div>

                <div class="space-y-1">
                    <label class="block text-xs font-bold text-[#1B4332]">Deskripsi Produk & Layanan</label>
                    <textarea name="deskripsi" rows="3" placeholder="Ceritakan produk unggulan, jam operasional, atau keunikan usaha Anda..." 
                              class="w-full px-4 py-2 text-xs rounded-xl border border-gray-300 focus:border-[#2D6A4F] focus:ring-1 focus:ring-[#2D6A4F] outline-none"></textarea>
                </div>

                <div class="p-3 rounded-xl bg-amber-50 border border-amber-200 text-[11px] text-amber-800 space-y-1">
                    <strong>Catatan Kurasi &amp; Pelindungan Data (UU No. 27/2022):</strong>
                    <p>Setelah formulir dikirim, petugas kelurahan akan memverifikasi keabsahan usaha sebelum ditampilkan di peta digital. <a href="{{ route('regulasi.index') }}" class="font-bold underline text-[#1B4332]">Lihat Regulasi Pengelolaan Data &rarr;</a></p>
                </div>

                <div class="pt-3 border-t border-gray-100 flex items-center justify-end gap-3">
                    <button type="button" onclick="document.getElementById('daftar-umkm-modal').classList.add('hidden')" class="px-4 py-2 rounded-xl border border-gray-200 text-gray-600 font-bold text-xs hover:bg-gray-50">
                        Batal
                    </button>
                    <button type="submit" class="px-6 py-2 rounded-xl bg-[#2D6A4F] hover:bg-[#1B4332] text-white font-bold text-xs shadow-sm transition-all">
                        Kirim Pendaftaran
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.app>

