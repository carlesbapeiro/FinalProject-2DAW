<?php

namespace App\Controller;

use App\Entity\Practica;
use App\Form\PracticaType;
use App\Repository\PracticaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/practica')]
class PracticaController extends AbstractController
{
    #[Route('/', name: 'practica_index', methods: ['GET'])]
    public function index(PracticaRepository $practicaRepository): Response
    {
        return $this->render('practica/index.html.twig', [
            'practicas' => $practicaRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'practica_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $practica = new Practica();
        $form = $this->createForm(PracticaType::class, $practica);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($practica);
            $entityManager->flush();

            return $this->redirectToRoute('practica_index');
        }

        return $this->render('practica/new.html.twig', [
            'practica' => $practica,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/show/{id}', name: 'practica_show', methods: ['GET'])]
    public function show(Practica $practica): Response
    {
        return $this->render('practica/show.html.twig', [
            'practica' => $practica,
        ]);
    }

    #[Route('/{id}/edit', name: 'practica_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Practica $practica): Response
    {
        $form = $this->createForm(PracticaType::class, $practica);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('practica_index');
        }

        return $this->render('practica/edit.html.twig', [
            'practica' => $practica,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'practica_delete', methods: ['POST'])]
    public function delete(Request $request, Practica $practica): Response
    {
        if ($this->isCsrfTokenValid('delete'.$practica->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($practica);
            $entityManager->flush();
        }

        return $this->redirectToRoute('practica_index');
    }
    #[Route('/filter', name: 'practica_filter', methods: ['GET'])]

    public function filter(Request $request)
    {
        $text = $request->query->getAlnum("text");
        $practicaRepository = $this->getDoctrine()->getRepository(Practica::class);
        $practiques = $practicaRepository->filterByText($text);

        return $this->render('practica/index.html.twig', array(
            'practicas' => $practiques
        ));

    }
}
