<?php

namespace App\Filament\Resources\ProduksiRotaries\Tables;

use Carbon\Carbon;
use Dom\Text;
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

                TextColumn::make('target.mesin.nama_mesin')
                    ->label('Nama Mesin')
                    ->sortable()->searchable(),

                TextColumn::make('jumlah_batang')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('total')
                    ->label('Total Produksi')
                    ->searchable()
                    ->sortable()
                    ->formatStateUsing(fn($state) => $state . ' lembar'),
                //ubah format titik ke koma
                TextColumn::make('kubikasi')
                    ->label('Kubikasi (m³)')
                    ->formatStateUsing(
                        fn($state) =>
                        number_format($state, 4, ',', '.')
                    ),


                TextColumn::make('durasi_kerja')
                    ->label('Durasi Kerja')
                    ->getStateUsing(function ($record) {
                        try {
                            $mulai = Carbon::parse($record->jam_kerja_mulai);
                            $selesai = Carbon::parse($record->jam_kerja_selesai);

                            // kalau jam selesai lebih kecil dari jam mulai (lewat tengah malam)
                            if ($selesai->lessThan($mulai)) {
                                $selesai->addDay();
                            }

                            $diffInHours = $mulai->diffInHours($selesai);
                            $diffInMinutes = $mulai->diffInMinutes($selesai) % 60;

                            if ($diffInMinutes > 0) {
                                return $diffInHours . ' jam ' . $diffInMinutes . ' menit';
                            }

                            return $diffInHours . ' jam';
                        } catch (\Exception $e) {
                            return '-';
                        }
                    }),

                TextColumn::make('pekerja')
                    ->searchable()
                    ->sortable()
                    ->formatStateUsing(fn($state) => $state . ' orang'),

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
            ]);
    }
}
