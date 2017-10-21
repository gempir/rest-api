<?php

namespace gempir\api;

require __DIR__ . "/../vendor/autoload.php";

$factory = new Factory();
$application = $factory->createApplication();

$application->run();