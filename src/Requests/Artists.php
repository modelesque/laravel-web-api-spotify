<?php

namespace Modelesque\App\Requests;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\Promises\LazyPromise;
use Modelesque\ApiTokenManager\Abstracts\BaseRequest;

class Artists extends BaseRequest
{
    /**
     * Get an artist by their ID.
     *
     * @param string $id
     * @return LazyPromise|mixed
     * @throws ConnectionException
     */
    public function get(string $id)
    {
        return $this->client->get('artists/' . $id);
    }
}