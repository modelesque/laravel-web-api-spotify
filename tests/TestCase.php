<?php

namespace Modelesque\Api\Spotify\Tests;

use Dotenv\Dotenv;
use Illuminate\Support\Facades\DB;
use Modelesque\Api\Spotify\Enums\SpotifyScope;
use Modelesque\Api\Spotify\Helpers\SpotifyConfig;
use Modelesque\Api\Spotify\SpotifyServiceProvider;
use Modelesque\ApiTokenManager\ApiTokenManagerServiceProvider;
use Modelesque\ApiTokenManager\Enums\ApiAccount;
use Modelesque\ApiTokenManager\Enums\ApiTokenGrantType;
use Orchestra\Testbench\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    /** Returns scope values test with */
    public function scope(): string
    {
        return implode(' ', [
            SpotifyScope::UPLOAD_IMAGES->value,
            SpotifyScope::PLAYLIST_PRIVATE_READ->value,
            SpotifyScope::PLAYLIST_PRIVATE_WRITE->value,
            SpotifyScope::PLAYLIST_PUBLIC_WRITE->value,
            SpotifyScope::MY_LIBRARY_READ->value,
        ]);
    }

    /** @inheritdoc */
    protected function getApplicationTimezone($app): string
    {
        return 'Europe/Berlin';
    }

    /** @inheritdoc */
    protected function getPackageProviders($app): array
    {
        return [
            SpotifyServiceProvider::class,
            ApiTokenManagerServiceProvider::class,
        ];
    }

    /** @inheritdoc */
    protected function getEnvironmentSetUp($app): void
    {
        $app['config']->set('apis', require __DIR__ . '/../config/apis.php');

        // Use SQLite in-memory for testing
        $app['config']->set('database.default', 'testbench');
        $app['config']->set('database.connections.testbench', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);
    }

    /** @inheritdoc */
    protected function setUp(): void
    {
        // ensure .env is loaded before setting up so Pest parses env() in the default config
        Dotenv::createImmutable(__DIR__ . '/..')->load();

        parent::setUp();

        // load and run the migration from the Token Manager package
        $this->loadMigrationsFrom([
            '--database' => 'testbench',
            '--path' => realpath(__DIR__.'/../vendor/modelesque/laravel-api-token-manager/database/migrations'),
        ]);
        $this->artisan('migrate', ['--database' => 'testbench'])->run();

        // populate the table with a real token from the "authorization_code" flow
        // (do this manually since the test can't simulate the process)
        $token = env('AUTH_CODE_TOKEN');
        if ($token && env('APP_KEY')) {
            DB::table('api_tokens')->insert([
                'provider' => SpotifyConfig::KEY,
                'account' => ApiAccount::PUBLIC->value,
                'grant_type' => ApiTokenGrantType::AUTHORIZATION_CODE->value,
                'token_type' => 'bearer',
                'token' => $token,
                'refresh_token' => env('AUTH_CODE_REFRESH_TOKEN'),
                'scope' => $this->scope(),
                'meta' => null,
                'created_at' => now(),
                'updated_at' => now(),
                'expires_at' => env('AUTH_CODE_TOKEN_EXPIRES_AT') ?? now()->Hours(),
            ]);
        }
    }
}