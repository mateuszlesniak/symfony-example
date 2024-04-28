<?php

namespace App\Book\UI\Command\ResultFormatter;

use App\Book\OpenLibrary\DTO\BookDTO;

interface BookFormatter
{
    public function format(BookDTO $bookDTO): string;
}
