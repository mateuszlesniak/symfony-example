<?php

namespace App\Book\OpenLibrary\Client\Exception;

use Exception;
use JetBrains\PhpStorm\Pure;

class InvalidSearchDataException extends Exception
{
    #[Pure] public function __construct(string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct('Input data is invalid', 400, $previous);
    }
}
