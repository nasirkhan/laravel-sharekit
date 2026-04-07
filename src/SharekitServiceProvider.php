<?php

namespace Nasirkhan\LaravelSharekit;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Nasirkhan\LaravelSharekit\View\Components\Button;
use Nasirkhan\LaravelSharekit\View\Components\Buttons;
use Nasirkhan\LaravelSharekit\View\Components\Icon;

class SharekitServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/sharekit.php', 'sharekit');
    }

    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'sharekit');

        $this->publishes([
            __DIR__.'/../config/sharekit.php' => config_path('sharekit.php'),
        ], 'sharekit-config');

        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/sharekit'),
        ], 'sharekit-views');

        Blade::component('sharekit::buttons', Buttons::class);
        Blade::component('sharekit::button', Button::class);
        Blade::component('sharekit::icon', Icon::class);
    }
}
