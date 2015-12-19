<?php

namespace Gites\GitesBundle\DataFixtures\ORM;

//use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use Gites\GitesBundle\Entity\Gites;

class GitesData extends AbstractFixture implements OrderedFixtureInterface
{

    public function load(ObjectManager $manager)
    {

        $gite1 = new Gites();
        $gite1->setNom('Les Rosiers');
        $gite1->setVille('Odeillo - Font-Romeu');
        $gite1->setEpis(3);
        $gite1->setPersonnes(6);
        $gite1->setChambres('3');
        $gite1->setSurface('136');
        $gite1->setAnimauxAcceptes(1);
        $gite1->setCvAcceptes(1);
        $gite1->setUrlDispo('http://www.gites-de-france-66.com/location-vacances-Gite-a-Font-romeu-odeillo-via-Pyrenees-Orientales-112406.html');
        $gite1->setUrlTarif('http://www.gites-de-france-66.com/location-vacances-Gite-a-Font-romeu-odeillo-via-Pyrenees-Orientales-112406.html');
        $gite1->setUrlMap('http://www.gites-galte.fr/gites-ruraux-cerdagne/_situation_fontromeu.html?height=680&width=640');

        $gite1->setDescription('Grande maison de caractères stiuée au village d\'odeillo,
                                commune de font-romeu, à 5km des départs de randonnées et des pistes de ski,
                                à 10mn des sources d\'eaux chaudes, 15mn de l\'Espagne et 40mn de la principauté d\'Andoore,
                            et 1h de la plaine du roussillon et de Perpignan');

        $gite1->setEquipements('Rez-de-chaussée :
                Jardin avec barbecue, garage, cellier équipé d\'une machine à laver,
                d\'un sèche linge et d\'une table de ping-pong.

                    1er étage :
                Jardin d\'hiver, cuisine (vaisselle, micro-ondes, cafetière,
                lave-vaisselle), salon avec cheminée, salle à manger avec télé
                et lecteur DVD, WC.

                2e étage :
                2 chambres doubles (grand lit) donnant sur une terrasse,
                une chambre avec 2 lits simples superposés, une salle de bain
                avec douche et WC.');




        $gite2 = new Gites();
        $gite2->setNom('Les Jonquilles');
        $gite2->setVille('Saint piette del forcats');
        $gite2->setEpis(2);
        $gite2->setPersonnes(4);
        $gite2->setChambres('2');
        $gite2->setSurface('50');
        $gite2->setAnimauxAcceptes(1);
        $gite2->setCvAcceptes(1);
        $gite2->setUrlDispo('http://www.gites-de-france-66.com/location-vacances-Gite-a-Font-romeu-odeillo-via-Pyrenees-Orientales-112406.html');
        $gite2->setUrlTarif('http://www.gites-de-france-66.com/location-vacances-Gite-a-Font-romeu-odeillo-via-Pyrenees-Orientales-112406.html');
        $gite2->setUrlMap('http://www.gites-galte.fr/gites-ruraux-cerdagne/_situation_fontromeu.html?height=680&width=640');

        $gite2->setDescription('Grande maison de caractères stiuée au village d\'odeillo,
                                commune de font-romeu, à 5km des départs de randonnées et des pistes de ski,
                                à 10mn des sources d\'eaux chaudes, 15mn de l\'Espagne et 40mn de la principauté d\'Andoore,
                            et 1h de la plaine du roussillon et de Perpignan');

        $gite2->setEquipements('Rez-de-chaussée :
                Jardin avec barbecue, garage, cellier équipé d\'une machine à laver,
                d\'un sèche linge et d\'une table de ping-pong.

                    1er étage :
                Jardin d\'hiver, cuisine (vaisselle, micro-ondes, cafetière,
                lave-vaisselle), salon avec cheminée, salle à manger avec télé
                et lecteur DVD, WC.

                2e étage :
                2 chambres doubles (grand lit) donnant sur une terrasse,
                une chambre avec 2 lits simples superposés, une salle de bain
                avec douche et WC.');


        $gite3 = new Gites();
        $gite3->setNom('Les Coquelicots');
        $gite3->setVille('Saint pierre del forcats');
        $gite3->setEpis(2);
        $gite3->setPersonnes(4);
        $gite3->setChambres('2');
        $gite3->setSurface('50');
        $gite3->setAnimauxAcceptes(1);
        $gite3->setCvAcceptes(1);
        $gite3->setUrlDispo('http://www.gites-de-france-66.com/location-vacances-Gite-a-Font-romeu-odeillo-via-Pyrenees-Orientales-112406.html');
        $gite3->setUrlTarif('http://www.gites-de-france-66.com/location-vacances-Gite-a-Font-romeu-odeillo-via-Pyrenees-Orientales-112406.html');
        $gite3->setUrlMap('http://www.gites-galte.fr/gites-ruraux-cerdagne/_situation_fontromeu.html?height=680&width=640');

        $gite3->setDescription('Grande maison de caractères stiuée au village d\'odeillo,
                                commune de font-romeu, à 5km des départs de randonnées et des pistes de ski,
                                à 10mn des sources d\'eaux chaudes, 15mn de l\'Espagne et 40mn de la principauté d\'Andoore,
                            et 1h de la plaine du roussillon et de Perpignan');

        $gite3->setEquipements('Rez-de-chaussée :
                Jardin avec barbecue, garage, cellier équipé d\'une machine à laver,
                d\'un sèche linge et d\'une table de ping-pong.

                    1er étage :
                Jardin d\'hiver, cuisine (vaisselle, micro-ondes, cafetière,
                lave-vaisselle), salon avec cheminée, salle à manger avec télé
                et lecteur DVD, WC.

                2e étage :
                2 chambres doubles (grand lit) donnant sur une terrasse,
                une chambre avec 2 lits simples superposés, une salle de bain
                avec douche et WC.');




        $manager->persist($gite1);
        $manager->persist($gite2);
        $manager->persist($gite3);
        $manager->flush();

        $this->addReference('gite1',$gite1);


    }

    public function getOrder()
    {
        return 1;
    }
}