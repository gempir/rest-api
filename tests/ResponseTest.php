<?php

namespace gempir\api;

use PHPUnit\Framework\TestCase;

/**
 * @covers \gempir\api\Response
 */
class ResponseTest extends TestCase
{
    public function testCanGetResponseAsString()
    {
        $this->assertSame("Hi", (string) Response::fromParameters("Hi", []));
    }

    public function testCanGetHeaders()
    {
        $this->assertSame(
            "application/json",
            Response::fromParameters("Hi", ["Content-Type" => "application/json"])->getHeaders()["Content-Type"]
        );
    }
}
