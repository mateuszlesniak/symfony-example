<?php

namespace App\Book\Command\Decorator;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\DependencyInjection\Attribute\AutoconfigureTag;

#[AutoconfigureTag('app.book.command.decorator')]
interface BookCommandDecoratorInterface
{
    public function decorate(InputInterface $input, &$searchParameters): void;
}
