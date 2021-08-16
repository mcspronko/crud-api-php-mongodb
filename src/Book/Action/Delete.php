<?php

declare(strict_types=1);

namespace App\Book\Action;

use MongoDB\BSON\ObjectId;
use MongoDB\Collection;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class Delete
{
    private Collection $collection;

    public function __construct(Collection $collection)
    {
        $this->collection = $collection;
    }

    public function __invoke(RequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $params = (array) $request->getParsedBody();
        $deleteResult = $this->collection->deleteOne([
            '_id' => new ObjectId($params['id']),
        ]);

        $isDeleted = $deleteResult->getDeletedCount() > 0;
        $result = [
            'result' => $isDeleted,
            'message' => $isDeleted ?
                'The book has been successfully deleted.' :
                'Failed to delete book with the id provided.'
        ];

        $response->getBody()->write(json_encode($result));
        return $response;
    }
}