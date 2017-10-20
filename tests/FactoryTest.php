<?php

namespace gempir\api;

use PHPUnit\Framework\TestCase;

class FactoryTest extends TestCase
{
	public function testCanCreateRouter()
	{
		$this->assertInstanceOf(Router::class, (new Factory())->createRouter());
	}
}
