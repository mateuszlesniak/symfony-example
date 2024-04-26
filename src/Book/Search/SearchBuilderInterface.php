<?php

namespace App\Book\Search;

interface SearchBuilderInterface
{
    public function addTitle(?string $title = null): self;

    public function addAuthor(?string $author = null): self;

    public function setSort(?string $sort = null): void;

    public function getSearchQuery(): array;
}
