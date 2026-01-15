<?php

namespace Modelesque\Api\Spotify\Abstracts;

use Illuminate\Http\Client\PendingRequest;
use Modelesque\Api\Spotify\Services\RequestsService;
use Modelesque\ApiTokenManager\Abstracts\BaseRequest;

abstract class Request extends BaseRequest
{
    public function __construct(
        PendingRequest $client,
        protected RequestsService $requests
    )
    {
        parent::__construct($client);
    }
}