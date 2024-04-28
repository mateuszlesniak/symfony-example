<?php

declare(strict_types=1);

namespace App\Book\UI\Command\SearchParameter;

use App\Book\Infrastructure\DTO\BookSearchCriteria;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\DependencyInjection\Attribute\AutoconfigureTag;

#[AutoconfigureTag('app.book.command.plugin')]
interface BookSearchCommandParameter
{
    public function expand(InputInterface $input, BookSearchCriteria &$bookSearchCriteria): void;
}
