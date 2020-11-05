<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use App\Services\Fetcher;

class ImportDataCommand extends Command
{
    // the name of the command (the part after "bin/console")

    private $fetcher;

    public function __construct(Fetcher $fetcher)
    {
        $this->fetcher = $fetcher;

        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setName('app:import-randomuser')
            ->setDescription('Import Data from the third party APIs')
            ->setHelp('This command allows you to import third party API');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $fetcher = $this->fetcher->get('https://randomuser.me/api?results=100&nat=au');

        $output->writeln([
            'Importing data from the third party APIs',
            '============',
            '',
        ]);

        $output->writeln('Done.');

        return Command::SUCCESS;
    }
}