<?php

namespace App\Filament\Resources\DetailProduksiRotaries\Pages;

use App\Filament\Resources\DetailProduksiRotaries\DetailProduksiRotaryResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListDetailProduksiRotaries extends ListRecords
{
    protected static string $resource = DetailProduksiRotaryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
