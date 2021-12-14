<?php

namespace App\Controller;

use App\Entity\Trip;
use App\Form\TripType;
use App\Service\GeoService;
use App\Repository\CityRepository;
use App\Repository\TripRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/trip')]
class TripController extends AbstractController
{
    #[Route('/', name: 'trip_index', methods: ['GET'])]
    public function index(TripRepository $tripRepository): Response
    {
        return $this->render('trip/index.html.twig', [
            'trips' => $tripRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'trip_new', methods: ['GET', 'POST'])]
    public function new(
        Request $request, 
        EntityManagerInterface $entityManager,
        CityRepository $cityRepo,
        GeoService $gs): Response
    {
        $trip = new Trip();
        $form = $this->createForm(TripType::class, $trip);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $d = $this->getDistance($request, $cityRepo, $gs);

            $trip->setDistance($d);
            $entityManager->persist($trip);
            $entityManager->flush();

            return $this->redirectToRoute('trip_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('trip/new.html.twig', [
            'trip' => $trip,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'trip_show', methods: ['GET'])]
    public function show(Trip $trip): Response
    {
        return $this->render('trip/show.html.twig', [
            'trip' => $trip,
        ]);
    }

    #[Route('/{id}/edit', name: 'trip_edit', methods: ['GET', 'POST'])]
    public function edit(
        Request $request,
        Trip $trip,
        EntityManagerInterface $entityManager,
        CityRepository $cityRepo,
        GeoService $gs): Response
    {
        $form = $this->createForm(TripType::class, $trip);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $d = $this->getDistance($request, $cityRepo, $gs);

            $trip->setDistance($d);
            $entityManager->flush();

            return $this->redirectToRoute('trip_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('trip/edit.html.twig', [
            'trip' => $trip,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'trip_delete', methods: ['POST'])]
    public function delete(Request $request, Trip $trip, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$trip->getId(), $request->request->get('_token'))) {
            $entityManager->remove($trip);
            $entityManager->flush();
        }

        return $this->redirectToRoute('trip_index', [], Response::HTTP_SEE_OTHER);
    }

    private function getDistance($request, $cityRepo, $gs)
    {
        $fromCity = $cityRepo->find($request->request->get("trip")['fromCity']);
        $toCity = $cityRepo->find($request->request->get("trip")['toCity']);
            
        return $gs->calcDistance(
            $fromCity->getLatitude(),
            $fromCity->getLongitude(),
            $toCity->getLatitude(),
            $toCity->getLongitude()
        );
    }

}
