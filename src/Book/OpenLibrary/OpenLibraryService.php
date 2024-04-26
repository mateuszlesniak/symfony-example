<?php

namespace App\Book\OpenLibrary;

use App\Book\BookServiceInterface;
use App\Book\OpenLibrary\Client\Exception\InvalidSearchDataException;
use App\Book\OpenLibrary\Client\OpenLibraryApiInterface;
use App\Book\OpenLibrary\Dto\BookDto;
use App\Book\OpenLibrary\Formatter\FormatterInterface;
use App\Book\Search\SearchBuilderInterface;
use Symfony\Contracts\HttpClient\Exception\ExceptionInterface;

final class OpenLibraryService implements BookServiceInterface
{
    public function __construct(
        private readonly SearchBuilderInterface $builder,
        private readonly OpenLibraryApiInterface $openLibraryApi,
        private readonly FormatterInterface $formatter,
    )
    {
    }

    /**
     * @param string|null $title
     * @param string|null $author
     * @param string|null $sort
     *
     * @return array<BookDto>
     *
     * @throws InvalidSearchDataException
     */
    #[\Override] public function searchBooks(
        ?string $title = null,
        ?string $author = null,
        ?string $sort = null,
    ): array
    {
        $this->builder
            ->addTitle($title)
            ->addAuthor($author)
            ->setSort($sort);

        $searchQuery = $this->builder->getSearchQuery();

        try {
            $response = $this->openLibraryApi->search($searchQuery)['docs'];

            array_walk($response, function (array &$doc) {
                $doc = $this->formatter->format($doc);
            });

            return $response;
        } catch (ExceptionInterface $exception) {
            throw new InvalidSearchDataException(); //example of specific exception used in project
        }

    }

}
