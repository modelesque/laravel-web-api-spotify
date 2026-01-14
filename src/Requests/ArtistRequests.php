<?php

namespace Modelesque\App\Requests;

use Illuminate\Http\Client\ConnectionException;
use Modelesque\Api\Helpers\SpotifyError;
use Modelesque\App\Abstracts\Request;

/**
 * REST requests from Spotify's Web API regarding artists.
 */
class ArtistRequests extends Request
{
    /**
     * Get artists by their IDs.
     *
     * @param string|array $ids
     * @return mixed
     * @throws ConnectionException
     * @see https://developer.spotify.com/documentation/web-api/reference/get-an-artist
     * @see https://developer.spotify.com/documentation/web-api/reference/get-multiple-artists
     * @see SpotifyError::getArtists()
     */
    public function get(string|array $ids): mixed
    {
        return $this->client->get('artists/' . $this->requests->formatIds($ids, 50));
    }
}