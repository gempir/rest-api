<?php

namespace gempir\api;

class Router
{
	/** @var RequestHandler[] */
	private $requestHandlers;

	public function __construct(RequestHandler... $requestHandlers)
	{
		$this->requestHandlers = $requestHandlers;
	}

	public function route(Request $request): RequestHandler
	{
		foreach ($this->requestHandlers as $requestHandler) {
			if ($requestHandler->getRoute() === $request->getPath()) {
				return $requestHandler;
			}
		}

		throw new \RuntimeException("could not route request");
	}
}