<?php

declare(strict_types=1);

namespace App\Book\Shared\Exception;

use JetBrains\PhpStorm\Pure;

class CannotReachServiceException extends \Exception
{
    #[Pure]
    public function __construct(?\Throwable $previous = null)
    {
        parent::__construct('Service is unavailable', 500, $previous);
    }
}
