<?php

namespace App\Book\UI\Command\Parameter;

use App\Book\Shared\DTO\BookSearchCriteria;
use App\Book\UI\Command\Parameters;
use Symfony\Component\Console\Input\InputInterface;

class AuthorSearchPlugin implements BookSearchCommandParameter
{
    #[\Override] public function expand(InputInterface $input, BookSearchCriteria &$bookSearchCriteria): void
    {
        if ($input->hasOption(Parameters::AUTHOR->value) && !empty($input->getOption(Parameters::AUTHOR->value))) {
            $bookSearchCriteria->setAuthor($input->getOption(Parameters::AUTHOR->value));
        }
    }

}
