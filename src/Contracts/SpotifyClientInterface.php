<?php

namespace Modelesque\Api\Spotify\Contracts;

use Illuminate\Http\Client\ConnectionException;
use Modelesque\Api\Spotify\SpotifyClient;
use Modelesque\ApiTokenManager\Exceptions\AuthCodeFlowRequiredException;
use Modelesque\ApiTokenManager\Exceptions\InvalidConfigException;
use Modelesque\ApiTokenManager\Traits\HandlesAuthCodeFlow;
use Modelesque\Api\Spotify\Requests\AlbumRequests;
use Modelesque\Api\Spotify\Requests\ArtistRequests;
use Modelesque\Api\Spotify\Requests\PlaylistRequests;
use Modelesque\Api\Spotify\Requests\TrackRequests;

/**
 * @mixin HandlesAuthCodeFlow
 * @see SpotifyClient
 */
interface SpotifyClientInterface
{
    /**
     * Accesses all API requests related to Spotify albums.
     *
     * @return AlbumRequests
     * @throws ConnectionException
     * @throws AuthCodeFlowRequiredException
     * @throws InvalidConfigException
     */
    public function albums(): AlbumRequests;

    /**
     * Accesses all API requests related to Spotify artists.
     *
     * @return ArtistRequests
     * @throws ConnectionException
     * @throws AuthCodeFlowRequiredException
     * @throws InvalidConfigException
     */
    public function artists(): ArtistRequests;

    /**
     * Accesses all API requests related to Spotify playlists.
     *
     * @return PlaylistRequests
     * @throws ConnectionException
     * @throws AuthCodeFlowRequiredException
     * @throws InvalidConfigException
     */
    public function playlists(): PlaylistRequests;

    /**
     * Accesses all API requests related to Spotify tracks.
     *
     * @return TrackRequests
     * @throws ConnectionException
     * @throws AuthCodeFlowRequiredException
     * @throws InvalidConfigException
     */
    public function tracks(): TrackRequests;
}