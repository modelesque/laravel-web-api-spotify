<?php

namespace Modelesque\Api\Spotify;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use Modelesque\Api\Spotify\Contracts\SpotifyClientInterface;
use Modelesque\Api\Spotify\Helpers\SpotifyConfig;
use Modelesque\Api\Spotify\Services\RequestsService;
use Modelesque\ApiTokenManager\Events\ConstructAuthUrlParamsEvent;
use Modelesque\ApiTokenManager\Services\Providers\AuthCodeTokenProvider;

class SpotifyServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(RequestsService::class);
        $this->app->singleton(SpotifyClient::class);
        $this->app->alias(SpotifyClient::class, SpotifyClientInterface::class);

        // provide a fallback config that can be overwritten by hosts using this package
        $this->mergeConfigFrom(__DIR__ . '/../config/apis.php', 'apis');
    }

    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/apis.php' => config_path('apis.php'),
            ], 'config');
        }

        /**
         * Add additional query params to the OAuth2 authorize URL.
         * @see AuthCodeTokenProvider::authorizeUrlParams()
         */
        Event::listen(ConstructAuthUrlParamsEvent::class, static function($event) {
            /** @var ConstructAuthUrlParamsEvent $event */
            if ($event->provider !== SpotifyConfig::KEY) {
                return;
            }

            // this is helpful because not every API excepts 'show_dialog' or names it that way
            $showDialog = (bool)SpotifyConfig::get('show_dialog', $event->account, false);
            if ($showDialog) {
                $event->params['show_dialog'] = true;
            }
        });
    }
}