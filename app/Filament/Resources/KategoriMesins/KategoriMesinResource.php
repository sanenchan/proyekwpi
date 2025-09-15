<?php

namespace App\Filament\Resources\KategoriMesins;

use App\Filament\Resources\KategoriMesins\Pages\CreateKategoriMesin;
use App\Filament\Resources\KategoriMesins\Pages\EditKategoriMesin;
use App\Filament\Resources\KategoriMesins\Pages\ListKategoriMesins;
use App\Filament\Resources\KategoriMesins\Pages\ViewKategoriMesin;
use App\Filament\Resources\KategoriMesins\Schemas\KategoriMesinForm;
use App\Filament\Resources\KategoriMesins\Schemas\KategoriMesinInfolist;
use App\Filament\Resources\KategoriMesins\Tables\KategoriMesinsTable;
use App\Models\KategoriMesin;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class KategoriMesinResource extends Resource
{
    protected static ?string $model = KategoriMesin::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'nama_mesin';

    public static function form(Schema $schema): Schema
    {
        return KategoriMesinForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return KategoriMesinInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return KategoriMesinsTable::configure($table);
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
            'index' => ListKategoriMesins::route('/'),
            'create' => CreateKategoriMesin::route('/create'),
            'view' => ViewKategoriMesin::route('/{record}'),
            'edit' => EditKategoriMesin::route('/{record}/edit'),
        ];
    }
}
