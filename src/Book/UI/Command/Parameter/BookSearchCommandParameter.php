<?php

namespace App\Book\UI\Command\Parameter;

use App\Book\Shared\DTO\BookSearchCriteria;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\DependencyInjection\Attribute\AutoconfigureTag;

#[AutoconfigureTag('app.book.command.plugin')]
interface BookSearchCommandParameter
{
    public function expand(InputInterface $input, BookSearchCriteria &$bookSearchCriteria): void;
}
