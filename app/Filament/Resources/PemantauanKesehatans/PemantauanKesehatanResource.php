<?php

namespace App\Filament\Resources\PemantauanKesehatans;

use App\Enums\KategoriPemantauan;
use App\Enums\TingkatRisikoKesehatan;
use App\Filament\Resources\PemantauanKesehatans\Pages\CreatePemantauanKesehatan;
use App\Filament\Resources\PemantauanKesehatans\Pages\EditPemantauanKesehatan;
use App\Filament\Resources\PemantauanKesehatans\Pages\ListPemantauanKesehatans;
use App\Filament\Resources\PemantauanKesehatans\Schemas\PemantauanKesehatanForm;
use App\Filament\Resources\PemantauanKesehatans\Tables\PemantauanKesehatansTable;
use App\Models\PemantauanKesehatan;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use UnitEnum;

class PemantauanKesehatanResource extends Resource
{
    protected static ?string $model = PemantauanKesehatan::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedHeart;

    protected static string|UnitEnum|null $navigationGroup = 'Kependudukan & Demografi';

    protected static ?string $navigationLabel = 'Ibu Hamil & Kesehatan Keluarga';

    protected static ?string $modelLabel = 'Pemantauan Kesehatan';

    protected static ?string $pluralModelLabel = 'Pemantauan Ibu Hamil & Kesehatan Keluarga';

    protected static ?int $navigationSort = 5;

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->with(['penduduk', 'wilayah.parent'])->forCurrentUserWilayah();
    }

    public static function getNavigationBadge(): ?string
    {
        $resti = static::getEloquentQuery()
            ->where('aktif', true)
            ->where('kategori', KategoriPemantauan::IbuHamil->value)
            ->whereIn('status_risiko', [TingkatRisikoKesehatan::Kek->value, TingkatRisikoKesehatan::RisikoTinggi->value])
            ->count();

        return $resti > 0 ? "{$resti} Resti" : null;
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'danger';
    }

    public static function form(Schema $schema): Schema
    {
        return PemantauanKesehatanForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PemantauanKesehatansTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPemantauanKesehatans::route('/'),
            'create' => CreatePemantauanKesehatan::route('/create'),
            'edit' => EditPemantauanKesehatan::route('/{record}/edit'),
        ];
    }
}
