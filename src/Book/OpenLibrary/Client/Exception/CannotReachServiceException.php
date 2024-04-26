<?php

namespace App\Book\OpenLibrary\Client\Exception;

use Exception;
use JetBrains\PhpStorm\Pure;

class CannotReachServiceException extends Exception
{
    #[Pure] public function __construct(string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct('Service is unavailable', 500, $previous);
    }

}
