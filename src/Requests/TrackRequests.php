<?php

namespace Modelesque\App\Requests;

use Illuminate\Http\Client\ConnectionException;
use Modelesque\ApiTokenManager\Abstracts\BaseRequest;
use SpotifyError;

/**
 * REST requests from Spotify's Web API regarding tracks.
 */
class TrackRequests extends BaseRequest
{
    /**
     * Get a track by its ID.
     *
     * @param string $id
     * @return mixed
     * @throws ConnectionException
     * @see https://developer.spotify.com/documentation/web-api/reference/get-track
     * @see SpotifyError::getTrack()
     */
    public function get(string $id): mixed
    {
        return $this->client->get('tracks/' . $id);
    }
}