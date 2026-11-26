<?php

namespace App\Filament\Resources\MutasiPenduduks;

use App\Enums\StatusVerifikasi;
use App\Filament\Resources\MutasiPenduduks\Pages\CreateMutasiPenduduk;
use App\Filament\Resources\MutasiPenduduks\Pages\EditMutasiPenduduk;
use App\Filament\Resources\MutasiPenduduks\Pages\ListMutasiPenduduks;
use App\Filament\Resources\MutasiPenduduks\Schemas\MutasiPendudukForm;
use App\Filament\Resources\MutasiPenduduks\Tables\MutasiPenduduksTable;
use App\Models\MutasiPenduduk;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use UnitEnum;

class MutasiPendudukResource extends Resource
{
    protected static ?string $model = MutasiPenduduk::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedArrowsRightLeft;

    protected static string|UnitEnum|null $navigationGroup = 'Kependudukan & Demografi';

    protected static ?string $navigationLabel = 'Mutasi Penduduk (LAMPID)';

    protected static ?string $modelLabel = 'Mutasi Penduduk';

    protected static ?string $pluralModelLabel = 'Buku Mutasi Penduduk (LAMPID)';

    protected static ?int $navigationSort = 4;

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->with(['wilayah.parent', 'penduduk', 'pengaju'])->forCurrentUserWilayah();
    }

    public static function getNavigationBadge(): ?string
    {
        $pending = static::getEloquentQuery()
            ->where('status_verifikasi', StatusVerifikasi::Diajukan->value)
            ->count();

        return $pending > 0 ? (string) $pending : null;
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'warning';
    }

    public static function form(Schema $schema): Schema
    {
        return MutasiPendudukForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MutasiPenduduksTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListMutasiPenduduks::route('/'),
            'create' => CreateMutasiPenduduk::route('/create'),
            'edit' => EditMutasiPenduduk::route('/{record}/edit'),
        ];
    }
}
