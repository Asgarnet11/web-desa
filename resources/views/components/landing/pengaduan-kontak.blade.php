@props(['data'])

@php
    $profil = $data['profil'] ?? null;
@endphp

<section id="kontak" class="py-16 md:py-24 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
            <!-- Left: Formulir Pengaduan Warga -->
            <div class="lg:col-span-7 bg-[#FFF8E7] rounded-[36px] p-8 md:p-10 border border-[#52B788]/20 shadow-soft space-y-6">
                <div class="space-y-2">
                    <span class="inline-block px-3 py-1 rounded-full bg-[#B3361A]/15 text-[#B3361A] text-xs font-bold uppercase tracking-wider">
                        Kanal Pengaduan & Aspirasi
                    </span>
                    <h2 class="font-display font-bold text-2xl sm:text-3xl text-[#1B4332]">
                        Sampaikan Aspirasi & Laporan Warga
                    </h2>
                    <p class="text-xs text-[#1F2D26]/75">
                        Laporan Anda akan ditindaklanjuti secara resmi oleh tim respon cepat kelurahan dan diberikan nomor tiket tracking.
                    </p>
                </div>

                @if(session('success'))
                    <div class="p-4 rounded-2xl bg-emerald-100 border border-emerald-300 text-emerald-900 text-xs font-bold">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('pengaduan.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="space-y-1.5">
                            <label class="block text-xs font-bold text-[#1B4332]">Nama Lengkap *</label>
                            <input type="text" name="nama_pelapor" required value="{{ old('nama_pelapor') }}" 
                                   class="w-full px-4 py-2.5 rounded-2xl bg-white border border-[#52B788]/40 focus:ring-2 focus:ring-[#52B788] text-xs outline-none"
                                   placeholder="Contoh: Budi Gunawan">
                        </div>
                        <div class="space-y-1.5">
                            <label class="block text-xs font-bold text-[#1B4332]">Nomor WhatsApp / HP *</label>
                            <input type="text" name="telepon_pelapor" required value="{{ old('telepon_pelapor') }}" 
                                   class="w-full px-4 py-2.5 rounded-2xl bg-white border border-[#52B788]/40 focus:ring-2 focus:ring-[#52B788] text-xs outline-none"
                                   placeholder="Contoh: 081234567890">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="space-y-1.5">
                            <label class="block text-xs font-bold text-[#1B4332]">Kategori Masalah *</label>
                            <select name="kategori" required class="w-full px-4 py-2.5 rounded-2xl bg-white border border-[#52B788]/40 focus:ring-2 focus:ring-[#52B788] text-xs outline-none">
                                <option value="Infrastruktur">Infrastruktur (Jalan, PJU, Drainase)</option>
                                <option value="Kebersihan">Kebersihan & Sampah Lingkungan</option>
                                <option value="Ketertiban">Ketertiban & Keamanan</option>
                                <option value="Pelayanan">Pelayanan Administrasi</option>
                                <option value="Sosial">Bantuan Sosial & Kesejahteraan</option>
                            </select>
                        </div>
                        <div class="space-y-1.5">
                            <label class="block text-xs font-bold text-[#1B4332]">Lokasi Kejadian (RT / RW)</label>
                            <input type="text" name="lokasi" value="{{ old('lokasi') }}" 
                                   class="w-full px-4 py-2.5 rounded-2xl bg-white border border-[#52B788]/40 focus:ring-2 focus:ring-[#52B788] text-xs outline-none"
                                   placeholder="Contoh: Jl. Sukagalih RW 02">
                        </div>
                    </div>

                    <div class="space-y-1.5">
                        <label class="block text-xs font-bold text-[#1B4332]">Judul Pengaduan *</label>
                        <input type="text" name="judul" required value="{{ old('judul') }}" 
                               class="w-full px-4 py-2.5 rounded-2xl bg-white border border-[#52B788]/40 focus:ring-2 focus:ring-[#52B788] text-xs outline-none"
                               placeholder="Ringkasan singkat kendala yang dilaporkan">
                    </div>

                    <div class="space-y-1.5">
                        <label class="block text-xs font-bold text-[#1B4332]">Deskripsi Lengkap *</label>
                        <textarea name="isi" rows="4" required 
                                  class="w-full px-4 py-2.5 rounded-2xl bg-white border border-[#52B788]/40 focus:ring-2 focus:ring-[#52B788] text-xs outline-none"
                                  placeholder="Ceritakan kronologi atau penjelasan detail kendala..."></textarea>
                    </div>

                    <div class="flex items-center justify-between pt-2">
                        <button type="submit" class="btn-organic px-8 py-3 bg-[#FFB703] text-[#1B4332] font-bold text-xs shadow-sm hover:scale-[1.02] transition-transform">
                            Kirim Pengaduan Resmi
                        </button>

                        <a href="{{ route('pengaduan.cek') }}" class="text-xs font-bold text-[#17708A] hover:underline">
                            Lacak Tiket Sebelumnya &rarr;
                        </a>
                    </div>
                </form>
            </div>

            <!-- Right: Kantor Info & Peta Lokasi -->
            <div class="lg:col-span-5 space-y-6">
                <div class="bg-white rounded-[36px] p-8 border border-[#52B788]/20 shadow-soft space-y-6">
                    <div class="space-y-2">
                        <span class="text-xs font-bold text-[#2D6A4F] uppercase tracking-wider">Pusat Layanan Warga</span>
                        <h3 class="font-display font-bold text-2xl text-[#1B4332]">Kantor Kelurahan</h3>
                    </div>

                    <div class="space-y-3 text-xs leading-relaxed text-[#1F2D26]/85">
                        <div class="flex items-start gap-3">
                            <div class="w-8 h-8 rounded-full bg-[#52B788]/20 text-[#2D6A4F] flex-shrink-0 flex items-center justify-center font-bold">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                            </div>
                            <p class="pt-1">{{ $profil?->alamat_kantor ?? 'Jl. Sukawarna No. 12, Kec. Sukasari, Kota Bandung, Jawa Barat 40164' }}</p>
                        </div>

                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-[#52B788]/20 text-[#2D6A4F] flex-shrink-0 flex items-center justify-center font-bold">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                            </div>
                            <p class="font-semibold">{{ $profil?->kontak_whatsapp ?? '0812-3456-7890' }} (WhatsApp Resmi)</p>
                        </div>

                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-[#52B788]/20 text-[#2D6A4F] flex-shrink-0 flex items-center justify-center font-bold">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                            </div>
                            <p>{{ $profil?->kontak_email ?? 'kelurahan.sukawarna@bandung.go.id' }}</p>
                        </div>
                    </div>

                    <!-- Direct Quick Connect Buttons -->
                    <div class="pt-2 flex flex-wrap gap-3">
                        <a href="https://wa.me/62{{ ltrim($profil?->kontak_whatsapp ?? '081234567890', '0') }}" 
                           target="_blank" 
                           class="flex-1 inline-flex items-center justify-center gap-2 px-5 py-3 rounded-full bg-[#2D6A4F] text-[#FFF8E7] text-xs font-bold hover:bg-[#1B4332] transition-colors">
                            <span>Hubungi via WhatsApp</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

