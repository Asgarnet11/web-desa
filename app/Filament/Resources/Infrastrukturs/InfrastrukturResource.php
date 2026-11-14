<?php

namespace App\Filament\Resources\Infrastrukturs;

use App\Filament\Resources\Infrastrukturs\Pages\CreateInfrastruktur;
use App\Filament\Resources\Infrastrukturs\Pages\EditInfrastruktur;
use App\Filament\Resources\Infrastrukturs\Pages\ListInfrastrukturs;
use App\Filament\Resources\Infrastrukturs\Schemas\InfrastrukturForm;
use App\Filament\Resources\Infrastrukturs\Tables\InfrastruktursTable;
use App\Models\Infrastruktur;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class InfrastrukturResource extends Resource
{
    protected static ?string $model = Infrastruktur::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return InfrastrukturForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return InfrastruktursTable::configure($table);
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
            'index' => ListInfrastrukturs::route('/'),
            'create' => CreateInfrastruktur::route('/create'),
            'edit' => EditInfrastruktur::route('/{record}/edit'),
        ];
    }
}
