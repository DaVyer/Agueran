<?php

namespace App\Controller;

use App\Entity\Activite;
use App\Repository\ActiviteRepository;
use App\Repository\AnimalRepository;
use App\Repository\BilletRepository;
use App\Repository\EnclosRepository;
use App\Repository\UserRepository;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class AdminController extends AbstractController
{
    #[Route('/administration', name: 'app_admin')]
    #[IsGranted('ROLE_SOIGNEUR')]
    public function index(): Response
    {
        return $this->render('admin/index.html.twig');
    }

    #[Route('/administration/clients', name: 'app_admin_liste_clients')]
    #[IsGranted('ROLE_SOIGNEUR')]
    public function liste_clients(
        Request $request,
        UserRepository $userRepository
    ): Response {
        $clients = $userRepository->findByFilters(
            $request->query->get('nom', ''),
            $request->query->get('prenom', ''),
            $request->query->get('email', '')
        );

        return $this->render('admin/liste_clients.html.twig', [
            'clients' => $clients,
        ]);
    }

    #[Route('/administration/billets', name: 'app_admin_liste_billets')]
    #[IsGranted('ROLE_SOIGNEUR')]
    public function liste_billets(
        Request $request,
        BilletRepository $billetRepository
    ): Response {
        $billets = $billetRepository->findByFilters(
            $request->query->get('type', ''),
            $request->query->get('dateReservation', ''),
            $request->query->get('dateAchat', '')
        );

        foreach ($billets as $billet) {
            $billet->code = $this->generateCode($billet, $billet->getId());
        }

        return $this->render('admin/liste_billets.html.twig', [
            'billets' => $billets,
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

    #[Route('/administration/animaux', name: 'app_admin_liste_animaux')]
    #[IsGranted('ROLE_SOIGNEUR')]
    public function liste_animaux(
        Request $request,
        AnimalRepository $animalRepository
    ): Response {
        $animaux = $animalRepository->findByFilters(
            $request->query->get('nomAnimal', ''),
            $request->query->get('descAnimal', ''),
            $request->query->get('lieuOriginaireAnimal', '')
        );

        return $this->render('admin/liste_animaux.html.twig', [
            'animaux' => $animaux,
        ]);
    }

    #[Route('/administration/evenements', name: 'app_admin_liste_evenements')]
    #[IsGranted('ROLE_SOIGNEUR')]
    public function liste_evenements(
        Request $request,
        ActiviteRepository $activiteRepository
    ): Response {
        $programs = $activiteRepository->findByFilters(
            $request->query->get('nomActivite', ''),
            $request->query->get('dateActivite', ''),
            $request->query->get('descActivite', '')
        );

        return $this->render('admin/liste_evenements.html.twig', [
            'programmes' => $programs,
        ]);
    }

    #[Route('/administration/evenements/{id}', name: 'app_admin_evenement')]
    #[IsGranted('ROLE_SOIGNEUR')]
    public function liste_evenements_details(
        #[MapEntity(expr: 'repository.findById(id)')]
        Activite $evenement,
    ): Response {
        $reservations = $evenement->getReservations();

        $clients = $reservations->map(function ($client) {
            return $client->getUser();
        });

        return $this->render('admin/liste_evenement_clients.html.twig', [
            'evenement' => $evenement,
            'clients' => $clients,
        ]);
    }

    #[Route('/administration/enclos', name: 'app_admin_liste_enclos')]
    #[IsGranted('ROLE_SOIGNEUR')]
    public function liste_enclos(
        Request $request,
        EnclosRepository $enclosRepository
    ): Response {
        $enclos = $enclosRepository->findByFilters(
            $request->query->get('nomEnclos', ''),
            $request->query->get('descEnclos', '')
        );

        return $this->render('admin/liste_enclos.html.twig', [
            'enclos' => $enclos,
        ]);
    }
}
