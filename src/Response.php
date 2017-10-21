<?php

namespace gempir\api;

class Response
{
	/** @var string */
	private $response;

	/** @var array */
	private $headers;

	public static function fromParameters(string $response, array $headers)
	{
		return new self($response, $headers);
	}

	private function __construct(string $response, array $headers)
	{
		$this->response = $response;
		$this->headers = $headers;
	}

	public function getHeaders(): array
	{
		return $this->headers;
	}

	public function __toString(): string
	{
		return (string) $this->response;
	}
}