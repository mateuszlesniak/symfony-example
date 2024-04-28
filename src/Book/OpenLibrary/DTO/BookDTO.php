<?php

namespace App\Book\OpenLibrary\DTO;

class BookDTO
{
    private array $authors = [];
    private string $title;

    public function addAuthor(string $author): self
    {
        $this->authors[] = $author;

        return $this;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getAuthors(): array
    {
        return $this->authors;
    }

    public function getTitle(): string
    {
        return $this->title;
    }
}
