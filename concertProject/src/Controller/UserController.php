<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\UserRepository;
use App\Form\UserType;
use App\Entity\User;

class UserController extends AbstractController
{
    /**
     * Displays the user's profile page
     * 
     * @Route("/user/{id}", name="user_profile")
     * @isGranted("ROLE_USER")
     */
    public function index(UserRepository $userRepository, int $id): Response
    {

        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
            'id' => $id,
            'user' => $userRepository->find($id),
        ]);
    }

    /**
     * Update a user
     * 
     * @Route("/user/update/{id}", name="user_update")
     * @isGranted("ROLE_USER")
     */
    public function updateUser(Request $request, User $user): Response
    {
        
        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();

            // We encrypt the newly modified password
            $password = password_hash($form['password']->getData(), PASSWORD_BCRYPT);

            $user->setPassword($password);

             $entityManager = $this->getDoctrine()->getManager();
             $entityManager->persist($user);
             $entityManager->flush();

            $this->addFlash('Success', 'Success : user updated !');

            return $this->redirectToRoute('concert');
        }

        return $this->render('user/new.html.twig', [
            'controller_name' => 'UserController',
            'form' => $form->createView()
        ]);
    }
}
