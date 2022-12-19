<?php

namespace App\EventSubscriber;

use App\Entity\Utilisateur;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class SetUtilisateurPasswordSubscriber implements EventSubscriberInterface
{
    public function __construct(private readonly UserPasswordHasherInterface $encoder)
    {
    }

    public function onKernelView(BeforeEntityPersistedEvent $event): void
    {
        $user = $event->getEntityInstance();

        if (!$user instanceof Utilisateur) {
            return;
        }

        $user->setPassword($this->encoder->hashPassword($user, $user->getPassword()));
    }

    public static function getSubscribedEvents(): array
    {
        return [
            BeforeEntityPersistedEvent::class => ['onKernelView'],
        ];
    }
}
