<?php

namespace gempir\api;

class Factory
{
    private $secretFile = __DIR__ . "/../secret";

    public function createApplication(): Application
    {
        return new Application($this->createRouter());
    }

    private function createRouter(): Router
    {
        return new Router(
            $this->createRootRequestHandler(),
            $this->createSearchRequestHandler(),
            $this->createIndexRequestHandler()
        );
    }

    private function createRootRequestHandler(): RootRequestHandler
    {
        return new RootRequestHandler($this->createAccessHandler());
    }

    private function createAccessHandler(): AccessHandler
    {
        return new AccessHandler(file_get_contents($this->secretFile));
    }

    private function createSearchRequestHandler(): SearchRequestHandler
    {
        return new SearchRequestHandler($this->createAccessHandler());
    }

    private function createIndexRequestHandler()
    {
        return new IndexRequestHandler($this->createAccessHandler());
    }
}