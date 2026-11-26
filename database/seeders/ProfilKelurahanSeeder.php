<?php

namespace Database\Seeders;

use App\Enums\KondisiFisik;
use App\Enums\StatusKonten;
use App\Enums\StatusVerifikasi;
use App\Models\Agenda;
use App\Models\Berita;
use App\Models\Demografi;
use App\Models\Fasilitas;
use App\Models\Galeri;
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
        $konda = Wilayah::where('kode', '74.05.07.1001')->first();
        if (! $konda) {
            return;
        }

        // 1. Profil Kelurahan
        ProfilKelurahan::updateOrCreate(
            ['wilayah_id' => $konda->id],
            [
                'slogan' => 'Konda Maju, Rukun, dan Melayani Sepenuh Hati',
                'sejarah' => 'Kelurahan Konda merupakan pusat pemerintahan Kecamatan Konda di Kabupaten Konawe Selatan, Sulawesi Tenggara. Terletak strategis pada koridor penghubung Kota Kendari dan Bandara Haluoleo, masyarakat Konda menjaga harmoni sosial antara kearifan lokal Tolaki dan kemajemukan warga dalam pembangunan wilayah.',
                'tahun_terbentuk' => '1982',
                'makna_lambang' => 'Pohon Hayat berakar kuat melambangkan gotong royong dan kebersamaan warga; mentari emas melambangkan kemandirian ekonomi Konawe Selatan.',
                'visi' => 'Terwujudnya Kelurahan Konda yang Maju, Tertib Adminduk, Sejahtera, dan Berdaya Saing di Kabupaten Konawe Selatan.',
                'misi' => [
                    'Meningkatkan tata kelola pelayanan publik yang transparan, ramah, dan cepat berbasis digital.',
                    'Mendorong kemandirian ekonomi warga melalui pemberdayaan UMKM lokal dan agrobisnis keluarga.',
                    'Mewujudkan lingkungan pemukiman yang bersih, hijau, tangguh bencana, dan berkelanjutan.',
                    'Memperkuat kerukunan warga, kohesi sosial, dan ruang partisipasi aktif pemuda serta perempuan.',
                ],
                'motto_pelayanan' => 'CERIA: Cepat, Efisien, Ramah, Ikhlas, dan Akuntabel',
                'foto_kantor' => 'https://images.unsplash.com/photo-1577495508048-b635879837f1?auto=format&fit=crop&w=1200&q=80',
                'foto_peta_wilayah' => null,
                'batas_utara' => 'Kota Kendari & Desa Cialam Jaya',
                'batas_selatan' => 'Kecamatan Wolasi & Desa Konda Satu',
                'batas_timur' => 'Kecamatan Moramo Utara & Desa Lalowiu',
                'batas_barat' => 'Kecamatan Ranomeeto & Desa Ambololi',
                'kontak_telepon' => '(0401) 3124567',
                'kontak_whatsapp' => '08114051938',
                'kontak_email' => 'kelurahan.konda@konaselkab.go.id',
                'alamat_kantor' => 'Jl. Poros Kendari–Konda No. 12, Kecamatan Konda, Kabupaten Konawe Selatan, Sulawesi Tenggara 93874',
                'jam_pelayanan' => "Senin - Kamis: 08.00 - 15.30 WITA\nJumat: 08.00 - 14.30 WITA\nSabtu - Minggu: Libur",
                'social_media' => [
                    'instagram' => 'kelurahankonda',
                    'facebook' => 'KelurahanKondaResmi',
                    'youtube' => 'KondaTV',
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

        // 2. Perangkat Kelurahan (Struktur Lengkap Hierarki)
        $perangkatList = [
            [
                'nama' => 'H. La Ode Muhammad Nasir, S.Sos, M.Si',
                'jabatan' => 'Lurah Konda',
                'nip' => '19750812 200003 1 004',
                'foto' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=400&q=80',
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
                'nama' => 'Kafa Birrasyid, S.Ag',
                'jabatan' => 'Staf Umum & Kepegawaian',
                'nip' => '19890412 201201 1 008',
                'foto' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=400&q=80',
                'kontak' => '0813-1122-3344',
                'urutan' => 3,
            ],
            [
                'nama' => 'Luthfi Abdul Karim, S.Ag',
                'jabatan' => 'Pengadministrasi Keuangan & BMD',
                'nip' => '19900820 201402 1 005',
                'foto' => 'https://images.unsplash.com/photo-1492562080023-ab3db95bfbce?auto=format&fit=crop&w=400&q=80',
                'kontak' => '0813-2233-4455',
                'urutan' => 4,
            ],
            [
                'nama' => 'Budi Santoso, S.Sos',
                'jabatan' => 'Kasi Pemerintahan & Pelayanan',
                'nip' => '19800620 200604 1 012',
                'foto' => 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?auto=format&fit=crop&w=400&q=80',
                'kontak' => '0815-5566-7788',
                'urutan' => 5,
            ],
            [
                'nama' => 'Abdullah Zubair, S.Ag',
                'jabatan' => 'Staf Pelayanan Kependudukan',
                'nip' => '19920110 201503 1 002',
                'foto' => 'https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?auto=format&fit=crop&w=400&q=80',
                'kontak' => '0815-6677-8899',
                'urutan' => 6,
            ],
            [
                'nama' => 'Ahmad Fauzi, S.T',
                'jabatan' => 'Kasi Ekonomi & Pembangunan',
                'nip' => '19881105 201101 1 003',
                'foto' => 'https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?auto=format&fit=crop&w=400&q=80',
                'kontak' => '0817-7788-9900',
                'urutan' => 7,
            ],
            [
                'nama' => 'Taufik Kurrahman, S.H',
                'jabatan' => 'Staf Pengawas Infrastruktur',
                'nip' => '19930514 201701 1 007',
                'foto' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=400&q=80',
                'kontak' => '0817-8899-0011',
                'urutan' => 8,
            ],
            [
                'nama' => 'Dewi Sartika, S.Pd',
                'jabatan' => 'Kasi Kesejahteraan Sosial',
                'nip' => '19860925 201001 2 005',
                'foto' => 'https://images.unsplash.com/photo-1580489944761-15a19d654956?auto=format&fit=crop&w=400&q=80',
                'kontak' => '0818-8899-0011',
                'urutan' => 9,
            ],
            [
                'nama' => 'Lalu Yasin, S.H',
                'jabatan' => 'Staf Bantuan Sosial & PKH',
                'nip' => '19940218 201802 1 006',
                'foto' => 'https://images.unsplash.com/photo-1522075469751-3a6694fb2f61?auto=format&fit=crop&w=400&q=80',
                'kontak' => '0818-9900-1122',
                'urutan' => 10,
            ],
            [
                'nama' => 'Mayor (Purn) Hendra Gunawan',
                'jabatan' => 'Kasi Ketenteraman & Ketertiban',
                'nip' => '19780315 200201 1 009',
                'foto' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=400&q=80',
                'kontak' => '0819-0011-2233',
                'urutan' => 11,
            ],
            [
                'nama' => 'Adam Lubis, S.Ag',
                'jabatan' => 'Komandan Regu Linmas',
                'nip' => '19850722 200903 1 004',
                'foto' => 'https://images.unsplash.com/photo-1492562080023-ab3db95bfbce?auto=format&fit=crop&w=400&q=80',
                'kontak' => '0819-1122-3344',
                'urutan' => 12,
            ],
            [
                'nama' => 'Abdil Mahfuzi, S.Ag',
                'jabatan' => 'Koordinator IT & Data Spasial',
                'nip' => '19910617 201601 1 003',
                'foto' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=400&q=80',
                'kontak' => '0821-2233-4455',
                'urutan' => 13,
            ],
            [
                'nama' => 'Hasan Ali, S.H',
                'jabatan' => 'Operator Data SIAK & Portal',
                'nip' => '19950311 201902 1 008',
                'foto' => 'https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?auto=format&fit=crop&w=400&q=80',
                'kontak' => '0821-3344-5566',
                'urutan' => 14,
            ],
            [
                'nama' => 'Hj. Wa Ode Hasnah',
                'jabatan' => 'Koordinator Lingkungan Hidup',
                'nip' => '19820519 200701 2 007',
                'foto' => 'https://images.unsplash.com/photo-1544005313-94ddf0286df2?auto=format&fit=crop&w=400&q=80',
                'kontak' => '0822-4455-6677',
                'urutan' => 15,
            ],
            [
                'nama' => 'Rohman Nasruddin, S.Ag',
                'jabatan' => 'Pengelola Bank Sampah Tematik',
                'nip' => '19931128 201801 1 005',
                'foto' => 'https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?auto=format&fit=crop&w=400&q=80',
                'kontak' => '0822-5566-7788',
                'urutan' => 16,
            ],
            [
                'nama' => 'Reza Pratama, S.Kom',
                'jabatan' => 'Ketua Karang Taruna',
                'nip' => '-',
                'foto' => 'https://images.unsplash.com/photo-1522075469751-3a6694fb2f61?auto=format&fit=crop&w=400&q=80',
                'kontak' => '0823-6677-8899',
                'urutan' => 17,
            ],
            [
                'nama' => 'Damu Azrial, S.Kom',
                'jabatan' => 'Staf Kreatif & Media Sosial',
                'nip' => '-',
                'foto' => 'https://images.unsplash.com/photo-1492562080023-ab3db95bfbce?auto=format&fit=crop&w=400&q=80',
                'kontak' => '0823-7788-9900',
                'urutan' => 18,
            ],
        ];

        foreach ($perangkatList as $p) {
            Perangkat::updateOrCreate(
                ['wilayah_id' => $konda->id, 'nama' => $p['nama']],
                array_merge($p, ['status_aktif' => true])
            );
        }

        // 3. Lembaga Kelurahan
        $lembagaList = [
            ['nama_lembaga' => 'Lembaga Pemberdayaan Masyarakat (LPM)', 'ketua' => 'H. La Ode Bakri', 'jumlah_anggota' => 24, 'deskripsi' => 'Mitra kelurahan dalam merencanakan dan mengawal pembangunan partisipatif tingkat warga.'],
            ['nama_lembaga' => 'Tim Penggerak PKK', 'ketua' => 'Hj. St. Aminah Nasir', 'jumlah_anggota' => 45, 'deskripsi' => 'Gerakan pemberdayaan kesejahteraan keluarga, posyandu, dan ketahanan pangan rumah tangga.'],
            ['nama_lembaga' => 'Karang Taruna Tunas Harapan', 'ketua' => 'Rizky Pratama', 'jumlah_anggota' => 60, 'deskripsi' => 'Wadah pembinaan generasi muda di bidang kewirausahaan kreatif, lingkungan hidup, dan olahraga.'],
            ['nama_lembaga' => 'Forum RW & RT Konda', 'ketua' => 'Ir. Gunawan Wibowo', 'jumlah_anggota' => 38, 'deskripsi' => 'Koordinasi lintas ketua RW dan RT untuk pelayanan keamanan, kebersihan, dan sosial warga.'],
        ];

        foreach ($lembagaList as $l) {
            Lembaga::updateOrCreate(
                ['wilayah_id' => $konda->id, 'nama_lembaga' => $l['nama_lembaga']],
                $l
            );
        }

        // 4. Layanan Publik
        $layananList = [
            [
                'nama_layanan' => 'Surat Pengantar SKCK',
                'kategori' => 'Kependudukan',
                'persyaratan' => ['KTP asli & fotokopi pemohon', 'Kartu Keluarga asli & fotokopi', 'Surat Pengantar dari Ketua RT/RW setempat', 'Pas foto 4x6 (2 lembar) latar merah'],
                'alur_pelayanan' => 'Warga membawa berkas pengantar RT/RW ke loket kelurahan -> Petugas memverifikasi kelengkapan -> Lurah menandatangani berkas pengantar -> Berkas diserahkan untuk dibawa ke Polsek Konda.',
                'waktu_penyelesaian' => '15 Menit',
                'biaya' => 'Gratis',
                'jam_buka' => '08.00 - 14.30 WITA',
            ],
            [
                'nama_layanan' => 'Surat Keterangan Usaha (SKU)',
                'kategori' => 'Perizinan & Usaha',
                'persyaratan' => ['KTP & KK pemohon yang berdomisili di Konda', 'Surat Pengantar RT/RW', 'Foto lokasi dan kegiatan usaha', 'Surat pernyataan tidak sengketa tempat usaha'],
                'alur_pelayanan' => 'Pengajuan berkas di loket kelurahan -> Verifikasi lapangan bila diperlukan -> Penerbitan Surat Keterangan Usaha resmi.',
                'waktu_penyelesaian' => '1 Hari Kerja',
                'biaya' => 'Gratis',
                'jam_buka' => '08.00 - 15.00 WITA',
            ],
            [
                'nama_layanan' => 'Surat Keterangan Domisili Warga / Lembaga',
                'kategori' => 'Kependudukan',
                'persyaratan' => ['Fotokopi KTP & KK pemohon', 'Surat pengantar RT/RW', 'Bukti sewa/kepemilikan tempat tinggal'],
                'alur_pelayanan' => 'Penyerahan berkas -> Verifikasi data kependudukan -> Cetak dan legalisasi surat keterangan.',
                'waktu_penyelesaian' => '20 Menit',
                'biaya' => 'Gratis',
                'jam_buka' => '08.00 - 15.00 WITA',
            ],
            [
                'nama_layanan' => 'Surat Keterangan Tidak Mampu (SKTM)',
                'kategori' => 'Sosial',
                'persyaratan' => ['KTP & KK asli dan fotokopi', 'Pengantar RT/RW bermaterai', 'Foto kondisi rumah pemohon', 'Tujuan peruntukan (beasiswa/kesehatan)'],
                'alur_pelayanan' => 'Pemeriksaan DTKS/data bansos -> Penandatanganan pejabat kelurahan -> Digunakan untuk fasilitas kesehatan/pendidikan.',
                'waktu_penyelesaian' => '1 Hari Kerja',
                'biaya' => 'Gratis',
                'jam_buka' => '08.00 - 14.30 WITA',
            ],
        ];

        foreach ($layananList as $lay) {
            Layanan::updateOrCreate(
                ['wilayah_id' => $konda->id, 'nama_layanan' => $lay['nama_layanan']],
                array_merge($lay, ['is_aktif' => true])
            );
        }

        // 5. Demografi
        Demografi::updateOrCreate(
            ['wilayah_id' => $konda->id, 'periode' => '2026'],
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
                ['wilayah_id' => $konda->id, 'indikator' => $s['indikator'], 'periode' => '2026'],
                array_merge($s, ['status_verifikasi' => 'terverifikasi'])
            );
        }

        // 7. Fasilitas Umum
        $katPendidikan = KategoriFasilitas::where('slug', 'pendidikan')->first();
        $katKesehatan = KategoriFasilitas::where('slug', 'kesehatan')->first();
        $katIbadah = KategoriFasilitas::where('slug', 'tempat-ibadah')->first();
        $katPemerintahan = KategoriFasilitas::where('slug', 'pemerintahan')->first();
        $katEkonomi = KategoriFasilitas::where('slug', 'ekonomi-pasar')->first();
        $katInfrastruktur = KategoriFasilitas::where('slug', 'infrastruktur-utilitas')->first();
        $katSosial = KategoriFasilitas::where('slug', 'sosial-olahraga')->first();

        $fasilitas = [
            [
                'kategori_id' => $katPemerintahan?->id,
                'nama' => 'Kantor Kelurahan Konda',
                'alamat' => 'Jl. Poros Kendari–Konda No. 12',
                'lat' => -4.124444,
                'lng' => 122.440278,
                'kondisi' => KondisiFisik::Baik,
                'keterangan' => 'Pusat pelayanan administrasi warga Kelurahan Konda dengan fasilitas ruang laktasi, jalur ramah disabilitas, dan pojok digital.',
                'foto' => 'https://images.unsplash.com/photo-1577495508048-b635879837f1?auto=format&fit=crop&w=600&q=80',
                'status_verifikasi' => StatusVerifikasi::Terverifikasi,
            ],
            [
                'kategori_id' => $katKesehatan?->id,
                'nama' => 'Puskesmas Konda',
                'alamat' => 'Jl. Poros Kendari–Konda KM 18',
                'lat' => -4.121800,
                'lng' => 122.438100,
                'kondisi' => KondisiFisik::Baik,
                'keterangan' => 'Layanan rawat jalan umum, KIA/Ibu Hamil, imunisasi anak, UGD 24 jam, dan pemeriksaan lansia berkala.',
                'foto' => 'https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?auto=format&fit=crop&w=600&q=80',
                'status_verifikasi' => StatusVerifikasi::Terverifikasi,
            ],
            [
                'kategori_id' => $katPendidikan?->id,
                'nama' => 'SD Negeri 1 Konda & SMPN 1 Konawe Selatan',
                'alamat' => 'Jl. Pendidikan Konda No. 8',
                'lat' => -4.126200,
                'lng' => 122.442500,
                'kondisi' => KondisiFisik::Baik,
                'keterangan' => 'Sarana pendidikan dasar dan menengah ramah anak berwawasan lingkungan hidup.',
                'foto' => 'https://images.unsplash.com/photo-1580582932707-520aed937b7b?auto=format&fit=crop&w=600&q=80',
                'status_verifikasi' => StatusVerifikasi::Terverifikasi,
            ],
            [
                'kategori_id' => $katIbadah?->id,
                'nama' => 'Masjid Besar Nurul Iman Konda',
                'alamat' => 'Jl. Poros Konda Raya No. 22',
                'lat' => -4.123500,
                'lng' => 122.443200,
                'kondisi' => KondisiFisik::Baik,
                'keterangan' => 'Pusat ibadah dan pembinaan keagamaan masyarakat Kecamatan Konda dengan taman baca warga.',
                'foto' => 'https://images.unsplash.com/photo-1591604129939-f1efa4d9f7fa?auto=format&fit=crop&w=600&q=80',
                'status_verifikasi' => StatusVerifikasi::Terverifikasi,
            ],
            [
                'kategori_id' => $katEkonomi?->id,
                'nama' => 'Pasar Rakyat & Sentra Tani Konda',
                'alamat' => 'Jl. Pasar Sentral Konda No. 5',
                'lat' => -4.127100,
                'lng' => 122.437500,
                'kondisi' => KondisiFisik::Baik,
                'keterangan' => 'Pusat perputaran hasil pertanian, perkebunan, hortikultura, dan kuliner UMKM warga Konda.',
                'foto' => 'https://images.unsplash.com/photo-1533900298318-6b8da08a523e?auto=format&fit=crop&w=600&q=80',
                'status_verifikasi' => StatusVerifikasi::Terverifikasi,
            ],
            [
                'kategori_id' => $katInfrastruktur?->id,
                'nama' => 'Posko Siaga Bencana & Polsek Konda',
                'alamat' => 'Jl. Poros Konda–Morome No. 3',
                'lat' => -4.122800,
                'lng' => 122.436800,
                'kondisi' => KondisiFisik::Baik,
                'keterangan' => 'Posko kesiapsiagaan bencana, layanan ambulans siaga 24 jam, dan pengamanan ketertiban masyarakat.',
                'foto' => 'https://images.unsplash.com/photo-1544620347-c4fd4a3d5957?auto=format&fit=crop&w=600&q=80',
                'status_verifikasi' => StatusVerifikasi::Terverifikasi,
            ],
            [
                'kategori_id' => $katSosial?->id,
                'nama' => 'Lapangan Olahraga & Alun-Alun Konda',
                'alamat' => 'Jl. Poros Kecamatan Konda No. 10',
                'lat' => -4.125500,
                'lng' => 122.441000,
                'kondisi' => KondisiFisik::Baik,
                'keterangan' => 'Fasilitas lapangan sepak bola, jogging track, taman bermain anak, dan kegiatan senam warga.',
                'foto' => 'https://images.unsplash.com/photo-1574629810360-7efbbe195018?auto=format&fit=crop&w=600&q=80',
                'status_verifikasi' => StatusVerifikasi::Terverifikasi,
            ],
            [
                'kategori_id' => $katInfrastruktur?->id,
                'nama' => 'Bank Sampah Induk & Rumah Kompos Konda',
                'alamat' => 'Jl. Lingkungan RW 04 No. 18',
                'lat' => -4.128200,
                'lng' => 122.440800,
                'kondisi' => KondisiFisik::Baik,
                'keterangan' => 'Pusat daur ulang sampah anorganik warga, produksi kompos organik, dan kebun bibit pekarangan.',
                'foto' => 'https://images.unsplash.com/photo-1532996122724-e3c354a0b15b?auto=format&fit=crop&w=600&q=80',
                'status_verifikasi' => StatusVerifikasi::Terverifikasi,
            ],
        ];

        foreach ($fasilitas as $f) {
            if (! $f['kategori_id']) {
                continue;
            }
            Fasilitas::updateOrCreate(
                ['wilayah_id' => $konda->id, 'nama' => $f['nama']],
                array_merge($f, ['is_publik' => true])
            );
        }

        // 8. UMKM Unggulan
        $umkmList = [
            [
                'nama_usaha' => 'Kopi Tolaki & Kedai Konda',
                'nama_pemilik' => 'Bapak Hendra',
                'kategori' => 'Kuliner',
                'deskripsi' => 'Kopi sangrai lokal Konawe pilihan binaan kelurahan dengan racikan tradisional dan cold brew kemasan siap saji.',
                'alamat' => 'Jl. Poros Kendari–Konda No. 18, RW 02',
                'kontak_wa' => '081298765432',
                'lat' => -4.123800,
                'lng' => 122.439500,
                'foto' => 'https://images.unsplash.com/photo-1501339847302-ac426a4a7cbb?auto=format&fit=crop&w=600&q=80',
                'is_unggulan' => true,
            ],
            [
                'nama_usaha' => 'Kerajinan Anyam Rotan & Bambu Konda',
                'nama_pemilik' => 'Ibu Siti Aminah',
                'kategori' => 'Kerajinan',
                'deskripsi' => 'Aneka wadah hantaran, keranjang belanja alami tanpa plastik, dan dekorasi rumah dari rotan serta bambu Sulawesi Tenggara.',
                'alamat' => 'Jl. Konda Raya Lorong 3 No. 7, RW 01',
                'kontak_wa' => '081387654321',
                'lat' => -4.120500,
                'lng' => 122.437200,
                'foto' => 'https://images.unsplash.com/photo-1590736969955-71cc94801759?auto=format&fit=crop&w=600&q=80',
                'is_unggulan' => true,
            ],
            [
                'nama_usaha' => 'Hidroponik & Hortikultura Konda Lestari',
                'nama_pemilik' => 'Kelompok Tani Muda RW 03',
                'kategori' => 'Pertanian',
                'deskripsi' => 'Sayuran segar pakcoy, selada, cabai, dan tomat bebas pestisida dipanen langsung setiap pagi dari kebun pekarangan warga.',
                'alamat' => 'Sentra Agro RW 03 Konda',
                'kontak_wa' => '081576543210',
                'lat' => -4.125800,
                'lng' => 122.438800,
                'foto' => 'https://images.unsplash.com/photo-1530836369250-ef72a3f5cda8?auto=format&fit=crop&w=600&q=80',
                'is_unggulan' => true,
            ],
        ];

        foreach ($umkmList as $u) {
            Umkm::updateOrCreate(
                ['wilayah_id' => $konda->id, 'nama_usaha' => $u['nama_usaha']],
                array_merge($u, ['is_publik' => true])
            );
        }

        // 9. Berita
        $beritaList = [
            [
                'judul' => 'Gerakan Menanam Serentak: Kelurahan Konda Perkuat Ketahanan Pangan Rumah Tangga',
                'kategori' => 'Lingkungan Hidup',
                'ringkasan' => 'Warga Kelurahan Konda bergotong royong menanam bibit cabai, tomat, dan sayuran di pekarangan rumah untuk mewujudkan kemandirian pangan keluarga.',
                'konten' => 'Kegiatan gotong royong hijau kembali digalakkan di Kelurahan Konda, Kecamatan Konda. Diinisiasi oleh PKK bersama Karang Taruna, lebih dari 500 bibit sayuran dan hortikultura dibagikan secara gratis kepada setiap dasawisma. Lurah Konda menegaskan bahwa ketahanan pangan Konawe Selatan berawal dari kemandirian pekarangan rumah tangga kita sendiri.',
                'foto' => 'https://images.unsplash.com/photo-1466692476868-aef1dfb1e735?auto=format&fit=crop&w=800&q=80',
                'published_at' => now()->subDays(2),
            ],
            [
                'judul' => 'Pelatihan Literasi Digital & Pemasaran Online untuk Pelaku UMKM Kelurahan Konda',
                'kategori' => 'Ekonomi',
                'ringkasan' => 'Sebanyak 35 pelaku usaha mikro Kelurahan Konda mengikuti lokakarya branding dan pemasaran digital untuk memperluas pasar di Kendari dan Konawe Selatan.',
                'konten' => 'Bekerja sama dengan komunitas kreatif daerah, Kelurahan Konda menyelenggarakan lokakarya pembuatan foto produk yang menarik dan penyusunan katalog daring lewat WhatsApp Business. Pelaku usaha menyambut antusias program pendampingan gratis ini.',
                'foto' => 'https://images.unsplash.com/photo-1556761175-5973dc0f32e7?auto=format&fit=crop&w=800&q=80',
                'published_at' => now()->subDays(5),
            ],
            [
                'judul' => 'Inovasi Pelayanan Keliling: Sinkronisasi Adminduk dan Layanan Surat Masuk RW',
                'kategori' => 'Pelayanan Publik',
                'ringkasan' => 'Petugas Kelurahan Konda jemput bola memberikan kemudahan akses pengurusan administrasi warga bagi kaum lansia dan penyandang disabilitas.',
                'konten' => 'Untuk memastikan tidak ada warga yang tertinggal dalam pelayanan publik, tim pelayanan keliling Kelurahan Konda kini rutin mengunjungi setiap RW dua kali sebulan. Layanan mencakup penerbitan surat pengantar, pembaruan Kartu Keluarga, dan konsultasi bantuan sosial.',
                'foto' => 'https://images.unsplash.com/photo-1450133064473-71024230f91b?auto=format&fit=crop&w=800&q=80',
                'published_at' => now()->subDays(9),
            ],
        ];

        foreach ($beritaList as $b) {
            Berita::updateOrCreate(
                ['slug' => Str::slug($b['judul'])],
                array_merge($b, [
                    'wilayah_id' => $konda->id,
                    'status' => StatusKonten::Terbit,
                    'views_count' => rand(150, 600),
                ])
            );
        }

        // 10. Pengumuman
        Pengumuman::updateOrCreate(
            ['judul' => 'Pendaftaran Bantuan Permodalan Usaha Mikro Tahap I 2026 Dibuka', 'wilayah_id' => $konda->id],
            [
                'isi' => 'Diberitahukan kepada seluruh pelaku UMKM di Kelurahan Konda, pendaftaran fasilitasi permodalan usaha mikro dari pemerintah daerah telah dibuka hingga akhir bulan ini. Silakan hubungi seksi Ekbang di kantor kelurahan.',
                'status' => StatusKonten::Terbit,
                'published_at' => now()->subDays(1),
            ]
        );

        // 11. Agenda
        Agenda::updateOrCreate(
            ['judul' => 'Musyawarah Perencanaan Pembangunan (Musrenbang) Kelurahan Konda 2026', 'wilayah_id' => $konda->id],
            [
                'deskripsi' => 'Penyusunan rencana kerja pembangunan wilayah tahun anggaran mendatang bersama perwakilan RT, RW, tokoh masyarakat, dan instansi Kabupaten Konawe Selatan.',
                'lokasi' => 'Aula Pertemuan Kantor Kelurahan Konda',
                'tanggal_mulai' => now()->addDays(5)->setTime(9, 0),
                'tanggal_selesai' => now()->addDays(5)->setTime(13, 0),
                'penyelenggara' => 'LPM & Kelurahan Konda',
            ]
        );

        Agenda::updateOrCreate(
            ['judul' => 'Senam Bugar Warga dan Pemeriksaan Kesehatan Gratis Lansia', 'wilayah_id' => $konda->id],
            [
                'deskripsi' => 'Senam bersama dilanjutkan cek tensi darah, gula darah, dan konsultasi tim kesehatan Puskesmas Konda secara cuma-cuma.',
                'lokasi' => 'Lapangan Olahraga & Alun-Alun Konda RW 02',
                'tanggal_mulai' => now()->addDays(8)->setTime(6, 30),
                'tanggal_selesai' => now()->addDays(8)->setTime(10, 0),
                'penyelenggara' => 'TP-PKK & Puskesmas Konda',
            ]
        );

        // 12. Infrastruktur
        Infrastruktur::updateOrCreate(
            ['nama' => 'Jalan Poros Kendari–Konda', 'wilayah_id' => $konda->id],
            [
                'jenis' => 'Jalan',
                'volume_kapasitas' => '3.2 km (Lebar 7m, Aspal Hotmix)',
                'kondisi' => KondisiFisik::Baik,
                'periode' => '2026',
                'status_verifikasi' => StatusVerifikasi::Terverifikasi,
            ]
        );

        Infrastruktur::updateOrCreate(
            ['nama' => 'Saluran Drainase Induk Konda', 'wilayah_id' => $konda->id],
            [
                'jenis' => 'Drainase',
                'volume_kapasitas' => '2.1 km (U-Ditch Beton)',
                'kondisi' => KondisiFisik::Baik,
                'periode' => '2026',
                'status_verifikasi' => StatusVerifikasi::Terverifikasi,
            ]
        );

        // 13. Galeri Foto Kegiatan Warga
        $galeriList = [
            [
                'judul' => 'Kerja Bakti Massal Kebersihan Saluran & Lingkungan Konda',
                'keterangan' => 'Gotong royong warga RW 01 dan RW 02 membersihkan drainase menyambut musim penghujan.',
                'tipe' => 'foto',
                'file_url' => 'https://images.unsplash.com/photo-1593113598332-cd288d649433?auto=format&fit=crop&w=800&q=80',
                'tanggal' => now()->subDays(3),
            ],
            [
                'judul' => 'Senam Sehat Lansia & Posyandu Balita Terpadu',
                'keterangan' => 'Pemeriksaan kesehatan rutin dan pemberian makanan tambahan bergizi bersama Kader Posyandu Konda.',
                'tipe' => 'foto',
                'file_url' => 'https://images.unsplash.com/photo-1576765608535-5f04d1e3f289?auto=format&fit=crop&w=800&q=80',
                'tanggal' => now()->subDays(7),
            ],
            [
                'judul' => 'Pelatihan Pemasaran Digital & Kemasan Produk UMKM',
                'keterangan' => 'Pendampingan wirausaha mandiri meningkatkan daya saing produk olahan pangan dan kerajinan warga.',
                'tipe' => 'foto',
                'file_url' => 'https://images.unsplash.com/photo-1556761175-5973dc0f32e7?auto=format&fit=crop&w=800&q=80',
                'tanggal' => now()->subDays(12),
            ],
            [
                'judul' => 'Panen Bersama Kebun Pekarangan Pangan Lestari',
                'keterangan' => 'Ketahanan pangan mandiri hasil budidaya sayur hidroponik dan tanaman hortikultura warga.',
                'tipe' => 'foto',
                'file_url' => 'https://images.unsplash.com/photo-1466692476868-aef1dfb1e735?auto=format&fit=crop&w=800&q=80',
                'tanggal' => now()->subDays(18),
            ],
            [
                'judul' => 'Musyawarah Warga Perencanaan Pembangunan (Musrenbang)',
                'keterangan' => 'Rembug warga menyepakati prioritas perbaikan infrastruktur jalan dan sarana publik.',
                'tipe' => 'foto',
                'file_url' => 'https://images.unsplash.com/photo-1577495508048-b635879837f1?auto=format&fit=crop&w=800&q=80',
                'tanggal' => now()->subDays(25),
            ],
        ];

        foreach ($galeriList as $g) {
            Galeri::updateOrCreate(
                ['wilayah_id' => $konda->id, 'judul' => $g['judul']],
                $g
            );
        }
    }
}
