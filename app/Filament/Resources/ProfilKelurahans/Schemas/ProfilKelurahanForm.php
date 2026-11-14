<?php

namespace App\Filament\Resources\ProfilKelurahans\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ProfilKelurahanForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('wilayah_id')
                    ->relationship('wilayah', 'id')
                    ->required(),
                TextInput::make('slogan'),
                Textarea::make('sejarah')
                    ->columnSpanFull(),
                TextInput::make('tahun_terbentuk'),
                Textarea::make('makna_lambang')
                    ->columnSpanFull(),
                Textarea::make('visi')
                    ->columnSpanFull(),
                TextInput::make('misi'),
                TextInput::make('motto_pelayanan'),
                TextInput::make('foto_kantor'),
                TextInput::make('foto_peta_wilayah'),
                TextInput::make('batas_utara'),
                TextInput::make('batas_selatan'),
                TextInput::make('batas_timur'),
                TextInput::make('batas_barat'),
                TextInput::make('kontak_telepon')
                    ->tel(),
                TextInput::make('kontak_whatsapp'),
                TextInput::make('kontak_email')
                    ->email(),
                Textarea::make('alamat_kantor')
                    ->columnSpanFull(),
                Textarea::make('jam_pelayanan')
                    ->columnSpanFull(),
                TextInput::make('social_media'),
                TextInput::make('pengaturan_bagian'),
            ]);
    }
}
