<?php

namespace App\Command;

use App\Service\EncryptDataService;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use App\Repository\LyceenRepository;


#[AsCommand(
    name: 'app:encrypt-data',
    description: 'Add a short description for your command',
)]
class EncryptDataCommand extends Command
{
    public function __construct(
        private LyceenRepository $lyceenRepository,
        private EntityManagerInterface $em,
        private EncryptDataService $encryptDataService
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
        $students = $this->lyceenRepository->findAll();

        foreach ($students as $student) {
            if (!$student->getUser()->isHashed()) {
                $this->encryptDataService->hashService($student);
            }
        }

        $this->em->flush();

        $io->success('Les utilisateurs ont été hashé');

        return Command::SUCCESS;
    }
}
