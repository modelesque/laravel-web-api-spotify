<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modelesque\Api\Spotify\Tests\TestCase;

uses(TestCase::class, RefreshDatabase::class)->in('Feature');
uses(TestCase::class)->in('Unit');

// clean up Mockery after each test
afterEach(fn() => Mockery::close());