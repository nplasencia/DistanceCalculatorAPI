<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Distance;

interface DistanceSumServiceInterface
{
    public function sum(array $distances, string $resultUnit): Distance;
}
