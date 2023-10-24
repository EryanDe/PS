<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\protocoles;



class ProtocolesFixture extends Fixture
{
    public function load(ObjectManager $manager): void
{
    $protocole = new protocoles();
    $protocole->setNomProtocole("Sport");
    $protocole->setDescriptionProtocole("Ceci est la description du protocole sport");
    $protocole->setPrixProtocole("10");
    $protocole->setImageProtocole("#");
    

    $manager->persist($protocole);
    $manager->flush();
}

}

