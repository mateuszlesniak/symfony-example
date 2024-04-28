<?php

declare(strict_types=1);

namespace App\Book\Infrastructure\OpenLibrary\Client;

use App\Book\Application\Service\DTO\BookDTO;

class OpenLibraryFactory
{
    public function createBook(array $doc): BookDTO
    {
        $bookDTO = (new BookDTO())
            ->setTitle($doc['title']);

        if (array_key_exists('author_name', $doc)) {
            foreach ($doc['author_name'] as $author) {
                $bookDTO->addAuthor($author);
            }
        }

        return $bookDTO;
    }
}
