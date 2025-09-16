<?php

namespace App\Filament\Resources\Ukurans\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class UkuranInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('panjang')
                    ->numeric(),
                TextEntry::make('tinggi')
                    ->numeric(),
                TextEntry::make('tebal')
                    ->numeric(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
