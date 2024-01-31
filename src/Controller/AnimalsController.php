<?php

namespace App\Controller;

use App\Entity\Animal;
use App\Repository\ActiviteRepository;
use App\Repository\AnimalRepository;
use App\Repository\UtiliserRepository;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AnimalsController extends AbstractController
{
    #[Route('/animaux', name: 'app_animals')]
    public function index(Request $request, AnimalRepository $animalRepository): Response
    {
        $searchAnimals = $request->query->get('search', '');
        $animalSearch = $animalRepository->search($searchAnimals);

        return $this->render('animals/animals.html.twig',
            [
                'animals' => $animalSearch,
                'search' => $searchAnimals,
            ]);
    }

    #[Route('/animaux/img/{id}', name: 'app_image_animals')]
    public function image(Animal $animal): Response
    {
        $imgBlob = $animal->getImage();
        $imgBinary = stream_get_contents($imgBlob);
        fclose($imgBlob);

        $response = new Response($imgBinary);
        $response->headers->set('Content-Type', 'image/png');
        $response->headers->set('Content-Disposition', 'inline; filename="image.png"');

        return $response;
    }

    #[Route('/animaux/{id}', name: 'app_show_animals')]
    public function show(#[MapEntity(expr: 'repository.findById(id)')] Animal $animal,
        ActiviteRepository $activiteRepository,
        UtiliserRepository $utiliserRepository,
    ): Response {
        $activites = [];

        $enclos = $animal->getEnclos();
        if (null !== $enclos) {
            $ac = $enclos->getActivite();
            if (null !== $ac) {
                $activite = $activiteRepository->findById($ac->getId());
                $activite->lieu = $animal->getEnclos()->getNomEnclos();

                $activites[] = $activite;
            }
        }

        $acs = $utiliserRepository->findByAnimalId($animal->getId());
        foreach ($acs as $ac) {
            $activite = $activiteRepository->findById($ac->getId());
            $activite->lieu = $ac->getLieu();

            $activites[] = $activite;
        }

        return $this->render('animals/show.html.twig',
            [
                'animal' => $animal,
                'activites' => $activites,
            ]);
    }
}
