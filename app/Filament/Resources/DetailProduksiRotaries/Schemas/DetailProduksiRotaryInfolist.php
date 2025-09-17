<?php

namespace App\Filament\Resources\DetailProduksiRotaries\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class DetailProduksiRotaryInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('id_rotary')
                    ->numeric(),
                TextEntry::make('id_pegawai')
                    ->numeric(),
                TextEntry::make('potongan_target')
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
