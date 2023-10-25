<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Exercices;
use App\Entity\Protocoles;
use App\Entity\Semaines;

class ExercicesFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
{
    $protocole = new Protocoles();
    $protocole->setNomProtocole("Sport");
    $protocole->setDescriptionProtocole("Ceci est la description du protocole sport");
    $protocole->setPrixProtocole("10");
    $protocole->setImageProtocole("#");

    $semaine = new Semaines();
    $semaine->setTitreSemaine("Semaine 1");
    $dateEnvoiForm = new \DateTime();
    $semaine->setDateDebutSemaine($dateEnvoiForm);
    $semaine->setEtatSemaine("1");
    $semaine->setPourcentageRealiserSemaine("25.00");
    
    $exercice = new Exercices();
    $exercice->setTitreExercice("Squat titre exo 1");
    $exercice->setDureeExercice("15.00");
    $exercice->setFrequenceExercice("3");
    $exercice->setEtatExercice("1");
    $exercice->setMaterielExercice("haletre");
    $exercice->setContenuFacileExercice("1");
    $exercice->setContenuDifficileExercice("0");
    $exercice->setProtocoles($protocole);
    $exercice->setSemaines($semaine);

    $manager->persist($exercice);
    $manager->flush();
}
}
   
   
    