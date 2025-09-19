<?php

namespace App\Filament\Resources\JenisKayus;

use App\Filament\Resources\JenisKayus\Pages\CreateJenisKayu;
use App\Filament\Resources\JenisKayus\Pages\EditJenisKayu;
use App\Filament\Resources\JenisKayus\Pages\ListJenisKayus;
use App\Filament\Resources\JenisKayus\Pages\ViewJenisKayu;
use App\Filament\Resources\JenisKayus\Schemas\JenisKayuForm;
use App\Filament\Resources\JenisKayus\Schemas\JenisKayuInfolist;
use App\Filament\Resources\JenisKayus\Tables\JenisKayusTable;
use App\Models\JenisKayu;
use BackedEnum;
use Filament\Facades\Filament;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class JenisKayuResource extends Resource
{
    //Permision


    protected static ?string $model = JenisKayu::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'kode_kayu';

    public static function form(Schema $schema): Schema
    {
        return JenisKayuForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return JenisKayuInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return JenisKayusTable::configure($table);
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
            'index' => ListJenisKayus::route('/'),
            'create' => CreateJenisKayu::route('/create'),
            'view' => ViewJenisKayu::route('/{record}'),
            'edit' => EditJenisKayu::route('/{record}/edit'),
        ];
    }
}
