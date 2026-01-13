<?php

namespace Modelesque\Api;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\PendingRequest;
use Modelesque\ApiTokenManager\Abstracts\BaseClient;
use Modelesque\ApiTokenManager\Contracts\PKCEAuthCodeFlowInterface;
use Modelesque\ApiTokenManager\Exceptions\PKCEAuthorizationRequiredException;
use Modelesque\ApiTokenManager\Factories\ApiClientFactory;
use Modelesque\Api\Contracts\SpotifyClientInterface;
use Modelesque\App\Requests\AlbumRequests;
use Modelesque\App\Requests\ArtistRequests;
use Modelesque\ApiTokenManager\Traits\HandlesPKCEAuthCodeFlow;
use Modelesque\App\Requests\PlaylistRequests;
use Modelesque\App\Requests\TrackRequests;

/**
 * @method PKCEAuthCodeFlowInterface pkce()
 * @mixin HandlesPKCEAuthCodeFlow
 */
class SpotifyClient extends BaseClient implements SpotifyClientInterface
{
    use HandlesPKCEAuthCodeFlow;

    public const CONFIG_KEY = 'spotify';

    public function __construct(ApiClientFactory $factory, string $account = '', string $grantType = '')
    {
        parent::__construct($factory, self::CONFIG_KEY, $account, $grantType);
    }

    /**
     * Returns a Http client configured for Spotify.
     *
     * @return PendingRequest
     * @throws ConnectionException
     * @throws PKCEAuthorizationRequiredException
     */
    private function make(): PendingRequest
    {
        return $this->factory->make(
            self::CONFIG_KEY,
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