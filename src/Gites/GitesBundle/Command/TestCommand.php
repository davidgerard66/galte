<?php
namespace Gites\GitesBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class TestCommand extends ContainerAwareCommand
{
    protected function configure()
    {
     $this->setName('premier:test')
          ->setDescription('ceci est une commande de test')
          ->addArgument('toto',InputArgument::OPTIONAL, 'date du jour');

    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $date = $input->getArgument('toto');
        if ($date=='21/09/2014')
        $output->writeln('bonjour félicitatop, voici votre premier test : '.$date );
        else
            $output->writeln('mauvaise date' );

        //parent::execute($input, $output);

    }





}
