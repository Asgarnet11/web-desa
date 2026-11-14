<?php

namespace App\Filament\Resources\Beritas\Schemas;

use App\Enums\StatusKonten;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class BeritaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('wilayah_id')
                    ->relationship('wilayah', 'id')
                    ->required(),
                TextInput::make('user_id')
                    ->numeric(),
                TextInput::make('judul')
                    ->required(),
                TextInput::make('slug')
                    ->required(),
                TextInput::make('kategori')
                    ->required()
                    ->default('Kegiatan'),
                Textarea::make('ringkasan')
                    ->columnSpanFull(),
                Textarea::make('konten')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('foto'),
                Select::make('status')
                    ->options(StatusKonten::class)
                    ->default('draf')
                    ->required(),
                DateTimePicker::make('published_at'),
                TextInput::make('views_count')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }
}
