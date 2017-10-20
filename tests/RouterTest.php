<?php

namespace gempir\api;

use PHPUnit\Framework\TestCase;

class RouterTest extends TestCase
{
	public function testCanRouteRequest()
	{
		$rootRequestHandlerMock = $this->createMock(RootRequestHandler::class);

		$router = new Router($rootRequestHandlerMock);

		$requestMock = $this->createMock(Request::class);
		$requestMock->method("getHeaders")->willReturn([]);
		$requestMock->method("getPath")->willReturn("/");

		$this->assertInstanceOf(RequestHandler::class, $router->route($requestMock));
	}

	public function testThrowsExceptionWhenCanNotRouteRequest()
	{
		$this->expectException(\RuntimeException::class);
		$this->expectExceptionMessage("could not route request");

		$rootRequestHandlerMock = $this->createMock(RootRequestHandler::class);

		$router = new Router($rootRequestHandlerMock);

		$requestMock = $this->createMock(Request::class);
		$requestMock->method("getHeaders")->willReturn([]);
		$requestMock->method("getPath")->willReturn("/abc");

		$router->route($requestMock);
	}
}
