<?php

namespace App\Filament\Resources\StokKayus\Pages;

use App\Filament\Resources\StokKayus\StokKayuResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditStokKayu extends EditRecord
{
    protected static string $resource = StokKayuResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
