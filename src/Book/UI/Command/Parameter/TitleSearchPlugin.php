<?php

namespace App\Book\UI\Command\Parameter;

use App\Book\Shared\DTO\BookSearchCriteria;
use App\Book\UI\Command\Parameters;
use Symfony\Component\Console\Input\InputInterface;

class TitleSearchPlugin implements BookSearchCommandParameter
{
    #[\Override] public function expand(InputInterface $input, BookSearchCriteria &$bookSearchCriteria): void
    {
        if ($input->hasOption(Parameters::TITLE->value) && !empty($input->getOption(Parameters::TITLE->value))) {
            $bookSearchCriteria->setTitle($input->getOption(Parameters::TITLE->value));
        }
    }

}
