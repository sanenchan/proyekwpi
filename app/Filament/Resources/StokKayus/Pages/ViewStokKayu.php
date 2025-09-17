<?php

namespace App\Filament\Resources\StokKayus\Pages;

use App\Filament\Resources\StokKayus\StokKayuResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewStokKayu extends ViewRecord
{
    protected static string $resource = StokKayuResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
