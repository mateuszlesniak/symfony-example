<?php

namespace App\Book\OpenLibrary\Dto;

class BookDto
{
    public function __construct(
        private readonly string $authors,
        private readonly string $title,
    )
    {
    }

    public function getAuthors(): string
    {
        return $this->authors;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

}
