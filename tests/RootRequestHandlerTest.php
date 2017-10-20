<?php

namespace gempir\api;

use PHPUnit\Framework\TestCase;

class RootRequestHandlerTest extends TestCase
{
	public function testCanHandleRequest()
	{
		$requestMock = $this->createMock(Request::class);
		$requestMock->method("getHeaders")->willReturn([]);
		$requestMock->method("getPath")->willReturn("/");

		$this->assertSame("Hello World", (string) (new RootRequestHandler())->handle($requestMock));
	}
}
