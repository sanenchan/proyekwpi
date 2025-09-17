<?php

namespace App\Filament\Resources\DetailProduksiRotaries\Pages;

use App\Filament\Resources\DetailProduksiRotaries\DetailProduksiRotaryResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewDetailProduksiRotary extends ViewRecord
{
    protected static string $resource = DetailProduksiRotaryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
