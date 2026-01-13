<?php

namespace Modelesque\Api\Helpers;

use Modelesque\ApiTokenManager\Exceptions\InvalidConfigException;
use Modelesque\ApiTokenManager\Helpers\Config;

class SpotifyConfig
{
    public const KEY = 'spotify';

    /**
     * @param null $key
     * @param null $sub
     * @param null $default
     * @return mixed
     * @throws InvalidConfigException
     */
    public static function get($key = null, $sub = null, $default = null): mixed
    {
        return Config::get(self::KEY, $key, $sub, $default);
    }

    /**
     * @param null $key
     * @param null $sub
     * @return mixed
     * @throws InvalidConfigException
     */
    public static function getRequired($key = null, $sub = null): mixed
    {
        return Config::getRequired(self::KEY, $key, $sub);
    }
}