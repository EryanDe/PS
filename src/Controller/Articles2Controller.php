<?php
namespace App\Controller;
use App\Entity\Articles;
use App\Form\ArticlesType;
use App\Repository\ArticlesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpKernel\KernelInterface;

#[Route('/admin/articles2')]
class Articles2Controller extends AbstractController
{
    #[Route('/', name: 'app_articles2_index', methods: ['GET'])]
    public function index(ArticlesRepository $articlesRepository): Response
    {
        return $this->render('articles2/index.html.twig', [
            'articles' => $articlesRepository->findAll(),
        ]);
    }
    #[Route('/new', name: 'app_articles2_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $article = new Articles();
        $form = $this->createForm(ArticlesType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($article);
            $entityManager->flush();

            return $this->redirectToRoute('app_articles2_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('articles2/new.html.twig', [
            'article' => $article,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_articles2_show', methods: ['GET'])]
    public function show(Articles $article): Response
    {
        return $this->render('articles2/show.html.twig', [
            'article' => $article,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_articles2_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Articles $article, EntityManagerInterface $entityManager, SluggerInterface $slugger, KernelInterface $kernel): Response
    {
        $form = $this->createForm(ArticlesType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Dans votre méthode edit
$file = $form->get('image_article')->getData();
if ($file) {
    $uploadsDirectory = $kernel->getProjectDir() . '/public/assets';

    // Vous pouvez également vouloir utiliser le Slugger pour créer un nom de fichier sûr
    $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
    $safeFilename = $slugger->slug($originalFilename);
    $filename = $safeFilename.'-'.uniqid().'.'.$file->guessExtension();

    try {
        $file->move($uploadsDirectory, $filename);
        // Après avoir déplacé le fichier, vous devez probablement mettre à jour l'entité avec le nom du fichier
        // ou le chemin pour pouvoir le sauvegarder dans la base de données
        $article->setImageArticle($filename); // Assurez-vous que votre entité Articles a une méthode pour définir le chemin de l'image
    } catch (FileException $e) {
        // Gérer l'exception si quelque chose se passe mal lors du téléchargement
    }
}

            $entityManager->flush();

            return $this->redirectToRoute('app_articles2_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('articles2/edit.html.twig', [
            'article' => $article,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_articles2_delete', methods: ['POST'])]
    public function delete(Request $request, Articles $article, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$article->getId(), $request->request->get('_token'))) {
            $entityManager->remove($article);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_articles2_index', [], Response::HTTP_SEE_OTHER);
    }
}
