<?php

namespace App\Controller\Admin;

use App\Entity\Property;
use App\Entity\Section;
use App\Entity\User;
use App\Entity\Watch;
use App\Entity\SubSection;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[isGranted('ROLE_ADMIN')]
class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin.index')]
    public function index(): Response
    {
        return $this->render('admin/index.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Watchphilia')
            ->disableDarkMode();
    }

    public function configureMenuItems(): iterable
    {
        return [
            MenuItem::linkToUrl('Accueil', 'fa fa-house', '/'),
            MenuItem::linkToDashboard('Dashboard', 'fa fa-home'),
            MenuItem::linkToCrud('Montres', 'fa fa-clock', Watch::class),
            MenuItem::linkToCrud('Sections', 'fa fa-section', Section::class),
            MenuItem::linkToCrud('Sous-Sections', 'fa fa-border-top-left', SubSection::class),
            MenuItem::linkToCrud('Propriétés', 'fa fa-percent', Property::class),
            MenuItem::linkToCrud('Utilisateurs', 'fa fa-user', User::class),
        ];
    }
}
