<?php

namespace gempir\api;

class Router
{
	/** @var RootRequestHandler */
	private $rootRequestHandler;

	public function __construct(RootRequestHandler $rootRequestHandler)
	{
		$this->rootRequestHandler = $rootRequestHandler;
	}

	public function route(Request $request): RequestHandler
	{
		switch ($request->getPath()) {
			case "/":
				return $this->rootRequestHandler;
			default:
				throw new \RuntimeException("could not route request");
		}
	}
}