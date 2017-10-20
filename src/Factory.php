<?php

namespace gempir\api;

class Factory
{
	public function createRouter()
	{
		return new Router($this->createRootRequestHandler());
	}

	private function createRootRequestHandler()
	{
		return new RootRequestHandler();
	}
}