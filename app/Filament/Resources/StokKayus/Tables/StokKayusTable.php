<?php

namespace App\Filament\Resources\StokKayus\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class StokKayusTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('jenisKayu.nama_kayu')
                    ->label('Jenis Kayu')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('lahan.kode_lahan')
                    ->label('Kode Lahan')
                    ->sortable()
                    ->searchable(),

                // TextColumn::make('id_jenis_kayu')
                //     ->numeric()
                //     ->sortable(),
                // TextColumn::make('id_lahan')
                //     ->numeric()
                //     ->sortable(),
                TextColumn::make('panjang')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('jumlah_bata')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('kubikasi')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('harga')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('tanggal_masuk')
                    ->date()
                    ->sortable(),
                TextColumn::make('detail_nomor_seri')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
