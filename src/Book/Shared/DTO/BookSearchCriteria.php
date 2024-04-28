<?php

namespace App\Book\Shared\DTO;

use App\Book\Shared\Exception\InvalidSearchCriteriaException;

class BookSearchCriteria
{
    private ?string $author = null;
    private ?string $title = null;
    private string $sort = self::OPTION_SEARCH_DESC;

    public const string OPTION_SEARCH_DESC = 'desc';
    public const string OPTION_SEARCH_ASC = 'asc';

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function setAuthor(?string $author): void
    {
        $this->author = $author;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): void
    {
        $this->title = $title;
    }

    public function getSort(): string
    {
        return $this->sort;
    }

    /**
     * @param string $sort
     * @return void
     *
     * @throws InvalidSearchCriteriaException
     */
    public function setSort(string $sort): void
    {
        if (!in_array($sort, self::getSortingOptions())) {
            throw new InvalidSearchCriteriaException();
        }

        $this->sort = $sort;
    }

    public function setDefaultSorting(): void
    {
        $this->setSort(self::OPTION_SEARCH_DESC);
    }

    /**
     * @return array<string>
     */
    public static function getSortingOptions(): array
    {
        return [
            self::OPTION_SEARCH_DESC,
            self::OPTION_SEARCH_ASC,
        ];
    }
}
