<?php

namespace gempir\api;

class SearchRequestHandler extends RequestHandler
{
    public function handle(Request $request): Response
    {
        $this->ensureHasReadAccess($request);

        $headers = ["Content-Type" => "application/json"];

        return Response::fromParameters(json_encode(["results" => ["dummy"]]), $headers);
    }

    public function getRoute(): string
    {
        return "/search";
    }
}
