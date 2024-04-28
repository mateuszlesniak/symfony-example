<?php

declare(strict_types=1);

namespace App\Book\Application\SearchQuery;

use App\Book\Application\Exception\InvalidSearchDataException;
use App\Book\Infrastructure\DTO\BookSearchCriteria;

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
