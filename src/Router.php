<?php

namespace App;

use App\Book\Action\Create;
use App\Book\Action\Delete;
use App\Book\Action\Read;
use App\Book\Action\Update;
use Slim\App;

class Router
{
    public function configure(App $app)
    {
        $app->addRoutingMiddleware();
        $app->addErrorMiddleware(true, true, true);

        $app->get('/read', Read::class);
        $app->post('/update', Update::class);
        $app->post('/delete', Delete::class);
        $app->post('/create', Create::class);
    }
}