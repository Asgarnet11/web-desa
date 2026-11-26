<?php

namespace App\Filament\Resources\Demografis\Schemas;

use App\Enums\StatusVerifikasi;
use App\Support\WilayahSelectHelper;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class DemografiForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Rekapitulasi Agregat Kependudukan')
                    ->description('Teragregasi otomatis saat mutasi LAMPID diverifikasi atau saat sinkronisasi manual dijalankan.')
                    ->columns(2)
                    ->schema([
                        Select::make('wilayah_id')
                            ->label('Wilayah Cakupan')
                            ->options(fn () => WilayahSelectHelper::aggregateWilayahOptionsForCurrentUser())
                            ->searchable()
                            ->required(),
                        TextInput::make('periode')
                            ->label('Periode (Tahun / Kuartal)')
                            ->default((string) now()->year)
                            ->required(),
                        TextInput::make('jumlah_penduduk')
                            ->label('Total Penduduk Aktif')
                            ->required()
                            ->numeric()
                            ->default(0),
                        TextInput::make('jumlah_kk')
                            ->label('Jumlah Kepala Keluarga')
                            ->required()
                            ->numeric()
                            ->default(0),
                        TextInput::make('laki_laki')
                            ->label('Penduduk Laki-laki')
                            ->required()
                            ->numeric()
                            ->default(0),
                        TextInput::make('perempuan')
                            ->label('Penduduk Perempuan')
                            ->required()
                            ->numeric()
                            ->default(0),
                    ]),

                Section::make('Rincian Komposisi & Kesehatan (Otomatis)')
                    ->columns(2)
                    ->schema([
                        KeyValue::make('rincian.usia')
                            ->label('Komposisi Usia')
                            ->disabled(),
                        KeyValue::make('rincian.kesehatan_keluarga')
                            ->label('Pemantauan Kesehatan Keluarga')
                            ->disabled(),
                        KeyValue::make('rincian.mutasi_tahun_ini')
                            ->label('Rekapitulasi Mutasi LAMPID Tahun Berjalan')
                            ->disabled(),
                        KeyValue::make('rincian.pendidikan')
                            ->label('Komposisi Pendidikan')
                            ->disabled(),
                    ]),

                Section::make('Status Pengesahan')
                    ->columns(2)
                    ->schema([
                        Select::make('status_verifikasi')
                            ->label('Status Verifikasi')
                            ->options(StatusVerifikasi::class)
                            ->default('draf')
                            ->required(),
                        DateTimePicker::make('diverifikasi_pada')
                            ->label('Disinkronkan / Diverifikasi Pada'),
                        Textarea::make('catatan_verifikasi')
                            ->label('Catatan')
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
