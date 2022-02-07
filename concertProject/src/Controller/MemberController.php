<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted; 
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\MemberRepository;
use App\Form\MemberType;
use App\Entity\Member;

class MemberController extends AbstractController
{
    /**
     * @Route("/member", name="member")
     */
    public function index(): Response
    {
        return $this->render('member/index.html.twig', [
            'controller_name' => 'MemberController',
        ]);
    }

    /**
     * Displays the admin backoffice (member route)
     * 
     * @Route("member/admin", name="member_admin")
     * @isGranted("ROLE_ADMIN") 
     */
    public function admin(MemberRepository $memberRepository): Response
    {
        return $this->render('member/admin.html.twig', [
            'controller_name' => 'MemberController',
            'memberList' => $memberRepository->findAll(),
        ]);
    }

    /**
     * Create a member
     * 
     * @Route("/member/create", name="member_create")
     * @isGranted("ROLE_ADMIN") 
     */
    public function createMember(Request $request): Response
    {
        $member = new Member();
        
        $form = $this->createForm(MemberType::class, $member);

        // Checks if the form has been submited
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() contains the submitted values
            // but, $member has been updated
            $member = $form->getData();
            $file = $form['picture']->getData();

            // This is the path where we're going to store the image
            $imgFolder = $this->getParameter('kernel.project_dir').'/public/img';
            
            // Checks if an image has been uploaded 
            if ($file != NULL) {
                // Picks a randow number between 1 and 999999999.
                // We do this to avoid overwritting the image if we upload an image that already exists.
                $randomPrefix = rand(1, 999999999);

                // Setting the image
                $member->setPicture($randomPrefix.$file->getClientOriginalName());

                // Move the image in the 'public/img'
                $file->move($imgFolder, $member->getPicture());
            }

            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
             $entityManager = $this->getDoctrine()->getManager();
             $entityManager->persist($member);
             $entityManager->flush();

            $this->addFlash('Success', 'Success : member created !');

            return $this->redirectToRoute('member_admin');
        }

        return $this->render('member/new.html.twig', [
            'controller_name' => 'MemberController',
            'form' => $form->createView()
        ]);
    }


    /**
     * Update a member
     * 
     * @Route("/member/update/{id}", name="member_update")
     * @isGranted("ROLE_ADMIN") 
     */
    public function updateMember(Request $request, Member $member): Response
    {
        
        $form = $this->createForm(MemberType::class, $member);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $member = $form->getData();

            $file = $form['picture']->getData();

            $imgFolder = $this->getParameter('kernel.project_dir').'/public/img';
            
            if ($file != NULL) {
                $member->setPicture($file->getClientOriginalName());
                $file->move($imgFolder, $file->getClientOriginalName());
            }

             $entityManager = $this->getDoctrine()->getManager();
             $entityManager->persist($member);
             $entityManager->flush();

            $this->addFlash('Success', 'Success : member updated !');

            return $this->redirectToRoute('member_admin');
        }

        return $this->render('member/new.html.twig', [
            'controller_name' => 'MemberController',
            'form' => $form->createView()
        ]);
    }


    /**
     * Delete a member
     * 
     * @Route("member/delete/{id}", name="member_delete")
     * @isGranted("ROLE_ADMIN")
     */
    public function deleteMember(Request $request, Member $member): Response
    {
             $entityManager = $this->getDoctrine()->getManager();
             $entityManager->remove($member);
             $entityManager->flush();

            $this->addFlash('Success', 'Success : member removed !');

            return $this->redirectToRoute('member_admin');
    }
}
