<?php

namespace App\Controller;

use App\Entity\Accio;
use App\Form\AccioType;
use App\Repository\AccioRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/accio')]
class AccioController extends AbstractController
{
    #[Route('/', name: 'accio_index', methods: ['GET'])]
    public function index(AccioRepository $accioRepository): Response
    {

        return $this->render('accio/index.html.twig', [
            'accios' => $accioRepository->findAll(),
        ]);


    }

    #[Route('/new', name: 'accio_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $accio = new Accio();
        $form = $this->createForm(AccioType::class, $accio);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($accio);
            $entityManager->flush();

            return $this->redirectToRoute('accio_index');
        }

        return $this->render('accio/new.html.twig', [
            'accio' => $accio,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/show/{id}', name: 'accio_show', methods: ['GET'])]
    public function show(Accio $accio): Response
    {
        return $this->render('accio/show.html.twig', [
            'accio' => $accio,
        ]);
    }

    #[Route('/{id}/edit', name: 'accio_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Accio $accio): Response
    {
        $form = $this->createForm(AccioType::class, $accio);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('accio_index');
        }

        return $this->render('accio/edit.html.twig', [
            'accio' => $accio,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'accio_delete', methods: ['POST'])]
    public function delete(Request $request, Accio $accio): Response
    {
        if ($this->isCsrfTokenValid('delete'.$accio->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($accio);
            $entityManager->flush();
        }

        return $this->redirectToRoute('accio_index');
    }
    #[Route('/filter', name: 'accio_filter', methods: ['GET'])]

    public function filter(Request $request)
    {
        $text = $request->query->getAlnum("text");
        $accioRepository = $this->getDoctrine()->getRepository(Accio::class);
        $accions = $accioRepository->filterByText($text);

        return $this->render('accio/index.html.twig', array(
            'accios' => $accions
        ));

    }
}
