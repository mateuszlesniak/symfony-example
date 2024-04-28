<?php

declare(strict_types=1);

namespace App\Book\Infrastructure\OpenLibrary\Client;

interface OpenLibraryClient
{
    public function search(array $queryParameters): array;
}
