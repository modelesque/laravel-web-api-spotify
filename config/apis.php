<?php

return [
    'providers' => [
        'spotify' => [
            'name' => 'Spotify',
            'base_url' => 'https://api.spotify.com/v1/',
            'base_auth_url' => 'https://accounts.spotify.com/authorize',
            'token_url' => 'https://accounts.spotify.com/api/token',
            'redirect_uri' => 'pkce-auth-redirect',
            'client_id' => env('SPOTIFY_CLIENT_ID'),
            'client_secret' => env('SPOTIFY_CLIENT_SECRET'),
            'user_id' => env('SPOTIFY_USER_ID'),
            'scope' => [],
        ],
    ],
];