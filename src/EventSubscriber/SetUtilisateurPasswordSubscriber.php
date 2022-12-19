<?php

namespace App\EventSubscriber;

use App\Entity\Utilisateur;
use EasyCorp\Bundle\EasyAdminBundle\Event\AbstractLifecycleEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityUpdatedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class SetUtilisateurPasswordSubscriber implements EventSubscriberInterface
{
    public function __construct(private readonly UserPasswordHasherInterface $encoder)
    {
    }

    public function onKernelView(AbstractLifecycleEvent $event): void
    {
        $user = $event->getEntityInstance();

        if (!$user instanceof Utilisateur) {
            return;
        }

        if ($user->getPlainPassword()) {
            $user->setPassword($this->encoder->hashPassword($user, $user->getPlainPassword()));
            $user->eraseCredentials();
        }
    }

    public static function getSubscribedEvents(): array
    {
        return [
            BeforeEntityPersistedEvent::class => ['onKernelView'],
            BeforeEntityUpdatedEvent::class => ['onKernelView'],
        ];
    }
}
