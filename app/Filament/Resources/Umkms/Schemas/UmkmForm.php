<?php

namespace App\Filament\Resources\Umkms\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class UmkmForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('wilayah_id')
                    ->relationship('wilayah', 'id')
                    ->required(),
                TextInput::make('nama_usaha')
                    ->required(),
                TextInput::make('nama_pemilik'),
                TextInput::make('kategori')
                    ->required()
                    ->default('Kuliner'),
                Textarea::make('deskripsi')
                    ->columnSpanFull(),
                TextInput::make('alamat'),
                TextInput::make('kontak_wa'),
                TextInput::make('lat')
                    ->numeric(),
                TextInput::make('lng')
                    ->numeric(),
                TextInput::make('foto'),
                Toggle::make('is_unggulan')
                    ->required(),
                Toggle::make('is_publik')
                    ->required(),
            ]);
    }
}
