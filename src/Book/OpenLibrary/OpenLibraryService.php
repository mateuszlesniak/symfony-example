<?php

declare(strict_types=1);

namespace App\Book\OpenLibrary;

use App\Book\BookService;
use App\Book\OpenLibrary\Client\OpenLibraryClient;
use App\Book\OpenLibrary\DTO\BookDTO;
use App\Book\OpenLibrary\Transformer\OpenLibraryResponseTransformer;
use App\Book\Shared\DTO\BookSearchCriteria;
use App\Book\Shared\Exception\CannotReachServiceException;
use App\Book\Shared\Exception\InvalidSearchDataException;
use App\Book\Shared\Search\BookSearchQueryBuilder;
use Symfony\Contracts\HttpClient\Exception\ExceptionInterface;

final readonly class OpenLibraryService implements BookService
{
    public function __construct(
        private BookSearchQueryBuilder $builder,
        private OpenLibraryClient $openLibraryApi,
        private OpenLibraryResponseTransformer $responseTransformer,
    ) {
    }

    /**
     * @return array<BookDTO>
     *
     * @throws CannotReachServiceException
     * @throws InvalidSearchDataException
     */
    #[\Override]
    public function searchBooks(BookSearchCriteria $bookSearchCriteria): array
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
