<?php

namespace App\Filament\Resources\KategoriFasilitas\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class KategoriFasilitasForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nama')
                    ->required(),
                TextInput::make('slug')
                    ->required(),
                TextInput::make('ikon')
                    ->required()
                    ->default('heroicon-o-map-pin'),
                TextInput::make('warna')
                    ->required()
                    ->default('#2D6A4F'),
                TextInput::make('kelompok')
                    ->required(),
            ]);
    }
}
