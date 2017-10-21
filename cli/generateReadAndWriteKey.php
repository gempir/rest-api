<?php

namespace gempir\api;

require __DIR__ . "/../vendor/autoload.php";

$accessHandler = new AccessHandler(file_get_contents(__DIR__ . "/../secret"));
echo $accessHandler->generateReadAndWriteToken();