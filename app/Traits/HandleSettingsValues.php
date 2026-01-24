<?php

declare(strict_types=1);

namespace App\Traits;

use Exception;

trait HandleSettingsValues
{
    protected function normalizeValue(mixed $value): mixed
    {
        return match ($value) {
            'true' => true,
            'false' => false,
            default => $value,
        };
    }

    protected function decryptIfNeeded(mixed $value): mixed
    {
        try {
            return $this->normalizeValue(decrypt($value));
        } catch (Exception) {
            return $this->normalizeValue($value);
        }
    }
}
