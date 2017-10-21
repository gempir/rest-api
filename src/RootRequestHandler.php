<?php

namespace gempir\api;

class RootRequestHandler extends RequestHandler
{
    public function handle(Request $request): Response
    {
        $headers = ["Content-Type" => "application/json"];

        return Response::fromParameters(
            json_encode(["Access-Token" => $this->accessHandler->generateReadToken()]),
            $headers
        );
    }

    public function getRoute(): string
    {
        return "/";
    }
}
