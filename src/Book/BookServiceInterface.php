<?php

namespace App\Book;

use App\Book\OpenLibrary\Client\Exception\InvalidSearchDataException;
use App\Book\OpenLibrary\Dto\BookDto;

interface BookServiceInterface
{
    /**
     * @param string|null $title
     * @param string|null $author
     * @param string|null $sort
     *
     * @return array<BookDto>
     *
     * @throws InvalidSearchDataException
     */
    public function searchBooks(
        ?string $title = null,
        ?string $author = null,
        ?string $sort = null,
    ): array;
}
