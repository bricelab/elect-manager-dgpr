<?php

declare(strict_types=1);

namespace App\EventDispatcher\Event;

use App\Entity\Arrondissement;
use Symfony\Contracts\EventDispatcher\Event;

final class RapportOuvertureSoumisEtValideEvent extends Event
{
    public function __construct(private readonly Arrondissement $arrondissement)
    {
    }

    public function getArrondissement(): Arrondissement
    {
        return $this->arrondissement;
    }

}
