<?php

declare(strict_types=1);

namespace App\Book\OpenLibrary\Transformer;

use App\Book\OpenLibrary\Client\OpenLibraryFactory;
use App\Book\OpenLibrary\DTO\BookDTO;

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
