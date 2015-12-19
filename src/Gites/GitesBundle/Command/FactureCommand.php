<?php
namespace Gites\GitesBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class FactureCommand extends ContainerAwareCommand
{
    protected function configure()
    {
     $this->setName('Gites:facture')
          ->setDescription('ceci est une commande de test')
          ->addArgument('date',InputArgument::OPTIONAL, 'date de facturation des factures que vous souhaitez récuperer');

    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $date = new \DateTime();
        $em = $this->getContainer()->get('doctrine')->getManager();

        $factures = $em->getRepository("GitesBundle:Commandes")->byDateCommande($input->getArgument('date'));


        $output->writeln(count($factures) . ' factures generees.');
        if (count($factures) > 0)
        {
            $dir = $date->format('d-m-y h-i-s');
            mkdir('_facturation_tuto_command/'.$dir);

            foreach($factures as $facture)
            {
                $this->getContainer()->get('editeFacture')->facture($facture)->Output('_facturation_tuto_command/'.$dir.'/facture '.$facture->getReference().'.pdf', 'F');
            }
        }
    }



}
