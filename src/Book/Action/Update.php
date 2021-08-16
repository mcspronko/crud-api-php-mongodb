<?php

declare(strict_types=1);

namespace App\Book\Action;

use MongoDB\BSON\ObjectId;
use MongoDB\Collection;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class Update
{
    private Collection $collection;

    public function __construct(Collection $collection)
    {
        $this->collection = $collection;
    }

    public function __invoke(RequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $params = (array) $request->getParsedBody();

        $result = $this->collection->updateOne(
            ['_id' => new ObjectId($params['id'])],
            [
                '$set' => [
                    'name' => $params['name'],
                    'description' => $params['description'],
                ],
            ],
        );

        $data = ['success' => $result->isAcknowledged()];

        $response->getBody()->write(json_encode($data));
        return $response;
    }
}