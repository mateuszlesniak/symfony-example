<?php

namespace App\Book\Shared\Exception;

use Exception;
use JetBrains\PhpStorm\Pure;
use Throwable;

class InvalidSearchDataException extends Exception
{
    #[Pure] public function __construct(?Throwable $previous = null)
    {
        parent::__construct('Input data is invalid', 400, $previous);
    }
}
