<?php

namespace App\Filament\Resources\Penduduks;

use App\Filament\Resources\Penduduks\Pages\CreatePenduduk;
use App\Filament\Resources\Penduduks\Pages\EditPenduduk;
use App\Filament\Resources\Penduduks\Pages\ListPenduduks;
use App\Filament\Resources\Penduduks\Schemas\PendudukForm;
use App\Filament\Resources\Penduduks\Tables\PenduduksTable;
use App\Models\Penduduk;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use UnitEnum;

class PendudukResource extends Resource
{
    protected static ?string $model = Penduduk::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUserGroup;

    protected static string|UnitEnum|null $navigationGroup = 'Kependudukan & Demografi';

    protected static ?string $navigationLabel = 'Data Induk Penduduk';

    protected static ?string $modelLabel = 'Penduduk';

    protected static ?string $pluralModelLabel = 'Buku Induk Penduduk';

    protected static ?int $navigationSort = 3;

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->with(['wilayah.parent', 'kartuKeluarga'])->forCurrentUserWilayah();
    }

    public static function form(Schema $schema): Schema
    {
        return PendudukForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PenduduksTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPenduduks::route('/'),
            'create' => CreatePenduduk::route('/create'),
            'edit' => EditPenduduk::route('/{record}/edit'),
        ];
    }
}
