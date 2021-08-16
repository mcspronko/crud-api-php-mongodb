<?php

use App\Book\Action\Update;
use App\MongoDb\BookCollectionProvider;
use MongoDB\Client;
use Psr\Container\ContainerInterface;

return [
    Client::class => DI\autowire()
        ->constructor(getenv('MONGODB_URI')),

    BookCollectionProvider::class => DI\autowire()
        ->constructor(function (ContainerInterface $container) {
            return $container->get(Client::class)->test->books;
        }),

    Update::class => DI\autowire()
        ->constructor(function (ContainerInterface $container) {
            return $container->get(BookCollectionProvider::class)->get();
        })
];
