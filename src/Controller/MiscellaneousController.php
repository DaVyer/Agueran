<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MiscellaneousController extends AbstractController
{
    #[Route('/cgv', name: 'app_cgv')]
    public function cgv(): Response
    {
        return $this->render('miscellaneous/cgv.html.twig');
    }

    #[Route('/propos', name: 'app_propos')]
    public function propos(): Response
    {
        return $this->render('miscellaneous/propos.html.twig');
    }

    #[Route('/contacter', name: 'app_contacter')]
    public function contacter(): Response
    {
        return $this->render('miscellaneous/contacter.html.twig');
    }

    #[Route('/faq', name: 'app_faq')]
    public function faq(): Response
    {
        return $this->render('miscellaneous/faq.html.twig');
    }

    #[Route('/mentions', name: 'app_mentions')]
    public function mentions(): Response
    {
        return $this->render('miscellaneous/mentions.html.twig');
    }

    #[Route('/confidentialite', name: 'app_confidentialite')]
    public function confidentialite(): Response
    {
        return $this->render('miscellaneous/confidentialite.html.twig');
    }

    #[Route('/emplois', name: 'app_emplois')]
    public function emplois(): Response
    {
        return $this->render('miscellaneous/emplois.html.twig');
    }

    #[Route('/actualites', name: 'app_actualites')]
    public function actualites(): Response
    {
        return $this->render('miscellaneous/actualites.html.twig');
    }

    #[Route('/reglement', name: 'app_reglement')]
    public function reglement(): Response
    {
        return $this->render('miscellaneous/reglement.html.twig');
    }
}
