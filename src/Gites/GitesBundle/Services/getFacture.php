<?php
namespace Gites\GitesBundle\Services;



use Symfony\Component\DependencyInjection\ContainerInterface;



class getFacture
{
        public function __construct(containerInterface $container)
    {
                $this->container = $container;


            }

    public function facture($facture)
    {
        //on stocke la vue à convertir en PDF, en n'oubliant pas les paramètres twig si la vue comporte des données dynamiques
        $html = $this->container->get('templating')->render('UtilisateursBundle:Default:layout/facturePDF.html.twig', array('facture' => $facture));

        //on instancie la classe Html2Pdf_Html2Pdf en lui passant en paramètre
        //le sens de la page "portrait" => p ou "paysage" => l
        //le format A4,A5...
        //la langue du document fr,en,it...
        $html2pdf = new \Html2Pdf_Html2Pdf('P','A4','fr');
        //SetDisplayMode définit la manière dont le document PDF va être affiché par l’utilisateur
        //fullpage : affiche la page entière sur l'écran
        //fullwidth : utilise la largeur maximum de la fenêtre
        //real : utilise la taille réelle
        $html2pdf->pdf->SetDisplayMode('real');
        $html2pdf->pdf->setAuthor('david');
        $html2pdf->pdf->setTitle('facture '.$facture->getReference());

        //writeHTML va tout simplement prendre la vue stocker dans la variable $html pour la convertir en format PDF
        $html2pdf->writeHTML($html);
        //Output envoit le document PDF au navigateur internet avec un nom spécifique qui aura un rapport avec le contenu à convertir (exemple : Facture, Règlement…)
       /*$pdf= $html2pdf->Output('Facture.pdf');
        $response = new Response();
$response->setContent($pdf);
        $response->headers->set('Content-Type', 'application/force-download');
        $response->headers->set('Content-disposition', 'attachment');
        $response->type('application/pdf');
        return $response;*/
        return $html2pdf;
    }
} 