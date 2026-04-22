<?php

namespace Adipradana\FilamentTurnstile;

use Illuminate\Support\ServiceProvider;

class FilamentTurnstileServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/filament-turnstile.php', 'filament-turnstile');
    }

    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__.'/../Forms/Components', 'filament-turnstile');

        $this->publishes([
            __DIR__.'/../config/filament-turnstile.php' => config_path('filament-turnstile.php'),
        ], 'filament-turnstile-config');

        $this->publishes([
            __DIR__.'/../Forms/Components' => resource_path('Components/vendor/filament-turnstile'),
        ], 'filament-turnstile-Components');
    }
}
