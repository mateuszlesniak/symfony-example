<?php

namespace App\Book\OpenLibrary\SearchQuery;

use App\Book\OpenLibrary\Client\Exception\InvalidSearchDataException;
use App\Book\Search\SearchBuilderInterface;

class SearchBuilder implements SearchBuilderInterface
{
    const FIELD_TITLE = 'title';
    const FIELD_AUTHOR = 'author';
    const FIELD_SORT = 'sort';

    private array $data = [
        self::FIELD_AUTHOR => null,
        self::FIELD_TITLE => null,
        self::FIELD_SORT => null,
        'limit' => 10,
    ];

    #[\Override] public function addTitle(?string $title = null): SearchBuilderInterface
    {
        $this->data[self::FIELD_TITLE] = mb_strtolower($title);

        return $this;
    }

    #[\Override] public function addAuthor(?string $author = null): SearchBuilderInterface
    {
        $this->data[self::FIELD_AUTHOR] = mb_strtolower($author);

        return $this;
    }

    #[\Override] public function setSort(?string $sort = null): void
    {
        switch ($sort) {
            case 'asc':
                $sort = 'new';

                break;
            case 'desc':
            default:
                $sort = 'old';
        }

        $this->data[self::FIELD_SORT] = $sort;
    }

    /**
     * @return array
     * @throws InvalidSearchDataException
     */
    #[\Override] public function getSearchQuery(): array
    {
        $searchQuery = array_filter($this->data, function ($row) {
            return !empty($row);
        });

        if (count($searchQuery) < 2) {
            throw new InvalidSearchDataException();
        }

        return $searchQuery;
    }

}
