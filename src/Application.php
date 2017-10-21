<?php

namespace gempir\api;

/**
 * @codeCoverageIgnoreFile
 */
class Application
{
    /** @var Router */
    private $router;

    public function __construct(Router $router)
    {
        $this->router = $router;
    }

    public function run()
    {
        try {
            $request = Request::fromGlobalState();

            $requestHandler = $this->router->route($request);
            $response = $requestHandler->handle($request);

            foreach ($response->getHeaders() as $key => $value) {
                header($key . ": " . $value);
            }

            echo (string) $response;
        } catch (\Exception $e) {
            http_response_code(400);
            header("Content-Type: application/json");
            echo json_encode(["error" => $e->getMessage()]);
        }
    }
}
