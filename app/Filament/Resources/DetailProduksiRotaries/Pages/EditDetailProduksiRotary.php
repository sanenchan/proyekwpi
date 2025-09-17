<?php

namespace App\Filament\Resources\DetailProduksiRotaries\Pages;

use App\Filament\Resources\DetailProduksiRotaries\DetailProduksiRotaryResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditDetailProduksiRotary extends EditRecord
{
    protected static string $resource = DetailProduksiRotaryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
