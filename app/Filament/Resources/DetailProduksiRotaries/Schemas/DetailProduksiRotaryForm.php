<?php

namespace App\Filament\Resources\DetailProduksiRotaries\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class DetailProduksiRotaryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('id_rotary')
                    ->required()
                    ->numeric(),
                TextInput::make('id_pegawai')
                    ->required()
                    ->numeric(),
                TextInput::make('potongan_target')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }
}
