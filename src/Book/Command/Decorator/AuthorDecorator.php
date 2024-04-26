<?php

namespace App\Book\Command\Decorator;

use App\Book\Command\Parameters;
use Symfony\Component\Console\Input\InputInterface;

class AuthorDecorator implements BookCommandDecoratorInterface
{
    #[\Override] public function decorate(InputInterface $input, &$searchParameters): void
    {
        if ($input->hasOption(Parameters::AUTHOR->value) && !empty($input->getOption(Parameters::AUTHOR->value))) {
            $searchParameters[Parameters::AUTHOR->value] = $input->getOption(Parameters::AUTHOR->value);
        }
    }

}
