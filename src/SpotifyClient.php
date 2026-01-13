<?php

namespace Modelesque\Api;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\PendingRequest;
use Modelesque\ApiTokenManager\Abstracts\BaseClient;
use Modelesque\ApiTokenManager\Exceptions\AuthCodeFlowRequiredException;
use Modelesque\ApiTokenManager\Exceptions\InvalidConfigException;
use Modelesque\ApiTokenManager\Factories\ApiClientFactory;
use Modelesque\ApiTokenManager\Traits\HandlesAuthCodeFlow;
use Modelesque\Api\Contracts\SpotifyClientInterface;
use Modelesque\Api\Helpers\SpotifyConfig;
use Modelesque\App\Requests\AlbumRequests;
use Modelesque\App\Requests\ArtistRequests;
use Modelesque\App\Requests\PlaylistRequests;
use Modelesque\App\Requests\TrackRequests;

/**
 * @mixin HandlesAuthCodeFlow
 */
class SpotifyClient extends BaseClient implements SpotifyClientInterface
{
    use HandlesAuthCodeFlow;

    public function __construct(ApiClientFactory $factory, string $account = '', string $grantType = '')
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
        return new AlbumRequests($this->make());
    }

    /** @inheritdoc */
    public function artists(): ArtistRequests
    {
        return new ArtistRequests($this->make());
    }

    /** @inheritdoc */
    public function playlists(): PlaylistRequests
    {
        return new PlaylistRequests($this->make());
    }

    /** @inheritdoc */
    public function tracks(): TrackRequests
    {
        return new TrackRequests($this->make());
    }
}