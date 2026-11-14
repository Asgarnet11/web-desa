<?php

namespace App\Filament\Resources\Layanans\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class LayananForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('wilayah_id')
                    ->relationship('wilayah', 'id')
                    ->required(),
                TextInput::make('nama_layanan')
                    ->required(),
                TextInput::make('kategori')
                    ->required()
                    ->default('Kependudukan'),
                TextInput::make('persyaratan'),
                Textarea::make('alur_pelayanan')
                    ->columnSpanFull(),
                TextInput::make('waktu_penyelesaian')
                    ->required()
                    ->default('1 Hari Kerja'),
                TextInput::make('biaya')
                    ->required()
                    ->default('Gratis'),
                TextInput::make('jam_buka'),
                Toggle::make('is_aktif')
                    ->required(),
            ]);
    }
}
