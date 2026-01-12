<?php

namespace Modelesque\Api\Contracts;

use Modelesque\App\Requests\Artists;

interface SpotifyClientInterface
{
    /**
     * Accesses all API requests related to Spotify artists.
     *
     * @return Artists
     */
    public function artists(): Artists;
}