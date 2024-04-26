<?php

namespace App\Book\OpenLibrary\Formatter;

use App\Book\OpenLibrary\Dto\BookDto;

interface FormatterInterface
{
    public function format(array $doc): BookDto;
}
