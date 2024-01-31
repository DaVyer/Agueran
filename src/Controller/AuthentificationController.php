<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class AuthentificationController extends AbstractController
{
    private Security $security;
    private UserPasswordHasherInterface $passwordHasherInterface;

    public function __construct(Security $security, UserPasswordHasherInterface $passwordHasher)
    {
        $this->security = $security;

        $this->passwordHasherInterface = $passwordHasher;
    }

    #[Route(path: '/compte', name: 'app_compte')]
    #[IsGranted('ROLE_USER')]
    public function compte(): Response
    {
        $user = $this->security->getUser();

        return $this->render('authentification/show.html.twig', ['user' => $user]);
    }

    #[Route(path: '/compte/revision', name: 'app_compte_update')]
    #[IsGranted('ROLE_USER')]
    public function compte_update(
        EntityManagerInterface $entityManager,
        Request $request
    ): Response {
        $user = $this->security->getUser();
        $form = $this->createForm(UserType::class, $user);
        $form->get('pays')->setData($user->getPays());

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $user->setPrenom($data->getPrenom());
            $user->setNom($data->getNom());
            $user->setEmail($data->getEmail());
            $user->setPassword($this->passwordHasherInterface->hashPassword($user, $data->getPassword()));
            $user->setTelephone($data->getTelephone());
            $user->setAdresse($data->getAdresse());
            $user->setVille($data->getVille());
            $user->setCodePostal($data->getCodePostal());
            $user->setPays($data->getPays());

            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('app_compte');
        }

        return $this->render('authentification/update.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route(path: '/compte/nouveau', name: 'app_compte_create')]
    public function compte_new(
        EntityManagerInterface $entityManager,
        Request $request,
    ): Response {
        $form = $this->createForm(UserType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $user = new User();
            $user->setPrenom($data->getPrenom());
            $user->setNom($data->getNom());
            $user->setEmail($data->getEmail());
            $user->setPassword($this->passwordHasherInterface->hashPassword($user, $data->getPassword()));
            $user->setTelephone($data->getTelephone());
            $user->setAdresse($data->getAdresse());
            $user->setVille($data->getVille());
            $user->setCodePostal($data->getCodePostal());
            $user->setPays($data->getPays());
            $user->setRoles(['ROLE_USER']);

            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('app_compte');
        }

        return $this->render('authentification/create.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route(path: '/compte/supprimer', name: 'app_compte_delete')]
    #[IsGranted('ROLE_USER')]
    public function compte_delete(
        EntityManagerInterface $entityManager,
        TokenStorageInterface $tokenStorage
    ): Response {
        $user = $this->getUser();
        $entityManager->remove($user);
        $entityManager->flush();

        $tokenStorage->setToken(null);

        return $this->redirectToRoute('app_home');
    }

    #[Route(path: '/acces-refuse', name: 'app_access_denied')]
    public function access_denied(): Response
    {
        return $this->render('authentification/access_denied.html.twig');
    }
}
