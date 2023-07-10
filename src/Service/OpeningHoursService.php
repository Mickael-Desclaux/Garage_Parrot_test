<?php

namespace App\Service;

use App\Entity\OpeningHours;
use Doctrine\Persistence\ManagerRegistry;

class OpeningHoursService
{
    private $doctrine;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    public function getOpeningHours()
    {
        $repository = $this->doctrine->getRepository(OpeningHours::class);
        $opening = $repository->findAll();

        return $opening;
    }
}
