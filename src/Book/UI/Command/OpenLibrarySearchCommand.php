<?php

declare(strict_types=1);

namespace App\Book\UI\Command;

use App\Book\BookService;
use App\Book\Shared\DTO\BookSearchCriteria;
use App\Book\Shared\Exception\CannotReachServiceException;
use App\Book\Shared\Exception\InvalidSearchDataException;
use App\Book\UI\Command\Parameter\BookSearchCommandParameter;
use App\Book\UI\Command\ResultFormatter\BookFormatter;
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
        private readonly BookService $bookApi,
        private readonly BookFormatter $bookFormatter,
        /** @var BookSearchCommandParameter[] $searchOptionPlugins */
        private readonly iterable $searchOptionPlugins,
    ) {
        parent::__construct();
    }

    #[\Override]
    protected function configure()
    {
        $this
            ->setDescription('CLI command which allows search books in Open Library website')
            ->setHelp('See: https://openlibrary.org/')
            ->addOption(Parameters::TITLE->value, 't', InputArgument::OPTIONAL)
            ->addOption(Parameters::AUTHOR->value, 'a', InputArgument::OPTIONAL)
            ->addOption(Parameters::SORT->value, null, InputArgument::OPTIONAL);
    }

    #[\Override]
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        try {
            $bookSearchCriteria = $this->getSearchCriteria($input);

            $books = $this->bookApi->searchBooks($bookSearchCriteria);

            $output->writeln(sprintf('Found %d book(s)', count($books)));
            $output->writeln('----------------');
        } catch (InvalidSearchDataException|CannotReachServiceException $exception) {
            $output->writeln(sprintf('<fg=yellow>%s</> <fg=red>%s</>', $exception->getCode(), $exception->getMessage()));

            return Command::FAILURE;
        } catch (Exception $exception) {
            $output->writeln(sprintf('<fg=red>ERROR: %s</>', $exception->getMessage()));

            return Command::FAILURE;
        }

        foreach ($books as $book) {
            $output->writeln($this->bookFormatter->format($book));
        }

        return Command::SUCCESS;
    }

    private function getSearchCriteria(InputInterface $input): BookSearchCriteria
    {
        $bookSearchCriteria = new BookSearchCriteria();

        foreach ($this->searchOptionPlugins as $plugin) {
            $plugin->expand($input, $bookSearchCriteria);
        }

        return $bookSearchCriteria;
    }
}
