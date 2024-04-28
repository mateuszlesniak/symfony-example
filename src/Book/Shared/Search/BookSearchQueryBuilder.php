<?php

namespace App\Book\Shared\Search;

use App\Book\Shared\DTO\BookSearchCriteria;

interface BookSearchQueryBuilder
{
    public function addTitle(BookSearchCriteria $bookSearchCriteria): self;

    public function addAuthor(BookSearchCriteria $bookSearchCriteria): self;

    public function sort(BookSearchCriteria $bookSearchCriteria): self;

    public function getSearchQuery(): array;
}
