<?php

namespace App\Controller;

use App\Entity\Users;
use App\Form\RegistrationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
   
    /**
     * login
     *  @Route("/login", name="app_login")
     * @param  AuthenticationUtils $authenticationUtils
     * @return Response
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

      
    /**
     * registration
     * @Route("/registration", name="app_registration")
     * @param  Request $request
     * @param  EntityManagerInterface $em
     * @param  UserPasswordEncoderInterface $encoder
     * @return Response
     */
    public function registration(Request $request,EntityManagerInterface $em,UserPasswordEncoderInterface $encoder ): Response {

        $user = new Users();
        $form = $this->createForm(RegistrationType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $user = $form->getData();
            $hash = $encoder->encodePassword($user,$user->getPassword());
            $user->setPassword($hash);
            
            $em->persist($user);
            $em->flush();
            // dd($user);
            $this->addFlash('success', 'Compte créer avec succes.');
            return $this->redirectToRoute('app_login');
        }
        $response = new Response(null, $form->isSubmitted() ? 422 : 200);
        return $this->render('security/registration.html.twig',[
            'form' => $form->createView(),
        ], $response);
    }

       
    /**
     * logout
     * @Route("/logout", name="app_logout")
     * @return void
     */
    public function logout()
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
