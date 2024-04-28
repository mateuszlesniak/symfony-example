<?php

declare(strict_types=1);

namespace App\Book\Infrastructure\OpenLibrary\Transformer;

use App\Book\Application\Service\DTO\BookDTO;
use App\Book\Infrastructure\OpenLibrary\Client\OpenLibraryFactory;

final readonly class OpenLibraryResponseTransformer
{
    public function __construct(
        private OpenLibraryFactory $openLibraryFactory,
    ) {
    }

    /**
     * @param array<mixed> $response
     *
     * @return array<BookDTO>
     */
    public function transformResponseToBookDTO(array $response): array
    {
        $bookDTOs = [];

        array_walk($response, function (array $document) use (&$bookDTOs) {
            $bookDTOs[] = $this->openLibraryFactory->createBook($document);
        });

        return $bookDTOs;
    }
}
