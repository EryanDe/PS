<?php

namespace App\Controller;

use App\Repository\ProtocolesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\UtilisateursRepository;

class AdminController extends AbstractController
{
    #[Route('/admin', name: 'app_admin')]
    public function index(UtilisateursRepository $utilisateursRepository, ProtocolesRepository $protocolesRepository): Response
    {
        $nombreUtilisateurs = $utilisateursRepository->count([]);
        $nombreUtilisateursParProtocole = $protocolesRepository->countUsersByProtocole();
        $totalPaiements = $utilisateursRepository->totalPaiementsGeneres();
        
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
            'nombreUtilisateurs' => $nombreUtilisateurs,
            'utilisateursParProtocole' => $nombreUtilisateursParProtocole,
            'totalPaiements' => $totalPaiements,
            
        ]);
    }
}
