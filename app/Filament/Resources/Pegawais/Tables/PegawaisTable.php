<?php

namespace App\Filament\Resources\Pegawais\Tables;

use Filament\Actions\ViewAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\BulkActionGroup;


use Filament\Tables\Table;
use App\Filament\Resources\PegawaiResource\Pages;
use App\Models\Pegawai;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Tables;
class PegawaisTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('kode_pegawai')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('nama_pegawai')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('alamat')->limit(30),
                Tables\Columns\TextColumn::make('jenis_kelamin_pegawai')
                    ->label('Jenis Kelamin')
                    ->formatStateUsing(fn($state) => $state ? 'Perempuan' : 'Laki-laki'),

            ])
            ->actions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                DeleteBulkAction::make(),
            ]);
    }
}
