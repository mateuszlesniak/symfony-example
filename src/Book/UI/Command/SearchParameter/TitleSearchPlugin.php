<?php

declare(strict_types=1);

namespace App\Book\UI\Command\SearchParameter;

use App\Book\Infrastructure\DTO\BookSearchCriteria;
use App\Book\UI\Command\Parameters;
use Symfony\Component\Console\Input\InputInterface;

class TitleSearchPlugin implements BookSearchCommandParameter
{
    #[\Override]
    public function expand(InputInterface $input, BookSearchCriteria &$bookSearchCriteria): void
    {
        if ($input->hasOption(Parameters::TITLE->name) && !empty($input->getOption(Parameters::TITLE->name))) {
            $bookSearchCriteria->setTitle($input->getOption(Parameters::TITLE->name));
        }
    }
}
