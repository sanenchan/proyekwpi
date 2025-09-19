<?php

namespace App\Filament\Resources\ProduksiRotaries\Pages;

use App\Filament\Resources\ProduksiRotaries\ProduksiRotaryResource;
use Filament\Resources\Pages\CreateRecord;

class CreateProduksiRotary extends CreateRecord
{
    protected static string $resource = ProduksiRotaryResource::class;
    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\Action::make('back')
                ->label('Kembali')
                ->url(fn() => static::getResource()::getUrl('index'))
                ->color('secondary'),
        ];
    }

}
