<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class UserInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name'),
                TextEntry::make('email')
                    ->label('Email address'),
                TextEntry::make('roles')
                    ->label('Roles')
                    ->getStateUsing(function ($record) {
                        // Ambil semua nama role dan gabungkan dengan koma
                        return $record->roles->pluck('name')->join(', ');
                    })
                    ->placeholder('-'),
                TextEntry::make('email_verified_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
    public static function infolist(Schema $schema): Schema
    {
        return UserInfolist::configure($schema);
    }
}
