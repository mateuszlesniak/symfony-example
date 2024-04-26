<?php

namespace App\Book\OpenLibrary\Client;

interface OpenLibraryApiInterface
{
    public function search(array $queryParameters):array;
}
