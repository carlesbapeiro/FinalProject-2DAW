<?php

namespace App\Controller;

use App\Entity\Empresa;
use App\Entity\Professor;
use App\Form\EmpresaType;
use App\Repository\EmpresaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/empresa')]
class EmpresaController extends AbstractController
{
    #[Route('/', name: 'empresa_index', methods: ['GET'])]
    public function index(EmpresaRepository $empresaRepository): Response
    {
        return $this->render('empresa/index.html.twig', [
            'empresas' => $empresaRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'empresa_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $empresa = new Empresa();
        $form = $this->createForm(EmpresaType::class, $empresa);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($empresa);
            $entityManager->flush();

            return $this->redirectToRoute('empresa_index');
        }

        return $this->render('empresa/new.html.twig', [
            'empresa' => $empresa,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/show/{id}', name: 'empresa_show', methods: ['GET'])]
    public function show(Empresa $empresa): Response
    {
        return $this->render('empresa/show.html.twig', [
            'empresa' => $empresa,
        ]);
    }

    #[Route('/{id}/edit', name: 'empresa_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Empresa $empresa): Response
    {
        $form = $this->createForm(EmpresaType::class, $empresa);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('empresa_index');
        }

        return $this->render('empresa/edit.html.twig', [
            'empresa' => $empresa,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'empresa_alta', methods: ['POST'])]
    public function alta(Request $request, Empresa $empresa): Response
    {
        if ($this->isCsrfTokenValid('delete'.$empresa->getId(), $request->request->get('_token'))) {

            $alta = $empresa->getAlta();
            if($alta == true){
                $empresa->setAlta(false);
            }else{
                $empresa->setAlta(true);
            }
            $this->getDoctrine()->getManager()->flush();
        }

        return $this->redirectToRoute('empresa_index');
    }
    #[Route('/filter', name: 'empresa_filter', methods: ['GET'])]

    public function filter(Request $request)
    {
        $text = $request->query->getAlnum("text");
        $representantRepository = $this->getDoctrine()->getRepository(Empresa::class);
        $empreses = $representantRepository->filterByText($text);

        return $this->render('empresa/index.html.twig', array(
            'empresas' => $empreses
        ));

    }


}
