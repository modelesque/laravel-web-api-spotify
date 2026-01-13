<?php

namespace Modelesque\Api;

use Illuminate\Support\ServiceProvider;
use Modelesque\Api\Contracts\SpotifyClientInterface;

class SpotifyServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(SpotifyClient::class);
        $this->app->bind(SpotifyClientInterface::class, SpotifyClient::class);
    }

    public function boot(): void
    {

    }
}