<?php

use MongoDB\Client;

return [
    Client::class => DI\autowire()
        ->constructor(getenv('MONGODB_URI')),
];
