<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Tests\Traits\GetsJsonTestFixtures;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use GetsJsonTestFixtures;
}
