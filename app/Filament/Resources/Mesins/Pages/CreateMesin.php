<?php

namespace App\Filament\Resources\Mesins\Pages;

use App\Filament\Resources\Mesins\MesinResource;
use Filament\Resources\Pages\CreateRecord;

class CreateMesin extends CreateRecord
{
    protected static string $resource = MesinResource::class;
    protected function getRedirectUrl(): string
    {
        // setelah create, langsung ke halaman index (tabel Pegawai)
        return $this->getResource()::getUrl('index');
    }
}
