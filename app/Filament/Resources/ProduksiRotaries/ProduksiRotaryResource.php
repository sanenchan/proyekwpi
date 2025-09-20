<?php

namespace App\Filament\Resources\ProduksiRotaries;

use App\Filament\Resources\ProduksiRotaries\Pages\CreateProduksiRotary;
use App\Filament\Resources\ProduksiRotaries\Pages\EditProduksiRotary;
use App\Filament\Resources\ProduksiRotaries\Pages\ListProduksiRotaries;
use App\Filament\Resources\ProduksiRotaries\Pages\ViewProduksiRotary;
use App\Filament\Resources\ProduksiRotaries\Schemas\ProduksiRotaryForm;
use App\Filament\Resources\ProduksiRotaries\Schemas\ProduksiRotaryInfolist;
use App\Filament\Resources\ProduksiRotaries\Tables\ProduksiRotariesTable;
use App\Models\Produksi_Rotary;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;
class ProduksiRotaryResource extends Resource
{
    public static function canViewAny(): bool
    {
        return auth()->user()?->can('ViewAny:ProduksiRotary') ?? false;
    }

    public static function canCreate(): bool
    {
        return auth()->user()?->can('Create:ProduksiRotary') ?? false;
    }

    public static function canEdit($record): bool
    {
        return auth()->user()?->can('Update:ProduksiRotary') ?? false;
    }

    public static function canDelete($record): bool
    {
        return auth()->user()?->can('Delete:ProduksiRotary') ?? false;
    }


    protected static ?string $navigationLabel = 'Users';
    protected static ?int $navigationSort = 1;

    // harus sesuai permission Spatie
    protected function afterSave($record): void
    {
        $record->pekerja = $record->detailRotaries()->count();
        $record->saveQuietly(); // hindari infinite loop
    }
    protected static ?string $model = Produksi_Rotary::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'tanggal_produksi';

    public static function form(Schema $schema): Schema
    {
        return ProduksiRotaryForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ProduksiRotaryInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ProduksiRotariesTable::configure($table);
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
            'index' => ListProduksiRotaries::route('/'),
            'create' => CreateProduksiRotary::route('/create'),
            'view' => ViewProduksiRotary::route('/{record}'),
            'edit' => EditProduksiRotary::route('/{record}/edit'),
        ];
    }

    // //untuk level user. 
    // public static function canViewAny(): bool
    // {
    //     return Auth()->user()?->can('produksi__rotary.view') ?? false;
    // }

    // public static function canCreate(): bool
    // {
    //     return auth()->user()?->can('produksi__rotary.create') ?? false;
    // }

    // public static function canEdit($record): bool
    // {
    //     return auth()->user()?->can('produksi__rotary.edit') ?? false;
    // }

    // public static function canDelete($record): bool
    // {
    //     return auth()->user()?->can('produksi__rotary.delete') ?? false;
    // }


}
