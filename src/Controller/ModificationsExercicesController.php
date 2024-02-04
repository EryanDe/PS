<?php

namespace App\Controller;

use App\Entity\Exercices;
use App\Form\ExercicesType;
use App\Repository\ExercicesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/exercices')]
class ModificationsExercicesController extends AbstractController
{
    #[Route('/', name: 'app_modifications_exercices_index', methods: ['GET'])]
    public function index(ExercicesRepository $exercicesRepository): Response
    {
        return $this->render('modifications_exercices/index.html.twig', [
            'exercices' => $exercicesRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_modifications_exercices_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $exercice = new Exercices();
        $form = $this->createForm(ExercicesType::class, $exercice);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($exercice);
            $entityManager->flush();

            return $this->redirectToRoute('app_modifications_exercices_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('modifications_exercices/new.html.twig', [
            'exercice' => $exercice,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_modifications_exercices_show', methods: ['GET'])]
    public function show(Exercices $exercice): Response
    {
        return $this->render('modifications_exercices/show.html.twig', [
            'exercice' => $exercice,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_modifications_exercices_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Exercices $exercice, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ExercicesType::class, $exercice);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_modifications_exercices_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('modifications_exercices/edit.html.twig', [
            'exercice' => $exercice,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_modifications_exercices_delete', methods: ['POST'])]
    public function delete(Request $request, Exercices $exercice, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$exercice->getId(), $request->request->get('_token'))) {
            $entityManager->remove($exercice);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_modifications_exercices_index', [], Response::HTTP_SEE_OTHER);
    }
}
