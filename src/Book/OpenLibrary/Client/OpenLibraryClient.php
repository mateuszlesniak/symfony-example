<?php

namespace App\Book\OpenLibrary\Client;

interface OpenLibraryClient
{
    public function search(array $queryParameters):array;
}
