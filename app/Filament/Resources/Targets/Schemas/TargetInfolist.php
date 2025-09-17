<?php

namespace App\Filament\Resources\Targets\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class TargetInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('ukuran'),
                TextEntry::make('target')
                    ->numeric(),
                TextEntry::make('orang')
                    ->numeric(),
                TextEntry::make('jam')
                    ->numeric(),
                TextEntry::make('targetperjam')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('targetperorang')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('gaji')
                    ->numeric(),
                TextEntry::make('potongan')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
