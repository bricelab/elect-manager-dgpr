<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Arrondissement;
use App\Entity\Utilisateur;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

final class CreateNewUserAccount
{

    public function __construct(private readonly EntityManagerInterface $em, private readonly UserPasswordHasherInterface $encoder)
    {
    }

    public function create($email, $password, $role, $nom = null, $prenom = null): Utilisateur
    {
        $arrondissement = $this->em->getRepository(Arrondissement::class)->findOneBy(['nom' => 'ABOMEY-CALAVI']);
        $user = new Utilisateur();
        $user->setEmail($email);
        $user->setPassword($this->encoder->hashPassword($user, $password));
        $user->setNom($nom)->setPrenoms($prenom);
        $user->setRoles($role);
        $user->setArrondissementCouvert($arrondissement);

        $this->em->persist($user);
        $this->em->flush();

        return $user;
    }
}
