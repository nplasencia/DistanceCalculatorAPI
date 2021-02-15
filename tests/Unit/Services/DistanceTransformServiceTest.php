<?php

declare(strict_types=1);

namespace Unit\Services;

use App\Exceptions\UnsupportedDistanceUnitException;
use App\Models\Distance;
use App\Services\DistanceTransformService;
use PHPUnit\Framework\TestCase;

final class DistanceTransformServiceTest extends TestCase
{
    private DistanceTransformService $service;

    public function setUp(): void
    {
        $this->service = new DistanceTransformService();
    }

    public function test_distanceTransformService_sameResultUnitAsDistanceUnit_success()
    {
        $unit = 'meter';
        $distance = new Distance(1.23, $unit);

        $result = $this->service->getTransformedValue($distance, $unit);
        $this->assertEquals(1.23, $result);
    }

    public function test_distanceTransformService_fromMetersToYards_success()
    {
        $distance = new Distance(1.23, 'meter');

        $result = $this->service->getTransformedValue($distance, 'yard');
        $this->assertEquals(1.35, $result);
    }

    public function test_distanceTransformService_fromYardsToMeters_success()
    {
        $distance = new Distance(1.35, 'yard');

        $result = $this->service->getTransformedValue($distance, 'meter');
        $this->assertEquals(1.23, $result);
    }

    public function test_distanceTransformService_unexpectedResultUnit_throwsException()
    {
        $this->expectException(UnsupportedDistanceUnitException::class);
        $this->expectExceptionMessage('Unsupported Distance Unit [unknown unit]');

        $distance = new Distance(1.35, 'yard');
        $this->service->getTransformedValue($distance, 'unknown unit');
    }
}
