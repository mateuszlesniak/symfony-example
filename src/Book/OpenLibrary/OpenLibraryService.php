<?php

namespace App\Book\OpenLibrary;

use App\Book\BookService;
use App\Book\OpenLibrary\Client\OpenLibraryClient;
use App\Book\OpenLibrary\DTO\BookDTO;
use App\Book\OpenLibrary\Transformer\OpenLibraryResponseTransformer;
use App\Book\Search\SearchBuilderInterface;
use App\Book\Shared\DTO\BookSearchCriteria;
use App\Book\Shared\Exception\CannotReachServiceException;
use Symfony\Contracts\HttpClient\Exception\ExceptionInterface;

final readonly class OpenLibraryService implements BookService
{
    public function __construct(
        private SearchBuilderInterface $builder,
        private OpenLibraryClient $openLibraryApi,
        private OpenLibraryResponseTransformer $responseTransformer,
    )
    {
    }

    /**
     * @param BookSearchCriteria $bookSearchCriteria
     *
     * @return array<BookDTO>
     *
     * @throws CannotReachServiceException
     */
    #[\Override] public function searchBooks(BookSearchCriteria $bookSearchCriteria): array
    {
        $this->builder
            ->addTitle($bookSearchCriteria)
            ->addAuthor($bookSearchCriteria)
            ->sort($bookSearchCriteria);

        $searchQuery = $this->builder->getSearchQuery();

        try {
            $response = $this->openLibraryApi->search($searchQuery)['docs'];

            return $this->responseTransformer->transformResponseToBookDTO($response);
        } catch (ExceptionInterface $exception) {
            throw new CannotReachServiceException();
        }

    }

}
