<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\BandRepository;
use App\Form\BandType;
use App\Entity\Band;

class BandController extends AbstractController
{
    /**
     * @Route("/band", name="band")
     */
    public function index(): Response
    {
        return $this->render('band/index.html.twig', [
            'controller_name' => 'BandController',
        ]);
    }

    /**
     * @Route("/band/list", name="bands")
     */
    public function band(BandRepository $bandRepository): Response
    {
        return $this->render('band/list.html.twig', [
            'controller_name' => 'BandController',
            'bandList' => $bandRepository->findAll(),
        ]);
    }

    /**
     * @Route("band/admin", name="band_admin")
     */
    public function admin(BandRepository $bandRepository): Response
    {
        return $this->render('band/admin.html.twig', [
            'controller_name' => 'BandController',
            'bandList' => $bandRepository->findAll(),
        ]);
    }

    /**
     * Create a band
     * 
     * @Route("/band/create", name="band_create")
     */
    public function createBand(Request $request): Response
    {
        $band = new Band();
        
        $form = $this->createForm(BandType::class, $band);

        // Checks if the form has been submited
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() contains the submitted values
            // but, $band has been updated
            $band = $form->getData();
            $file = $form['logo']->getData();

            // This is the path where we're going to store the image
            $imgFolder = $this->getParameter('kernel.project_dir').'/public/img';
            
            // Checks if an image has been uploaded 
            if ($file != NULL) {
                // Picks a randow number between 1 and 999999999.
                // We do this to avoid overwritting the image if we upload an image that already exists.
                $randomPrefix = rand(1, 999999999);

                // Setting the image
                $band->setLogo($randomPrefix.$file->getClientOriginalName());

                // Move the image in the 'public/img'
                $file->move($imgFolder, $band->getLogo());
            }

            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
             $entityManager = $this->getDoctrine()->getManager();
             $entityManager->persist($band);
             $entityManager->flush();

            $this->addFlash('Success', 'Success : band created !');

            return $this->redirectToRoute('band_admin');
        }

        return $this->render('band/new.html.twig', [
            'controller_name' => 'BandController',
            'form' => $form->createView()
        ]);
    }


    /**
     * Update a band
     * 
     * @Route("/band/update/{id}", name="band_update")
     */
    public function updateBand(Request $request, Band $band): Response
    {
        
        $form = $this->createForm(BandType::class, $band);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $band = $form->getData();

            $file = $form['logo']->getData();

            $imgFolder = $this->getParameter('kernel.project_dir').'/public/img';
            
            if ($file != NULL) {
                $band->setLogo($file->getClientOriginalName());
                $file->move($imgFolder, $file->getClientOriginalName());
            }

             $entityManager = $this->getDoctrine()->getManager();
             $entityManager->persist($band);
             $entityManager->flush();

            $this->addFlash('Success', 'Success : band updated !');

            return $this->redirectToRoute('band_admin');
        }

        return $this->render('band/new.html.twig', [
            'controller_name' => 'BandController',
            'form' => $form->createView()
        ]);
    }

    
    /**
     * Delete a band
     * 
     * @Route("band/delete/{id}", name="band_delete")
     */
    public function deleteBand(Request $request, Band $band): Response
    {
             $entityManager = $this->getDoctrine()->getManager();
             $entityManager->remove($band);
             $entityManager->flush();

            $this->addFlash('Success', 'Success : band removed !');

            return $this->redirectToRoute('band_admin');
    }

    /**
     * @Route("/band/{id}", name="band_show")
     */
    public function show(BandRepository $bandRepository, int $id): Response
    {
        return $this->render('band/show.html.twig', [
            'controller_name' => 'BandController',
            'band' => $bandRepository->find($id),
         ]);
    }
    
}
