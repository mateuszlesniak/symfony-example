<?php

declare(strict_types=1);

namespace App\Book\UI\Command\SearchParameter;

use App\Book\Application\Exception\InvalidSearchCriteriaException;
use App\Book\Infrastructure\DTO\BookSearchCriteria;
use App\Book\UI\Command\Parameters;
use Symfony\Component\Console\Input\InputInterface;

class SortSearchPlugin implements BookSearchCommandParameter
{
    #[\Override]
    public function expand(InputInterface $input, BookSearchCriteria &$bookSearchCriteria): void
    {
        if ($input->hasOption(Parameters::SORT->name)) {
            $sorting = $input->getOption(Parameters::SORT->name);

            try {
                $bookSearchCriteria->setSort($sorting);
            } catch (InvalidSearchCriteriaException) {
                $bookSearchCriteria->setDefaultSorting();
            }
        }
    }
}
