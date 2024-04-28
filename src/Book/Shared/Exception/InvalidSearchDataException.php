<?php

declare(strict_types=1);

namespace App\Book\Shared\Exception;

use JetBrains\PhpStorm\Pure;

class InvalidSearchDataException extends \Exception
{
    #[Pure]
    public function __construct(?\Throwable $previous = null)
    {
        parent::__construct('Input data is invalid', 400, $previous);
    }
}
