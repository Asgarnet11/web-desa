<x-layouts.app :title="'Layanan Pengaduan Warga - Kelurahan Sukawarna'">
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
                               placeholder="Contoh: Jl. Sukagalih RW 02 RT 01">
                    </div>
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
</x-layouts.app>
