<?php

namespace App\Filament\Resources\ProfilKelurahans;

use App\Filament\Resources\ProfilKelurahans\Pages\CreateProfilKelurahan;
use App\Filament\Resources\ProfilKelurahans\Pages\EditProfilKelurahan;
use App\Filament\Resources\ProfilKelurahans\Pages\ListProfilKelurahans;
use App\Filament\Resources\ProfilKelurahans\Schemas\ProfilKelurahanForm;
use App\Filament\Resources\ProfilKelurahans\Tables\ProfilKelurahansTable;
use App\Models\ProfilKelurahan;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class ProfilKelurahanResource extends Resource
{
    protected static ?string $model = ProfilKelurahan::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBuildingOffice2;

    protected static string|UnitEnum|null $navigationGroup = 'Pemerintahan & Sistem';

    protected static ?string $navigationLabel = 'Profil & Aparatur Wilayah';

    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return ProfilKelurahanForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ProfilKelurahansTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListProfilKelurahans::route('/'),
            'create' => CreateProfilKelurahan::route('/create'),
            'edit' => EditProfilKelurahan::route('/{record}/edit'),
        ];
    }
}
