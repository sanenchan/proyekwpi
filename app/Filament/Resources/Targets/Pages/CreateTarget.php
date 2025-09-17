<?php

namespace App\Filament\Resources\Targets\Pages;

use App\Filament\Resources\Targets\TargetResource;
use Filament\Resources\Pages\CreateRecord;

class CreateTarget extends CreateRecord
{
    protected static string $resource = TargetResource::class;
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['status'] = 'diajukan'; // default status
        return $data;
    }
    // protected function mutateFormDataBeforeCreate(array $data): array
    // {
    //     dd($data); // cek realtime value sebelum insert
    //     return $data;
    // }
}
