<?php

namespace Modelesque\Api;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use Modelesque\Api\Contracts\SpotifyClientInterface;
use Modelesque\Api\Helpers\SpotifyConfig;
use Modelesque\ApiTokenManager\Events\ConstructAuthUrlParamsEvent;
use Modelesque\ApiTokenManager\Services\Providers\AuthCodeTokenProvider;

class SpotifyServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(SpotifyClient::class);
        $this->app->bind(SpotifyClientInterface::class, SpotifyClient::class);
    }

    public function boot(): void
    {
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