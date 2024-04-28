<?php

declare(strict_types=1);

namespace App\Book\Application\Service\DTO;

class BookDTO implements \JsonSerializable
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

    #[\Override]
    public function jsonSerialize(): array
    {
        return [
            'author' => $this->getBookAuthors(),
            'title' => $this->getBookTitle(),
        ];
    }

    public static function getUnknownAuthor(): string
    {
        return 'Unknown author';
    }

    public static function getUnknownTitle(): string
    {
        return 'Unknown title';
    }

    private function getBookAuthors(): string
    {
        $authors = trim(implode(', ', $this->getAuthors()));

        if (empty($authors)) {
            return self::getUnknownAuthor();
        }

        return $authors;
    }

    private function getBookTitle(): string
    {
        return $this->getTitle() ?? self::getUnknownTitle();
    }
}
