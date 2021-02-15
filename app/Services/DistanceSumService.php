<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Distance;

final class DistanceSumService implements DistanceSumServiceInterface
{
    private DistanceTransformServiceInterface $transformService;

    public function __construct(DistanceTransformServiceInterface $transformService)
    {
        $this->transformService = $transformService;
    }

    /**
     * @param Distance[] $distances
     * @param string $resultUnit
     * @return Distance
     */
    public function sum(array $distances, string $resultUnit): Distance
    {
        $sum = 0;
        foreach ($distances as $distance) {
            $sum += $this->transformService->getTransformedValue($distance, $resultUnit);
        }

        return new Distance(round($sum, 2), $resultUnit);
    }
}
