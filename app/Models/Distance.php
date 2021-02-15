<?php

declare(strict_types=1);

namespace App\Models;

use JsonException;
use JsonSerializable;

final class Distance implements JsonSerializable
{
    private float $value;
    private string $unit;

    public function __construct(float $value, string $unit)
    {
        $this->value = $value;
        $this->unit = $unit;
    }

    /**
     * @param string $jsonString
     * @return Distance
     * @throws JsonException
     */
    public static function createFromJsonString(string $jsonString): Distance
    {
        $object = json_decode($jsonString, false, 512, JSON_THROW_ON_ERROR);
        return new Distance($object->value, $object->unit);
    }

    public function jsonSerialize(): array
    {
        $array = [];

        $properties = get_object_vars($this);
        foreach ($properties as $propertyName => $propertyValue) {
            $array[$propertyName] = $propertyValue;
        }

        return $array;
    }
}
