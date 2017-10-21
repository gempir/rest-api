<?php

namespace gempir\api;

/**
 * @codeCoverageIgnoreFile
 */
class Request
{
    private function __construct()
    {
    }

    public static function fromGlobalState()
    {
        return new self();
    }

    public function getPath(): string
    {
        return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    }

    public function getHeaders(): array
    {
        return getallheaders();
    }
}
