<?php

namespace App\Filament\Resources\ProduksiRotaries\Pages;

use App\Filament\Resources\ProduksiRotaries\ProduksiRotaryResource;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditProduksiRotary extends EditRecord
{
    protected static string $resource = ProduksiRotaryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
            Action::make('back')
                ->label('Kembali')
                ->url(fn() => static::getResource()::getUrl('index'))
                ->color('secondary'),
        ];
    }

}
