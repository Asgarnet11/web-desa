<?php

namespace App\Filament\Resources\Demografis;

use App\Filament\Resources\Demografis\Pages\CreateDemografi;
use App\Filament\Resources\Demografis\Pages\EditDemografi;
use App\Filament\Resources\Demografis\Pages\ListDemografis;
use App\Filament\Resources\Demografis\Schemas\DemografiForm;
use App\Filament\Resources\Demografis\Tables\DemografisTable;
use App\Models\Demografi;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class DemografiResource extends Resource
{
    protected static ?string $model = Demografi::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUsers;

    protected static string|UnitEnum|null $navigationGroup = 'Kependudukan & Demografi';

    protected static ?string $navigationLabel = 'Data Demografi & KK';

    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return DemografiForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return DemografisTable::configure($table);
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
            'index' => ListDemografis::route('/'),
            'create' => CreateDemografi::route('/create'),
            'edit' => EditDemografi::route('/{record}/edit'),
        ];
    }
}
