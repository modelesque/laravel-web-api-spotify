<?php

namespace Modelesque\App\Requests;

use Illuminate\Http\Client\ConnectionException;
use Modelesque\ApiTokenManager\Abstracts\BaseRequest;
use SpotifyError;

/**
 * REST requests from Spotify's Web API regarding playlists.
 */
class PlaylistRequests extends BaseRequest
{
    /**
     * Get a playlist by its ID.
     *
     * @param string $id
     * @return mixed
     * @throws ConnectionException
     * @see https://developer.spotify.com/documentation/web-api/reference/get-playlist
     * @see SpotifyError::getPlaylist()
     */
    public function get(string $id): mixed
    {
        return $this->client->get('playlists/' . $id);
    }
}