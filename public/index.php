<?php

require __DIR__ . '/../vendor/autoload.php';

use App\Bootstrap;

$app = new Bootstrap();
$app->configure(
    dirname(__DIR__) . '/di.php',
    dirname(__DIR__) . '/.env'
);

$app->run();
