<?php

declare(strict_types=1);

namespace App\Book\Action;

use App\MongoDb\ClientFactory;
use MongoDB\Client;
use MongoDB\Model\BSONDocument;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class Update
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
        $result = $collection->updateOne(
            ['_id' => $parsedBody['id']],
            [
                'name' => $parsedBody['name'],
                'description' => $parsedBody['description']
            ]
        );

        $id = (string) $result->getUpsertedId();
        $data = ['id' => $id];

        $response->getBody()->write(json_encode($data));
        return $response;
    }
}