<?php

namespace App\Controller;

use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Protocoles;
use App\Entity\Exercices;
use App\Entity\Semaines;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SportController extends AbstractController
{
    #[Route('/sport', name: 'app_sport')]
    public function index(): Response
    {
        return $this->render('sport/index.html.twig', [
            'controller_name' => 'SportController',
        ]);
    }

    #[Route('/protocoles/{protocolId}', name: 'protocole')]
    public function showExercicesForProtocol(ManagerRegistry $mr, $protocolId): Response
    {
        // Récupérez le protocole avec l'ID
        $protocole = $mr->getRepository(Protocoles::class)->find($protocolId);
       
    
        // Vérifiez si le protocole existe
        if (!$protocole) {
            throw $this->createNotFoundException('Protocole non trouvé');
        }
    
        // Récupérez tous les exercices liés à ce protocole
        $exercices = $protocole->getRelation();
        return $this->render('protocoles/index.html.twig', [
            'exercices' => $exercices,
            'protocole' => $protocole, // Ajout de la variable protocole
        ]);
    }
}

