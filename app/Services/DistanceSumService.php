<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Distance;

final class DistanceSumService implements DistanceSumServiceInterface
{
    /**
     * @param Distance[] $distances
     * @param string $resultUnit
     * @return Distance
     */
    public function sum(array $distances, string $resultUnit): Distance
    {
        $sum = array_reduce($distances, function(float $carry, Distance $distance) {
            $carry += $distance->getValue();
            return $carry;
        }, 0);

        return new Distance($sum, $resultUnit);
    }
}
