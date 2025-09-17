<?php

namespace App\Filament\Resources\StokKayus\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class StokKayuForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // Dropdown pilih Jenis Kayu
                Select::make('id_jenis_kayu')
                    ->label('Jenis Kayu')
                    ->relationship('jenisKayu', 'nama_kayu')
                    ->required(),

                // Dropdown pilih Lahan
                Select::make('id_lahan')
                    ->label('Lahan')
                    ->relationship('lahan', 'id_lahan')
                    ->getOptionLabelFromRecordUsing(fn($record) => "{$record->kode_lahan} - {$record->nama_lahan}")
                    ->required(),


                TextInput::make('panjang')
                    ->numeric()
                    ->required(),

                TextInput::make('jumlah_bata')
                    ->numeric()
                    ->required(),

                TextInput::make('kubikasi')
                    ->numeric()
                    ->required(),

                TextInput::make('harga')
                    ->numeric()
                    ->required(),

                DatePicker::make('tanggal_masuk')
                    ->required(),

                TextInput::make('detail_nomor_seri')
                    ->required(),
            ]);
    }
}
