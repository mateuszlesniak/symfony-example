<?php

declare(strict_types=1);

namespace App\Book;

use App\Book\OpenLibrary\DTO\BookDTO;
use App\Book\Shared\DTO\BookSearchCriteria;
use App\Book\Shared\Exception\CannotReachServiceException;
use App\Book\Shared\Exception\InvalidSearchDataException;

interface BookService
{
    /**
     * @return array<BookDTO>
     *
     * @throws CannotReachServiceException
     * @throws InvalidSearchDataException
     */
    public function searchBooks(BookSearchCriteria $bookSearchCriteria): array;
}
