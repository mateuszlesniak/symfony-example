<?php

namespace App\Book\OpenLibrary\Formatter;

use App\Book\OpenLibrary\Dto\BookDto;

class AuthorTitleFormatter implements FormatterInterface
{
    #[\Override] public function format(array $doc): BookDto
    {
        return new BookDto($this->getAuthors($doc), $doc['title']);
    }

    private function getAuthors(array $doc): string
    {
        if (!array_key_exists('author_name', $doc)) {
            return 'Unknown author';
        }

        return implode(', ', $doc['author_name']);
    }
}
