<?php

namespace App\Book\OpenLibrary\SearchQuery;

use App\Book\Shared\DTO\BookSearchCriteria;
use App\Book\Shared\Exception\InvalidSearchDataException;
use App\Book\Shared\Search\BookSearchQueryBuilder;

class BookSearchBuilder implements BookSearchQueryBuilder
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

    #[\Override] public function addTitle(BookSearchCriteria $bookSearchCriteria): BookSearchBuilder
    {
        $this->data[self::FIELD_TITLE] = mb_strtolower($bookSearchCriteria->getTitle());

        return $this;
    }

    #[\Override] public function addAuthor(BookSearchCriteria $bookSearchCriteria): BookSearchBuilder
    {
        $this->data[self::FIELD_AUTHOR] = mb_strtolower($bookSearchCriteria->getAuthor());

        return $this;
    }

    #[\Override] public function sort(BookSearchCriteria $bookSearchCriteria): BookSearchBuilder
    {
        switch ($bookSearchCriteria->getSort()) {
            case BookSearchCriteria::OPTION_SEARCH_ASC:
                $sort = 'new';

                break;
            case BookSearchCriteria::OPTION_SEARCH_DESC:
            default:
                $sort = 'old';
        }

        $this->data[self::FIELD_SORT] = $sort;

        return $this;
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
