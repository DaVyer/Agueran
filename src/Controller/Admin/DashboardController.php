<?php

namespace App\Controller\Admin;

use App\Entity\Activite;
use App\Entity\Animal;
use App\Entity\Billet;
use App\Entity\Categorie;
use App\Entity\Enclos;
use App\Entity\Famille;
use App\Entity\Reserver;
use App\Entity\User;
use App\Repository\ReserverRepository;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\UX\Chartjs\Model\Chart;

class DashboardController extends AbstractDashboardController
{
    public function __construct(private ChartBuilderInterface $chartBuilder,
        ReserverRepository $reserverRepository)
    {
        $this->reserverRepository = $reserverRepository;
    }

    //Ajout des charts de :
    // - nombre de réservation par activité et par personne,
    // - nombre de réservation par mois et par activité,
    // - billet par client
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $reservations = $this->reserverRepository->findAll();

        foreach ($reservations as $reservation) {
            $labels[] = $reservation->getActivite()->getLibActivite();
            $datasets[] = $reservation->getNbVisiteurs();
            $dates[] = $reservation->getDateReservation()->format('d/m/Y');
        }

        $touristBookingChart = $this->createChart($labels, $dates, $datasets);

        $touristBookingChartByMonth = $this->createChart(['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Aout', 'Octobre', 'Septembre', 'Octobre', 'Novembre', 'Décembre'], $dates, $datasets);

        return $this->render('admin/admin.html.twig',
            [
                'touristBookingChart' => $touristBookingChart,
                'touristBookingChartByMonth' => $touristBookingChartByMonth,
            ]);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Panel Admin');
    }

    public function configureAssets(): \EasyCorp\Bundle\EasyAdminBundle\Config\Assets
    {
        $assets = parent::configureAssets();

        $assets->addWebpackEncoreEntry('app');

        return $assets;
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-dashboard');

        yield MenuItem::section('User', 'fa fa-angle-down');
        yield MenuItem::linkToCrud('Users', 'fa fa-caret-right', User::class);
        yield MenuItem::linkToCrud('Reserver', 'fa fa-caret-right', Reserver::class);

        yield MenuItem::section('Animal', 'fa fa-angle-down');
        yield MenuItem::linkToCrud('Animal', 'fa fa-caret-right', Animal::class);
        yield MenuItem::linkToCrud('Categorie', 'fa fa-caret-right', Categorie::class);
        yield MenuItem::linkToCrud('Famille', 'fa fa-caret-right', Famille::class);
        yield MenuItem::linkToCrud('Enclos', 'fa fa-caret-right', Enclos::class);

        yield MenuItem::section('Activite', 'fa fa-angle-down');
        yield MenuItem::linkToCrud('Activite', 'fa fa-caret-right', Activite::class);
        yield MenuItem::linkToCrud('Billet', 'fa fa-caret-right', Billet::class);
    }

    public function createChart(array $labels, ?array $dates, array $datasets)
    {
        $chart = $this->chartBuilder->createChart(Chart::TYPE_BAR);

        if (null == $dates) {
            $dates = '';
        }

        $chart->setData([
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'nombre de visiteurs par réservation',
                    'backgroundColor' => 'rgb(255, 99, 132)',
                    'borderColor' => 'rgb(255, 99, 132)',
                    'data' => [
                        $datasets,
                    ],
                ],
            ],
        ]);

        $chart->setOptions([
            'scales' => [
                'y' => [
                    'suggestedMin' => 0,
                    'suggestedMax' => 100,
                ],
            ],
        ]);

        return $chart;
    }
}
