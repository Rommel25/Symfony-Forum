<?php

namespace App\Command;

use App\Repository\AtelierRepository;
use App\Repository\SalleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:AutoAssign',
    description: 'Add a short description for your command',
)]
class AutoAssignCommand extends Command
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private AtelierRepository $atelierRepository,
        private SalleRepository $salleRepository
    )
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $ateliers = $this->atelierRepository->findAll();
        $salles = $this->salleRepository->findAll();

        foreach ($ateliers as $atelier) {
            $nbrInscrits = $atelier->getLyceens()->count();

            foreach ($salles as $salle) {
                if ($nbrInscrits <= $salle->getCappacite()) {
                    $salle->addAtelier($atelier);
                    $salle->setCappacite($salle->getCappacite() - $nbrInscrits);
                    $this->entityManager->persist($salle);
                }
            }
            $this->entityManager->flush();

        }

        $io->success('Repartition effectué');

        return Command::SUCCESS;
    }
}
