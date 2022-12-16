<?php

namespace App\EventDispatcher\EventSubscriber;

use ApiPlatform\Symfony\EventListener\EventPriorities;
use App\Entity\IncidentSignale;
use App\Entity\Utilisateur;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class SetAuteurAndArrondissementForIncidentSignaleSubscriber implements EventSubscriberInterface
{
    public function __construct(private readonly Security $security)
    {
    }

    public function onKernelView(ViewEvent $event): void
    {
        $entity = $event->getControllerResult();

        if (!$entity instanceof IncidentSignale) {
            return;
        }

        $user = $this->security->getUser();

        if (!$user instanceof Utilisateur) {
            throw new \LogicException('Une erreur interne  s\'est produite');
        }

        $entity->setArrondissement($user->getArrondissementCouvert());
        $entity->setSignalePar($user);
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
