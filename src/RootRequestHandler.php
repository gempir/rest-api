<?php

namespace gempir\api;

class RootRequestHandler implements RequestHandler
{
	public function handle(Request $request): Response
	{
		return Response::fromString("Hello World");
	}
}