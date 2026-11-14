<?php

namespace App\Filament\Resources\Fasilitas\Schemas;

use App\Enums\KondisiFisik;
use App\Enums\StatusVerifikasi;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class FasilitasForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('wilayah_id')
                    ->relationship('wilayah', 'id')
                    ->required(),
                Select::make('kategori_id')
                    ->relationship('kategori', 'id')
                    ->required(),
                TextInput::make('nama')
                    ->required(),
                Textarea::make('alamat')
                    ->columnSpanFull(),
                TextInput::make('lat')
                    ->required()
                    ->numeric(),
                TextInput::make('lng')
                    ->required()
                    ->numeric(),
                Select::make('kondisi')
                    ->options(KondisiFisik::class)
                    ->default('baik')
                    ->required(),
                Textarea::make('keterangan')
                    ->columnSpanFull(),
                TextInput::make('foto'),
                Select::make('status_verifikasi')
                    ->options(StatusVerifikasi::class)
                    ->default('draf')
                    ->required(),
                Textarea::make('catatan_verifikasi')
                    ->columnSpanFull(),
                TextInput::make('diverifikasi_oleh')
                    ->numeric(),
                DateTimePicker::make('diverifikasi_pada'),
                Toggle::make('is_publik')
                    ->required(),
            ]);
    }
}
