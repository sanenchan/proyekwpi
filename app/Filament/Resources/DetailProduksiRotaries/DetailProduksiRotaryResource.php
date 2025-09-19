<?php

namespace App\Filament\Resources\DetailProduksiRotaries;

use App\Filament\Resources\DetailProduksiRotaries\Pages\CreateDetailProduksiRotary;
use App\Filament\Resources\DetailProduksiRotaries\Pages\EditDetailProduksiRotary;
use App\Filament\Resources\DetailProduksiRotaries\Pages\ListDetailProduksiRotaries;
use App\Filament\Resources\DetailProduksiRotaries\Pages\ViewDetailProduksiRotary;
use App\Filament\Resources\DetailProduksiRotaries\Schemas\DetailProduksiRotaryForm;
use App\Filament\Resources\DetailProduksiRotaries\Schemas\DetailProduksiRotaryInfolist;
use App\Filament\Resources\DetailProduksiRotaries\Tables\DetailProduksiRotariesTable;
use App\Models\DetailProduksiRotary;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class DetailProduksiRotaryResource extends Resource
{
    protected static ?string $model = DetailProduksiRotary::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'id_pegawai';

    public static function form(Schema $schema): Schema
    {
        return DetailProduksiRotaryForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return DetailProduksiRotaryInfolist::configure($schema);
    }
    public static function shouldRegisterNavigation(): bool
    {
        return false; // ⛔ jangan daftarkan di sidebar
    }

    public static function table(Table $table): Table
    {
        return DetailProduksiRotariesTable::configure($table);
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
            'index' => ListDetailProduksiRotaries::route('/'),
            'create' => CreateDetailProduksiRotary::route('/create'),
            'view' => ViewDetailProduksiRotary::route('/{record}'),
            'edit' => EditDetailProduksiRotary::route('/{record}/edit'),
        ];
    }
}
