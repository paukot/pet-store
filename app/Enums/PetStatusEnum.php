<?php

namespace App\Enums;

enum PetStatusEnum: int
{
    case NOT_AVAILABLE = 0;
    case AVAILABLE = 1;

    public static function fromValue(int $value): ?string
    {
        foreach (self::cases() as $case) {
            if ($case->value === $value) {
                return $case->name;
            }
        }

        return null;
    }
}
