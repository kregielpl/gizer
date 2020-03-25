<?php

namespace App\Command;

use App\Service\ScoreService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class ImportScoresCommand extends Command
{
    protected static $defaultName = 'app:import-scores';

    /** @var ScoreService */
    private $scoreService;

    /**
     * ImportScoresCommand constructor.
     * @param ScoreService $scoreService
     */
    public function __construct(ScoreService $scoreService)
    {
        parent::__construct();
        $this->scoreService = $scoreService;
    }

    protected function configure()
    {
        $this
            ->setDescription('Command import users score from api')
            ->setHelp('This command allows you to import all scores...')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $io->note('START import scores');

        $this->scoreService->importScores();

        $io->success('END import scores');

        return 0;
    }
}
