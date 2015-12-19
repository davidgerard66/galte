<?php

namespace Gites\GitesBundle\DataFixtures\ORM;

//use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use Gites\GitesBundle\Entity\Media;

class MediaData extends AbstractFixture implements OrderedFixtureInterface
{

    public function load(ObjectManager $manager)
    {

        $media1 = new Media();
        $media1->setName('photo1');
        $media1->setGite($this->getReference('gite1'));
        $media1->setPath('fixture1.jpg');

        $media2 = new Media();
        $media2->setName('photo2');
        $media2->setGite($this->getReference('gite1'));
        $media2->setPath('fixture2.jpg');

        $media3 = new Media();
        $media3->setName('photo3');
        $media3->setGite($this->getReference('gite1'));
        $media3->setPath('fixture3.jpg');


        $manager->persist($media1);
        $manager->persist($media2);
        $manager->persist($media3);

        $manager->flush();
    }

    public function getOrder()
    {
        return 2;
    }
}