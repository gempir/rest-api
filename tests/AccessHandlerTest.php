<?php

namespace gempir\api;

use PHPUnit\Framework\TestCase;

/**
 * @covers \gempir\api\AccessHandler
 */
class AccessHandlerTest extends TestCase
{
    public function testCanGenerateReadToken()
    {
        $accessHandler = new AccessHandler("super secret");
        $this->assertInternalType("string", $accessHandler->generateReadToken());
    }

    public function testCanGenerateReadAndWriteToken()
    {
        $accessHandler = new AccessHandler("super secret2");
        $this->assertInternalType("string", $accessHandler->generateReadAndWriteToken());
    }

    public function testCanCheckReadAccess()
    {
        $accessHandler = new AccessHandler("super secret");
        $token = $accessHandler->generateReadToken();

        $this->assertTrue($accessHandler->hasReadAccess($token));
        $this->assertFalse($accessHandler->hasReadAndWriteAccess($token));
    }

    public function testCanCheckReadAndWriteAccess()
    {
        $accessHandler = new AccessHandler("super secret2");
        $token = $accessHandler->generateReadAndWriteToken();

        $this->assertTrue($accessHandler->hasReadAndWriteAccess($token));
        $this->assertTrue($accessHandler->hasReadAccess($token));
    }

    public function testCheckIsFalseWhenReadTokenInvalidFormat()
    {
        $accessHandler = new AccessHandler("super secret2");
        $this->assertFalse($accessHandler->hasReadAccess("token abc 321"));
    }

    public function testCheckIsFalseWhenReadAndWriteTokenInvalidFormat()
    {
        $accessHandler = new AccessHandler("super secret2");
        $this->assertFalse($accessHandler->hasReadAndWriteAccess("token 123"));
    }
}
