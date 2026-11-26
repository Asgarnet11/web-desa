<?php

namespace App\Filament\Resources\Pengaduans\Schemas;

use App\Enums\StatusPengaduan;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PengaduanForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('wilayah_id')
                    ->relationship('wilayah', 'id')
                    ->required(),
                TextInput::make('nomor_tiket')
                    ->required(),
                TextInput::make('nama_pelapor')
                    ->required(),
                TextInput::make('email_pelapor')
                    ->email(),
                TextInput::make('telepon_pelapor')
                    ->tel()
                    ->required(),
                TextInput::make('kategori')
                    ->required()
                    ->default('Infrastruktur'),
                TextInput::make('judul')
                    ->required(),
                Textarea::make('isi')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('foto'),
                TextInput::make('lokasi'),
                TextInput::make('lat')
                    ->numeric()
                    ->label('Latitude GPS'),
                TextInput::make('lng')
                    ->numeric()
                    ->label('Longitude GPS'),
                Select::make('status')
                    ->options(StatusPengaduan::class)
                    ->default('menunggu')
                    ->required(),
                Textarea::make('tanggapan')
                    ->columnSpanFull(),
                TextInput::make('ditanggapi_oleh')
                    ->numeric(),
                DateTimePicker::make('ditanggapi_pada'),
            ]);
    }
}
