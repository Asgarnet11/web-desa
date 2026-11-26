<?php

namespace App\Filament\Resources\Penduduks\Schemas;

use App\Enums\HubunganKeluarga;
use App\Enums\JenisKelamin;
use App\Enums\StatusKependudukan;
use App\Models\KartuKeluarga;
use App\Models\Penduduk;
use App\Support\KependudukanSecurity;
use App\Support\WilayahSelectHelper;
use Closure;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PendudukForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('wilayah_id')
                    ->label('Wilayah RT / RW')
                    ->options(fn () => WilayahSelectHelper::rtOptionsForCurrentUser())
                    ->searchable()
                    ->required(),
                Select::make('kartu_keluarga_id')
                    ->label('Kartu Keluarga')
                    ->options(fn () => KartuKeluarga::query()
                        ->forCurrentUserWilayah()
                        ->orderBy('kepala_keluarga_nama')
                        ->get()
                        ->mapWithKeys(fn (KartuKeluarga $kk) => [$kk->id => "{$kk->kepala_keluarga_nama} ({$kk->no_kk_tersamar})"])
                        ->all())
                    ->searchable()
                    ->nullable(),
                TextInput::make('nik')
                    ->label('NIK (16 Digit)')
                    ->required()
                    ->maxLength(32)
                    ->helperText('Terenkripsi di database sesuai UU PDP.')
                    ->rule(fn (?Penduduk $record): Closure => function (string $attribute, mixed $value, Closure $fail) use ($record) {
                        $hash = KependudukanSecurity::hashIdentifier((string) $value);
                        $exists = Penduduk::query()
                            ->where('nik_hash', $hash)
                            ->when($record, fn ($q) => $q->whereKeyNot($record->getKey()))
                            ->exists();

                        if ($exists) {
                            $fail('NIK tersebut sudah terdaftar dalam Buku Induk Penduduk.');
                        }
                    }),
                TextInput::make('nama_lengkap')
                    ->label('Nama Lengkap (Sesuai KTP/KK)')
                    ->required()
                    ->maxLength(150),
                Select::make('jenis_kelamin')
                    ->label('Jenis Kelamin')
                    ->options(collect(JenisKelamin::cases())->mapWithKeys(fn (JenisKelamin $jk) => [$jk->value => $jk->label()])->all())
                    ->required(),
                TextInput::make('tempat_lahir')
                    ->label('Tempat Lahir')
                    ->maxLength(100),
                DatePicker::make('tanggal_lahir')
                    ->label('Tanggal Lahir')
                    ->required(),
                Select::make('hubungan_keluarga')
                    ->label('Status Hubungan Dalam KK')
                    ->options(collect(HubunganKeluarga::cases())->mapWithKeys(fn (HubunganKeluarga $h) => [$h->value => $h->label()])->all())
                    ->default(HubunganKeluarga::Anak->value)
                    ->required(),
                Select::make('pendidikan')
                    ->label('Pendidikan Terakhir')
                    ->options([
                        'Belum Sekolah' => 'Belum Sekolah',
                        'SD/Sederajat' => 'SD/Sederajat',
                        'SMP/Sederajat' => 'SMP/Sederajat',
                        'SMA/SMK' => 'SMA/SMK',
                        'Diploma/Sarjana' => 'Diploma/Sarjana',
                    ])
                    ->default('SMA/SMK'),
                TextInput::make('pekerjaan')
                    ->label('Pekerjaan')
                    ->maxLength(80)
                    ->default('Karyawan Swasta'),
                Select::make('status_kependudukan')
                    ->label('Status Kependudukan')
                    ->options(collect(StatusKependudukan::cases())->mapWithKeys(fn (StatusKependudukan $s) => [$s->value => $s->label()])->all())
                    ->default(StatusKependudukan::Tetap->value)
                    ->required(),
                DatePicker::make('tanggal_terdaftar')
                    ->label('Tanggal Terdaftar / Datang')
                    ->default(now()),
            ]);
    }
}
