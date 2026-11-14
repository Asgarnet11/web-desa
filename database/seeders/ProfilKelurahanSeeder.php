<?php

namespace Database\Seeders;

use App\Enums\KondisiFisik;
use App\Enums\StatusKonten;
use App\Enums\StatusVerifikasi;
use App\Models\Agenda;
use App\Models\Berita;
use App\Models\Demografi;
use App\Models\Fasilitas;
use App\Models\Infrastruktur;
use App\Models\KategoriFasilitas;
use App\Models\KondisiSosial;
use App\Models\Layanan;
use App\Models\Lembaga;
use App\Models\Pengumuman;
use App\Models\Perangkat;
use App\Models\ProfilKelurahan;
use App\Models\Umkm;
use App\Models\Wilayah;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProfilKelurahanSeeder extends Seeder
{
    public function run(): void
    {
        $sukawarna = Wilayah::where('kode', '32.73.01.1001')->first();
        if (! $sukawarna) {
            return;
        }

        // 1. Profil Kelurahan
        ProfilKelurahan::updateOrCreate(
            ['wilayah_id' => $sukawarna->id],
            [
                'slogan' => 'Harmoni Hijau, Mandiri, dan Melayani Sepenuh Hati',
                'sejarah' => 'Kelurahan Sukawarna terbentuk dari pemekaran wilayah yang mengutamakan kebersamaan warga dan keasrian alam lingkungan perbukitan utara. Nama Sukawarna bermakna tempat penuh keberagaman yang indah, di mana warga hidup rukun dalam harmoni sosial dan kepedulian lingkungan.',
                'tahun_terbentuk' => '1982',
                'makna_lambang' => 'Pohon Hayat berakar kuat melambangkan gotong royong; mentari emas melambangkan kemandirian energi dan optimisme masa depan.',
                'visi' => 'Terwujudnya Kelurahan Sukawarna yang Mandiri, Asri, Berdaya Saing Berbasis Komunitas dan Teknologi Ramah Lingkungan.',
                'misi' => [
                    'Meningkatkan tata kelola pelayanan publik yang transparan, ramah, dan cepat berbasis digital.',
                    'Mendorong kemandirian ekonomi warga melalui pemberdayaan UMKM lokal dan pertanian perkotaan ramah lingkungan.',
                    'Mewujudkan lingkungan pemukiman yang bersih, hijau, tangguh bencana, dan berkelanjutan.',
                    'Memperkuat kerukunan warga, kohesi sosial, dan ruang partisipasi aktif pemuda serta perempuan.',
                ],
                'motto_pelayanan' => 'CERIA: Cepat, Efisien, Ramah, Ikhlas, dan Akuntabel',
                'foto_kantor' => 'https://images.unsplash.com/photo-1577495508048-b635879837f1?auto=format&fit=crop&w=1200&q=80',
                'foto_peta_wilayah' => null,
                'batas_utara' => 'Kelurahan Sarijadi & Isola',
                'batas_selatan' => 'Kelurahan Pajajaran & Cicendo',
                'batas_timur' => 'Kelurahan Gegerkalong',
                'batas_barat' => 'Kota Cimahi',
                'kontak_telepon' => '(022) 2012345',
                'kontak_whatsapp' => '081234567890',
                'kontak_email' => 'kelurahan.sukawarna@bandung.go.id',
                'alamat_kantor' => 'Jl. Sukawarna No. 12, Kecamatan Sukasari, Kota Bandung, Jawa Barat 40164',
                'jam_pelayanan' => "Senin - Kamis: 08.00 - 15.30 WIB\nJumat: 08.00 - 14.30 WIB\nSabtu - Minggu: Libur",
                'social_media' => [
                    'instagram' => 'kelurahansukawarna',
                    'facebook' => 'KelurahanSukawarnaResmi',
                    'youtube' => 'SukawarnaTV',
                ],
                'pengaturan_bagian' => [
                    'hero' => true,
                    'profil_sejarah' => true,
                    'visi_misi' => true,
                    'struktur_organisasi' => true,
                    'wilayah_statistik' => true,
                    'peta_interaktif' => true,
                    'layanan' => true,
                    'umkm' => true,
                    'berita' => true,
                    'galeri' => true,
                    'pengaduan_kontak' => true,
                ],
            ]
        );

        // 2. Perangkat Kelurahan
        $perangkatList = [
            [
                'nama' => 'Drs. H. Rahmat Hidayat, M.Si',
                'jabatan' => 'Lurah Sukawarna',
                'nip' => '19750812 200003 1 004',
                'foto' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=400&q=80',
                'kontak' => '0812-2233-4455',
                'urutan' => 1,
            ],
            [
                'nama' => 'Siti Nurhaliza, S.STP, M.AP',
                'jabatan' => 'Sekretaris Kelurahan',
                'nip' => '19840315 200801 2 006',
                'foto' => 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=400&q=80',
                'kontak' => '0813-3344-5566',
                'urutan' => 2,
            ],
            [
                'nama' => 'Budi Santoso, S.Sos',
                'jabatan' => 'Kasi Pemerintahan & Ketertiban',
                'nip' => '19800620 200604 1 012',
                'foto' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=400&q=80',
                'kontak' => '0815-5566-7788',
                'urutan' => 3,
            ],
            [
                'nama' => 'Ahmad Fauzi, S.T',
                'jabatan' => 'Kasi Ekonomi & Pembangunan',
                'nip' => '19881105 201101 1 003',
                'foto' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=400&q=80',
                'kontak' => '0817-7788-9900',
                'urutan' => 4,
            ],
            [
                'nama' => 'Dewi Sartika, S.Pd',
                'jabatan' => 'Kasi Kesejahteraan Sosial',
                'nip' => '19860925 201001 2 005',
                'foto' => 'https://images.unsplash.com/photo-1580489944761-15a19d654956?auto=format&fit=crop&w=400&q=80',
                'kontak' => '0818-8899-0011',
                'urutan' => 5,
            ],
        ];

        foreach ($perangkatList as $p) {
            Perangkat::updateOrCreate(
                ['wilayah_id' => $sukawarna->id, 'nama' => $p['nama']],
                array_merge($p, ['status_aktif' => true])
            );
        }

        // 3. Lembaga Kelurahan
        $lembagaList = [
            ['nama_lembaga' => 'Lembaga Pemberdayaan Masyarakat (LPM)', 'ketua' => 'H. Dedi Mulyadi', 'jumlah_anggota' => 24, 'deskripsi' => 'Mitra kelurahan dalam merencanakan dan mengawal pembangunan partisipatif tingkat warga.'],
            ['nama_lembaga' => 'Tim Penggerak PKK', 'ketua' => 'Hj. Endang Rahmat', 'jumlah_anggota' => 45, 'deskripsi' => 'Gerakan pemberdayaan kesejahteraan keluarga, posyandu, dan ketahanan pangan rumah tangga.'],
            ['nama_lembaga' => 'Karang Taruna Tunas Harapan', 'ketua' => 'Rizky Pratama', 'jumlah_anggota' => 60, 'deskripsi' => 'Wadah pembinaan generasi muda di bidang kewirausahaan kreatif, lingkungan hidup, dan olahraga.'],
            ['nama_lembaga' => 'Forum RW & RT Sukawarna', 'ketua' => 'Ir. Gunawan Wibowo', 'jumlah_anggota' => 38, 'deskripsi' => 'Koordinasi lintas ketua RW dan RT untuk pelayanan keamanan, kebersihan, dan sosial warga.'],
        ];

        foreach ($lembagaList as $l) {
            Lembaga::updateOrCreate(
                ['wilayah_id' => $sukawarna->id, 'nama_lembaga' => $l['nama_lembaga']],
                $l
            );
        }

        // 4. Layanan Publik
        $layananList = [
            [
                'nama_layanan' => 'Surat Pengantar SKCK',
                'kategori' => 'Kependudukan',
                'persyaratan' => ['KTP asli & fotokopi pemohon', 'Kartu Keluarga asli & fotokopi', 'Surat Pengantar dari Ketua RT/RW setempat', 'Pas foto 4x6 (2 lembar) latar merah'],
                'alur_pelayanan' => 'Warga membawa berkas pengantar RT/RW ke loket kelurahan -> Petugas memverifikasi kelengkapan -> Lurah menandatangani berkas pengantar -> Berkas diserahkan untuk dibawa ke Polsek.',
                'waktu_penyelesaian' => '15 Menit',
                'biaya' => 'Gratis',
                'jam_buka' => '08.00 - 14.30 WIB',
            ],
            [
                'nama_layanan' => 'Surat Keterangan Usaha (SKU)',
                'kategori' => 'Perizinan & Usaha',
                'persyaratan' => ['KTP & KK pemohon yang berdomisili di Sukawarna', 'Surat Pengantar RT/RW', 'Foto lokasi dan kegiatan usaha', 'Surat pernyataan tidak sengketa tempat usaha'],
                'alur_pelayanan' => 'Pengajuan berkas di loket kelurahan -> Verifikasi lapangan bila diperlukan -> Penerbitan Surat Keterangan Usaha resmi.',
                'waktu_penyelesaian' => '1 Hari Kerja',
                'biaya' => 'Gratis',
                'jam_buka' => '08.00 - 15.00 WIB',
            ],
            [
                'nama_layanan' => 'Surat Keterangan Domisili Warga / Lembaga',
                'kategori' => 'Kependudukan',
                'persyaratan' => ['Fotokopi KTP & KK pemohon', 'Surat pengantar RT/RW', 'Bukti sewa/kepemilikan tempat tinggal'],
                'alur_pelayanan' => 'Penyerahan berkas -> Verifikasi data kependudukan -> Cetak dan legalisasi surat keterangan.',
                'waktu_penyelesaian' => '20 Menit',
                'biaya' => 'Gratis',
                'jam_buka' => '08.00 - 15.00 WIB',
            ],
            [
                'nama_layanan' => 'Surat Keterangan Tidak Mampu (SKTM)',
                'kategori' => 'Sosial',
                'persyaratan' => ['KTP & KK asli dan fotokopi', 'Pengantar RT/RW bermaterai', 'Foto kondisi rumah pemohon', 'Tujuan peruntukan (beasiswa/kesehatan)'],
                'alur_pelayanan' => 'Pemeriksaan DTKS/data bansos -> Penandatanganan pejabat kelurahan -> Digunakan untuk fasilitas kesehatan/pendidikan.',
                'waktu_penyelesaian' => '1 Hari Kerja',
                'biaya' => 'Gratis',
                'jam_buka' => '08.00 - 14.30 WIB',
            ],
        ];

        foreach ($layananList as $lay) {
            Layanan::updateOrCreate(
                ['wilayah_id' => $sukawarna->id, 'nama_layanan' => $lay['nama_layanan']],
                array_merge($lay, ['is_aktif' => true])
            );
        }

        // 5. Demografi
        Demografi::updateOrCreate(
            ['wilayah_id' => $sukawarna->id, 'periode' => '2026'],
            [
                'jumlah_penduduk' => 12450,
                'jumlah_kk' => 3820,
                'laki_laki' => 6180,
                'perempuan' => 6270,
                'rincian' => [
                    'usia' => [
                        '0-14' => 2650,
                        '15-39' => 4890,
                        '40-64' => 3720,
                        '65+' => 1190,
                    ],
                    'pendidikan' => [
                        'SD/Sederajat' => 1850,
                        'SMP/Sederajat' => 2420,
                        'SMA/SMK' => 5230,
                        'Diploma/Sarjana' => 2950,
                    ],
                    'pekerjaan' => [
                        'Karyawan Swasta' => 4150,
                        'Wirausaha/UMKM' => 2830,
                        'PNS/TNI/Polri' => 890,
                        'Jasa/Profesional' => 1460,
                        'Lainnya/Pelajar' => 3120,
                    ],
                ],
                'status_verifikasi' => StatusVerifikasi::Terverifikasi,
            ]
        );

        // 6. Kondisi Sosial
        $sosialItems = [
            ['indikator' => 'Penerima PKH', 'nilai' => '340 KK'],
            ['indikator' => 'Penerima BPNT / Sembako', 'nilai' => '512 KK'],
            ['indikator' => 'Tingkat Kepesertaan BPJS PBI', 'nilai' => '89.4%'],
            ['indikator' => 'Status Stunting Balita', 'nilai' => '0.8% (Sangat Rendah)'],
            ['indikator' => 'Tingkat Kerawanan Bencana', 'nilai' => 'Rendah (Tangguh Bencana)'],
        ];

        foreach ($sosialItems as $s) {
            KondisiSosial::updateOrCreate(
                ['wilayah_id' => $sukawarna->id, 'indikator' => $s['indikator'], 'periode' => '2026'],
                array_merge($s, ['status_verifikasi' => 'terverifikasi'])
            );
        }

        // 7. Fasilitas Umum
        $katPendidikan = KategoriFasilitas::where('slug', 'pendidikan')->first();
        $katKesehatan = KategoriFasilitas::where('slug', 'kesehatan')->first();
        $katIbadah = KategoriFasilitas::where('slug', 'tempat-ibadah')->first();
        $katPemerintahan = KategoriFasilitas::where('slug', 'pemerintahan')->first();
        $katEkonomi = KategoriFasilitas::where('slug', 'ekonomi-pasar')->first();

        $fasilitas = [
            [
                'kategori_id' => $katPemerintahan?->id,
                'nama' => 'Kantor Kelurahan Sukawarna',
                'alamat' => 'Jl. Sukawarna No. 12',
                'lat' => -6.887200,
                'lng' => 107.576500,
                'kondisi' => KondisiFisik::Baik,
                'keterangan' => 'Pusat pelayanan administrasi warga dengan fasilitas ruang laktasi, jalur ramah disabilitas, dan pojok digital.',
                'foto' => 'https://images.unsplash.com/photo-1577495508048-b635879837f1?auto=format&fit=crop&w=600&q=80',
                'status_verifikasi' => StatusVerifikasi::Terverifikasi,
            ],
            [
                'kategori_id' => $katKesehatan?->id,
                'nama' => 'Puskesmas Pembantu Sukawarna',
                'alamat' => 'Jl. Sukagalih No. 45',
                'lat' => -6.885800,
                'lng' => 107.574200,
                'kondisi' => KondisiFisik::Baik,
                'keterangan' => 'Layanan rawat jalan umum, KIA, imunisasi anak, dan pemeriksaan lansia berkala.',
                'foto' => 'https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?auto=format&fit=crop&w=600&q=80',
                'status_verifikasi' => StatusVerifikasi::Terverifikasi,
            ],
            [
                'kategori_id' => $katPendidikan?->id,
                'nama' => 'SD Negeri Sukawarna 1 & 2',
                'alamat' => 'Jl. Sukawarna Raya No. 8',
                'lat' => -6.888500,
                'lng' => 107.578800,
                'kondisi' => KondisiFisik::Baik,
                'keterangan' => 'Sekolah dasar ramah anak berwawasan lingkungan hidup (Adiwiyata).',
                'foto' => 'https://images.unsplash.com/photo-1580582932707-520aed937b7b?auto=format&fit=crop&w=600&q=80',
                'status_verifikasi' => StatusVerifikasi::Terverifikasi,
            ],
            [
                'kategori_id' => $katIbadah?->id,
                'nama' => 'Masjid Jami Al-Hidayah',
                'alamat' => 'Jl. Sukasari Indah No. 22',
                'lat' => -6.886400,
                'lng' => 107.579500,
                'kondisi' => KondisiFisik::Baik,
                'keterangan' => 'Pusat ibadah dan kajian keislaman komunitas Sukawarna dengan perpustakaan mini.',
                'foto' => 'https://images.unsplash.com/photo-1591604129939-f1efa4d9f7fa?auto=format&fit=crop&w=600&q=80',
                'status_verifikasi' => StatusVerifikasi::Terverifikasi,
            ],
            [
                'kategori_id' => $katEkonomi?->id,
                'nama' => 'Pasar Tradisional & Sentra Kuliner Sukawarna',
                'alamat' => 'Jl. Cibogo Bawah No. 5',
                'lat' => -6.889200,
                'lng' => 107.573800,
                'kondisi' => KondisiFisik::Baik,
                'keterangan' => 'Pusat perputaran ekonomi warga, komoditas sayur segar, dan kuliner UMKM lokal.',
                'foto' => 'https://images.unsplash.com/photo-1533900298318-6b8da08a523e?auto=format&fit=crop&w=600&q=80',
                'status_verifikasi' => StatusVerifikasi::Terverifikasi,
            ],
        ];

        foreach ($fasilitas as $f) {
            if (! $f['kategori_id']) {
                continue;
            }
            Fasilitas::updateOrCreate(
                ['wilayah_id' => $sukawarna->id, 'nama' => $f['nama']],
                array_merge($f, ['is_publik' => true])
            );
        }

        // 8. UMKM Unggulan
        $umkmList = [
            [
                'nama_usaha' => 'Kopi Kebun Sukawarna',
                'nama_pemilik' => 'Kang Hendra',
                'kategori' => 'Kuliner',
                'deskripsi' => 'Kopi sangrai arabika dan robusta lokal olahan petani kota binaan kelurahan dengan metode cold brew botolan ramah lingkungan.',
                'alamat' => 'Jl. Sukagalih No. 18, RW 02',
                'kontak_wa' => '081298765432',
                'lat' => -6.886800,
                'lng' => 107.575500,
                'foto' => 'https://images.unsplash.com/photo-1501339847302-ac426a4a7cbb?auto=format&fit=crop&w=600&q=80',
                'is_unggulan' => true,
            ],
            [
                'nama_usaha' => 'Kerajinan Anyam Bambu Lestari',
                'nama_pemilik' => 'Ibu Imas Solihah',
                'kategori' => 'Kerajinan',
                'deskripsi' => 'Aneka wadah hantaran, keranjang belanja organik tanpa plastik, dan dekorasi interior rumah dari bambu alam terbarukan.',
                'alamat' => 'Jl. Sukasari Gang 3 No. 7, RW 01',
                'kontak_wa' => '081387654321',
                'lat' => -6.885100,
                'lng' => 107.573200,
                'foto' => 'https://images.unsplash.com/photo-1590736969955-71cc94801759?auto=format&fit=crop&w=600&q=80',
                'is_unggulan' => true,
            ],
            [
                'nama_usaha' => 'Hidroponik Sukawarna Hijau',
                'nama_pemilik' => 'Kelompok Tani Pemuda RW 03',
                'kategori' => 'Pertanian',
                'deskripsi' => 'Sayuran organik pakcoy, selada, kangkung segar bebas pestisida dipanen langsung setiap hari di kebun atap warga.',
                'alamat' => 'Sentra Hijau RW 03',
                'kontak_wa' => '081576543210',
                'lat' => -6.889500,
                'lng' => 107.576200,
                'foto' => 'https://images.unsplash.com/photo-1530836369250-ef72a3f5cda8?auto=format&fit=crop&w=600&q=80',
                'is_unggulan' => true,
            ],
        ];

        foreach ($umkmList as $u) {
            Umkm::updateOrCreate(
                ['wilayah_id' => $sukawarna->id, 'nama_usaha' => $u['nama_usaha']],
                array_merge($u, ['is_publik' => true])
            );
        }

        // 9. Berita
        $beritaList = [
            [
                'judul' => 'Gerakan Menanam Serentak: Sukawarna Perkuat Ketahanan Pangan Rumah Tangga',
                'kategori' => 'Lingkungan Hidup',
                'ringkasan' => 'Warga Sukawarna bergotong royong menanam bibit cabai, tomat, dan sayuran di pekarangan rumah untuk mewujudkan kelurahan hijau mandiri.',
                'konten' => 'Kegiatan gotong royong hijau kembali digalakkan di Kelurahan Sukawarna. Diinisiasi oleh PKK bersama Karang Taruna, lebih dari 500 bibit sayuran dibagikan secara gratis kepada setiap dasawisma. Lurah Sukawarna menegaskan bahwa ketahanan pangan berawal dari kemandirian pekarangan rumah tangga kita sendiri.',
                'foto' => 'https://images.unsplash.com/photo-1466692476868-aef1dfb1e735?auto=format&fit=crop&w=800&q=80',
                'published_at' => now()->subDays(2),
            ],
            [
                'judul' => 'Pelatihan Literasi Digital & Pemasaran Online untuk Pelaku UMKM Kelurahan',
                'kategori' => 'Ekonomi',
                'ringkasan' => 'Sebanyak 35 pelaku usaha mikro Sukawarna mengikuti lokakarya branding dan digital marketing untuk memperluas jangkauan pasar lokal.',
                'konten' => 'Bekerja sama dengan komunitas kreatif lokal, Kelurahan Sukawarna menyelenggarakan lokakarya pembuatan foto produk yang menarik dan pembuatan katalog daring lewat WhatsApp Business. Pelaku usaha menyambut antusias program pendampingan gratis ini.',
                'foto' => 'https://images.unsplash.com/photo-1556761175-5973dc0f32e7?auto=format&fit=crop&w=800&q=80',
                'published_at' => now()->subDays(5),
            ],
            [
                'judul' => 'Inovasi Pelayanan Keliling: Rekam e-KTP dan Layanan Administrasi Masuk RW',
                'kategori' => 'Pelayanan Publik',
                'ringkasan' => 'Petugas kelurahan jemput bola memberikan kemudahan akses pengurusan administrasi warga bagi kaum lansia dan disabilitas.',
                'konten' => 'Untuk memastikan tidak ada warga yang tertinggal dalam pelayanan publik, mobil pelayanan keliling kelurahan kini rutin mengunjungi setiap balai RW dua kali sebulan. Layanan mencakup penerbitan surat pengantar, pembaruan KK, dan konsultasi bantuan sosial.',
                'foto' => 'https://images.unsplash.com/photo-1450133064473-71024230f91b?auto=format&fit=crop&w=800&q=80',
                'published_at' => now()->subDays(9),
            ],
        ];

        foreach ($beritaList as $b) {
            Berita::updateOrCreate(
                ['slug' => Str::slug($b['judul'])],
                array_merge($b, [
                    'wilayah_id' => $sukawarna->id,
                    'status' => StatusKonten::Terbit,
                    'views_count' => rand(150, 600),
                ])
            );
        }

        // 10. Pengumuman
        Pengumuman::updateOrCreate(
            ['judul' => 'Pendaftaran Bantuan Permodalan Usaha Mikro Tahap I 2026 Dibuka', 'wilayah_id' => $sukawarna->id],
            [
                'isi' => 'Diberitahukan kepada seluruh pelaku UMKM di Kelurahan Sukawarna, pendaftaran fasilitasi permodalan tanpa bunga dari dinas telah dibuka hingga akhir bulan ini. Silakan hubungi seksi Ekbang di kantor kelurahan.',
                'status' => StatusKonten::Terbit,
                'published_at' => now()->subDays(1),
            ]
        );

        // 11. Agenda
        Agenda::updateOrCreate(
            ['judul' => 'Musyawarah Perencanaan Pembangunan (Musrenbang) Kelurahan Sukawarna 2026', 'wilayah_id' => $sukawarna->id],
            [
                'deskripsi' => 'Penyusunan rencana kerja pembangunan wilayah tahun anggaran mendatang bersama perwakilan RT, RW, tokoh masyarakat, dan pimpinan dinas.',
                'lokasi' => 'Aula Pertemuan Kelurahan Sukawarna',
                'tanggal_mulai' => now()->addDays(5)->setTime(9, 0),
                'tanggal_selesai' => now()->addDays(5)->setTime(13, 0),
                'penyelenggara' => 'LPM & Kelurahan Sukawarna',
            ]
        );

        Agenda::updateOrCreate(
            ['judul' => 'Senam Bugar Warga dan Pemeriksaan Kesehatan Gratis Lansia', 'wilayah_id' => $sukawarna->id],
            [
                'deskripsi' => 'Senam bersama dilanjutkan cek tensi darah, gula darah, dan konsultasi dokter puskesmas secara cuma-cuma.',
                'lokasi' => 'Lapangan Serbaguna RW 02',
                'tanggal_mulai' => now()->addDays(8)->setTime(6, 30),
                'tanggal_selesai' => now()->addDays(8)->setTime(10, 0),
                'penyelenggara' => 'TP-PKK & Puskesmas Pembantu',
            ]
        );

        // 12. Infrastruktur
        Infrastruktur::updateOrCreate(
            ['nama' => 'Jalan Utama Sukawarna Raya', 'wilayah_id' => $sukawarna->id],
            [
                'jenis' => 'Jalan',
                'volume_kapasitas' => '2.4 km (Lebar 6m, Aspal Hotmix)',
                'kondisi' => KondisiFisik::Baik,
                'periode' => '2026',
                'status_verifikasi' => StatusVerifikasi::Terverifikasi,
            ]
        );

        Infrastruktur::updateOrCreate(
            ['nama' => 'Saluran Drainase Induk Sukagalih', 'wilayah_id' => $sukawarna->id],
            [
                'jenis' => 'Drainase',
                'volume_kapasitas' => '1.8 km (U-Ditch Beton)',
                'kondisi' => KondisiFisik::Baik,
                'periode' => '2026',
                'status_verifikasi' => StatusVerifikasi::Terverifikasi,
            ]
        );
    }
}
