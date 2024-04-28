<?php

declare(strict_types=1);

namespace App\Book\Infrastructure\OpenLibrary;

use App\Book\Application\Exception\CannotReachServiceException;
use App\Book\Application\Exception\InvalidSearchDataException;
use App\Book\Application\SearchQuery\BookSearchQueryBuilder;
use App\Book\Application\Service\BookService;
use App\Book\Application\Service\DTO\BookDTO;
use App\Book\Infrastructure\DTO\BookSearchCriteria;
use App\Book\Infrastructure\OpenLibrary\Client\OpenLibraryClient;
use App\Book\Infrastructure\OpenLibrary\Transformer\OpenLibraryResponseTransformer;
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
