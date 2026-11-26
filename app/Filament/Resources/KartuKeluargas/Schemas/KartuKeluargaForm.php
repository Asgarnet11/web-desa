<?php

namespace App\Filament\Resources\KartuKeluargas\Schemas;

use App\Models\KartuKeluarga;
use App\Support\KependudukanSecurity;
use App\Support\WilayahSelectHelper;
use Closure;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class KartuKeluargaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('wilayah_id')
                    ->label('Wilayah RT / RW')
                    ->options(fn () => WilayahSelectHelper::rtOptionsForCurrentUser())
                    ->searchable()
                    ->required(),
                TextInput::make('no_kk')
                    ->label('Nomor Kartu Keluarga (16 Digit)')
                    ->required()
                    ->maxLength(32)
                    ->helperText('Disimpan terenkripsi. Pencarian otomatis menggunakan blind-index.')
                    ->rule(fn (?KartuKeluarga $record): Closure => function (string $attribute, mixed $value, Closure $fail) use ($record) {
                        $hash = KependudukanSecurity::hashIdentifier((string) $value);
                        $exists = KartuKeluarga::query()
                            ->where('no_kk_hash', $hash)
                            ->when($record, fn ($q) => $q->whereKeyNot($record->getKey()))
                            ->exists();

                        if ($exists) {
                            $fail('Nomor Kartu Keluarga sudah terdaftar.');
                        }
                    }),
                TextInput::make('kepala_keluarga_nama')
                    ->label('Nama Kepala Keluarga')
                    ->required()
                    ->maxLength(150),
                TextInput::make('alamat_ringkas')
                    ->label('Alamat Domisili')
                    ->required()
                    ->maxLength(255)
                    ->columnSpanFull(),
                Select::make('status_kk')
                    ->label('Status KK')
                    ->options([
                        'aktif' => 'Aktif',
                        'pindah' => 'Pindah Keluar',
                        'nonaktif' => 'Nonaktif / Bubar',
                    ])
                    ->default('aktif')
                    ->required(),
                Textarea::make('catatan')
                    ->label('Catatan Kependudukan')
                    ->rows(2)
                    ->columnSpanFull(),
            ]);
    }
}
