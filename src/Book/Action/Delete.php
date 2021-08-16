<?php

declare(strict_types=1);

namespace App\Book\Action;

use MongoDB\Client;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class Delete
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
        $deleteResult = $collection->deleteOne([
            '_id' => $parsedBody['id'],
        ]);

        $result = [
            'result' => $deleteResult->getDeletedCount() > 0,
            'message' => $deleteResult->getDeletedCount() > 0 ?
                'The book has been successfully deleted.' :
                'Failed to delete book with the id provided.'
        ];

        $response->getBody()->write(json_encode($result));
        return $response;
    }
}