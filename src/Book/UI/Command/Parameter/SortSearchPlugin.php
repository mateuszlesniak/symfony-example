<?php

declare(strict_types=1);

namespace App\Book\UI\Command\Parameter;

use App\Book\Shared\DTO\BookSearchCriteria;
use App\Book\Shared\Exception\InvalidSearchCriteriaException;
use App\Book\UI\Command\Parameters;
use Symfony\Component\Console\Input\InputInterface;

class SortSearchPlugin implements BookSearchCommandParameter
{
    #[\Override]
    public function expand(InputInterface $input, BookSearchCriteria &$bookSearchCriteria): void
    {
        if ($input->hasOption(Parameters::SORT->value)) {
            $sorting = $input->getOption(Parameters::SORT->value);

            try {
                $bookSearchCriteria->setSort($sorting);
            } catch (InvalidSearchCriteriaException) {
                $bookSearchCriteria->setDefaultSorting();
            }
        }
    }
}
