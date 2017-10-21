<?php

namespace gempir\api;

use Firebase\JWT\JWT;

class AccessHandler
{
    const ALGORITHMS = ["HS256"];

    /** @var string */
    private $secret;

    public function __construct(string $secret)
    {
        $this->secret = $secret;
    }

    public function hasReadAccess(string $token): bool
    {
        try {
            $decoded = JWT::decode($token, $this->secret, self::ALGORITHMS);
        } catch (\Exception $e) {
            return false;
        }

        return isset($decoded->read) && $decoded->read;
    }

    public function hasReadAndWriteAccess(string $token): bool
    {
        try {
            $decoded = JWT::decode($token, $this->secret, self::ALGORITHMS);
        } catch (\Exception $e) {
            return false;
        }

        return isset($decoded->read) && $decoded->read && isset($decoded->write) && $decoded->write;
    }

    public function generateReadToken(): string
    {
        $token = [
            "read" => true,
            "write" => false,
            "exp" => time() + (5 * 24 * 60 * 60)
        ];

        return JWT::encode($token, $this->secret);
    }

    public function generateReadAndWriteToken(): string
    {
        $token = [
            "read" => true,
            "write" => true,
            "exp" => time() + (10 * 365 * 24 * 60 * 60)
        ];

        return JWT::encode($token, $this->secret);
    }
}
