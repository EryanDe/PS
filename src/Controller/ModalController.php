<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ModalController extends AbstractController
{
    #[Route('/modal', name: 'app_modal')]
    public function index(): Response
    {
        // Liste des métiers
        $metiers = [
            'Informatique',
            'Médecine',
            'Enseignement',
            'Ingénierie',
            'Architecture',
            'Comptabilité',
            'Design graphique',
            'Psychologie',
            'Droit',
            'Marketing',
        ];

        // Passer la liste des métiers au template
        return $this->render('modal/index.html.twig', [
            'controller_name' => 'ModalController',
            'metiers' => $metiers, // Ajout de la liste des métiers à la vue
        ]);
    }
}
