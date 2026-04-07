<?php

namespace Nasirkhan\LaravelSharekit\Tests;

use Nasirkhan\LaravelSharekit\SharekitServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function getPackageProviders($app): array
    {
        return [SharekitServiceProvider::class];
    }
}
