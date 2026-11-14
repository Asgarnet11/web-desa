<?php

namespace App\Filament\Resources\Wilayahs\Schemas;

use App\Enums\TipeWilayah;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class WilayahForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('parent_id')
                    ->relationship('parent', 'id'),
                Select::make('tipe')
                    ->options(TipeWilayah::class)
                    ->required(),
                TextInput::make('kode')
                    ->required(),
                TextInput::make('nama')
                    ->required(),
                TextInput::make('luas')
                    ->numeric(),
                TextInput::make('lat')
                    ->numeric(),
                TextInput::make('lng')
                    ->numeric(),
                TextInput::make('batas'),
            ]);
    }
}
