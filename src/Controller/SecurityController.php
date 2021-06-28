<?php


namespace App\Controller;


use App\Entity\Professor;
use App\Form\ProfessorType;
use App\Repository\AccioRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Routing\Annotation\Route;

class SecurityController extends AbstractController
{

    /**
     * @Route("/login", name="login")
     */
    public function login(AuthenticationUtils $authenticationUtils)
    {
        $user = $this->getUser();
        if($this->isGranted('IS_AUTHENTICATED_FULLY') && $user->getRoles()[0] == 'ROLE_USER'){

            return $this->render('permissions.html.twig');

        }
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();
        return $this->render('security/iniciSessio.html.twig', array(
            'error' => $error,
            'lastUserName'=> $lastUsername
        ));
    }

    #[Route('/registre', name: 'professor_registre', methods: ['GET','POST'])]
    public function registre(Request $request, UserPasswordEncoderInterface $encoder): Response
    {
        $professor = new Professor();
        $form = $this->createForm(ProfessorType::class, $professor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $hashedPassword = $encoder->encodePassword($professor, $professor->getContrassenya());
            $professor->setContrassenya($hashedPassword);
            $professor->setRole('ROLE_USER');

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($professor);
            $entityManager->flush();

            $user = $professor;
            $token = new UsernamePasswordToken($user, null, 'main', $user->getRoles());
            $this->container->get('security.token_storage')->setToken($token);
            $this->container->get('session')->set('_security_main', serialize($token));

            return $this->redirectToRoute('home');


        }

        return $this->render('security/registre.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }

}