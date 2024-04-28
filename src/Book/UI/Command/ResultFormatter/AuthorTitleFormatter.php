<?php

declare(strict_types=1);

namespace App\Book\UI\Command\ResultFormatter;

use App\Book\Application\Service\DTO\BookDTO;

final class AuthorTitleFormatter implements BookFormatter
{
    #[\Override]
    public function format(BookDTO $bookDTO): string
    {
        return sprintf(
            '<fg=green>%s</> - <fg=yellow>%s</>',
            $this->getBookAuthors($bookDTO),
            $this->getBookTitle($bookDTO),
        );
    }

    private function getBookAuthors(BookDTO $bookDTO): string
    {
        $authors = trim(implode(', ', $bookDTO->getAuthors()));

        if (empty($authors)) {
            return BookDTO::getUnknownAuthor();
        }

        return $authors;
    }

    private function getBookTitle(BookDTO $bookDTO): string
    {
        return $bookDTO->getTitle() ?? BookDTO::getUnknownTitle();
    }
}
