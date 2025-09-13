<?php

namespace App\Filament\Resources\Pegawais\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Radio;
class PegawaiForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('kode_pegawai')
                    ->label('Kode Pegawai')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(255),

                TextInput::make('nama_pegawai')
                    ->label('Nama Pegawai')
                    ->required()
                    ->maxLength(255),

                Textarea::make('alamat')
                    ->label('Alamat')
                    ->rows(3)
                    ->nullable(),

                TextInput::make('no_telepon_pegawai')
                    ->label('No. Telepon')
                    ->tel()
                    ->nullable(),

                Radio::make('jenis_kelamin_pegawai')
                    ->label('Jenis Kelamin (Laki-laki=1, Perempuan=0)')
                    ->options([
                        1 => 'Laki-laki',
                        0 => 'Perempuan',
                    ])
                    ->inline()
                    ->default(1),

                DatePicker::make('tanggal_masuk')
                    ->label('Tanggal Masuk')
                    ->required(),
                //
            ]);
    }
}
