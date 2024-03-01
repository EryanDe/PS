<?php
namespace App\Controller;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Articles;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
class ArticlesController extends AbstractController
{
    #[Route('/articles', name: 'app_articles')]
    public function index(ManagerRegistry $mr): Response
    {
        $articles = $mr->getRepository(Articles::class)->findall();
        return $this->render('articles/index.html.twig', [
            'articles' => $articles,
        ]);
    }
    #[Route('/articles/{articleId}', name: 'article')]
    public function showArticles(ManagerRegistry $mr, $articleId): Response
    {
        // Récupérez l'article' avec l'ID
        $article = $mr->getRepository(Articles::class)->find($articleId);
    
        // Vérifiez si l'article' existe
        if (!$article) {
            throw $this->createNotFoundException('Article non trouvé');
        }
    
        return $this->render('articles/article.html.twig', [
            
            'article' => $article, // Ajout de la variable article
        ]);
    }
}
