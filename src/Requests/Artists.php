<?php

namespace Modelesque\App\Requests;

use Modelesque\ApiTokenManager\Abstracts\BaseRequest;

class Artists extends BaseRequest
{
    public function get(string $id)
    {
        return $this->client->get('artists/' . $id);
    }
}