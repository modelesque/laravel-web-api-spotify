<?php

namespace Modelesque\Api;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\PendingRequest;
use Modelesque\ApiTokenManager\Abstracts\BaseClient;
use Modelesque\ApiTokenManager\Exceptions\PKCEAuthorizationRequiredException;
use Modelesque\ApiTokenManager\Factories\ApiClientFactory;
use Modelesque\Api\Contracts\SpotifyClientInterface;
use Modelesque\App\Requests\Artists;

class SpotifyClient extends BaseClient implements SpotifyClientInterface
{
    public const CONFIG_KEY = 'spotify';

    public function __construct(ApiClientFactory $factory, string $account = '', string $grantType = '')
    {
        parent::__construct($factory, self::CONFIG_KEY, $account, $grantType);
    }

    /**
     * Returns an Http client configured for Spotify.
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
    public function artists(): Artists
    {
        return new Artists($this->make());
    }
}