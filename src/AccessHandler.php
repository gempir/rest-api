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

			return $decoded->read && !$this->isExpiredToken($decoded);
		} catch(\Exception $e) {
			return false;
		}
	}

	public function hasReadAndWriteAccess(string $token): bool
	{
		try {
			$decoded = JWT::decode($token, $this->secret, self::ALGORITHMS);

			return $decoded->read && $decoded->write && !$this->isExpiredToken($decoded);
		} catch(\Exception $e) {
			return false;
		}
	}

	public function generateReadToken(): string
	{
		$token = [
			"read" => true,
			"write" => false,
			"expiresAt" => date('Y-m-d H:i:s', strtotime('+5 day'))
		];

		return JWT::encode($token, $this->secret);
	}

	public function generateReadAndWriteToken(): string
	{
		$token = [
			"read" => true,
			"write" => true,
			"expiresAt" => date('Y-m-d', strtotime('+5 day'))
		];

		return JWT::encode($token, $this->secret);
	}

	private function isExpiredToken(\stdClass $decoded): bool
	{
		return strtotime($decoded->expiresAt) <= strtotime("today");
	}
}