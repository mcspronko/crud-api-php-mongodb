<?php

declare(strict_types=1);

namespace App\Book\Action;

use MongoDB\Client;
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
        $params = (array) $request->getParsedBody();

        /** @var \MongoDB\Model\BSONDocument $result */
        $result = $collection->findOneAndUpdate(
            ['_id' => $params['id']],
            [
                '$set' => [
                    'name' => $params['name'],
                    'description' => $params['description'],
                ],
            ],
            ['upsert' => true]
        );

        $data = ['success' => true];

        $response->getBody()->write(json_encode($data));
        return $response;
    }
}