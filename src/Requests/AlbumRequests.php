<?php

namespace Modelesque\App\Requests;

use Illuminate\Http\Client\ConnectionException;
use Modelesque\ApiTokenManager\Abstracts\BaseRequest;
use Modelesque\ApiTokenManager\Exceptions\InvalidConfigException;
use SpotifyConfig;
use SpotifyError;

/**
 * REST requests from Spotify's Web API regarding albums.
 */
class AlbumRequests extends BaseRequest
{
    /**
     * Get albums by their IDs.
     *
     * @param string|array $ids
     * @param string $market
     * @return mixed
     * @throws ConnectionException
     * @throws InvalidConfigException
     * @see https://developer.spotify.com/documentation/web-api/reference/get-an-album
     * @see SpotifyError::getAlbum()
     */
    public function get(string|array $ids, string $market = ''): mixed
    {
        $client = $this->client;

        if (! $market) {
            $market = SpotifyConfig::get('market') ?? '';
            if ($market) {
                $client->withQueryParameters(['market' => strtoupper($market)]);
            }
        }

        if (is_array($ids)) {
            $ids = implode(',', $ids);
        }

        return $client->get('albums/' . $ids);
    }

    public function getUsersSavedAlbums()
    {
    
    }
}