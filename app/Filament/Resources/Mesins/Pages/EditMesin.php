<?php

namespace App\Filament\Resources\Mesins\Pages;

use App\Filament\Resources\Mesins\MesinResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditMesin extends EditRecord
{
    protected static string $resource = MesinResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
    protected function getRedirectUrl(): string
    {
        // setelah create, langsung ke halaman index (tabel Pegawai)
        return $this->getResource()::getUrl('index');
    }
}
