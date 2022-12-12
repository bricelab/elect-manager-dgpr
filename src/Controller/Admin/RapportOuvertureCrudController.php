<?php

namespace App\Controller\Admin;

use App\Entity\RapportOuverture;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TimeField;

class RapportOuvertureCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return RapportOuverture::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->showEntityActionsInlined(false)
            ->setEntityLabelInSingular('un rapport d\'ouverture')
            ->setEntityLabelInPlural('Liste des rapports d\'ouverture')
            ->setDefaultSort(['createdAt' => 'ASC'])
        ;
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
//            ->addBatchAction(Action::BATCH_DELETE)
            ->add(Crud::PAGE_INDEX, Action::NEW)
            ->add(Crud::PAGE_INDEX, Action::EDIT)
//            ->add(Crud::PAGE_INDEX, Action::DELETE)

            ->add(Crud::PAGE_DETAIL, Action::EDIT)
//            ->add(Crud::PAGE_DETAIL, Action::DELETE)
            ;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id', 'Identifiant')->onlyOnDetail(),
            DateTimeField::new('createdAt', 'Reçu le'),
            AssociationField::new('arrondissement', 'Arrondissement'),
            AssociationField::new('auteur', 'Auteur'),
            TextareaField::new('ouverture', 'Détails à l\'ouverture'),
            TextareaField::new('incidents', 'Incidents observés'),
            TextareaField::new('difficultes', 'Difficultés rencontrées'),
        ];
    }
}
