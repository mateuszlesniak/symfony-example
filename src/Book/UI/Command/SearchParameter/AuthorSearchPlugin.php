<?php

declare(strict_types=1);

namespace App\Book\UI\Command\SearchParameter;

use App\Book\Infrastructure\DTO\BookSearchCriteria;
use App\Book\UI\Command\Parameters;
use Symfony\Component\Console\Input\InputInterface;

class AuthorSearchPlugin implements BookSearchCommandParameter
{
    #[\Override]
    public function expand(InputInterface $input, BookSearchCriteria &$bookSearchCriteria): void
    {
        if ($input->hasOption(Parameters::AUTHOR->name) && !empty($input->getOption(Parameters::AUTHOR->name))) {
            $bookSearchCriteria->setAuthor($input->getOption(Parameters::AUTHOR->name));
        }
    }
}
