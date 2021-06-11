<?php

namespace App\Controller;

use App\Entity\Representant;
use App\Form\Representant1Type;
use App\Repository\RepresentantRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/representant')]
class RepresentantController extends AbstractController
{
    #[Route('/', name: 'representant_index', methods: ['GET'])]
    public function index(RepresentantRepository $representantRepository): Response
    {
        return $this->render('representant/index.html.twig', [
            'representants' => $representantRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'representant_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $representant = new Representant();
        $form = $this->createForm(Representant1Type::class, $representant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($representant);
            $entityManager->flush();

            return $this->redirectToRoute('representant_index');
        }

        return $this->render('representant/new.html.twig', [
            'representant' => $representant,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/show/{id}', name: 'representant_show', methods: ['GET'])]
    public function show(Representant $representant): Response
    {
        return $this->render('representant/show.html.twig', [
            'representant' => $representant,
        ]);
    }

    #[Route('/{id}/edit', name: 'representant_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Representant $representant): Response
    {
        $form = $this->createForm(Representant1Type::class, $representant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('representant_index');
        }

        return $this->render('representant/edit.html.twig', [
            'representant' => $representant,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'representant_alta', methods: ['POST'])]
    public function alta(Request $request, Representant $representant): Response
    {
        if ($this->isCsrfTokenValid('delete'.$representant->getId(), $request->request->get('_token'))) {

            $alta = $representant->getAlta();
            if($alta == true){
                $representant->setAlta(false);
            }else{
                $representant->setAlta(true);
            }

            $this->getDoctrine()->getManager()->flush();
            /*
            $entityManager->remove($representant);
            $entityManager->flush();*/
        }

        return $this->redirectToRoute('representant_index');
    }

    #[Route('/filter', name: 'representant_filter', methods: ['GET'])]

    public function filter(Request $request)
    {
        $text = $request->query->getAlnum("text");
        $representantRepository = $this->getDoctrine()->getRepository(Representant::class);
        $representants = $representantRepository->filterByText($text);

        return $this->render('representant/index.html.twig', array(
            'representants' => $representants
        ));

    }
}
