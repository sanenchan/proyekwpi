<?php

namespace App\Filament\Resources\StokKayus\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class StokKayuInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('id_jenis_kayu')
                    ->numeric(),
                TextEntry::make('id_lahan')
                    ->numeric(),
                TextEntry::make('panjang')
                    ->numeric(),
                TextEntry::make('jumlah_bata')
                    ->numeric(),
                TextEntry::make('kubikasi')
                    ->numeric(),
                TextEntry::make('harga')
                    ->numeric(),
                TextEntry::make('tanggal_masuk')
                    ->date(),
                TextEntry::make('detail_nomor_seri'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
