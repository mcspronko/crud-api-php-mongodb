<?php

declare(strict_types=1);

namespace App\Book\Action;

use MongoDB\Client;
use MongoDB\Model\BSONDocument;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class Read
{
    private Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function __invoke(RequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $collection = $this->client->test->books;

        $result = [];
        /** @var BSONDocument $book */
        foreach ($collection->find([]) as $book) {
            $result[] = [
                'id' => (string)$book->_id,
                'name' => $book->name,
                'description' => $book->description,
            ];
        }
        $response->getBody()->write(json_encode($result));
        return $response;
    }
}
