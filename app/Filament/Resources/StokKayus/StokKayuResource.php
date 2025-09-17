<?php

namespace App\Filament\Resources\StokKayus;

use App\Filament\Resources\StokKayus\Pages\CreateStokKayu;
use App\Filament\Resources\StokKayus\Pages\EditStokKayu;
use App\Filament\Resources\StokKayus\Pages\ListStokKayus;
use App\Filament\Resources\StokKayus\Pages\ViewStokKayu;
use App\Filament\Resources\StokKayus\Schemas\StokKayuForm;
use App\Filament\Resources\StokKayus\Schemas\StokKayuInfolist;
use App\Filament\Resources\StokKayus\Tables\StokKayusTable;
use App\Models\StokKayu;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class StokKayuResource extends Resource
{
    protected static ?string $model = StokKayu::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'harga';

    public static function form(Schema $schema): Schema
    {
        return StokKayuForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return StokKayuInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return StokKayusTable::configure($table);
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
            'index' => ListStokKayus::route('/'),
            'create' => CreateStokKayu::route('/create'),
            'view' => ViewStokKayu::route('/{record}'),
            'edit' => EditStokKayu::route('/{record}/edit'),
        ];
    }
}
