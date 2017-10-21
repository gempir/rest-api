<?php

namespace gempir\api;

use PHPUnit\Framework\TestCase;

/**
 * @covers \gempir\api\Factory
 */
class FactoryTest extends TestCase
{
    public function testCanCreateApplication()
    {
        $this->assertInstanceOf(Application::class, (new Factory())->createApplication());
    }
}
