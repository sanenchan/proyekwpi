<?php

namespace App\Filament\Resources\Lahans;

use App\Filament\Resources\Lahans\Pages\CreateLahan;
use App\Filament\Resources\Lahans\Pages\EditLahan;
use App\Filament\Resources\Lahans\Pages\ListLahans;
use App\Filament\Resources\Lahans\Pages\ViewLahan;
use App\Filament\Resources\Lahans\Schemas\LahanForm;
use App\Filament\Resources\Lahans\Schemas\LahanInfolist;
use App\Filament\Resources\Lahans\Tables\LahansTable;
use App\Models\Lahan;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class LahanResource extends Resource
{
    protected static ?string $model = Lahan::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'nama_lahan';

    public static function form(Schema $schema): Schema
    {
        return LahanForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return LahanInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return LahansTable::configure($table);
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
            'index' => ListLahans::route('/'),
            'create' => CreateLahan::route('/create'),
            'view' => ViewLahan::route('/{record}'),
            'edit' => EditLahan::route('/{record}/edit'),
        ];
    }
}
