<?php

namespace gempir\api;

abstract class RequestHandler
{
    /** @var AccessHandler */
    protected $accessHandler;

    public function __construct(AccessHandler $accessHandler)
    {
        $this->accessHandler = $accessHandler;
    }

    abstract public function handle(Request $request): Response;

    abstract public function getRoute(): string;

    protected function ensureHasReadAccess(Request $request)
    {
        $token = $this->getAccessToken($request);

        if (!$this->accessHandler->hasReadAccess($token)) {
            throw new AccessException("Access-Token does not allow read access");
        }
    }

    private function getAccessToken(Request $request): string
    {
        $headers = $request->getHeaders();

        if (!array_key_exists("Access-Token", $headers)) {
            throw new AccessException("Access-Token not found in request headers");
        }

        return $headers['Access-Token'];
    }

    protected function ensureHasReadAndWriteAccess(Request $request)
    {
        $token = $this->getAccessToken($request);

        if (!$this->accessHandler->hasReadAndWriteAccess($token)) {
            throw new AccessException("Access-Token does not allow read and write access");
        }
    }
}
