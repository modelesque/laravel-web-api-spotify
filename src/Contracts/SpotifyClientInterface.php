<?php

namespace Modelesque\Api\Contracts;

use Illuminate\Http\Client\ConnectionException;
use Modelesque\Api\SpotifyClient;
use Modelesque\ApiTokenManager\Contracts\PKCEAuthCodeFlowInterface;
use Modelesque\ApiTokenManager\Exceptions\PKCEAuthorizationRequiredException;
use Modelesque\ApiTokenManager\Traits\HandlesPKCEAuthCodeFlow;
use Modelesque\App\Requests\Artists;

/**
 * @method PKCEAuthCodeFlowInterface pkce()
 * @mixin HandlesPKCEAuthCodeFlow
 * @see SpotifyClient
 */
interface SpotifyClientInterface
{
    /**
     * Accesses all API requests related to Spotify artists.
     *
     * @return Artists
     * @throws ConnectionException
     * @throws PKCEAuthorizationRequiredException
     */
    public function artists(): Artists;
}