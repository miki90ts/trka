<?php

namespace App\Enums;

enum Gender: int
{
    case M = 1;
    case F = 2;

    public function label(): string
    {
        return match ($this) {
            self::M => 'Muški',
            self::F => 'Ženski',
        };
    }
}
