<?php

declare(strict_types=1);

namespace Unit\Services;

use App\Models\Distance;
use App\Services\DistanceSumService;
use App\Services\DistanceTransformService;
use PHPUnit\Framework\TestCase;

final class DistanceSumServiceTest extends TestCase
{
    private DistanceSumService $service;

    public function setUp(): void
    {
        $this->service = new DistanceSumService(new DistanceTransformService());
    }

    public function test_distanceSumService_twoDistances_sameUnits_sameResultUnit_success()
    {
        $unit = 'meter';
        $distance1 = new Distance(1.23, $unit);
        $distance2 = new Distance(4.56, $unit);

        $result = $this->service->sum([$distance1, $distance2], $unit);

        $expected = new Distance(5.79, 'meter');
        $this->assertEquals($expected, $result);
    }

    public function test_distanceSumService_twoDistances_sameUnits_differentResultUnit_success()
    {
        $distance1 = new Distance(1.23, 'meter');
        $distance2 = new Distance(4.56, 'meter');

        $result = $this->service->sum([$distance1, $distance2], 'yard');

        $expected = new Distance(6.34, 'yard');
        $this->assertEquals($expected, $result);
    }

    public function test_distanceSumService_twoDistances_differentUnits_differentResultUnit_success()
    {
        $distance1 = new Distance(3.00, 'yard');
        $distance2 = new Distance(5.00, 'meter');

        $result = $this->service->sum([$distance1, $distance2], 'meter');

        $expected = new Distance(7.74, 'meter');
        $this->assertEquals($expected, $result);
    }

    public function test_distanceSumService_oneDistance_sameResultUnit_success()
    {
        $distance = new Distance(3.12, 'yard');;

        $result = $this->service->sum([$distance], 'yard');

        $expected = new Distance(3.12, 'yard');
        $this->assertEquals($expected, $result);
    }

    public function test_distanceSumService_oneDistance_differentResultUnit_success()
    {
        $distance = new Distance(3.00, 'yard');

        $result = $this->service->sum([$distance], 'meter');

        $expected = new Distance(2.74, 'meter');
        $this->assertEquals($expected, $result);
    }

    public function test_distanceSumService_threeDistances_sameUnits_sameResultUnit_success()
    {
        $distance1 = new Distance(1.23, 'meter');
        $distance2 = new Distance(4.56, 'meter');
        $distance3 = new Distance(7.89, 'meter');

        $result = $this->service->sum([$distance1, $distance2, $distance3], 'meter');

        $expected = new Distance(13.68, 'meter');
        $this->assertEquals($expected, $result);
    }

    public function test_distanceSumService_threeDistances_differentUnits_differentResultUnit_success()
    {
        $distance1 = new Distance(3.00, 'yard');
        $distance2 = new Distance(5.00, 'meter');
        $distance3 = new Distance(7.00, 'yard');

        $result = $this->service->sum([$distance1, $distance2, $distance3], 'meter');

        $expected = new Distance(14.14, 'meter');
        $this->assertEquals($expected, $result);
    }
}
