<?php

namespace App\Filament\Resources\Infrastrukturs\Schemas;

use App\Enums\KondisiFisik;
use App\Enums\StatusVerifikasi;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class InfrastrukturForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('wilayah_id')
                    ->relationship('wilayah', 'id')
                    ->required(),
                TextInput::make('jenis')
                    ->required(),
                TextInput::make('nama')
                    ->required(),
                TextInput::make('volume_kapasitas'),
                Select::make('kondisi')
                    ->options(KondisiFisik::class)
                    ->default('baik')
                    ->required(),
                TextInput::make('geometri'),
                TextInput::make('periode')
                    ->required()
                    ->default('2026'),
                Select::make('status_verifikasi')
                    ->options(StatusVerifikasi::class)
                    ->default('draf')
                    ->required(),
                Textarea::make('catatan_verifikasi')
                    ->columnSpanFull(),
            ]);
    }
}
