<?php

namespace App\Controller\Admin;

use App\Entity\Utilisateur;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
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
            ->setEntityPermission('ROLE_SUPER_ADMIN')
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
        $roles = [
            'ROLE_USER',
            'ROLE_ADMIN',
            'ROLE_SUPER_ADMIN',
        ];

        yield IdField::new('id', 'Identifiant')->onlyOnDetail();
        yield AssociationField::new('arrondissementCouvert', 'Arrondissement couvert');
        yield TextField::new('nom', 'Nom');
        yield TextField::new('prenoms', 'Prénoms');
        yield EmailField::new('email', 'Adresse mail');
        yield TextField::new('plainPassword', 'Mot de passe')
            ->onlyOnForms()
            ->setFormType(PasswordType::class)
        ;
        yield ChoiceField::new('roles', 'Rôles')
            ->renderAsBadges()
            ->renderExpanded()
            ->setChoices(array_combine($roles, $roles))
            ->allowMultipleChoices()
            ->setPermission('ROLE_SUPER_ADMIN')
        ;
    }
}
