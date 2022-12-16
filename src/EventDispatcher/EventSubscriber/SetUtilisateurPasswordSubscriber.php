<?php

namespace App\EventDispatcher\EventSubscriber;

use ApiPlatform\Symfony\EventListener\EventPriorities;
use App\Entity\Utilisateur;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class SetUtilisateurPasswordSubscriber implements EventSubscriberInterface
{
    public function __construct(private readonly UserPasswordHasherInterface $passwordHasher)
    {
    }

    public function onKernelView(ViewEvent $event): void
    {
        $entity = $event->getControllerResult();

        if (!$entity instanceof Utilisateur) {
            return;
        }

        $entity->setPassword($this->passwordHasher->hashPassword($entity, $entity->getPassword()));
    }

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::VIEW => [
                ['onKernelView', EventPriorities::PRE_WRITE],
            ],
        ];
    }
}
