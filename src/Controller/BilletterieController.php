<?php

namespace App\Controller;

use App\Entity\Billet;
use App\Form\BilletType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class BilletterieController extends AbstractController
{
    #[Route('/billetterie', name: 'app_billetterie')]
    #[IsGranted('ROLE_USER')]
    public function index(
        Request $request,
        EntityManagerInterface $entityManager
    ): Response {
        $form = $this->createForm(BilletType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $billets = array_merge(
                $this->createBillets($form, $form->get('quantity20')->getData(), 'Plein tarif', $entityManager),
                $this->createBillets($form, $form->get('quantity15')->getData(), 'Tarif réduit', $entityManager),
                $this->createBillets($form, $form->get('quantity5')->getData(), 'Moins de 10 ans', $entityManager)
            );

            // On pourrait aussi faire un render ici, mais on redirige vers une autre page pour éviter que si
            // l'utilisateur recharge la page, il ne crée des billets en double !

            // return $this->render('billetterie/achat.html.twig', [
            //    'controller_name' => 'BilletterieController',
            //    'billets' => $billets,
            // ]);

            // Vérification qu'il y a max 50 billets par type de billet
            if ($form->get('quantity20')->getData() > 50 || $form->get('quantity15')->getData() > 50 || $form->get('quantity5')->getData() > 50) {
                return $this->redirectToRoute('app_billetterie');
            }

            // On stocke les billets pour pouvoir les récupérer dans la méthode achat
            $this->addFlash('postData', $billets);

            // On redirige vers la page achat
            return $this->redirectToRoute('app_billetterie_achat');
        }

        return $this->render('billetterie/index.html.twig', [
            'controller_name' => 'BilletterieController',
            'form' => $form->createView(),
        ]);
    }

    #[Route('/billetterie/achat', name: 'app_billetterie_achat')]
    #[IsGranted('ROLE_USER')]
    public function achat(
        Request $request,
    ): Response {
        // On récupère les billets stockés
        $billets = $request->getSession()->getFlashBag()->get('postData')[0] ?? [];

        // Si aucun billet n'a été créé, on redirige vers la billetterie
        if (empty($billets)) {
            return $this->redirectToRoute('app_billetterie');
        }

        return $this->render('billetterie/achat.html.twig', [
            'controller_name' => 'BilletterieController',
            'billets' => $billets,
        ]);
    }

    public function createBillets($form, $quantity, $type, $entityManager): array
    {
        $billets = [];
        for ($i = 0; $i < $quantity; ++$i) {
            $billet = new Billet();
            $billet->setDateAchat(new \DateTime());
            $billet->setDateReservation($form->get('dateReservation')->getData());
            $billet->setType($type);
            $billet->setVisiteur($this->getUser());

            $id = $entityManager->createQueryBuilder()
                ->select('MAX(b.id)')
                ->from(Billet::class, 'b')
                ->getQuery()
                ->getSingleScalarResult();

            $billet->code = $this->generateCode($billet, $id + 1);

            $entityManager->persist($billet);
            $entityManager->flush();

            $billets[] = $billet;
        }

        return $billets;
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
