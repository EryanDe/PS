<?php

namespace App\Controller;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Articles; // Assurez-vous d'importer la classe Article

class AccueilController extends AbstractController
{
    private $entityManager;

public function __construct(EntityManagerInterface $entityManager)
{
    $this->entityManager = $entityManager;
}

    #[Route('/accueil', name: 'app_accueil')]
    public function index(): Response
{
    // Récupérez les trois derniers articles depuis la base de données
    $repository = $this->entityManager->getRepository(Articles::class);
    $troisDerniersArticles = $repository->findBy([], ['date_creation_article' => 'DESC'], 3);

    return $this->render('accueil/accueil.html.twig', [
        'articles' => $troisDerniersArticles,
    ]);
}
}
