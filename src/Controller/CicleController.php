<?php

namespace App\Controller;

use App\Entity\Alumne;
use App\Entity\Cicle;
use App\Form\CicleType;
use App\Repository\AlumneRepository;
use App\Repository\CicleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/cicle')]
class CicleController extends AbstractController
{
    #[Route('/', name: 'cicle_index', methods: ['GET'])]
    public function index(CicleRepository $cicleRepository): Response
    {
        return $this->render('cicle/index.html.twig', [
            'cicles' => $cicleRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'cicle_new', methods: ['GET', 'POST'])]
    public function new(Request $request,AlumneRepository $alumneRepository): Response
    {
        $cicle = new Cicle();
        $form = $this->createForm(CicleType::class, $cicle);
        $form->handleRequest($request);

/*        $alumne = new Alumne();
        $alumne = $alumneRepository->find('1');
        $cicle ->addAlumne($alumne);*/

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($cicle);
            $entityManager->flush();

            return $this->redirectToRoute('cicle_index');
        }

        return $this->render('cicle/new.html.twig', [
            'cicle' => $cicle,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'cicle_show', methods: ['GET'])]
    public function show(Cicle $cicle, AlumneRepository $alumneRepository): Response
    {
        
/*        $alumne = $alumneRepository->findBy(["cicle" => $cicle]);*/
/*        $alumnes = $alumneRepository->findAll();

        $length = count($alumnes);
        for($i = 0; $i < $length; $i++)
        $cicle ->addAlumne($alumnes[$i]);*/

        return $this->render('cicle/show.html.twig', [
            'cicle' => $cicle,
/*            'alumnes' =>$alumnes,*/
        ]);
    }

    #[Route('/{id}/edit', name: 'cicle_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Cicle $cicle): Response
    {
        $form = $this->createForm(CicleType::class, $cicle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('cicle_index');
        }

        return $this->render('cicle/edit.html.twig', [
            'cicle' => $cicle,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'cicle_delete', methods: ['POST'])]
    public function delete(Request $request, Cicle $cicle): Response
    {
        if ($this->isCsrfTokenValid('delete'.$cicle->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($cicle);
            $entityManager->flush();
        }

        return $this->redirectToRoute('cicle_index');
    }
}
