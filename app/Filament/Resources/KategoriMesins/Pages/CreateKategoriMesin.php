<?php

namespace App\Filament\Resources\KategoriMesins\Pages;

use App\Filament\Resources\KategoriMesins\KategoriMesinResource;
use Filament\Resources\Pages\CreateRecord;

class CreateKategoriMesin extends CreateRecord
{
    protected static string $resource = KategoriMesinResource::class;
    protected function getRedirectUrl(): string
    {
        // setelah create, langsung ke halaman index (tabel Pegawai)
        return $this->getResource()::getUrl('index');
    }

}
