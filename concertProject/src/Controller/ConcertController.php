<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ConcertRepository;
use App\Form\ConcertType;
use App\Entity\Concert;

class ConcertController extends AbstractController
{


    /**
     * @Route("/concert", name="concert")
     */
    public function index(ConcertRepository $concertRepository): Response
    {
        return $this->render('concert/index.html.twig', [
            'controller_name' => 'ConcertController',
            'concertList' => $concertRepository->findAll(),
            'currentDate' => date('d-m-Y')
        ]);
    }


    /**
     * @Route("concert/list", name="concerts")
     */
    public function list(ConcertRepository $concertRepository): Response
    {
        return $this->render('concert/list.html.twig', [
            'controller_name' => 'ConcertController',
            'concertList' => $concertRepository->findAll(),
            'currentDate' => date('d-m-Y')
        ]);
    }

    /**
     * @Route("concert/admin", name="concert_admin")
     */
    public function admin(ConcertRepository $concertRepository): Response
    {
        return $this->render('concert/admin.html.twig', [
            'controller_name' => 'ConcertController',
            'concertList' => $concertRepository->findAll(),
            'currentDate' => date('d-m-Y')
        ]);
    }


    /**
     * Create a concert
     * 
     * @Route("/concert/create", name="concert_create")
     */
    public function createConcert(Request $request): Response
    {
        $concert = new Concert();
        
        $form = $this->createForm(ConcertType::class, $concert);

        // Checks if the form has been submited
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() contains the submitted values
            // but, $concert has been updated
            $concert = $form->getData();
            $file = $form['logo']->getData();

            // This is the path where we're going to store the image
            $imgFolder = $this->getParameter('kernel.project_dir').'/public/img';
            
            // Checks if an image has been uploaded 
            if ($file != NULL) {
                // Picks a randow number between 1 and 999999999.
                // We do this to avoid overwritting the image if we upload an image that already exists.
                $randomPrefix = rand(1, 999999999);

                // Setting the image
                $concert->setLogo($randomPrefix.$file->getClientOriginalName());

                // Move the image in the 'public/img'
                $file->move($imgFolder, $concert->getLogo());
            }

            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
             $entityManager = $this->getDoctrine()->getManager();
             $entityManager->persist($concert);
             $entityManager->flush();

            $this->addFlash('Success', 'Success : concert created !');

            return $this->redirectToRoute('concert_admin');
        }

        return $this->render('concert/new.html.twig', [
            'controller_name' => 'ConcertController',
            'form' => $form->createView()
        ]);
    }


    /**
     * Update a concert
     * 
     * @Route("/concert/update/{id}", name="concert_update")
     */
    public function updateConcert(Request $request, Concert $concert): Response
    {
        
        $form = $this->createForm(ConcertType::class, $concert);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $concert = $form->getData();

            $file = $form['logo']->getData();

            $imgFolder = $this->getParameter('kernel.project_dir').'/public/img';
            
            if ($file != NULL) {
                $concert->setLogo($file->getClientOriginalName());
                $file->move($imgFolder, $file->getClientOriginalName());
            }

             $entityManager = $this->getDoctrine()->getManager();
             $entityManager->persist($concert);
             $entityManager->flush();

            $this->addFlash('Success', 'Success : concert updated !');

            return $this->redirectToRoute('concert_admin');
        }

        return $this->render('concert/new.html.twig', [
            'controller_name' => 'ConcertController',
            'form' => $form->createView()
        ]);
    }


    /**
     * Delete a concert
     * 
     * @Route("concert/delete/{id}", name="concert_delete")
     */
    public function deleteConcert(Request $request, Concert $concert): Response
    {
             $entityManager = $this->getDoctrine()->getManager();
             $entityManager->remove($concert);
             $entityManager->flush();

            $this->addFlash('Success', 'Success : concert removed !');

            return $this->redirectToRoute('concert_admin');
    }


    /**
     * @Route("/concert/{id}", name="concert_show")
     */
    public function show(ConcertRepository $concertRepository, int $id): Response
    {
        return $this->render('concert/show.html.twig', [
            'controller_name' => 'ConcertController',
            'concert' => $concertRepository->find($id),
         ]);
    }
}