<?php

namespace App\Controller;

use App\Form\RegisterUserFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use App\Security\LoginAuthAuthenticator;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }

    /**
     * @Route("/register", name="app_register")
     */
    public function register(Request $request, EntityManagerInterface $doctrine, UserPasswordEncoderInterface $encoder,GuardAuthenticatorHandler $guard, LoginAuthAuthenticator $formAuthenticator) {

        $form = $this->createForm(RegisterUserFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $user = $form->getData();
            $password = $user->getPassword();
            $passwordEncode = $encoder->encodePassword($user, $password);
            $user->setPassword($passwordEncode);

        // $user->setRoles(['ROLE_ADMIN', 'ROLE_USER']);
            $user->setRoles(['ROLE_USER']);

            $doctrine->persist($user);
            $doctrine->flush();
            return $this->redirectToRoute("app_login");
            // return $guard->authenticateUserAndHandleSuccess($user, $request, $formAuthenticator, 'getMovies');
        }

        return $this->render("security/register.html.twig",['userForm' => $form->createView()]);
    }

}
