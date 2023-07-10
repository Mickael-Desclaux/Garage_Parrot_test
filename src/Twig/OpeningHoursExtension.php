<?php

namespace App\Twig;

use Twig\TwigFilter;
use Twig\TwigFunction;
use App\Service\OpeningHoursService;
use Twig\Extension\AbstractExtension;

class OpeningHoursExtension extends AbstractExtension
{
    private $openingHoursService;

    public function __construct(OpeningHoursService $openingHoursService)
    {
        $this->openingHoursService = $openingHoursService;
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('get_opening_hours', [$this, 'getOpeningHours']),
        ];
    }

    public function getOpeningHours()
    {
        return $this->openingHoursService->getOpeningHours();
    }

    public function getFilters()
{
    return [
        new TwigFilter('sort_days', [$this, 'sortDays']),
    ];
}

public function sortDays($openingHours)
{
    $order = [
        'Lundi',
        'Mardi',
        'Mercredi',
        'Jeudi',
        'Vendredi',
        'Samedi',
        'Dimanche',
    ];

    usort($openingHours, function ($a, $b) use ($order) {
        $dayA = $a->getDay();
        $dayB = $b->getDay();

        return array_search($dayA, $order) - array_search($dayB, $order);
    });

    return $openingHours;
}
}
