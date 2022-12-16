<?php

namespace App\EventDispatcher\EventSubscriber;

use App\EventDispatcher\Event\RapportOuvertureSoumisEtValideEvent;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class RapportOuvertureSoumisEtValideSubscriber implements EventSubscriberInterface
{
    public function __construct(private readonly EntityManagerInterface $entityManager)
    {
    }

    public function onRapportOuvertureSoumisEtValide(RapportOuvertureSoumisEtValideEvent $event): void
    {
        $arrondissement = $event->getArrondissement();

        $arrondissement->setRapportOuvertureRempli(true);

        $this->entityManager->flush();
    }

    public static function getSubscribedEvents(): array
    {
        return [
            RapportOuvertureSoumisEtValideEvent::class => 'onRapportOuvertureSoumisEtValide',
        ];
    }
}
