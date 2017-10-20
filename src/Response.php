<?php

namespace gempir\api;

class Response
{
	/** @var string */
	private $response;

	public static function fromString(string $response)
	{
		return new self($response);
	}

	private function __construct(string $response)
	{
		$this->response = $response;
	}

	public function __toString(): string
	{
		return (string) $this->response;
	}
}