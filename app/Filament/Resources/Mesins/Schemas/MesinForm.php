<?php

namespace App\Filament\Resources\Mesins\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

use Filament\Forms\Components\Select;

use App\Models\KategoriMesin;

class MesinForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('id_kategori_mesin')
                    ->label('Kategori Mesin')
                    ->required()
                    ->options(function () {
                        return KategoriMesin::all()->pluck('nama_kategori', 'id_kategori_mesin');
                    }),
                TextInput::make('nama_mesin')
                    ->required(),
                TextInput::make('ongkos_mesin')
                    ->required()
                    ->numeric(),
                TextInput::make('no_akun')
                    ->required(),
                Textarea::make('detail_mesin')
                    ->columnSpanFull(),
            ]);
    }
}
