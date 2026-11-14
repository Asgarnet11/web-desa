<?php

namespace App\Filament\Resources\LogAktivitas\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class LogAktivitasForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->relationship('user', 'name'),
                TextInput::make('aksi')
                    ->required(),
                TextInput::make('entitas')
                    ->required(),
                TextInput::make('entitas_id')
                    ->numeric(),
                TextInput::make('nilai_lama'),
                TextInput::make('nilai_baru'),
                TextInput::make('ip_address'),
            ]);
    }
}
