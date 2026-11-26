<?php

namespace App\Filament\Resources\MutasiPenduduks\Schemas;

use App\Enums\JenisKelamin;
use App\Enums\JenisMutasi;
use App\Enums\StatusKependudukan;
use App\Models\KartuKeluarga;
use App\Models\Penduduk;
use App\Support\WilayahSelectHelper;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;

class MutasiPendudukForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Peristiwa Kependudukan (LAMPID)')
                    ->columns(2)
                    ->schema([
                        Select::make('wilayah_id')
                            ->label('Wilayah RT / RW Kejadian')
                            ->options(fn () => WilayahSelectHelper::rtOptionsForCurrentUser())
                            ->searchable()
                            ->required(),
                        Select::make('jenis_mutasi')
                            ->label('Jenis Peristiwa / Mutasi')
                            ->options(collect(JenisMutasi::cases())->mapWithKeys(fn (JenisMutasi $m) => [$m->value => $m->label()])->all())
                            ->live()
                            ->required(),
                        DatePicker::make('tanggal_peristiwa')
                            ->label('Tanggal Peristiwa')
                            ->default(now())
                            ->required(),
                        TextInput::make('asal_atau_tujuan')
                            ->label(fn (Get $get): string => match ($get('jenis_mutasi')) {
                                JenisMutasi::Datang->value, JenisMutasi::Datang => 'Alamat / Daerah Asal Kedatangan',
                                JenisMutasi::PindahKeluar->value, JenisMutasi::PindahKeluar => 'Alamat / Daerah Tujuan Kepindahan',
                                JenisMutasi::Kematian->value, JenisMutasi::Kematian => 'Tempat / Keterangan Kematian',
                                default => 'Keterangan Lokasi / Tempat Peristiwa',
                            })
                            ->maxLength(255),
                        TextInput::make('nomor_surat_pengantar')
                            ->label('No. Surat Pengantar / Registrasi')
                            ->placeholder('Terisi otomatis saat verifikasi jika dikosongkan')
                            ->maxLength(80),
                    ]),

                Section::make('Subjek Penduduk Terkait')
                    ->columns(2)
                    ->visible(fn (Get $get): bool => in_array(
                        $get('jenis_mutasi') instanceof JenisMutasi ? $get('jenis_mutasi')->value : $get('jenis_mutasi'),
                        [JenisMutasi::Kematian->value, JenisMutasi::PindahKeluar->value, JenisMutasi::PerubahanData->value],
                        true
                    ))
                    ->schema([
                        Select::make('penduduk_id')
                            ->label('Pilih Warga Terdaftar')
                            ->options(fn () => Penduduk::query()
                                ->forCurrentUserWilayah()
                                ->aktif()
                                ->orderBy('nama_lengkap')
                                ->get()
                                ->mapWithKeys(fn (Penduduk $p) => [$p->id => "{$p->nama_lengkap} ({$p->nik_tersamar})"])
                                ->all())
                            ->searchable()
                            ->required()
                            ->columnSpanFull(),
                    ]),

                Section::make('Data Bayi Lahir Baru')
                    ->columns(2)
                    ->visible(fn (Get $get): bool => ($get('jenis_mutasi') instanceof JenisMutasi ? $get('jenis_mutasi')->value : $get('jenis_mutasi')) === JenisMutasi::Kelahiran->value)
                    ->schema([
                        Select::make('kartu_keluarga_id')
                            ->label('Kartu Keluarga Orang Tua')
                            ->options(fn () => KartuKeluarga::query()
                                ->forCurrentUserWilayah()
                                ->where('status_kk', 'aktif')
                                ->orderBy('kepala_keluarga_nama')
                                ->get()
                                ->mapWithKeys(fn (KartuKeluarga $kk) => [$kk->id => "{$kk->kepala_keluarga_nama} ({$kk->no_kk_tersamar})"])
                                ->all())
                            ->searchable(),
                        Select::make('payload_data.ibu_penduduk_id')
                            ->label('Ibu Kandung (Otomatis Menutup Pantauan Hamil)')
                            ->options(fn () => Penduduk::query()
                                ->forCurrentUserWilayah()
                                ->aktif()
                                ->where('jenis_kelamin', JenisKelamin::Perempuan->value)
                                ->orderBy('nama_lengkap')
                                ->get()
                                ->mapWithKeys(fn (Penduduk $p) => [$p->id => "{$p->nama_lengkap} ({$p->usia} thn)"])
                                ->all())
                            ->searchable(),
                        TextInput::make('payload_data.nama_lengkap')
                            ->label('Nama Lengkap Bayi')
                            ->required(),
                        Select::make('payload_data.jenis_kelamin')
                            ->label('Jenis Kelamin Bayi')
                            ->options(collect(JenisKelamin::cases())->mapWithKeys(fn (JenisKelamin $jk) => [$jk->value => $jk->label()])->all())
                            ->required(),
                        TextInput::make('payload_data.nik')
                            ->label('NIK Bayi (Opsional jika belum terbit KIA/NIK)')
                            ->maxLength(32),
                        Toggle::make('payload_data.daftarkan_balita')
                            ->label('Otomatis Daftarkan ke Pantauan Posyandu Balita')
                            ->default(true),
                    ]),

                Section::make('Data Pendatang Baru (Datang)')
                    ->columns(2)
                    ->visible(fn (Get $get): bool => ($get('jenis_mutasi') instanceof JenisMutasi ? $get('jenis_mutasi')->value : $get('jenis_mutasi')) === JenisMutasi::Datang->value)
                    ->schema([
                        TextInput::make('payload_data.no_kk')
                            ->label('No. KK Asal / Baru (16 Digit)')
                            ->required(),
                        TextInput::make('payload_data.kepala_keluarga_nama')
                            ->label('Nama Kepala Keluarga')
                            ->required(),
                        TextInput::make('payload_data.nik')
                            ->label('NIK Warga Datang')
                            ->required(),
                        TextInput::make('payload_data.nama_lengkap')
                            ->label('Nama Lengkap')
                            ->required(),
                        Select::make('payload_data.jenis_kelamin')
                            ->label('Jenis Kelamin')
                            ->options(collect(JenisKelamin::cases())->mapWithKeys(fn (JenisKelamin $jk) => [$jk->value => $jk->label()])->all())
                            ->required(),
                        DatePicker::make('payload_data.tanggal_lahir')
                            ->label('Tanggal Lahir')
                            ->required(),
                        Select::make('payload_data.status_kependudukan')
                            ->label('Jenis Domisili')
                            ->options([
                                StatusKependudukan::Tetap->value => StatusKependudukan::Tetap->label(),
                                StatusKependudukan::Sementara->value => StatusKependudukan::Sementara->label(),
                            ])
                            ->default(StatusKependudukan::Tetap->value)
                            ->required(),
                        TextInput::make('payload_data.pekerjaan')
                            ->label('Pekerjaan')
                            ->default('Karyawan Swasta'),
                    ]),

                Section::make('Catatan & Verifikasi')
                    ->schema([
                        Textarea::make('catatan_verifikasi')
                            ->label('Catatan Lapangan / Keterangan Pengantar')
                            ->rows(2)
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
