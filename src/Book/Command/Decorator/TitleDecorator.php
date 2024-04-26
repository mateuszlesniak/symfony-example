<?php

namespace App\Book\Command\Decorator;

use App\Book\Command\Parameters;
use Symfony\Component\Console\Input\InputInterface;

class TitleDecorator implements BookCommandDecoratorInterface
{
    #[\Override] public function decorate(InputInterface $input, &$searchParameters): void
    {
        if ($input->hasOption(Parameters::TITLE->value) && !empty($input->getOption(Parameters::TITLE->value))) {
            $searchParameters[Parameters::TITLE->value] = $input->getOption(Parameters::TITLE->value);
        }
    }

}
