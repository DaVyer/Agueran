<?php

namespace App\Controller;

use App\Entity\Activite;
use App\Entity\Reserver;
use App\Form\ReserverType;
use App\Repository\ActiviteRepository;
use App\Repository\EnclosRepository;
use App\Repository\ReserverRepository;
use App\Repository\UtiliserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class ProgramsController extends AbstractController
{
    #[Route('/programme', name: 'app_programs')]
    public function index(
        Request $request,
        ActiviteRepository $activiteRepository,
        EnclosRepository $enclosRepository,
        UtiliserRepository $utiliserRepository
    ): Response {
        $searchPrograms = $request->query->get('search', '');
        $programsSearch = $activiteRepository->search($searchPrograms);

        foreach ($programsSearch as $program) {
            if (true === $program->isEstActiviteAnimal()) {
                $program->lieu = $enclosRepository->findByActiviteId($program->getId())[0]->getNomEnclos();
            } else {
                $program->lieu = $utiliserRepository->findByActiviteId($program->getId())[0]->getLieu();
            }
        }

        return $this->render('programs/index.html.twig',
            [
                'programs' => $programsSearch,
                'search' => $searchPrograms,
            ]
        );
    }

    #[Route('/programme/img/{id}', name: 'app_image_activite')]
    public function image(
        Activite $activite
    ): Response {
        $imgBlob = $activite->getImage();
        $imgBinary = stream_get_contents($imgBlob);
        fclose($imgBlob);

        $response = new Response($imgBinary);
        $response->headers->set('Content-Type', 'image/png');
        $response->headers->set('Content-Disposition', 'inline; filename="image.png"');

        return $response;
    }

    #[Route('/programme/{id}', name: 'app_show_programs')]
    public function show(
        #[MapEntity(expr: 'repository.findById(id)')] Activite $activite,
        ReserverRepository $reserverRepository,
        EnclosRepository $enclosRepository,
        UtiliserRepository $utiliserRepository
    ): Response {
        if (true === $activite->isEstActiviteAnimal()) {
            $lieu = $enclosRepository->findByActiviteId($activite->getId())[0]->getNomEnclos();
        } else {
            $lieu = $utiliserRepository->findByActiviteId($activite->getId())[0]->getLieu();
        }

        $reservations = $reserverRepository->findAll();
        $count = 0;
        foreach ($reservations as $reservation) {
            if ($reservation->getActivite()->getId() == $activite->getId()) {
                $count += $reservation->getNbVisiteurs();
            }
        }

        return $this->render('programs/show.html.twig',
            [
                'lieu' => $lieu,
                'count' => $activite->getNbVisiteurMaxActivite() - $count,
                'activite' => $activite,
            ]
        );
    }

    #[Route('/programme/{id}/reservation', name: 'app_programs_reservation')]
    #[IsGranted('ROLE_USER')]
    public function form(
        #[MapEntity(expr: 'repository.findById(id)')] Activite $activite,
        Request $request,
        EntityManagerInterface $entityManager,
        ReserverRepository $reserverRepository
    ): Response {
        $reservations = $reserverRepository->findAll();
        $count = 0;
        foreach ($reservations as $reservation) {
            if ($reservation->getActivite()->getId() == $activite->getId()) {
                $count += $reservation->getNbVisiteurs();
            }
        }

        $form = $this->createForm(ReserverType::class, null,
            [
                'max' => $activite->getNbVisiteurMaxActivite() - $count,
            ]
        );
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if (0 == $form->getData()->getnbVisiteurs()) {
                return $this->render('programs/form.html.twig',
                    [
                        'activite' => $activite,
                        'titre' => "Réservation : {$activite->getLibActivite()}",
                        'form' => $form->createView(),
                        'error' => 'Vous devez réserver au moins une place !',
                    ]
                );
            }

            $places = $activite->getNbVisiteurMaxActivite() - $count;
            if ($form->getData()->getnbVisiteurs() <= $places) {
                $reservation = new Reserver();
                $reservation->setUser($this->getUser());
                $reservation->setActivite($activite);
                $reservation->setNbVisiteurs($form->getData()->getnbVisiteurs());
                $reservation->setDateReservation($activite->getDateActivite());

                $entityManager->persist($reservation);
                $entityManager->flush();

                return $this->redirectToRoute('app_reservations');
            } else {
                if (0 == $places) {
                    $erreur = "Il n'y a plus de places disponibles pour cette activité !";
                } else {
                    $erreur = "Le nombre de places disponibles est de {$places} !";
                }

                return $this->render('programs/form.html.twig',
                    [
                        'activite' => $activite,
                        'titre' => "Réservation : {$activite->getLibActivite()}",
                        'form' => $form->createView(),
                        'error' => $erreur,
                    ]
                );
            }
        }

        if (0 == $activite->getNbVisiteurMaxActivite() - $count) {
            return $this->render('programs/form.html.twig',
                [
                    'activite' => $activite,
                    'titre' => "Réservation : {$activite->getLibActivite()}",
                    'form' => $form->createView(),
                    'error' => "Il n'y a plus de places disponibles pour cette activité !",
                ]
            );
        } else {
            return $this->render('programs/form.html.twig',
                [
                    'activite' => $activite,
                    'titre' => "Réservation : {$activite->getLibActivite()}",
                    'form' => $form->createView(),
                ]
            );
        }
    }
}
