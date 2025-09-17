<?php

namespace App\Filament\Resources\StokKayus\Pages;

use App\Filament\Resources\StokKayus\StokKayuResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListStokKayus extends ListRecords
{
    protected static string $resource = StokKayuResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
