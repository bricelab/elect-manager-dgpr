<?php

namespace App\EventSubscriber;

use ApiPlatform\Symfony\EventListener\EventPriorities;
use App\Entity\RapportOuverture;
use App\Entity\Utilisateur;
use App\Event\RapportOuvertureSoumisEtValideEvent;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class SetAuteurForRapportOuvertureSubscriber implements EventSubscriberInterface
{
    public function __construct(private readonly Security $security, private readonly EventDispatcherInterface $eventDispatcher)
    {
    }

    public function onKernelView(ViewEvent $event): void
    {
        $entity = $event->getControllerResult();

        if (!$entity instanceof RapportOuverture) {
            return;
        }

        $user = $this->security->getUser();

        if (!$user instanceof Utilisateur) {
            throw new \LogicException('Une erreur interne  s\'est produite');
        }

        $entity->setAuteur($user);
    }

    public function triggerRapportOuvertureSoumisEtValideEvent(ViewEvent $event): void
    {
        $entity = $event->getControllerResult();

        if (!$entity instanceof RapportOuverture) {
            return;
        }
        $this->eventDispatcher->dispatch(new RapportOuvertureSoumisEtValideEvent($entity->getArrondissement()));
    }

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::VIEW => [
                ['onKernelView', EventPriorities::PRE_WRITE],
                ['triggerRapportOuvertureSoumisEtValideEvent', EventPriorities::POST_WRITE],
            ],
        ];
    }
}
