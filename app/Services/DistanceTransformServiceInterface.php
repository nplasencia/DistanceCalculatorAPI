<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Distance;

interface DistanceTransformServiceInterface
{
    public function getTransformedValue(Distance $distance, string $resultUnit): float;
}
