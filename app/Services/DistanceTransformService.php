<?php

declare(strict_types=1);

namespace App\Services;

use App\Exceptions\UnsupportedDistanceUnitException;
use App\Models\Distance;

final class DistanceTransformService implements DistanceTransformServiceInterface
{
    private const METERS_TO_YARDS = 1.09361;
    private const YARDS_TO_METERS = 0.9144;

    public function getTransformedValue(Distance $distance, string $resultUnit): float
    {
        if ($distance->getUnit() === $resultUnit) {
            return $distance->getValue();
        }

        switch ($resultUnit) {
            case 'meter':
                return round($distance->getValue() * self::YARDS_TO_METERS, 2);
            case 'yard':
                return round($distance->getValue() * self::METERS_TO_YARDS, 2);
            default:
                throw new UnsupportedDistanceUnitException($resultUnit);
        }
    }
}
