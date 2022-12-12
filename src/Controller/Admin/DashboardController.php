<?php

namespace App\Controller\Admin;

use App\Entity\Arrondissement;
use App\Entity\Commune;
use App\Entity\Departement;
use App\Entity\RapportOuverture;
use App\Entity\Utilisateur;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        return $this->render('admin/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Elect Manager');
    }

    public function configureCrud(): Crud
    {
        return Crud::new()
            ->showEntityActionsInlined()
            ->setDefaultSort(['nom' => 'ASC'])
        ;
    }

    public function configureActions(): Actions
    {
        return Actions::new()
//            ->addBatchAction(Action::BATCH_DELETE)
//            ->add(Crud::PAGE_INDEX, Action::NEW)
//            ->add(Crud::PAGE_INDEX, Action::EDIT)
//            ->add(Crud::PAGE_INDEX, Action::DELETE)
            ->add(Crud::PAGE_INDEX, Action::DETAIL)

//            ->add(Crud::PAGE_DETAIL, Action::EDIT)
            ->add(Crud::PAGE_DETAIL, Action::INDEX)
//            ->add(Crud::PAGE_DETAIL, Action::DELETE)

            ->add(Crud::PAGE_EDIT, Action::SAVE_AND_RETURN)
            ->add(Crud::PAGE_EDIT, Action::SAVE_AND_CONTINUE)

            ->add(Crud::PAGE_NEW, Action::SAVE_AND_RETURN)
            ->add(Crud::PAGE_NEW, Action::SAVE_AND_ADD_ANOTHER)
        ;
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Rapports d\'ouverture', 'fas fa-report', RapportOuverture::class);
        yield MenuItem::linkToCrud('Départements', 'fas fa-list', Departement::class);
        yield MenuItem::linkToCrud('Communes', 'fas fa-list', Commune::class);
        yield MenuItem::linkToCrud('Arrondissements', 'fas fa-list', Arrondissement::class);
        yield MenuItem::linkToCrud('Utilisateurs', 'fas fa-list', Utilisateur::class);
    }
}
