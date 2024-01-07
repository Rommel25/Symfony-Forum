<?php

namespace App\Command;

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
        private EntityManagerInterface $em
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
                $student->getUser()->setEmail(md5($student->getUser()->getEmail()));
                $student->getUser()->setNom(md5($student->getUser()->getNom()));
                $student->getUser()->setPrenom(md5($student->getUser()->getPrenom()));
                $student->getUser()->setTelephone(md5($student->getUser()->getTelephone()));
                $student->getUser()->setHashed(true);
            }
        }

        $this->em->flush();

        $io->success('Les utilisateurs ont été hashé');

        return Command::SUCCESS;
    }
}
