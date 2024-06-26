<?php

declare(strict_types=1);

namespace App\Book\UI\Command\ResultFormatter;

use App\Book\Application\Service\DTO\BookDTO;

interface BookFormatter
{
    public function format(BookDTO $bookDTO): string;
}
