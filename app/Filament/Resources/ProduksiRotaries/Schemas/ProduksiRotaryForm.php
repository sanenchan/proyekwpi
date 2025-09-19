<?php

namespace App\Filament\Resources\ProduksiRotaries\Schemas;

use App\Models\Pegawai;
use Carbon\CarbonPeriod;
use Filament\Schemas\Schema;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Schemas\Components\Section;


class ProduksiRotaryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Data Produksi Rotary')
                ->schema([
                    DatePicker::make('tanggal_produksi')
                        ->label('Tanggal Produksi')
                        ->required()
                        ->default(today())
                    ,

                    Select::make('id_target')
                        ->label('Target')
                        ->relationship('target', 'ukuran')
                        ->required(),

                    Select::make('id_lahan')
                        ->label('Lahan')
                        ->relationship('lahan', 'kode_lahan')
                        ->required(),
                    TextInput::make('jumlah_batang')
                        ->numeric()
                        ->default(0),
                    TextInput::make('hasilkw1')
                        ->numeric()
                        ->default(0),

                    TextInput::make('hasilkw2')
                        ->numeric()
                        ->default(0),

                    TextInput::make('hasilkw3')
                        ->numeric()
                        ->default(0),

                    TextInput::make('hasilkw4')
                        ->numeric()
                        ->default(0),

                    Select::make('jam_kerja_mulai')
                        ->label('Jam Mulai')
                        ->options(
                            collect(CarbonPeriod::create('00:00', '30 minutes', '23:30')->toArray())
                                ->mapWithKeys(fn($time) => [
                                    $time->format('H:i') => $time->format('H.i') // tampilkan pakai titik
                                ])
                        )
                        ->searchable()
                        ->required()
                        ->formatStateUsing(fn($state) => $state ? \Carbon\Carbon::parse($state)->format('H:i') : null)
                        ->dehydrateStateUsing(fn($state) => $state ? $state . ':00' : null),

                    Select::make('jam_kerja_selesai')
                        ->label('Jam Selesai')
                        ->options(
                            collect(CarbonPeriod::create('00:00', '30 minutes', '23:30')->toArray())
                                ->mapWithKeys(fn($time) => [
                                    $time->format('H:i') => $time->format('H.i') // tampilkan pakai titik
                                ])
                        )
                        ->searchable()
                        ->required()
                        ->formatStateUsing(fn($state) => $state ? \Carbon\Carbon::parse($state)->format('H:i') : null)
                        ->dehydrateStateUsing(fn($state) => $state ? $state . ':00' : null),

                    Forms\Components\Textarea::make('kendala')
                        ->columnSpanFull(),
                ])
                ->columns(1),

            Section::make('Detail Produksi Pegawai')
                ->description('Input pegawai yang ikut serta dalam produksi !')
                ->schema([
                    Repeater::make('detailRotaries')
                        ->relationship('detailRotaries')
                        ->schema([
                            //Search data pegawai
                            Select::make('id_pegawai')
                                ->label('Pegawai')
                                ->searchable()
                                ->preload() // tampilkan default 5 data awal saat dibuka
                                ->getSearchResultsUsing(function (?string $search) {
                                    $query = Pegawai::query();

                                    if (!empty($search)) {
                                        $query->where(function ($q) use ($search) {
                                            $q->where('nama_pegawai', 'like', "%{$search}%")
                                                ->orWhere('kode_pegawai', 'like', "%{$search}%");
                                        });
                                    }

                                    return $query
                                        ->orderBy('nama_pegawai')
                                        ->limit(5)
                                        ->get()
                                        ->mapWithKeys(fn($p) => [
                                            $p->id_pegawai => "{$p->kode_pegawai} - {$p->nama_pegawai}"
                                        ])
                                        ->toArray();
                                })
                                ->getOptionLabelUsing(
                                    fn($value): ?string =>
                                    Pegawai::where('id_pegawai', $value)
                                        ->selectRaw("CONCAT(kode_pegawai, ' - ', nama_pegawai) as label")
                                        ->value('label')
                                )
                                ->required(),
                        ])
                        ->columns(1)
                        ->addActionLabel('Tambah Pekerja'),
                ])
                ->collapsible(),
        ]);
    }

}
