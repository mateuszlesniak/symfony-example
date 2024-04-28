<?php

namespace App\Book\Shared\Exception;

use Exception;
use JetBrains\PhpStorm\Pure;
use Throwable;

class CannotReachServiceException extends Exception
{
    #[Pure] public function __construct(?Throwable $previous = null)
    {
        parent::__construct('Service is unavailable', 500, $previous);
    }

}
