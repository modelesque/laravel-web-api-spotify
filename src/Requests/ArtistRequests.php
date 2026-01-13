<?php

namespace Modelesque\App\Requests;

use Illuminate\Http\Client\ConnectionException;
use Modelesque\ApiTokenManager\Abstracts\BaseRequest;
use SpotifyError;

/**
 * REST requests from Spotify's Web API regarding artists.
 */
class ArtistRequests extends BaseRequest
{
    /**
     * Get an artist by their ID.
     *
     * @param string $id
     * @return mixed
     * @throws ConnectionException
     * @see https://developer.spotify.com/documentation/web-api/reference/get-an-artist
     * @see SpotifyError::getArtist()
     */
    public function get(string $id): mixed
    {
        return $this->client->get('artists/' . $id);
    }
}