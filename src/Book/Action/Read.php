<?php

declare(strict_types=1);

namespace App\Book\Action;

use MongoDB\Collection;
use MongoDB\Model\BSONDocument;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class Read
{
    private Collection $collection;

    public function __construct(Collection $collection)
    {
        $this->collection = $collection;
    }

    public function __invoke(RequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $result = [];
        /** @var BSONDocument $book */
        foreach ($this->collection->find([]) as $book) {
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
