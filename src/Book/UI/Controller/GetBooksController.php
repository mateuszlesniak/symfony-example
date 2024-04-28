<?php

declare(strict_types=1);

namespace App\Book\UI\Controller;

use App\Book\Application\Exception\CannotReachServiceException;
use App\Book\Application\Exception\InvalidSearchDataException;
use App\Book\Application\Service\BookService;
use App\Book\Infrastructure\DTO\BookSearchCriteria;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapQueryString;
use Symfony\Component\Routing\Attribute\Route;

final class GetBooksController extends AbstractController
{
    public function __construct(
        private readonly BookService $bookApi,
    ) {
    }

    #[Route('/api/books', name: 'api_get_books', format: 'json')]
    public function __invoke(
        #[MapQueryString(
            validationGroups: ['strict'],
            validationFailedStatusCode: Response::HTTP_UNPROCESSABLE_ENTITY
        )] BookSearchCriteria $bookSearchCriteria = new BookSearchCriteria(),
    ): JsonResponse {
        try {
            $books = $this->bookApi->searchBooks($bookSearchCriteria);
        } catch (CannotReachServiceException) {
            return $this->json(null, Response::HTTP_INTERNAL_SERVER_ERROR);
        } catch (InvalidSearchDataException) {
            return $this->json(null, Response::HTTP_BAD_REQUEST);
        }

        return $this->json($books);
    }
}
