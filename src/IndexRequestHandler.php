<?php

namespace gempir\api;

class IndexRequestHandler extends RequestHandler
{
	public function handle(Request $request): Response
	{
		$this->ensureHasReadAndWriteAccess($request);

		$headers = ["Content-Type" => "application/json"];

		return Response::fromParameters(json_encode(["message" => "indexed data"]), $headers);
	}

	public function getRoute(): string
	{
		return "/index";
	}
}