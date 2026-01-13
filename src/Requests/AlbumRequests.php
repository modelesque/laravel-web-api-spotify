<?php

namespace Modelesque\App\Requests;

use Illuminate\Http\Client\ConnectionException;
use Modelesque\ApiTokenManager\Abstracts\BaseRequest;
use SpotifyError;

/**
 * REST requests from Spotify's Web API regarding albums.
 */
class AlbumRequests extends BaseRequest
{
    /**
     * Get an album by its ID.
     *
     * @param string $id
     * @return mixed
     * @throws ConnectionException
     * @see https://developer.spotify.com/documentation/web-api/reference/get-an-album
     * @see SpotifyError::getAlbum()
     */
    public function get(string $id): mixed
    {
        return $this->client->get('albums/' . $id);
    }
}