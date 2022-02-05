<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ConcertRepository;

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