<?php

namespace Tests\Traits;

/**
 * Trait GetsJsonTestFixtures
 * @package Tests\Traits
 */
trait GetsJsonTestFixtures
{
    public function getJsonFixture(string $path): ?string
    {
        return file_get_contents(__DIR__.'/Fixtures/'.ltrim($path, '/'));
    }

    public function getJsonFixtureAsArray(string $path): ?array
    {
        return json_decode(file_get_contents(__DIR__.'/Fixtures/'.ltrim($path, '/')), true);
    }

    public function getJsonFixtureAsObject(string $path): ?\stdClass
    {
        return json_decode(file_get_contents(__DIR__.'/Fixtures/'.ltrim($path, '/')));
    }
}
