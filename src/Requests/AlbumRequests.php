<?php

namespace Modelesque\Api\Spotify\Requests;

use Illuminate\Http\Client\ConnectionException;
use Modelesque\Api\Spotify\Helpers\SpotifyError;
use Modelesque\Api\Spotify\Abstracts\Request;

/**
 * REST requests from Spotify's Web API regarding albums.
 */
class AlbumRequests extends Request
{
    /**
     * Get albums by their IDs.
     *
     * @param string|array $ids
     * @param string|null $market
     * @return mixed
     * @throws ConnectionException
     * @see https://developer.spotify.com/documentation/web-api/reference/get-an-album
     * @see https://developer.spotify.com/documentation/web-api/reference/get-multiple-albums
     * @see SpotifyError::getAlbums()
     */
    public function get(string|array $ids, ?string $market = null): mixed
    {
        return $this->client->get(
            'albums/' . $this->requests->formatIds($ids, 20),
            $this->requests->formatParams(['market' => $market])
        );
    }

    /**
     * Get saved albums from a user's account.
     *
     * @param int $limit
     * @param int $offset
     * @param string|null $market
     * @return mixed
     * @throws ConnectionException
     * @see https://developer.spotify.com/documentation/web-api/reference/get-users-saved-albums
     * @see SpotifyError::getUsersSavedAlbums()
     */
    public function getUsersSavedAlbums(int $limit = 20, int $offset = 0, ?string $market = null): mixed
    {
        if ($limit > 50) {
            $limit = 50; // Spotify's limit
        }

        return $this->client->get(
            'me/albums',
            $this->requests->formatParams([
                'limit' => $limit,
                'offset' => $offset,
                'market' => $market,
            ])
        );
    }
}