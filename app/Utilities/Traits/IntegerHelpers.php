<?php

namespace App\Utilities\Traits;

trait IntegerHelpers
{
    private function convertToInteger(mixed $value): int
    {
        return is_numeric($value) ? (int) $value : 0;
    }
}
