<?php

declare(strict_types=1);

namespace Unit\Models;

use App\Models\Distance;
use PHPUnit\Framework\TestCase;

final class DistanceTest extends TestCase
{
    public function test_distance_jsonEncode_success()
    {
        $value = 1.23;
        $unit = 'meter';

        $distance = new Distance($value, $unit);

        $expected = '{"value":1.23,"unit":"meter"}';
        $this->assertSame($expected, json_encode($distance));
    }

    public function test_distance_createFromJson_success()
    {
        $distanceObjectString = '{"value":1.23,"unit":"meter"}';
        $distance = Distance::createFromJsonString($distanceObjectString);

        $expected = new Distance(1.23, 'meter');
        $this->assertEquals($expected, $distance);
    }

    public function test_distance_createFromJsonObject_success()
    {
        $distanceObjectString = '{"value":1.23,"unit":"meter"}';
        $distanceObject = json_decode($distanceObjectString, false, 512, JSON_THROW_ON_ERROR);
        $distance = Distance::createFromJsonObject($distanceObject);

        $expected = new Distance(1.23, 'meter');
        $this->assertEquals($expected, $distance);
    }
}
