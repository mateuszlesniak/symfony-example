<?php

declare(strict_types=1);

namespace App\Book\Application\Service;

use App\Book\Application\Exception\CannotReachServiceException;
use App\Book\Application\Exception\InvalidSearchDataException;
use App\Book\Application\Service\DTO\BookDTO;
use App\Book\Infrastructure\DTO\BookSearchCriteria;

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
