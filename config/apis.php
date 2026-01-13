<?php

use Modelesque\ApiTokenManager\Enums\ApiAccount;
use Modelesque\ApiTokenManager\Enums\ApiTokenGrantType;

$public = ApiAccount::PUBLIC->value;
$private = ApiAccount::PRIVATE->value;
$pkce = ApiTokenGrantType::PKCE->value;
$cc = ApiTokenGrantType::CLIENT_CREDENTIALS->value;

return [
    'providers' => [
        'spotify' => [
            'base_auth_url' => 'https://accounts.spotify.com/authorize',
            'base_url' => 'https://api.spotify.com/v1/',
            'client_id' => env('SPOTIFY_CLIENT_ID'),
            'client_secret' => env('SPOTIFY_CLIENT_SECRET'),
            'default_account' => $public,
            'default_grant_type' => $pkce,
            'market' => 'DE',
            'name' => 'Spotify',
            'redirect_uri' => 'pkce-auth-redirect',
            'scope' => [],
            'token_url' => 'https://accounts.spotify.com/api/token',
            'user_id' => env('SPOTIFY_USER_ID'),
        ],
    ],
];