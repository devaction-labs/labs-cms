<?php

namespace App\Enums\Onboarding;

/**
 * @0@property string $value
 */
enum StatusEnum: string
{
    case ONBOARDING_PENDING = 'onboarding_pending';

    case ONBOARDING_COMPLETED = 'onboarding_completed';
}
