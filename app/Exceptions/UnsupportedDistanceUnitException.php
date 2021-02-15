<?php

declare(strict_types=1);

namespace App\Exceptions;

use RuntimeException;

final class UnsupportedDistanceUnitException extends RuntimeException
{
    public function __construct(string $distanceUnit)
    {
        $template = 'Unsupported Distance Unit [%s] ';
        parent::__construct(sprintf($template, $distanceUnit));
    }
}
