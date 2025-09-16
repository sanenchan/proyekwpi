<?php

namespace App\Filament\Resources\Mesins\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class MesinsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                // Ubah dari id_kategori_mesin menjadi menampilkan nama kategori
                TextColumn::make('kategori.nama_kategori')
                    ->label('Kategori Mesin')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('nama_mesin')
                    ->searchable(),

                TextColumn::make('ongkos_mesin')
                    ->numeric()
                    ->sortable(),

                TextColumn::make('no_akun')
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
