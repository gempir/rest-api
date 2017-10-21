<?php

namespace gempir\api;

use PHPUnit\Framework\TestCase;

/**
 * @covers \gempir\api\IndexRequestHandler
 * @covers \gempir\api\RequestHandler
 */
class IndexRequestHandlerTest extends TestCase
{
    public function testCanHandleRequest()
    {
        $accessHandler = new AccessHandler("dummy");
        $readAndWriteToken = $accessHandler->generateReadAndWriteToken();

        $requestMock = $this->createMock(Request::class);
        $requestMock->method("getHeaders")->willReturn(["Access-Token" => $readAndWriteToken]);
        $requestMock->method("getPath")->willReturn("/index");

        $this->assertSame(
            "indexed data",
            json_decode((new IndexRequestHandler($accessHandler))->handle($requestMock))->message
        );
    }

    public function testThrowsExceptionWhenNoToken()
    {
        $this->expectException(AccessException::class);
        $this->expectExceptionMessage("Access-Token not found in request headers");

        $accessHandler = new AccessHandler("dummy");

        $requestMock = $this->createMock(Request::class);
        $requestMock->method("getHeaders")->willReturn([]);
        $requestMock->method("getPath")->willReturn("/index");

        (new IndexRequestHandler($accessHandler))->handle($requestMock);
    }

    public function testThrowsExceptionWhenInvalidReadAndWriteToken()
    {
        $this->expectException(AccessException::class);
        $this->expectExceptionMessage("Access-Token does not allow read and write access");

        $accessHandler = new AccessHandler("dummy");

        $requestMock = $this->createMock(Request::class);
        $requestMock->method("getHeaders")->willReturn(["Access-Token" => "invalid token"]);
        $requestMock->method("getPath")->willReturn("/index");

        (new IndexRequestHandler($accessHandler))->handle($requestMock);
    }

    public function testCanGetRoute()
    {
        $accessHandler = new AccessHandler("dummy");

        $this->assertSame("/index", (new IndexRequestHandler($accessHandler))->getRoute());
    }
}
