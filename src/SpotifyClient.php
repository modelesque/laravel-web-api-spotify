<?php

namespace Modelesque\Api\Spotify;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\PendingRequest;
use Modelesque\ApiTokenManager\Abstracts\BaseClient;
use Modelesque\ApiTokenManager\Exceptions\AuthCodeFlowRequiredException;
use Modelesque\ApiTokenManager\Exceptions\InvalidConfigException;
use Modelesque\ApiTokenManager\Factories\ApiClientFactory;
use Modelesque\ApiTokenManager\Traits\HandlesAuthCodeFlow;
use Modelesque\Api\Spotify\Contracts\SpotifyClientInterface;
use Modelesque\Api\Spotify\Helpers\SpotifyConfig;
use Modelesque\Api\Spotify\Requests\AlbumRequests;
use Modelesque\Api\Spotify\Requests\ArtistRequests;
use Modelesque\Api\Spotify\Requests\PlaylistRequests;
use Modelesque\Api\Spotify\Requests\TrackRequests;
use Modelesque\Api\Spotify\Services\RequestsService;

/**
 * @mixin HandlesAuthCodeFlow
 */
class SpotifyClient extends BaseClient implements SpotifyClientInterface
{
    use HandlesAuthCodeFlow;

    // protected RequestsService $requests;
    public function __construct(
        ApiClientFactory $factory,
        string $account = '',
        string $grantType = '',
        protected RequestsService $requests
    )
    {
        parent::__construct($factory, SpotifyConfig::KEY, $account, $grantType);
    }

    /**
     * Returns a Http client configured for Spotify.
     *
     * @return PendingRequest
     * @throws ConnectionException
     * @throws AuthCodeFlowRequiredException
     * @throws InvalidConfigException
     */
    private function make(): PendingRequest
    {
        return $this->factory->make(
            SpotifyConfig::KEY,
            $this->account,
            $this->grantType
        );
    }

    /** @inheritdoc */
    public function albums(): AlbumRequests
    {
        return new AlbumRequests($this->make(), $this->requests);
    }

    /** @inheritdoc */
    public function artists(): ArtistRequests
    {
        return new ArtistRequests($this->make(), $this->requests);
    }

    /** @inheritdoc */
    public function playlists(): PlaylistRequests
    {
        return new PlaylistRequests($this->make(), $this->requests);
    }

    /** @inheritdoc */
    public function tracks(): TrackRequests
    {
        return new TrackRequests($this->make(), $this->requests);
    }
}