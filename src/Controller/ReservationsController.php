<?php

namespace App\Controller;

use App\Repository\BilletRepository;
use App\Repository\ReserverRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class ReservationsController extends AbstractController
{
    #[Route('/reservations', name: 'app_reservations')]
    #[IsGranted('ROLE_USER')]
    public function index(
        BilletRepository $billetRepository,
        ReserverRepository $reserverRepository,
    ): Response {
        $billets = $billetRepository->findByUserId($this->getUser()->getId());

        foreach ($billets as $billet) {
            $billet->code = $this->generateCode($billet, $billet->getId());
        }

        $evenements = $reserverRepository->findByUserId($this->getUser()->getId());

        $evenements = array_map(function ($evenement) {
            return $evenement->getActivite();
        }, $evenements);

        return $this->render('reservations/index.html.twig', [
            'billets' => $billets,
            'evenements' => $evenements,
        ]);
    }

    public function generateCode($billet, $id): string
    {
        $data = [
            'Plein tarif' => '1',
            'Tarif réduit' => '2',
            'Moins de 10 ans' => '3',
        ];

        $code = $billet->getDateReservation()->format('Ymd');
        $code .= $billet->getVisiteur()->getId();
        $code .= $id;
        $code .= $data[$billet->getType()];
        $code .= $billet->getDateAchat()->format('Ymd');
        $code .= $id;

        return $code;
    }
}
