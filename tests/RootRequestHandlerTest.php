<?php

namespace gempir\api;

use PHPUnit\Framework\TestCase;

/**
 * @covers \gempir\api\RootRequestHandler
 * @covers \gempir\api\RequestHandler
 */
class RootRequestHandlerTest extends TestCase
{
	public function testCanHandleRequest()
	{
		$accessHandler = new AccessHandler("dummy");

		$requestMock = $this->createMock(Request::class);
		$requestMock->method("getHeaders")->willReturn([]);
		$requestMock->method("getPath")->willReturn("/");

		$this->assertTrue(
			array_key_exists(
				"Access-Token",
				json_decode((string) (new RootRequestHandler($accessHandler))->handle($requestMock), true)
			)
		);
	}

	public function testCanGetRoute()
	{
		$accessHandler = new AccessHandler("dummy");

		$this->assertSame("/", (new RootRequestHandler($accessHandler))->getRoute());
	}
}
