<?php

function obfuscate_email(?string $email = null): string
{
    if (is_null($email) || !strpos($email, '@')) {
        return '';
    }

    [$firstPart, $secondPart] = explode('@', $email);

    $qty             = (int) floor(strlen($firstPart) * 0.75);
    $remainingFirst  = strlen($firstPart) - $qty;
    $remainingSecond = strlen($secondPart) - $qty;

    $maskedFirstPart  = substr($firstPart, 0, $remainingFirst) . str_repeat('*', $qty);
    $maskedSecondPart = str_repeat('*', $qty) . substr($secondPart, $remainingSecond * -1, $remainingSecond);

    return $maskedFirstPart . '@' . $maskedSecondPart;
}

/**
 * @throws JsonException
 */
function version(): string
{
    $composerJson = file_get_contents(base_path('composer.json'));

    if ($composerJson === false) {
        throw new RuntimeException('Failed to read composer.json');
    }

    $composerData = json_decode($composerJson, true, 512, JSON_THROW_ON_ERROR);

    if (!is_array($composerData) || !isset($composerData['version'])) {
        throw new RuntimeException('Version key not found in composer.json');
    }

    return 'Version:' . $composerData['version'];
}
