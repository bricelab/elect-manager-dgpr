<?php

namespace App\Controller\Admin;

use App\Entity\Utilisateur;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class UtilisateurCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Utilisateur::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('un utilisateur')
            ->setEntityLabelInPlural('Liste des utilisateurs')
            ;
    }

//    public function configureActions(Actions $actions): Actions
//    {
//        return $actions
//            ->addBatchAction(Action::BATCH_DELETE)
//            ->add(Crud::PAGE_INDEX, Action::NEW)
//            ->add(Crud::PAGE_INDEX, Action::EDIT)
//            ->add(Crud::PAGE_INDEX, Action::DELETE)
//
//            ->add(Crud::PAGE_DETAIL, Action::EDIT)
//            ->add(Crud::PAGE_DETAIL, Action::DELETE)
//        ;
//    }

    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id', 'Identifiant')->onlyOnDetail();
        yield AssociationField::new('arrondissementCouvert', 'Arrondissement couvert');
        yield TextField::new('nom', 'Nom');
        yield TextField::new('prenoms', 'Prénoms');
        yield EmailField::new('email', 'Adresse mail');
        yield TextField::new('password', 'Mot de passe')
            ->onlyWhenCreating()
            ->setFormType(PasswordType::class)
        ;
    }
}
