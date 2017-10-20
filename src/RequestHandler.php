<?php

namespace gempir\api;

interface RequestHandler
{
	public function handle(Request $request): Response;
}