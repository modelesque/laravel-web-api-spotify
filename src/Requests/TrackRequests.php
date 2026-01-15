<?php

namespace Modelesque\Api\Spotify\Requests;

use Illuminate\Http\Client\ConnectionException;
use Modelesque\Api\Spotify\Helpers\SpotifyError;
use Modelesque\Api\Spotify\Abstracts\Request;

/**
 * REST requests from Spotify's Web API regarding tracks.
 */
class TrackRequests extends Request
{
    /**
     * Get tracks by their IDs.
     *
     * @param string|array $ids
     * @param string|null $market
     * @return mixed
     * @throws ConnectionException
     * @see https://developer.spotify.com/documentation/web-api/reference/get-track
     * @see https://developer.spotify.com/documentation/web-api/reference/get-several-tracks
     * @see SpotifyError::getTracks()
     */
    public function get(string|array $ids, ?string $market = null): mixed
    {
        return $this->client->get(
            'tracks/' . $this->requests->formatIds($ids),
            $this->requests->formatParams(['market' => $market])
        );
    }
}