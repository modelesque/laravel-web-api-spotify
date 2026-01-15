<?php

namespace Modelesque\Api\Spotify\Helpers;

use Modelesque\ApiTokenManager\Exceptions\InvalidConfigException;
use Modelesque\ApiTokenManager\Helpers\Config;

class SpotifyConfig
{
    public const KEY = 'spotify';

    /**
     * @param string $key
     * @param string $sub
     * @param null $default
     * @return mixed
     * @throws InvalidConfigException
     */
    public static function get(string $key = '', string $sub = '', $default = null): mixed
    {
        return Config::get(self::KEY, $key, $sub, $default);
    }

    /**
     * @param string $key
     * @param string $sub
     * @return mixed
     * @throws InvalidConfigException
     */
    public static function getRequired(string $key = '', string $sub = ''): mixed
    {
        return Config::getRequired(self::KEY, $key, $sub);
    }
}