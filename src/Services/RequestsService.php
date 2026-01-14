<?php

namespace Modelesque\Api\Services;

use JetBrains\PhpStorm\Pure;
use Modelesque\Api\Helpers\SpotifyConfig;
use Modelesque\ApiTokenManager\Exceptions\InvalidConfigException;

class RequestsService
{
    /**
     * Format the most common params for the request to streamline searching for
     * default values in the config, formatting values, etc.
     *
     * @param array $params
     * @return array
     */
    public function formatParams(array $params): array
    {
        return collect($params)
            ->map(fn($value, $key) => match($key) {
                'market' => $this->formatMarket($value),
                'limit' => $this->formatLimit($value),
                'offset', 'position' => $this->formatUnsignedInt($value),
                'fields' => $this->formatFields($value),
                'uris' => $this->formatUris($value),
                default => $value,
            })
            ->filter(static fn($v) => $v !== null && $v !== '' && $v !== [])
            ->all();
    }

    /**
     * Format the `market` param for the request, representing a country code (e.g. "DE")
     * that the resource is available in.
     *
     * @param mixed $market
     * @return string|null
     * @throws InvalidConfigException
     */
    public function formatMarket(mixed $market = ''): ?string
    {
        if (! is_string($market)) {
            return null;
        }

        if (! $market) {
            $market = (string)(SpotifyConfig::get('market') ?? '');
        }

        if (! $market) {
            return '';
        }

        return strtoupper($market);
    }

    /**
     * @param mixed $limit
     * @return int|null
     */
    #[Pure]
    public function formatLimit(mixed $limit): ?int
    {
        if (! is_int($limit)) {
            return null;
        }

        if ($limit > 100) {
            $limit = 100;
        }

        return $this->formatUnsignedInt($limit);
    }

    /**
     * @param mixed $int
     * @return int|null
     */
    public function formatUnsignedInt(mixed $int): ?int
    {
        if (! is_int($int)) {
            return null;
        }

        return $int < 0 ? 0 : $int;
    }

    /**
     * @param mixed $ids
     * @param int $limit
     * @return string|null
     */
    public function formatIds(mixed $ids, int $limit = 50): ?string
    {
        if (is_string($ids) && str_contains($ids, ',')) {
            $ids = explode(',', $ids);
        }

        if (is_array($ids)) {
            $ids = collect($ids)->unique()->take($limit)->implode(',');
        }

        if (! is_string($ids)) {
            return null;
        }

        return $ids;
    }

    /**
     * @param mixed $uris
     * @param int $limit
     * @return string|null
     */
    public function formatUris(mixed $uris, int $limit = 100): ?string
    {
        if (is_string($uris) && str_contains($uris, ',')) {
            $uris = explode(',', $uris);
        }

        if (is_array($uris)) {
            $uris = collect($uris)->unique()->take($limit)->implode(',');
        }

        if (! is_string($uris)) {
            return null;
        }

        return $uris;
    }

    /**
     * TODO figure this out (see 'fields' param) and simplify Playlists response for Emotionalists
     *
     * @see https://developer.spotify.com/documentation/web-api/reference/get-playlist
     *
     * @param mixed $fields
     * @return string|null
     */
    public function formatFields(mixed $fields): ?string
    {
        if (is_array($fields)) {
            $fields = collect($fields)->implode(',');
        }

        if (! is_string($fields)) {
            return null;
        }

        return $fields;
    }
}