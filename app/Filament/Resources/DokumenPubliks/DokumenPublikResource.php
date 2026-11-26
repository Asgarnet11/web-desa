<?php

namespace App\Filament\Resources\DokumenPubliks;

use App\Filament\Resources\DokumenPubliks\Pages\CreateDokumenPublik;
use App\Filament\Resources\DokumenPubliks\Pages\EditDokumenPublik;
use App\Filament\Resources\DokumenPubliks\Pages\ListDokumenPubliks;
use App\Filament\Resources\DokumenPubliks\Schemas\DokumenPublikForm;
use App\Filament\Resources\DokumenPubliks\Tables\DokumenPubliksTable;
use App\Models\DokumenPublik;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class DokumenPublikResource extends Resource
{
    protected static ?string $model = DokumenPublik::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedDocumentDuplicate;

    protected static string|UnitEnum|null $navigationGroup = 'Pelayanan & Aspirasi Warga';

    protected static ?string $navigationLabel = 'Dokumen & Blangko Publik';

    protected static ?int $navigationSort = 3;

    public static function form(Schema $schema): Schema
    {
        return DokumenPublikForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return DokumenPubliksTable::configure($table);
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
            'index' => ListDokumenPubliks::route('/'),
            'create' => CreateDokumenPublik::route('/create'),
            'edit' => EditDokumenPublik::route('/{record}/edit'),
        ];
    }
}
