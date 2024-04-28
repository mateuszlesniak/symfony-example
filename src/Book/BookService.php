<?php

namespace App\Book;

use App\Book\OpenLibrary\DTO\BookDTO;
use App\Book\Shared\DTO\BookSearchCriteria;
use App\Book\Shared\Exception\InvalidSearchDataException;

interface BookService
{
    /**
     * @param BookSearchCriteria $bookSearchCriteria
     *
     * @return array<BookDTO>
     *
     * @throws InvalidSearchDataException
     */
    public function searchBooks(BookSearchCriteria $bookSearchCriteria): array;
}
