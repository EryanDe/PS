<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\exercices;
use App\Entity\protocoles;


class ExercicesFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
{
    $protocole = new protocoles();
    $protocole->setNomProtocole("Sport");
    $protocole->setDescriptionProtocole("Ceci est la description du protocole sport");
    $protocole->setPrixProtocole("10");
    $protocole->setImageProtocole("#");
    
    $exercice = new exercices();
    $exercice->setTitreExercice("Squat titre exo 1");
    $exercice->setDureeExercice("15.00");
    $exercice->setFrequenceExercice("3");
    $exercice->setEtatExercice("1");
    $exercice->setMaterielExercice("haletre");
    $exercice->setContenuFacileExercice("1");
    $exercice->setContenuDifficileExercice("0");
    $exercice->setProtocoles($protocole);
    // $exercice->setSemaines(0, 0 , 0);
    $manager->persist($exercice);
    $manager->flush();
}
}

