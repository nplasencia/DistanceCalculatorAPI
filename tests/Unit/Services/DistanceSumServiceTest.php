<?php

declare(strict_types=1);

namespace Unit\Services;

use App\Models\Distance;
use App\Services\DistanceSumService;
use PHPUnit\Framework\TestCase;

final class DistanceSumServiceTest extends TestCase
{
    private DistanceSumService $service;

    public function setUp(): void
    {
        $this->service = new DistanceSumService();
    }

    public function test_distanceSumService_twoDistances_sameUnits_sameResultUnit()
    {
        $unit = 'meter';

        $distance1 = new Distance(1.23, $unit);
        $distance2 = new Distance(4.56, $unit);
        $distances = [$distance1, $distance2];

        $result = $this->service->sum($distances, $unit);
        $expected = new Distance(5.79, 'meter');
        $this->assertEquals($expected, $result);
    }
}
