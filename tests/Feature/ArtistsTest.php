<?php

use Modelesque\Api\Spotify\Contracts\SpotifyClientInterface;
use Modelesque\Api\Spotify\Helpers\SpotifyTest;
use Modelesque\Api\Spotify\SpotifyClient;
use Modelesque\Api\Spotify\Tests\TestCase;
use Modelesque\ApiTokenManager\Contracts\AuthCodeFlowInterface;
use Modelesque\ApiTokenManager\Enums\ApiAccount;
use Modelesque\ApiTokenManager\Enums\ApiTokenGrantType;

it("returns a Spotify artist using 'client_credentials'", function () {
    /** @var TestCase $this */
    /** @var SpotifyClient|AuthCodeFlowInterface $spotify */
    $spotify = app()->makeWith(SpotifyClientInterface::class, [
        'account' => ApiAccount::PUBLIC->value,
        'grantType' => ApiTokenGrantType::CLIENT_CREDENTIALS->value,
    ]);

    $response = $spotify->artists()->get(SpotifyTest::artist());

    expect($response->status())->toBe(200);
    expect($response['name'])->toBeString(SpotifyTest::artist(true));
});

it("returns a Spotify artist using 'authorization_code'", function () {
    /** @var TestCase $this */
    /** @var SpotifyClient|AuthCodeFlowInterface $spotify */

    $spotify = app()->makeWith(SpotifyClientInterface::class, [
        'account' => ApiAccount::PUBLIC->value,
        'grantType' => ApiTokenGrantType::AUTHORIZATION_CODE->value,
    ]);

    $response = $spotify->artists()->get(SpotifyTest::artist());

    expect($response->status())->toBe(200);
    expect($response['name'])->toBeString(SpotifyTest::artist(true));
});