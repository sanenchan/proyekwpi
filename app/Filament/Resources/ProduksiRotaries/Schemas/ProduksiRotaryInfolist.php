<?php

namespace App\Filament\Resources\ProduksiRotaries\Schemas;

use Filament\Schemas\Schema;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Schemas\Components\Section;

class ProduksiRotaryInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // 📌 Section 1: Informasi Umum
                Section::make('Informasi Produksi')
                    ->schema([
                        TextEntry::make('tanggal_produksi')->label('Tanggal Produksi'),

                        TextEntry::make('lahan')
                            ->label('Lahan')
                            ->getStateUsing(
                                fn($record) =>
                                $record->lahan
                                ? $record->lahan->kode_lahan . ' - ' . $record->lahan->nama_lahan
                                : '-'
                            ),

                        TextEntry::make('jumlah_batang')->label('Jumlah Batang'),
                        TextEntry::make('target.ukuran')->label('Kode Ukuran'),

                        TextEntry::make('status_data')
                            ->label('Status')
                            ->columnSpan(1),

                        TextEntry::make('kendala')
                            ->label('Catatan Kendala')
                            ->columnSpan(3),

                    ])
                    ->columns(4)
                    ->columnSpanFull(), // Bagi jadi 2 kolom

                // 🔸 Baris 1: 4 kolom
                Section::make('Hasil Produksi (KW)')
                    ->schema([
                        TextEntry::make('hasilkw1')->label('KW 1'),
                        TextEntry::make('hasilkw2')->label('KW 2'),
                        TextEntry::make('hasilkw3')->label('KW 3'),
                        TextEntry::make('hasilkw4')->label('KW 4'),
                    ])
                    ->columns(4)->columnSpanFull(),

                // 🔸 Baris 2: 3 kolom
                Section::make('Rekap Produksi')
                    ->schema([
                        TextEntry::make('total')->label('Total Produksi'),
                        TextEntry::make('kubikasi')
                            ->label('Kubikasi (m³)')
                            ->formatStateUsing(
                                fn($state) => number_format($state, 4, ',', '.')
                            ),
                        TextEntry::make('target_produksi')->label('Target Produksi'),
                    ])
                    ->columns(3)->columnSpanFull(),

                // 🔸 Baris 3: 3 kolom
                Section::make('Evaluasi Produksi')
                    ->schema([
                        TextEntry::make('status_produksi')
                            ->label('Status Produksi (Total Produksi - Target)')
                            ->color(fn($state) => $state < 0 ? 'danger' : 'success'),
                        TextEntry::make('potongan_target')
                            ->label('Potongan Target')
                            ->formatStateUsing(
                                fn($state) =>
                                'Rp ' . number_format($state, 0, ',', '.')
                            ),
                        TextEntry::make('persen_capaian')
                            ->label('Persentase Capaian')
                            ->getStateUsing(fn($record) => $record->target_produksi > 0
                                ? round(($record->capaian_produksi / $record->target_produksi) * 100, 2) . '%'
                                : '0%'),
                    ])
                    ->columns(3)->columnSpanFull(),


                // 📌 Section 3: Jam Kerja
                Section::make('Jam Kerja')
                    ->schema([
                        TextEntry::make('jam_kerja_mulai')->label('Mulai'),
                        TextEntry::make('jam_kerja_selesai')->label('Selesai'),

                        // 🔹 Tambahan: Durasi Kerja
                        TextEntry::make('durasi_kerja')
                            ->label('Durasi Kerja')
                            ->getStateUsing(function ($record) {
                                if ($record->jam_kerja_mulai && $record->jam_kerja_selesai) {
                                    $mulai = \Carbon\Carbon::parse($record->jam_kerja_mulai);
                                    $selesai = \Carbon\Carbon::parse($record->jam_kerja_selesai);
                                    $diff = $selesai->diff($mulai);

                                    // format H:i jam dan menit
                                    return $diff->h . ' jam ' . $diff->i . ' menit';
                                }
                                return '-';
                            }),
                        TextEntry::make('pekerja')
                            ->label('Jumlah Pekerja')
                            ->formatStateUsing(fn($state) => $state ? $state . ' orang' : '0 orang'),
                    ])
                    ->columns(4) // ubah ke 4 supaya "Durasi Kerja" sejajar
                    ->columnSpanFull(),


                // 📌 Section 4: Daftar Pekerja
                Section::make('Pekerja yang Terlibat')
                    ->schema([
                        RepeatableEntry::make('detailRotaries')
                            ->schema([
                                TextEntry::make('pegawai.nama_pegawai')->label('Nama Pegawai'),
                                TextEntry::make('potongan_target')
                                    ->label('Potongan Target')
                                    ->formatStateUsing(
                                        fn($state) => $state !== null
                                        ? 'Rp ' . number_format($state, 0, ',', '.')
                                        : 'Rp 0'
                                    ),

                            ])
                            ->columns(2),
                    ])->columnSpanFull(), // ✅

            ]);
    }
}
