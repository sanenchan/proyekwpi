<?php

namespace App\Providers;

use Filament\Panel;
use Filament\PluginServiceProvider;
use Illuminate\Support\ServiceProvider;

class FilamentServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // Daftarkan panel default
        Panel::make()
            ->id('admin')        // ID panel, bisa sesuaikan
            ->path('admin')      // URL panel
            ->default();         // Penting! Ini membuatnya default
    }
}
