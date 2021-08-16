<?php

declare(strict_types=1);

namespace App\Book\Action;

use MongoDB\Collection;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class Create
{
    private Collection $collection;

    public function __construct(Collection $collection)
    {
        $this->collection = $collection;
    }

    public function __invoke(RequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $parsedBody = $request->getParsedBody();
        $result = $this->collection->insertOne([
            'name' => $parsedBody['name'],
            'description' => $parsedBody['description']
        ]);

        $data = ['id' => (string) $result->getInsertedId()];

        $response->getBody()->write(json_encode($data));
        return $response;
    }
}