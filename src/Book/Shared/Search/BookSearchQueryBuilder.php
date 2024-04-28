<?php

namespace App\Book\Shared\Search;

use App\Book\Shared\DTO\BookSearchCriteria;
use App\Book\Shared\Exception\InvalidSearchDataException;

interface BookSearchQueryBuilder
{
    public function addTitle(BookSearchCriteria $bookSearchCriteria): self;

    public function addAuthor(BookSearchCriteria $bookSearchCriteria): self;

    public function sort(BookSearchCriteria $bookSearchCriteria): self;

    /**
     * @return array<string, string>
     *
     * @throws InvalidSearchDataException
     */
    public function getSearchQuery(): array;
}
