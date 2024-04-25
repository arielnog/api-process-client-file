<?php

namespace App\Enums;

enum FileStatusEnum: string
{
    case UNPROCESSED = "unprocessed";
    case PROCESSED = "processed";

    public static function validValues(): array
    {
        return [
            self::UNPROCESSED->value,
            self::PROCESSED->value,
        ];
    }
}
