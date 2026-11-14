<?php

namespace App\Filament\Resources\Demografis\Schemas;

use App\Enums\StatusVerifikasi;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class DemografiForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('wilayah_id')
                    ->relationship('wilayah', 'id')
                    ->required(),
                TextInput::make('periode')
                    ->required(),
                TextInput::make('jumlah_penduduk')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('jumlah_kk')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('laki_laki')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('perempuan')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('rincian'),
                Select::make('status_verifikasi')
                    ->options(StatusVerifikasi::class)
                    ->default('draf')
                    ->required(),
                Textarea::make('catatan_verifikasi')
                    ->columnSpanFull(),
                TextInput::make('diverifikasi_oleh')
                    ->numeric(),
                DateTimePicker::make('diverifikasi_pada'),
            ]);
    }
}
