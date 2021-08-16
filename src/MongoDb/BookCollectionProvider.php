<?php

namespace App\MongoDb;

use MongoDB\Collection;

class BookCollectionProvider
{
    private Collection $collection;

    public function __construct(Collection $collection)
    {
        $this->collection = $collection;
    }

    public function get(): Collection
    {
        return $this->collection;
    }
}
