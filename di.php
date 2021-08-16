<?php

use App\Book\Action\Create;
use App\Book\Action\Delete;
use App\Book\Action\Read;
use App\Book\Action\Update;
use MongoDB\Client;

return [
    Create::class => DI\autowire()
        ->constructor(DI\get(Client::class)),
//    Read::class => DI\autowire()
//        ->constructor(DI\get(Client::class)),
    Update::class => DI\autowire()
        ->constructor(DI\get(Client::class)),
    Delete::class => DI\autowire()
        ->constructor(DI\get(Client::class)),
    Client::class => DI\autowire()
        ->constructor(getenv('MONGODB_URI')),
];
