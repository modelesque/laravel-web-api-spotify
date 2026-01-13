<?php

namespace Modelesque\Api\Contracts;

use Illuminate\Http\Client\ConnectionException;
use Modelesque\Api\SpotifyClient;
use Modelesque\ApiTokenManager\Contracts\PKCEAuthCodeFlowInterface;
use Modelesque\ApiTokenManager\Exceptions\PKCEAuthorizationRequiredException;
use Modelesque\ApiTokenManager\Traits\HandlesPKCEAuthCodeFlow;
use Modelesque\App\Requests\AlbumRequests;
use Modelesque\App\Requests\ArtistRequests;
use Modelesque\App\Requests\PlaylistRequests;
use Modelesque\App\Requests\TrackRequests;

/**
 * @method PKCEAuthCodeFlowInterface pkce()
 * @mixin HandlesPKCEAuthCodeFlow
 * @see SpotifyClient
 */
interface SpotifyClientInterface
{
    /**
     * Accesses all API requests related to Spotify albums.
     *
     * @return AlbumRequests
     * @throws ConnectionException
     * @throws PKCEAuthorizationRequiredException
     */
    public function albums(): AlbumRequests;

    /**
     * Accesses all API requests related to Spotify artists.
     *
     * @return ArtistRequests
     * @throws ConnectionException
     * @throws PKCEAuthorizationRequiredException
     */
    public function artists(): ArtistRequests;

    /**
     * Accesses all API requests related to Spotify playlists.
     *
     * @return PlaylistRequests
     * @throws ConnectionException
     * @throws PKCEAuthorizationRequiredException
     */
    public function playlists(): PlaylistRequests;

    /**
     * Accesses all API requests related to Spotify tracks.
     *
     * @return TrackRequests
     * @throws ConnectionException
     * @throws PKCEAuthorizationRequiredException
     */
    public function tracks(): TrackRequests;
}