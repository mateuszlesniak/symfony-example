<?php

namespace App\Book\Command;

use App\Book\BookServiceInterface;
use App\Book\Command\Decorator\BookCommandDecoratorInterface;
use App\Book\OpenLibrary\Client\Exception\InvalidSearchDataException;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'app:open-library:search')]
final class OpenLibrarySearchCommand extends Command
{

    public function __construct(
        private readonly BookServiceInterface $bookApi,
        /** @var BookCommandDecoratorInterface[] $searchOptionDecorators */
        private readonly iterable $searchOptionDecorators,
    )
    {
        parent::__construct();
    }

    #[\Override] protected function configure()
    {
        $this
            ->setDescription('CLI command which allows search books in Open Library website')
            ->setHelp('See: https://openlibrary.org/')
            ->addOption(Parameters::TITLE->value, 't', InputArgument::OPTIONAL)
            ->addOption(Parameters::AUTHOR->value, 'a', InputArgument::OPTIONAL)
            ->addOption(Parameters::SORT->value, null, InputArgument::OPTIONAL);
    }

    #[\Override] protected function execute(InputInterface $input, OutputInterface $output): int
    {

        try {
            $searchParameters = $this->getSearchParameters($input);

            $response = $this->bookApi->searchBooks(
                $searchParameters[Parameters::TITLE->value] ?? null,
                $searchParameters[Parameters::AUTHOR->value] ?? null,
                $searchParameters[Parameters::SORT->value],
            );

            $output->writeln(sprintf('Found %d book(s)', count($response)));
            $output->writeln('----------------');
        } catch (InvalidSearchDataException $exception) {
            $output->writeln(sprintf('<fg=yellow>%s</> <fg=red>%s</>', $exception->getCode(), $exception->getMessage()));

            return Command::FAILURE;
        } catch (Exception $exception) {
            $output->writeln(sprintf('<fg=red>ERROR: %s</>', $exception->getMessage()));

            return Command::FAILURE;
        }

        foreach ($response as $book) {
            $output->writeln(sprintf(
                    '<fg=green>%s</> <fg=yellow>%s</>',
                    $book->getAuthors(),
                    $book->getTitle(),
                )
            );
        }

        return Command::SUCCESS;
    }

    private function getSearchParameters(InputInterface $input): array
    {
        $searchParameters = [];

        foreach ($this->searchOptionDecorators as $optionDecorator) {
            $optionDecorator->decorate($input, $searchParameters);
        }

        return $searchParameters;
    }
}
