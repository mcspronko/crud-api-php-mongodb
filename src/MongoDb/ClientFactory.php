<?php

namespace App\MongoDb;

use MongoDB\Client;

class ClientFactory
{
    private string $uri;

    public function __construct(string $uri)
    {
        $this->uri = $uri;
    }

    public function connect(): Client
    {
        return new Client($this->uri);
    }
}