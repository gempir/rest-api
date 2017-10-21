<?php

namespace gempir\api;

use PHPUnit\Framework\TestCase;

/**
 * @covers \gempir\api\SearchRequestHandler
 * @covers \gempir\api\RequestHandler
 */
class SearchRequestHandlerTest extends TestCase
{
	public function testCanHandleRequest()
	{
		$accessHandler = new AccessHandler("dummy");
		$readToken = $accessHandler->generateReadToken();

		$requestMock = $this->createMock(Request::class);
		$requestMock->method("getHeaders")->willReturn(["Access-Token" => $readToken]);
		$requestMock->method("getPath")->willReturn("/search");

		$this->assertTrue(count(json_decode((new SearchRequestHandler($accessHandler))->handle($requestMock))->results) > 0
		);
	}

	public function testThrowsExceptionWhenNoToken()
	{
		$this->expectException(AccessException::class);
		$this->expectExceptionMessage("Access-Token not found in request headers");

		$accessHandler = new AccessHandler("dummy");

		$requestMock = $this->createMock(Request::class);
		$requestMock->method("getHeaders")->willReturn([]);
		$requestMock->method("getPath")->willReturn("/search");

		(new SearchRequestHandler($accessHandler))->handle($requestMock);
	}

	public function testThrowsExceptionWhenInvalidReadToken()
	{
		$this->expectException(AccessException::class);
		$this->expectExceptionMessage("Access-Token does not allow read access");

		$accessHandler = new AccessHandler("dummy");

		$requestMock = $this->createMock(Request::class);
		$requestMock->method("getHeaders")->willReturn(["Access-Token" => "invalid token"]);
		$requestMock->method("getPath")->willReturn("/search");

		(new SearchRequestHandler($accessHandler))->handle($requestMock);
	}

	public function testCanGetRoute()
	{
		$accessHandler = new AccessHandler("dummy");

		$this->assertSame("/search", (new SearchRequestHandler($accessHandler))->getRoute());
	}
}
