<?php

namespace App\Filament\Resources\ProduksiRotaries\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ProduksiRotariesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('tanggal_produksi')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('jumlah_batang')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('hasilkw1')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('hasilkw2')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('hasilkw3')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('hasilkw4')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('total')
                    ->searchable()
                    ->sortable(),
                //ubah format titik ke koma
                TextColumn::make('kubikasi')
                    ->label('Kubikasi (m³)')
                    ->formatStateUsing(
                        fn($state) =>
                        number_format($state, 4, ',', '.')
                    ),
                TextColumn::make('jam_kerja_mulai')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('jam_kerja_selesai')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('pekerja')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('target_produksi')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('status_produksi')
                    ->searchable()
                    ->sortable(),
                //merupiahkan 
                TextColumn::make('potongan_target')
                    ->label('Potongan Target')
                    ->sortable()
                    ->searchable()
                    ->formatStateUsing(
                        fn($state) =>
                        'Rp ' . number_format($state, 0, ',', '.')
                    ),

                TextColumn::make('kendala')
                    ->label('Kendala')
                    ->limit(15),
                TextColumn::make('status_data')
                    ->searchable()
                    ->sortable(),


                //
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
