<?php

namespace App\Filament\Resources\PemantauanKesehatans\Schemas;

use App\Enums\KategoriPemantauan;
use App\Enums\TingkatRisikoKesehatan;
use App\Models\Penduduk;
use App\Support\WilayahSelectHelper;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;

class PemantauanKesehatanForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Identitas Sasaran Posyandu & Kesehatan')
                    ->columns(2)
                    ->schema([
                        Select::make('penduduk_id')
                            ->label('Nama Warga')
                            ->options(fn () => Penduduk::query()
                                ->forCurrentUserWilayah()
                                ->aktif()
                                ->orderBy('nama_lengkap')
                                ->get()
                                ->mapWithKeys(fn (Penduduk $p) => [$p->id => "{$p->nama_lengkap} ({$p->usia} thn · {$p->nik_tersamar})"])
                                ->all())
                            ->searchable()
                            ->live()
                            ->afterStateUpdated(function ($state, Set $set) {
                                if ($state && ($penduduk = Penduduk::find($state))) {
                                    $set('wilayah_id', $penduduk->wilayah_id);
                                }
                            })
                            ->required(),
                        Select::make('wilayah_id')
                            ->label('Wilayah RT / RW')
                            ->options(fn () => WilayahSelectHelper::rtOptionsForCurrentUser())
                            ->searchable()
                            ->required(),
                        Select::make('kategori')
                            ->label('Kategori Pemantauan')
                            ->options(collect(KategoriPemantauan::cases())->mapWithKeys(fn (KategoriPemantauan $k) => [$k->value => $k->label()])->all())
                            ->live()
                            ->default(KategoriPemantauan::IbuHamil->value)
                            ->required(),
                        Select::make('status_risiko')
                            ->label('Tingkat Risiko')
                            ->options(collect(TingkatRisikoKesehatan::cases())->mapWithKeys(fn (TingkatRisikoKesehatan $r) => [$r->value => $r->label()])->all())
                            ->default(TingkatRisikoKesehatan::Normal->value)
                            ->required(),
                    ]),

                Section::make('Detail Kehamilan & Taksiran Persalinan')
                    ->columns(2)
                    ->visible(fn (Get $get): bool => ($get('kategori') instanceof KategoriPemantauan ? $get('kategori')->value : $get('kategori')) === KategoriPemantauan::IbuHamil->value)
                    ->schema([
                        TextInput::make('usia_kehamilan_minggu')
                            ->label('Usia Kehamilan (Minggu)')
                            ->numeric()
                            ->minValue(1)
                            ->maxValue(44),
                        DatePicker::make('hari_perkiraan_lahir')
                            ->label('Hari Perkiraan Lahir (HPL)'),
                    ]),

                Section::make('Antropometri & Catatan Kader (Terenkripsi UU PDP)')
                    ->columns(2)
                    ->schema([
                        TextInput::make('berat_badan_kg')
                            ->label('Berat Badan (kg)')
                            ->numeric()
                            ->step('0.1'),
                        TextInput::make('tinggi_badan_cm')
                            ->label('Tinggi Badan (cm)')
                            ->numeric()
                            ->step('0.1'),
                        DatePicker::make('tanggal_mulai')
                            ->label('Tanggal Mulai Pemantauan')
                            ->default(now())
                            ->required(),
                        DatePicker::make('tanggal_selesai')
                            ->label('Tanggal Selesai (Bila Sudah Melahirkan/Tuntas)'),
                        Toggle::make('aktif')
                            ->label('Status Pemantauan Aktif')
                            ->default(true),
                        Textarea::make('catatan_tindakan')
                            ->label('Catatan Medis / Tindak Lanjut Kader')
                            ->rows(3)
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
