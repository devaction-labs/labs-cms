<?php

namespace App\Utilities\Traits;

trait StringHelpers
{
    private function convertToString(mixed $value): string
    {
        return is_string($value) ? $value : '';
    }
}
