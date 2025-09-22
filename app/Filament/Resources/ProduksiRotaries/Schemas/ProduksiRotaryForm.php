<?php

namespace App\Filament\Resources\ProduksiRotaries\Schemas;

use App\Models\Pegawai;
use Carbon\CarbonPeriod;
use Filament\Schemas\Schema;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
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
                                    $time->format('H:i') => $time->format('H.i') // key: 06:00, label: 06.00
                                ])
                        )
                        ->searchable()
                        ->required()
                        // Saat load dari DB, konversi ke format 'H:i' biar match dengan key di options
                        ->formatStateUsing(fn($state) => $state ? \Carbon\Carbon::parse($state)->format('H:i') : null)

                        // Saat simpan, konversi jadi 'H:i:s' supaya konsisten ke DB
                        ->dehydrateStateUsing(fn($state) => $state ? \Carbon\Carbon::parse($state)->format('H:i:s') : null),


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

                    Textarea::make('kendala')
                        ->columnSpanFull(),
                ])
                ->columns(2)->columnSpanFull(),

            Section::make('Detail Produksi Pegawai')
                ->description('Input pegawai yang ikut serta dalam produksi !')
                ->schema([
                    Repeater::make('detailRotaries')
                        ->relationship('detailRotaries')
                        ->schema([
                            // Pilih Pegawai
                            Select::make('id_pegawai')
                                ->label('Pegawai')
                                ->searchable()
                                ->getSearchResultsUsing(function (?string $search, $get) {
                                    $query = Pegawai::query();

                                    // Ambil semua id_pegawai yang sudah dipilih di repeater
                                    $selectedIds = collect($get('detailRotaries') ?? [])
                                        ->pluck('id_pegawai')
                                        ->filter()
                                        ->toArray();

                                    // Ambil key & id baris yang sedang diedit
                                    $currentKey = (string) $get('recordKey');
                                    $currentId = data_get($get("detailRotaries.{$currentKey}"), 'id_pegawai');

                                    // Buang currentId supaya baris ini tetap bisa menampilkan pegawai terpilih
                                    $selectedIds = array_filter($selectedIds, fn($id) => $id !== $currentId);

                                    // Filter pencarian kalau ada keyword
                                    if (!empty($search)) {
                                        $query->where(function ($q) use ($search) {
                                            $q->where('nama_pegawai', 'like', "%{$search}%")
                                                ->orWhere('kode_pegawai', 'like', "%{$search}%");
                                        });
                                    }

                                    // Exclude pegawai yang sudah dipilih di baris lain
                                    if (!empty($selectedIds)) {
                                        $query->whereNotIn('id_pegawai', $selectedIds);
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
                                    fn($value) =>
                                    Pegawai::where('id_pegawai', $value)
                                        ->selectRaw("CONCAT(kode_pegawai, ' - ', nama_pegawai) as label")
                                        ->value('label')
                                )
                                ->required(),



                            Select::make('jam_mulai')
                                ->label('Jam Mulai')
                                ->options(self::timeOptions())
                                ->searchable()
                                ->required()
                                ->formatStateUsing(fn($state) => $state ? \Carbon\Carbon::parse($state)->format('H:i') : null)
                                ->dehydrateStateUsing(fn($state) => $state ? $state . ':00' : null)
                                ->afterStateHydrated(function ($component, $state, $set, $get) {
                                    if (!$state) {
                                        $detailRotaries = collect($get('detailRotaries') ?? []);
                                        $lastItem = $detailRotaries->slice(0, -1)->last(); // ambil baris sebelum terakhir
                                        if ($lastItem && isset($lastItem['jam_mulai'])) {
                                            $component->state($lastItem['jam_mulai']);
                                        }
                                    }
                                })
                                ->afterStateUpdated(function ($state, $set) {
                                    if ($state) {
                                        $next = \Carbon\Carbon::parse($state)->addMinutes(30)->format('H:i');
                                        $set('jam_selesai', $next);
                                    }
                                }),

                            // Jam Selesai
                            Select::make('jam_selesai')
                                ->label('Jam Selesai')
                                ->options(self::timeOptions())
                                ->searchable()
                                ->required()
                                ->formatStateUsing(fn($state) => $state ? \Carbon\Carbon::parse($state)->format('H:i') : null)
                                ->dehydrateStateUsing(fn($state) => $state ? $state . ':00' : null)
                                ->afterStateHydrated(function ($component, $state, $set, $get) {
                                    if (!$state) {
                                        $detailRotaries = collect($get('detailRotaries') ?? []);
                                        $lastItem = $detailRotaries->slice(0, -1)->last(); // ambil baris sebelum terakhir
                                        if ($lastItem && isset($lastItem['jam_selesai'])) {
                                            $component->state($lastItem['jam_selesai']);
                                        }
                                    }
                                })
                                ->rule(function ($get) {
                                    return function (string $attribute, $value, $fail) use ($get) {
                                        $jamMulai = $get('jam_mulai');
                                        if ($jamMulai && $value <= $jamMulai) {
                                            $fail('Jam selesai harus lebih besar dari jam mulai.');
                                        }
                                    };
                                }),
                        ])
                        ->columns(3)
                        ->addActionLabel('Tambah Pekerja'),
                ])
                ->collapsible()
                ->columnSpanFull(),
        ]);
    }
    public static function timeOptions(): array
    {
        return collect(CarbonPeriod::create('00:00', '30 minutes', '23:30')->toArray())
            ->mapWithKeys(fn($time) => [
                $time->format('H:i') => $time->format('H.i')
            ])
            ->toArray();
    }
}
