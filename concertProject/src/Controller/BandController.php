<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\BandRepository;

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
