<?php

namespace gempir\api;

use PHPUnit\Framework\TestCase;

/**
 * @covers \gempir\api\Router
 */
class RouterTest extends TestCase
{
	public function testCanRouteRootRequest()
	{
		$rootRequestHandlerMock = $this->createMock(RootRequestHandler::class);
		$rootRequestHandlerMock->method("getRoute")->willReturn("/");
		$searchRequestHandlerMock = $this->createMock(SearchRequestHandler::class);
		$indexRequestHandlerMock = $this->createMock(IndexRequestHandler::class);

		$router = new Router($rootRequestHandlerMock, $searchRequestHandlerMock, $indexRequestHandlerMock);

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
		$searchRequestHandlerMock = $this->createMock(SearchRequestHandler::class);
		$indexRequestHandlerMock = $this->createMock(IndexRequestHandler::class);

		$router = new Router($rootRequestHandlerMock, $searchRequestHandlerMock, $indexRequestHandlerMock);

		$requestMock = $this->createMock(Request::class);
		$requestMock->method("getHeaders")->willReturn([]);
		$requestMock->method("getPath")->willReturn("/abc");

		$router->route($requestMock);
	}
}
