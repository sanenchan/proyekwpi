<?php

namespace App\Filament\Resources\Ukurans\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class UkuranForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('panjang (mm)')
                    ->required()
                    ->numeric(),
                TextInput::make('tinggi (mm)')
                    ->required()
                    ->numeric(),
                TextInput::make('tebal (mm)')
                    ->required()
                    ->numeric(),
            ]);
    }
}
