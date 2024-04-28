<?php

namespace App\Book\OpenLibrary\Client;

use Symfony\Contracts\HttpClient\HttpClientInterface;

readonly final class OpenLibraryApi implements OpenLibraryClient
{
    private const ENDPOINT = 'https://openlibrary.org/search.json';

    public function __construct(
        private HttpClientInterface $httpClient,
    )
    {
    }

    #[\Override] public function search(array $queryParameters): array
    {
        $response = $this->httpClient->request(
            'GET',
            self::ENDPOINT,
            [
                'query' => $queryParameters,
            ]
        );

        return $response->toArray();
    }
}
