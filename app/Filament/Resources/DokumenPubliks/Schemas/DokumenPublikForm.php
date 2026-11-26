<?php

namespace App\Filament\Resources\DokumenPubliks\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class DokumenPublikForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('wilayah_id')
                    ->relationship('wilayah', 'nama')
                    ->default(1)
                    ->required(),
                TextInput::make('judul')
                    ->label('Judul Dokumen / Nama Blangko')
                    ->required()
                    ->maxLength(200),
                Select::make('kategori')
                    ->options([
                        'Formulir' => 'Formulir / Blangko Permohonan',
                        'SOP' => 'Standar Operasional Prosedur (SOP)',
                        'Laporan' => 'Laporan Akuntabilitas & Keuangan',
                        'Peraturan' => 'Peraturan / SK Lurah',
                    ])
                    ->required()
                    ->default('Formulir'),
                TextInput::make('file_path')
                    ->label('Path Berkas / URL Dokumen')
                    ->required()
                    ->placeholder('dokumen/blangko-surat-pengantar.pdf atau https://...'),
                TextInput::make('ukuran_file')
                    ->label('Ukuran Berkas & Format')
                    ->placeholder('Contoh: 1.2 MB PDF atau 450 KB DOCX'),
                TextInput::make('download_count')
                    ->label('Jumlah Unduhan')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }
}
