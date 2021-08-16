<?php

declare(strict_types=1);

namespace App\Book\Action;

use App\MongoDb\ClientFactory;
use MongoDB\Client;
use MongoDB\Model\BSONDocument;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class Create
{
    private Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function __invoke(RequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $collection = $this->client->test->books;
        $parsedBody = $request->getParsedBody();
        $result = $collection->insertOne([
            'name' => $parsedBody['name'],
            'description' => $parsedBody['description']
        ]);

        $data = ['id' => (string) $result->getInsertedId()];

        $response->getBody()->write(json_encode($data));
        return $response;
    }
}