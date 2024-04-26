<?php

namespace App\Book\Command\Decorator;

use App\Book\Command\Parameters;
use Symfony\Component\Console\Input\InputInterface;

class SortDecorator implements BookCommandDecoratorInterface
{
    private const OPTIONS_SORTING = [
        'desc',
        'asc',
    ];

    #[\Override] public function decorate(InputInterface $input, &$searchParameters): void
    {
        if ($input->hasOption(Parameters::SORT->value)) {
            $sorting = $input->getOption(Parameters::SORT->value);

            if (!$this->isValidSortingValue($sorting)) {
                $searchParameters[Parameters::SORT->value] = self::OPTIONS_SORTING[0];

                return;
            }

            $searchParameters[Parameters::SORT->value] = $sorting;
        }
    }

    private function isValidSortingValue(?string $sort = null): bool
    {
        return in_array($sort, self::OPTIONS_SORTING);
    }
}
