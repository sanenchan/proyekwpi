<?php

namespace App\Filament\Resources\Targets\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use App\Models\Mesin;
use App\Models\Ukuran;
use App\Models\JenisKayu;

class TargetForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            // Select::make('id_mesin')
            //     ->label('Mesin')
            //     ->relationship('mesin', 'nama_mesin') // otomatis ambil relasi
            //     ->required()
            //     ->reactive(),

            // Select::make('id_ukuran')
            //     ->label('Ukuran (P x L x T)')
            //     ->relationship('ukuran', 'id_ukuran') // pakai kolom asli
            //     ->getOptionLabelFromRecordUsing(fn(Ukuran $record) => $record->dimensi) // tampilkan accessor
            //     ->required()
            //     ->reactive(),

            // Select::make('id_jenis_kayu')
            //     ->label('Jenis Kayu')
            //     ->relationship('jenisKayu', 'nama_kayu')
            //     ->required()
            //     ->reactive(),

            // TextInput::make('ukuran')
            //     ->label('Kode Ukuran')
            //     ->disabled() // user tidak bisa ketik manual
            //     ->dehydrated() // tetap disimpan ke DB
            //     ->reactive()
            //     ->afterStateHydrated(function ($set, $get) {
            //         $set('ukuran', self::generateKodeUkuran($get));
            //     })
            //     ->afterStateUpdated(function ($state, $set, $get) {
            //         $set('ukuran', self::generateKodeUkuran($get));
            //     }),

            Select::make('id_mesin')
                ->label('Mesin')
                ->relationship('mesin', 'nama_mesin')
                ->required()
                ->reactive()
                ->dehydrated() // pastikan nilainya ikut submit
                ->afterStateUpdated(fn($state, $set, $get) => $set('ukuran', self::generateKodeUkuran($get))),

            Select::make('id_ukuran')
                ->label('Ukuran (P x L x T)')
                ->relationship('ukuran', 'id_ukuran')
                ->getOptionLabelFromRecordUsing(fn(Ukuran $record) => $record->dimensi)
                ->required()
                ->reactive()
                ->dehydrated() // pastikan nilainya ikut submit
                ->afterStateUpdated(fn($state, $set, $get) => $set('ukuran', self::generateKodeUkuran($get))),

            Select::make('id_jenis_kayu')
                ->label('Jenis Kayu')
                ->relationship('jenisKayu', 'nama_kayu')
                ->required()
                ->dehydrated() // pastikan nilainya ikut submit
                ->reactive()
                ->afterStateUpdated(fn($state, $set, $get) => $set('ukuran', self::generateKodeUkuran($get))),

            TextInput::make('ukuran')
                ->label('Kode Ukuran')
                ->disabled()
                ->dehydrated()
                ->reactive(),


            TextInput::make('target')
                ->label('Target')
                ->numeric()
                ->required(),

            TextInput::make('orang')
                ->label('Jumlah Orang')
                ->numeric()
                ->required(),

            TextInput::make('jam')
                ->label('Jam Kerja')
                ->numeric()
                ->required(),

            TextInput::make('gaji')
                ->label('Gaji')
                ->numeric()
                ->prefix('Rp')
                ->required(),
        ]);
    }
    public static function generateKodeUkuran($get): string
    {
        $mesin = \App\Models\Mesin::find($get('id_mesin'));
        $ukuran = \App\Models\Ukuran::find($get('id_ukuran'));
        $kayu = \App\Models\JenisKayu::find($get('id_jenis_kayu'));

        if (!$mesin || !$ukuran || !$kayu) {
            return '';
        }

        // konversi menjadi float untuk menghilangkan nol padding
        $panjang = (float) $ukuran->panjang; // misal 244.0 -> 244
        $tinggi = (float) $ukuran->tinggi;  // misal 144.0 -> 144
        $tebal = (float) $ukuran->tebal;   // misal 0.5 -> 0.5

        // ubah tebal menjadi string dengan koma
        $tebal_str = str_replace('.', ',', (string) $tebal);

        return strtoupper($mesin->nama_mesin)
            . $panjang
            . $tinggi
            . $tebal_str
            . strtolower($kayu->kode_kayu);
    }


}
