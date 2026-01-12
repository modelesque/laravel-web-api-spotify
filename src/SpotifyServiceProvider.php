<?php

namespace Modelesque\Api;

use Illuminate\Support\ServiceProvider;

class SpotifyServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(SpotifyClientInterface::class, SpotifyClient::class);
        $this->app->singleton(SpotifyClient::class);

        // provide a fallback config that can be overwritten by hosts using this package
        $this->mergeConfigFrom(__DIR__ . '/../config/apis.php', 'apis');
    }

    public function boot(): void
    {

    }
}