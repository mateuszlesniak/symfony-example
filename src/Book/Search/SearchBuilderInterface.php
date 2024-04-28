<?php

namespace App\Book\Search;

use App\Book\Shared\DTO\BookSearchCriteria;

interface SearchBuilderInterface
{
    public function addTitle(BookSearchCriteria $bookSearchCriteria): self;

    public function addAuthor(BookSearchCriteria $bookSearchCriteria): self;

    public function sort(BookSearchCriteria $bookSearchCriteria): self;

    public function getSearchQuery(): array;
}
